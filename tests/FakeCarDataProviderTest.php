<?php

use FakeCar\Tests\TestProviders\BMWFakeCarData;
use FakeCar\Tests\TestProviders\FerrariEnzoTestProvider;

test('custom provider data source', function () {
    $BMWCarData = new BMWFakeCarData;
    $fakeCarDataProvider = new \Faker\Provider\FakeCarDataProvider($BMWCarData);

    $faker = (new \Faker\Factory())::create();
    $fakeCar = new \Faker\Provider\FakeCar($faker);
    $fakeCar->setDataProvider($fakeCarDataProvider);
    $faker->addProvider($fakeCar);

    for ($i = 0; $i <= 100; $i++) {
        $data = $faker->vehicleArray();
        expect($data['brand'])->toEqual('BMW');
        expect($faker->vehicleBrand)->toEqual('BMW');
        expect((BMWFakeCarData::$brandsWithModels)['BMW'])->toContain($faker->vehicleModel);
        expect(BMWFakeCarData::$vehicleTypes)->toContain($faker->vehicleType);

        $regex = '/^(?<value>\d+) (?<unit>[a-zA-Z]+)$/';
        expect($faker->vehicleEnginePower)->toMatch($regex);
        preg_match($regex, $faker->vehicleEnginePower, $matches);
        expect($matches['value'])->toBeGreaterThanOrEqual(BMWFakeCarData::$vehicleEnginePower['range'][0]);
        expect($matches['value'])->toBeLessThanOrEqual(BMWFakeCarData::$vehicleEnginePower['range'][1]);
        expect($matches['unit'])->toEqual('hp');

        expect($faker->vehicleEngineTorque)->toMatch($regex);
        preg_match($regex, $faker->vehicleEngineTorque, $matches);
        expect($matches['value'])->toBeGreaterThanOrEqual(BMWFakeCarData::$vehicleEngineTorque['range'][0]);
        expect($matches['value'])->toBeLessThanOrEqual(BMWFakeCarData::$vehicleEngineTorque['range'][1]);
        expect($matches['unit'])->toEqual('nm');
    }
});

test('custom provider class', function () {
    $fakeCarDataProvider = new FerrariEnzoTestProvider();

    $faker = (new \Faker\Factory())::create();
    $fakeCar = new \Faker\Provider\FakeCar($faker);
    $fakeCar->setDataProvider($fakeCarDataProvider);
    $faker->addProvider($fakeCar);

    $vehicleArray = $faker->vehicleArray();
    expect($vehicleArray['brand'])->toEqual('Ferrari');
    expect($vehicleArray['model'])->toEqual('Enzo');

    expect($faker->vehicle)->toEqual('Ferrari Enzo');
    expect($faker->vehicleBrand)->toEqual('Ferrari');
    expect($faker->vehicleModel)->toEqual('Enzo');
    expect($faker->vehicleType)->toEqual('coupe');
    expect($faker->vehicleFuelType)->toEqual('gasoline');
    expect($faker->vehicleDoorCount)->toEqual(2);
    expect($faker->vehicleSeatCount)->toEqual(2);
    expect($faker->vehicleProperties)->toEqual([
        'Air condition',
        'GPS',
        'Leather seats',
    ]);
});
