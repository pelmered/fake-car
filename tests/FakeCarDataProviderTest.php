<?php
namespace FakeCar\Tests;

use FakeCar\Tests\TestProviders\BMWFakeCarData;
use FakeCar\Tests\TestProviders\FerrariEnzoTestProvider;
use PHPUnit\Framework\TestCase;

class FakeCarDataProviderTest extends TestCase
{
    public function testCustomProviderDataSource()
    {
        $BMWCarData = new BMWFakeCarData;
        $fakeCarDataProvider = new \Faker\Provider\FakeCarDataProvider($BMWCarData);

        $faker = (new \Faker\Factory())::create();
        $fakeCar = new \Faker\Provider\FakeCar($faker);
        $fakeCar->setDataProvider($fakeCarDataProvider);
        $faker->addProvider($fakeCar);

        for ($i = 0; $i <= 100; $i++) {
            $data = $faker->vehicleArray();
            $this->assertEquals('BMW', $data['brand']);
            $this->assertEquals('BMW', $faker->vehicleBrand);
            $this->assertContains($faker->vehicleModel, ($BMWCarData::$brandsWithModels)['BMW']);
            $this->assertContains($faker->vehicleType, $BMWCarData::$vehicleTypes);

            $this->assertMatchesRegularExpression('/^(\d+) ([a-zA-Z]+)$/', $faker->vehicleEngineTorque);
            preg_match_all('/^(\d+) ([a-zA-Z]+)$/', $faker->vehicleEngineTorque, $matches);
            $this->assertGreaterThanOrEqual($BMWCarData::$vehicleEngineTorque['range'][0], $matches[1][0]);
            $this->assertLessThanOrEqual($BMWCarData::$vehicleEngineTorque['range'][1], $matches[1][1]);
        }
    }

    public function testCustomProviderClass()
    {
        $fakeCarDataProvider = new FerrariEnzoTestProvider();

        $faker = (new \Faker\Factory())::create();
        $fakeCar = new \Faker\Provider\FakeCar($faker);
        $fakeCar->setDataProvider($fakeCarDataProvider);
        $faker->addProvider($fakeCar);

        $vehicleArray = $faker->vehicleArray();
        $this->assertEquals('Ferrari', $vehicleArray['brand']);
        $this->assertEquals('Enzo', $vehicleArray['model']);

        $this->assertEquals('Ferrari Enzo', $faker->vehicle);
        $this->assertEquals('Ferrari', $faker->vehicleBrand);
        $this->assertEquals('Enzo', $faker->vehicleModel);
        $this->assertEquals('coupe', $faker->vehicleType);
        $this->assertEquals('gasoline', $faker->vehicleFuelType);
        $this->assertEquals(2, $faker->vehicleDoorCount);
        $this->assertEquals(2, $faker->vehicleSeatCount);
        $this->assertEquals([
            'Air condition',
            'GPS',
            'Leather seats',
        ], $faker->vehicleProperties);
    }
}
