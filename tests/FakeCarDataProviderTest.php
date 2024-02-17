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
            $this->assertContains($faker->vehicleModel, (BMWFakeCarData::$brandsWithModels)['BMW']);
            $this->assertContains($faker->vehicleType, BMWFakeCarData::$vehicleTypes);

            $regex = '/^(?<value>\d+) (?<unit>[a-zA-Z]+)$/';
            $this->assertMatchesRegularExpression($regex, $faker->vehicleEnginePower);
            preg_match($regex, $faker->vehicleEnginePower, $matches);
            $this->assertGreaterThanOrEqual(BMWFakeCarData::$vehicleEnginePower['range'][0], $matches['value']);
            $this->assertLessThanOrEqual(BMWFakeCarData::$vehicleEnginePower['range'][1], $matches['value']);
            $this->assertEquals('hp', $matches['unit']);

            $this->assertMatchesRegularExpression($regex, $faker->vehicleEngineTorque);
            preg_match($regex, $faker->vehicleEngineTorque, $matches);
            $this->assertGreaterThanOrEqual(BMWFakeCarData::$vehicleEngineTorque['range'][0], $matches['value']);
            $this->assertLessThanOrEqual(BMWFakeCarData::$vehicleEngineTorque['range'][1], $matches['value']);
            $this->assertEquals('nm', $matches['unit']);
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
