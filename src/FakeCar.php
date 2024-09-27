<?php

namespace Faker\Provider;

use Exception;
use Faker\Generator;
use InvalidArgumentException;

class FakeCar extends \Faker\Provider\Base
{
    protected const EBCDIC = '0123456789.ABCDEFGH..JKLMN.P.R..STUVWXYZ';

    protected const MODEL_YEAR = 'ABCDEFGHJKLMNPRSTVWXY123456789';

    protected FakeCarDataProviderInterface $dataProvider;

    public function __construct(Generator $generator)
    {
        parent::__construct($generator);
        $this->setDataProvider(new FakeCarDataProvider);
    }

    public function setDataProvider(FakeCarDataProviderInterface $dataProvider): void
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * Get vehicle string with brand and model
     */
    public function vehicle(): string
    {
        $vehicleBrand = $this->vehicleBrand();

        return $vehicleBrand.' '.$this->vehicleModel($vehicleBrand);
    }

    /**
     * Get vehicle with brand and model as an array
     *
     * @return array{brand: string, model: string}
     */
    public function vehicleArray(): array
    {
        $vehicleBrand = $this->vehicleBrand();

        return [
            'brand' => $vehicleBrand,
            'model' => $this->vehicleModel($vehicleBrand),
        ];
    }

    /**
     * Get random vehicle brand
     */
    public function vehicleBrand(): string
    {
        return (string) $this->dataProvider->getVehicleBrand();
    }

    /**
     * Get random vehicle model
     *
     * @param  ?string  $brand  Get a random model from specific brand (optional)
     */
    public function vehicleModel(?string $brand = null): string
    {
        return $this->dataProvider->getVehicleModel($brand);
    }

    /**
     * Generate VIN
     *
     * @link https://en.wikipedia.org/wiki/Vehicle_identification_number
     */
    public function vin(int $year = 1980): string
    {
        $modelYear = self::encodeModelYear($year);
        $regex     = "([a-hj-npr-z0-9]{8})_{$modelYear}([a-hj-npr-z0-9]{7})";
        $vin       = static::regexify($regex);

        return str_replace('_', self::checkDigit($vin), $vin);
    }

    /**
     * Get vehicle registration number
     */
    public function vehicleRegistration(string $regex = '[A-Z]{3}-[0-9]{3}'): string
    {
        //TODO: Set format based on locale
        return static::regexify($regex);
    }

    /**
     * Get a vehicle type
     *
     * @throws Exception
     */
    public function vehicleType(): string
    {
        return (string) $this->dataProvider->getVehicleType();
    }

    /**
     * Get vehicle fuel type(s)
     *
     * @return string|array<string>
     */
    public function vehicleFuelType(int $count = 1): string|array
    {
        return $this->dataProvider->getVehicleFuelType($count);
    }

    /**
     * Get vehicle door count
     *
     * @throws Exception
     */
    public function vehicleDoorCount(): int
    {
        return $this->dataProvider->getVehicleDoorCount();
    }

    /**
     * Get vehicle door count
     *
     * @throws Exception
     */
    public function vehicleSeatCount(): int
    {
        return $this->dataProvider->getVehicleSeatCount();
    }

    /**
     * Get an array of random vehicle properties
     *
     * @return array<string>
     *
     * @throws Exception
     */
    public function vehicleProperties(int $count = 0): array
    {
        return $this->dataProvider->getVehicleProperties($count);
    }

    /**
     * Get random vehicle gearbox type
     *
     * @throws Exception
     */
    public function vehicleGearBoxType(): string
    {
        return $this->dataProvider->getVehicleGearBoxType();
    }

    /**
     * Get a random vehicle gearbox type without a unit
     *
     * @throws Exception
     */
    public function vehicleGearBoxTypeValue(): string
    {
        return $this->dataProvider->getVehicleGearBoxType();
    }

    /**
     * Get engine torque
     *
     * @throws Exception
     */
    public function vehicleEngineTorque(): string
    {
        //TODO: Remove check and add to data provider interface in next major version
        $this->isSupported(__FUNCTION__);

        /** @phpstan-ignore method.notFound */
        return $this->dataProvider->getVehicleEngineTorque();
    }

    /**
     * Get engine torque without a unit
     *
     * @throws Exception
     */
    public function vehicleEngineTorqueValue(): string
    {
        //TODO: Remove check and add to data provider interface in next major version
        $this->isSupported(__FUNCTION__);

        /** @phpstan-ignore method.notFound */
        return $this->dataProvider->getVehicleEngineTorqueValue();
    }

    /**
     * Get engine power (horsepower or kilowatts)
     *
     * @throws Exception
     */
    public function vehicleEnginePower(): string
    {
        //TODO: Remove check and add to data provider interface in next major version
        $this->isSupported(__FUNCTION__);

        /** @phpstan-ignore method.notFound */
        return $this->dataProvider->getVehicleEnginePower();
    }

    /**
     * Get engine power without a unit
     *
     * @throws Exception
     */
    public function vehicleEnginePowerValue(): string
    {
        //TODO: Remove check and add to data provider interface in next major version
        $this->isSupported(__FUNCTION__);

        /** @phpstan-ignore method.notFound */
        return $this->dataProvider->getVehicleEnginePowerValue();
    }

    public function isSupported(string $method): bool
    {
        $method = 'get'.ucfirst($method);

        if (method_exists($this->dataProvider, $method)) {
            return true;
        }

        throw new InvalidArgumentException('Method not supported be data provider. Please implement '.$method.'() in your data provider.');
    }

    /**
     * Model year encoding for VIN generation.
     *
     * @link: https://en.wikipedia.org/wiki/Vehicle_identification_number#Model_year_encoding
     */
    private static function encodeModelYear(int $modelYear = 1980): string
    {
        return substr(self::MODEL_YEAR, ($modelYear - 1980) % 30, 1);
    }

    /**php
     * @link: https://en.wikipedia.org/wiki/Vehicle_identification_number#Check-digit_calculation
     */
    private static function checkDigit(string $vin): string
    {
        $map     = '0123456789X';
        $weights = '8765432X098765432';
        $sum     = 0;
        for ($i = 0; $i < 17; $i++) {
            $sum += self::transliterate($vin[$i] ?? '')
                    * stripos($map, $weights[$i]);
        }

        return $map[$sum % 11];
    }

    private static function transliterate(string $character): int
    {
        return stripos(self::EBCDIC, $character) % 10;
    }

    public static function validateVin(string $vin, bool $strict = true): bool
    {
        if (! $strict) {
            /** @var string $vin */
            $vin = preg_replace('/[^A-Za-z0-9]/', '', $vin);
        }

        if (strlen($vin) !== 17) {
            return false;
        }

        return self::checkDigit($vin) === $vin[8];
    }
}
