<?php

namespace Faker\Provider;
use Faker\Generator;

class Fakecar extends \Faker\Provider\Base
{
    /**
     * Fakecar constructor.
     *
     * @param \Faker\Generator $generator
     */
    public function __construct(Generator $generator)
    {
        parent::__construct($generator);
    }

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
        return static::randomElement(array_keys(CarData::getBrandsWithModels()));
    }

    /**
     * Get random vehicle model
     *
     * @param null $brand Get random model from specific brand (optional)
     *
     * @return mixed
     */
    public static function vehicleModel($brand = null) : string
    {
        $brandsWithModels = CarData::getBrandsWithModels();

        return static::randomElement($brandsWithModels[$brand ?: static::vehicleBrand()]);
    }

    /**
     * Get vehicle registration number
     *
     * @param string $regex
     *
     * @return string
     */
    public static function vehicleRegistration($regex = '[A-Z]{3}-[0-9]{3}') : string
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
        return static::randomElement(CarData::getVehicleTypes());
    }

    /**
     * Get vehicle fuel type
     *
     * @return string
     */
    public static function vehicleFuelType() : string
    {
        return static::randomElement(CarData::getVehicleFuelTypes());
    }

    /**
     * Get vehicle door count
     *
     * @return int
     */
    public static function vehicleDoorCount() :int
    {
        return (int) static::getWeighted(CarData::getVehicleDoorCount());
    }

    /**
     * Get vehicle door count
     *
     * @return int
     */
    public static function vehicleSeatCount() :int
    {
        return (int) static::getWeighted(CarData::getVehicleSeatCount());
    }

    /**
     * Get an array of random vehicle properties
     *
     * @param int $count
     *
     * @return array
     */
    public static function vehicleProperties(int $count = 0)
    {
        return static::getRandomElementsFromArray(CarData::getVehicleProperties(), $count);
    }

    /**
     * Get random vehicle gearbox type
     *
     * @return mixed
     */
    public static function vehicleGearBoxType()
    {
        return static::randomElement(CarData::getVehicleGearBoxType());
    }

    /**
     * Get random elements from input array
     *
     * @param array $values The input array
     * @param int $count The number of random elements you want to get in your response. Leave out or set to 0 for random.
     *
     * @return array
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public static function getRandomElementsFromArray(array $values, int $count = 0) :array {

        $valuesLength = count($values);
        if ($count > $valuesLength)
        {
            throw new \InvalidArgumentException('Count larger than array length.');
        }

        if (!$count)
        {
            $count = random_int(0, $valuesLength);
        }

        if ($count === 0)
        {
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
     * Get one element out of an input array with specified weights to get the distribution of the generated elements as you want them.
     *
     * @param array $values Input array with values as key and weight as value. ['value 1' => 30, 'value 7' => 70]
     *
     * @return string
     * @throws \Exception
     */
    public static function getWeighted(array $values) :string {

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

}
