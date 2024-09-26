<?php

use FakeCar\Tests\TestDataProviders\BMWFakeCarData;
use FakeCar\Tests\TestDataProviders\FerrariEnzoTestProvider;
use Faker\Factory;
use Faker\Provider\FakeCar;
use Faker\Provider\FakeCarDataProvider;

test('custom provider data source', function () {
    $BMWCarData          = new BMWFakeCarData;
    $fakeCarDataProvider = new FakeCarDataProvider($BMWCarData);

    $faker   = (new Factory)::create();
    $fakeCar = new FakeCar($faker);
    $fakeCar->setDataProvider($fakeCarDataProvider);
    $faker->addProvider($fakeCar);

    for ($i = 0; $i <= 100; $i++) {
        $data = $faker->vehicleArray();
        expect($data['brand'])->toEqual('BMW')
            ->and($faker->vehicleBrand())->toEqual('BMW')
            ->and((BMWFakeCarData::$brandsWithModels)['BMW'])->toContain($faker->vehicleModel())
            ->and(BMWFakeCarData::$vehicleTypes)->toContain($faker->vehicleType());

        $regex = '/^(?<value>\d+) (?<unit>[a-zA-Z]+)$/';
        expect($faker->vehicleEnginePower())->toMatch($regex);
        preg_match($regex, $faker->vehicleEnginePower(), $matches);
        expect($matches['value'])->toBeGreaterThanOrEqual(BMWFakeCarData::$vehicleEnginePower['range'][0])
            ->and($matches['value'])->toBeLessThanOrEqual(BMWFakeCarData::$vehicleEnginePower['range'][1])
            ->and($matches['unit'])->toEqual('hp')
            ->and($faker->vehicleEngineTorque())->toMatch($regex);

        preg_match($regex, $faker->vehicleEngineTorque(), $matches);
        expect($matches['value'])->toBeGreaterThanOrEqual(BMWFakeCarData::$vehicleEngineTorque['range'][0])
            ->and($matches['value'])->toBeLessThanOrEqual(BMWFakeCarData::$vehicleEngineTorque['range'][1])
            ->and($matches['unit'])->toEqual('nm');
    }
});

test('custom provider class', function () {
    $fakeCarDataProvider = new FerrariEnzoTestProvider;

    $faker   = (new Factory)::create();
    $fakeCar = new FakeCar($faker);
    $fakeCar->setDataProvider($fakeCarDataProvider);
    $faker->addProvider($fakeCar);

    $vehicleArray = $faker->vehicleArray();
    expect($vehicleArray['brand'])->toEqual('Ferrari')
        ->and($vehicleArray['model'])->toEqual('Enzo')
        ->and($faker->vehicle())->toEqual('Ferrari Enzo')
        ->and($faker->vehicleBrand())->toEqual('Ferrari')
        ->and($faker->vehicleModel())->toEqual('Enzo')
        ->and($faker->vehicleType())->toEqual('coupe')
        ->and($faker->vehicleFuelType())->toEqual('gasoline')
        ->and($faker->vehicleDoorCount())->toEqual(2)
        ->and($faker->vehicleSeatCount())->toEqual(2)
        ->and($faker->vehicleProperties())->toEqual([
            'Air condition',
            'GPS',
            'Leather seats',
        ]);

});
