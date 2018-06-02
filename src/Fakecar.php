<?php

namespace Faker\Provider;
use Faker\Generator;

class Fakecar extends \Faker\Provider\Base
{
    /**
     * @param \Faker\Generator $generator
     */
    public function __construct(Generator $generator)
    {
        parent::__construct($generator);
    }

    public static function vehicle() : string
    {
        $vehicleBrand = static::vehicleBrand();
        return $vehicleBrand.' '.static::vehicleModel($vehicleBrand);
    }

    public static function vehicleArray() : array
    {
        $vehicleBrand = static::vehicleBrand();
        return [
            'brand' => $vehicleBrand,
            'model' => static::vehicleModel($vehicleBrand)
        ];
    }

    public static function vehicleBrand()
    {
        return static::randomElement(array_keys(CarData::getBrandsWithModels()));
    }

    public static function vehicleModel($brand = null)
    {
        $brandsWithModels = CarData::getBrandsWithModels();

        return static::randomElement($brandsWithModels[$brand ?: static::vehicleBrand()]);
    }

    public static function vehicleRegistration($regex = '[A-Z]{3}-[0-9]{3}')
    {
        return static::regexify($regex);
    }

    public static function vehicleType()
    {
        return static::randomElement(CarData::getVehicleTypes());
    }

    public static function vehicleFuelType()
    {
        return static::randomElement(CarData::getVehicleFuelTypes());
    }

    public static function vehicleDoorCount() :int
    {
        return (int) static::getWeighted(CarData::getVehicleDoorCount());
    }
    public static function vehicleSeatCount() :int
    {
        return (int) static::getWeighted(CarData::getVehicleSeatCount());
    }
    public static function vehicleProperties(int $count = 0)
    {
        return static::getRandomElementsFromArray(CarData::getVehicleProperties(), $count);
    }
    public static function vehicleGearBoxType()
    {
        return static::randomElement(CarData::getVehicleGearBoxType());
    }
    public static function getRandomElementsFromArray(array $values, int $count = 0) :array {

        if(!$count)
        {
            $count = random_int(0, count($values));
        }

        if($count === 0)
        {
            return [];
        }

        return array_intersect_key($values, array_flip((array) array_rand($values, $count)));
    }

    public static function getWeighted(array $values) :string {

        if(empty($values))
        {
            return '';
        }

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
    }

}
