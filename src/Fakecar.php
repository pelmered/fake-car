<?php

namespace Faker\Provider;

class Fakecar extends \Faker\Provider\Base
{
    const EBCDIC = "0123456789.ABCDEFGH..JKLMN.P.R..STUVWXYZ";
    const MODELYEAR = "ABCDEFGHJKLMNPRSTVWXY123456789";

    /**
     * Get vehicle string with brand and model
     *
     * @return string
     */
    public static function vehicle() : string
    {
        $vehicleBrand = static::vehicleBrand();
        return $vehicleBrand.' '.static::vehicleModel($vehicleBrand);
    }

    /**
     * Get vehicle with brand and model as an array
     *
     * @return array
     */
    public static function vehicleArray() : array
    {
        $vehicleBrand = static::vehicleBrand();
        return [
            'brand' => $vehicleBrand,
            'model' => static::vehicleModel($vehicleBrand)
        ];
    }

    /**
     * Get random vehicle brand
     *
     * @return string
     */
    public static function vehicleBrand() : string
    {
        return (string) static::randomElement(array_keys(CarData::getBrandsWithModels()));
    }

    /**
     * Get random vehicle model
     *
     * @param string $brand Get random model from specific brand (optional)
     *
     * @return mixed
     */
    public static function vehicleModel(string $brand = null) : string
    {
        $brandsWithModels = CarData::getBrandsWithModels();

        return (string) static::randomElement($brandsWithModels[$brand ?: static::vehicleBrand()]);
    }

    /**
     * Generate VIN
     * @link https://en.wikipedia.org/wiki/Vehicle_identification_number
     *
     * @param int $year
     *
     * @return mixed
     */
    public static function vin(int $year = 1980) : string
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
    public static function vehicleRegistration(string $regex = '[A-Z]{3}-[0-9]{3}') : string
    {
        //TODO: Set format based on locale
        return static::regexify($regex);
    }

    /**
     * Get vehicle type
     *
     * @return string
     */
    public static function vehicleType() : string
    {
        return (string) static::randomElement(CarData::getVehicleTypes());
    }

    /**
     * Get vehicle fuel type
     *
     * @return string
     */
    public static function vehicleFuelType() : string
    {
        return (string) static::randomElement(CarData::getVehicleFuelTypes());
    }

    /**
     * Get vehicle door count
     *
     * @return int
     * @throws \Exception
     */
    public static function vehicleDoorCount() : int
    {
        return (int) static::getWeighted(CarData::getVehicleDoorCount());
    }

    /**
     * Get vehicle door count
     *
     * @return int
     * @throws \Exception
     */
    public static function vehicleSeatCount() : int
    {
        return (int) static::getWeighted(CarData::getVehicleSeatCount());
    }

    /**
     * Get an array of random vehicle properties
     *
     * @param int $count
     *
     * @return array
     * @throws \Exception
     */
    public static function vehicleProperties(int $count = 0) : array
    {
        return static::getRandomElementsFromArray(CarData::getVehicleProperties(), $count);
    }

    /**
     * Get random vehicle gearbox type
     *
     * @return mixed
     * @throws \Exception
     */
    public static function vehicleGearBoxType() : string
    {
        return static::getWeighted(CarData::getVehicleGearBoxType());
    }

    /**
     * Get random elements from input array
     *
     * @param array $values The input array
     * @param int $count The number of random elements you want to get in your response.
                         Leave out or set to 0 for random.
     *
     * @return array
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public static function getRandomElementsFromArray(array $values, int $count = 0) : array
    {

        $valuesLength = count($values);
        if ($count > $valuesLength) {
            throw new \InvalidArgumentException('Count larger than array length.');
        }

        if (!$count) {
            $count = random_int(0, $valuesLength);
        }

        if ($count === 0) {
            return [];
        }

        return array_intersect_key(
            $values,
            array_flip(
                (array) array_rand($values, $count)
            )
        );
    }

    /**
     * Get one element out of an input array with specified weights to get the distribution
     * of the generated elements as you want them.
     *
     * @param array $values Input array with values as key and weight as value. ['value 1' => 30, 'value 7' => 70]
     *
     * @return string
     * @throws \Exception
     */
    public static function getWeighted(array $values) : string
    {

        $currentTotal = 0;
        $firstRand = random_int(1, 100);

        $total = array_sum($values);

        $rand = ($firstRand / 100) * $total;

        foreach ($values as $key => $weight) {
            $currentTotal += $weight;

            if ($rand <= $currentTotal) {
                return $key;
            }
        }

        return '';
    }

    /**
     * @param int $year
     *
     * @return string
     */
    public static function modelYear(int $year = 1980) : string
    {
        return substr(self::MODELYEAR, ($year-1980) % 30, 1);
    }

    /**
     * @param $c
     *
     * @return int
     */
    public static function transliterate(string $character) : string
    {
        return stripos(self::EBCDIC, $character) % 10;
    }

    /**
     * @param string $vin
     *
     * @return mixed
     */
    public static function checkDigit(string $vin) : string
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
    public static function validateVin(string $vin) : bool
    {
        if (strlen($vin) != 17) {
            return false;
        }
        return self::checkDigit($vin) == substr($vin, 8, 1);
    }
}
