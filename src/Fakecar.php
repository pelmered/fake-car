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
}
