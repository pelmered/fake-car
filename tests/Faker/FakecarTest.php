<?php

namespace Faker\Tests\Provider;

use Faker\Factory;
use Faker\Generator;
use Faker\Provider\Fakecar;
use Faker\Provider\CarData;
use PHPUnit\Framework\TestCase;

class FakecarTest extends TestCase
{
    /**
     * @var Generator
     */
    private $faker;

    public function setUp()
    {
        $faker = Factory::create();
        $faker->addProvider(new Fakecar($faker));
        $this->faker = $faker;
    }

    public function getProtectedProperty( $property, $class = null )
    {
        if( is_null($class))
        {
            $class = new Fakecar($this->faker);
        }

        $reflection = new \ReflectionClass($class);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);

        return $reflection_property->getValue($class, $property);
    }

    public function testVehicle()
    {
        $this->faker->seed(random_int(1, 9999));

        $vehicleBrand = $this->faker->vehicleBrand();

        $vehicleText = $this->faker->vehicle();
        $brands = CarData::getBrandsWithModels();

        foreach($brands as $brand => $models)
        {
            if(substr($vehicleText, 0, strlen($brand)) === $brand) {
                foreach ($models as $model)
                {
                    if(substr($vehicleText,  -strlen($model)) === $model) {

                        $this->assertStringEndsWith($model, $vehicleText);
                        break;
                    }
                }
            }
        }
    }

    public function testVehicleArray()
    {
        $vehicleArray = $this->faker->vehicleArray();

        $this->assertArrayHasKey('brand', $vehicleArray);
        $this->assertArrayHasKey('model', $vehicleArray);

        $brandsArray = CarData::getBrandsWithModels();

        $this->assertTrue(
            in_array(
                $vehicleArray['model'],
                $brandsArray[$vehicleArray['brand']]
            )
        );

    }

    public function testVehicleBrand()
    {
        $this->assertTrue(
            in_array(
                $this->faker->vehicleBrand,
                array_keys(CarData::getVehicleTypes())
            )
        );
    }

    public function testVehicleModel($make = null)
    {
        $this->faker->seed(random_int(1, 9999));

        $vehicleBrand = $this->faker->vehicleBrand();

        $modelArray = CarData::getBrandsWithModels();
        $modelArray = $modelArray[$this->faker->vehicleBrand()];

        $vehicleBrand = $this->faker->vehicleBrand();

        $this->assertTrue(
            in_array(
                $this->faker->vehicleModel($vehicleBrand),
                (CarData::getBrandsWithModels())[$vehicleBrand]
            )
        );
    }

    public function testVehicleRegistration()
    {
        $this->assertRegExp('/[A-Z]{3}-[0-9]{3}/', $this->faker->vehicleRegistration());
        $this->assertRegExp('/[A-Z]{2}-[0-9]{5}/', $this->faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'));
    }

    public function testVehicleType()
    {
        $this->assertTrue(in_array($this->faker->vehicleType, CarData::getVehicleTypes()));
    }

    public function testVehicleFuelType()
    {
        $this->assertTrue(in_array($this->faker->vehicleFuelType, CarData::getVehicleFuelTypes()));
    }
}
