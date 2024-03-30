<?php

namespace Faker\Provider;

use Exception;
use Faker\Generator;

class FakeCar extends \Faker\Provider\Base
{
    protected const EBCDIC = "0123456789.ABCDEFGH..JKLMN.P.R..STUVWXYZ";
    protected const MODEL_YEAR = "ABCDEFGHJKLMNPRSTVWXY123456789";

    protected FakeCarDataProviderInterface $dataProvider;

    /**
     * @param Generator $generator
     */
    public function __construct(Generator $generator)
    {
        parent::__construct($generator);
        $this->setDataProvider(new FakeCarDataProvider());
    }

    public function setDataProvider(FakeCarDataProviderInterface $dataProvider): void
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * Get vehicle string with brand and model
     *
     * @return string
     */
    public function vehicle(): string
    {
        $vehicleBrand = $this->vehicleBrand();

        return $vehicleBrand.' '.$this->vehicleModel($vehicleBrand);
    }

    /**
     * Get vehicle with brand and model as an array
     *
     * @return array
     */
    public function vehicleArray(): array
    {
        $vehicleBrand = $this->vehicleBrand();

        return [
            'brand' => $vehicleBrand,
            'model' => $this->vehicleModel($vehicleBrand)
        ];
    }

    /**
     * Get random vehicle brand
     *
     * @return string
     */
    public function vehicleBrand(): string
    {
        return (string) $this->dataProvider->getVehicleBrand();
    }

    /**
     * Get random vehicle model
     *
     * @param string $brand Get random model from specific brand (optional)
     *
     * @return mixed
     */
    public function vehicleModel(string $brand = null): string
    {
        return (string) $this->dataProvider->getVehicleModel($brand);
    }

    /**
     * Generate VIN
     * @link https://en.wikipedia.org/wiki/Vehicle_identification_number
     *
     * @param int $year
     *
     * @return mixed
     */
    public function vin(int $year = 1980): string
    {
        $modelYear = static::modelYear($year);
        $regex = "([a-hj-npr-z0-9]{8})_{$modelYear}([a-hj-npr-z0-9]{7})";
        $vin = static::regexify($regex);
        return str_replace('_', self::checkDigit($vin), $vin);
    }

    /**
     * Get vehicle registration number
     *
     * @param string $regex
     *
     * @return string
     */
    public function vehicleRegistration(string $regex = '[A-Z]{3}-[0-9]{3}'): string
    {
        //TODO: Set format based on locale
        return static::regexify($regex);
    }

    /**
     * Get vehicle type
     *
     * @return string
     * @throws Exception
     */
    public function vehicleType(): string
    {
        return (string) $this->dataProvider->getVehicleType();
    }

    /**
     * Get vehicle fuel type
     *
     * @param int $count
     *
     * @return string
     */
    public function vehicleFuelType(int $count = 1): string
    {
        return (string) $this->dataProvider->getVehicleFuelType($count);
    }

    /**
     * Get vehicle door count
     *
     * @return int
     * @throws Exception
     */
    public function vehicleDoorCount(): int
    {
        return (int) $this->dataProvider->getVehicleDoorCount();
    }

    /**
     * Get vehicle door count
     *
     * @return int
     * @throws Exception
     */
    public function vehicleSeatCount(): int
    {
        return (int) $this->dataProvider->getVehicleSeatCount();
    }

    /**
     * Get an array of random vehicle properties
     *
     * @param int $count
     *
     * @return array
     * @throws Exception
     */
    public function vehicleProperties(int $count = 0): array
    {
        return $this->dataProvider->getVehicleProperties($count);
    }

    /**
     * Get random vehicle gearbox type
     *
     * @return mixed
     * @throws Exception
     */
    public function vehicleGearBoxType(): string
    {
        return $this->dataProvider->getVehicleGearBoxType();
    }

    /**
     * Get random vehicle gearbox type without unit
     *
     * @return mixed
     * @throws Exception
     */
    public function vehicleGearBoxTypeValue(): string
    {
        return $this->dataProvider->getVehicleGearBoxType();
    }


    /**
     * Get engine torque
     *
     * @return mixed
     * @throws Exception
     */
    public function vehicleEngineTorque(): string
    {
        return $this->dataProvider->getVehicleEngineTorque();
    }

    /**
     * Get engine torque without unit
     *
     * @return mixed
     * @throws Exception
     */
    public function vehicleEngineTorqueValue(): string
    {
        return $this->dataProvider->getVehicleEngineTorque();
    }

    /**
     * Get engine power (horsepower or kilowatts)
     *
     * @return mixed
     * @throws Exception
     */
    public function vehicleEnginePower(): string
    {
        return $this->dataProvider->getVehicleEnginePower();
    }

    /**
     * Get engine power without unit
     *
     * @return mixed
     * @throws Exception
     */
    public function vehicleEnginePowerValue(): string
    {
        $this->isSupported(__FUNCTION__);

        return $this->dataProvider->getVehicleEnginePowerValue();
    }

    public function isSupported($method): bool
    {
        if (method_exists($this->dataProvider, $method)) {
            return true;
        }

        throw new \RuntimeException('Method not supported be data provider. Please implement '.$method.'() in your data provider.');
    }


    /**
     * @param int $year
     *
     * @return string
     */
    public static function modelYear(int $year = 1980): string
    {
        return substr(self::MODEL_YEAR, ($year - 1980) % 30, 1);
    }

    /**
     * @param string $character
     *
     * @return string
     */
    private static function transliterate(string $character): string
    {
        return stripos(self::EBCDIC, $character) % 10;
    }

    /**php
     * @param string $vin
     *
     * @return mixed
     */
    private static function checkDigit(string $vin): string
    {
        $map = "0123456789X";
        $weights = "8765432X098765432";
        $sum = 0;
        for ($i=0; $i < 17; $i++) {
            $sum += self::transliterate(substr($vin, $i, 1))
                    * stripos($map, $weights[$i]);
        }
        return $map[$sum % 11];
    }

    /**
     * @param $vin
     *
     * @return bool
     */
    public static function validateVin(string $vin): bool
    {
        if (strlen($vin) !== 17) {
            return false;
        }

        return self::checkDigit($vin) == $vin[8];
    }
}
