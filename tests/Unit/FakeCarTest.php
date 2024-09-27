<?php

use FakeCar\Tests\TestCase;
use FakeCar\Tests\TestDataProviders\FerrariEnzoTestProvider;
use Faker\Factory;
use Faker\Provider\FakeCar;
use Faker\Provider\FakeCarData;
use Faker\Provider\FakeCarDataProvider;
use Faker\Provider\FakeCarHelper;

uses(TestCase::class);

beforeEach(function () {
    $faker = Factory::create();
    $faker->addProvider(new FakeCar($faker));
    $this->faker = $faker;
});

test('vehicle', function () {
    $this->faker->seed(random_int(1, 9999));

    $vehicleText = $this->faker->vehicle();
    $brands      = (new FakeCarDataProvider)->getBrandsWithModels();

    foreach ($brands as $brand => $models) {
        if (substr($vehicleText, 0, strlen($brand)) === $brand) {
            foreach ($models as $model) {
                if (substr($vehicleText, -strlen($model)) === $model) {
                    expect($vehicleText)->toEndWith($model);
                    break;
                }
            }
        }
    }
});

test('vehicle array', function () {
    $vehicleArray = $this->faker->vehicleArray();

    expect($vehicleArray)->toHaveKey('brand');
    expect($vehicleArray)->toHaveKey('model');

    $brandsArray = (new FakeCarDataProvider)->getBrandsWithModels();

    expect($brandsArray[$vehicleArray['brand']])->toContain($vehicleArray['model']);
});

test('vehicle brand', function () {
    expect((new FakeCarDataProvider)->getBrandsWithModels())->toHaveKey($this->faker->vehicleBrand());
});

test('vehicle model', function () {
    $this->faker->seed(random_int(1, 9999));

    $vehicleBrand = $this->faker->vehicleBrand();

    expect(((new FakeCarDataProvider)->getBrandsWithModels())[$vehicleBrand])->toContain($this->faker->vehicleModel($vehicleBrand));
});

test('vehicle registration', function () {
    expect($this->faker->vehicleRegistration())->toMatch('/[A-Z]{3}-[0-9]{3}/');
    expect($this->faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'))->toMatch('/[A-Z]{2}-[0-9]{5}/');
});

test('vehicle type', function () {
    expect(FakeCarData::$vehicleTypes)->toContain($this->faker->vehicleType());
});

test('vehicle fuel type', function () {
    expect(array_keys(FakeCarData::$vehicleFuelTypes))->toContain($this->faker->vehicleFuelType());
});

test('vehicle door count', function () {
    for ($i = 0; $i < 10; $i++) {

        expect($this->faker->vehicleDoorCount())->toBeGreaterThanOrEqual(1)
            ->and($this->faker->vehicleDoorCount())->toBeLessThanOrEqual(9)
            ->and($this->faker->vehicleDoorCount())->toBeInt();
    }
});

test('vehicle seat count', function () {
    for ($i = 0; $i < 10; $i++) {

        expect($this->faker->vehicleSeatCount())->toBeGreaterThanOrEqual(1)
            ->and($this->faker->vehicleSeatCount())->toBeLessThanOrEqual(9)
            ->and($this->faker->vehicleSeatCount())->toBeInt();
    }
});

test('vehicle properties', function () {
    $properties = $this->faker->vehicleProperties();
    expect($properties)->toBeArray();

    $properties = $this->faker->vehicleProperties(2);
    expect($properties)->toBeArray()
        ->and($properties)->toHaveCount(2);

    $properties = $this->faker->vehicleProperties(5);
    expect($properties)->toBeArray()
        ->and($properties)->toHaveCount(5);

    // If we pass 0, we should get a random property
    $properties = $this->faker->vehicleProperties(0);
    expect($properties)->toBeArray()
        ->and(count($properties))->toBeGreaterThanOrEqual(0);
});

test('vehicle gear box', function () {
    expect(array_keys(FakeCarData::$vehicleGearBoxType))->toContain($this->faker->vehicleGearBoxType());
});

test('vehicle gear box value', function () {
    expect(array_keys(FakeCarData::$vehicleGearBoxType))->toContain($this->faker->vehicleGearBoxTypeValue());
});

test('get random elements from array', function () {
    $data = [
        'value1',
        'value2',
        'value3',
        'value4',
        'value5',
        'value6',
        'value7',
        'value8',
        'value9',
        'value10',
    ];

    expect(FakeCarHelper::getRandomElementsFromArray($data, 1))->toHaveCount(1)
        ->and(FakeCarHelper::getRandomElementsFromArray($data, 3))->toHaveCount(3)
        ->and(FakeCarHelper::getRandomElementsFromArray($data, 6))->toHaveCount(6)
        ->and(FakeCarHelper::getRandomElementsFromArray($data, 10))->toHaveCount(10)
        ->and(FakeCarHelper::getRandomElementsFromArray($data, 0))->toEqual([]);

    for ($i = 0; $i < 50; $i++) {
        $result6 = FakeCarHelper::getRandomElementsFromArray($data, null);

        expect(count($result6))->toBeGreaterThanOrEqual(0)
            ->and(count($result6))->toBeLessThanOrEqual(10);

        foreach ($result6 as $r) {
            expect($data)->toContain($r);
        }
    }

    $this->expectException(\InvalidArgumentException::class);

    FakeCarHelper::getRandomElementsFromArray($data, 20);
});

test('get weighted', function () {
    // NOTE: As this is based on random distribution this test might fail in extremely rare cases.
    $data = [
        'key1' => 100,
        'key2' => 10,
        'key3' => 1,
    ];

    for ($x = 0; $x < 10; $x++) {
        $result = array_fill_keys(array_keys($data), 0);

        for ($i = 0; $i < 1000; $i++) {
            $result[FakeCarHelper::getWeighted($data)]++;
        }

        expect($result['key1'])->toBeGreaterThan($result['key2'])
            ->and($result['key2'])->toBeGreaterThan($result['key3'])
            ->and($result['key1'])->toBeGreaterThan($result['key3']);
    }

    expect(FakeCarHelper::getWeighted([]))->toEqual('');
});

test('engine power', function () {
    $power = $this->faker->vehicleEnginePower();
    expect($power)->toMatch('/^\d+ hp$/')
        ->and((int) explode(' ', $power)[0])->toBeGreaterThanOrEqual(100)
        ->and((int) explode(' ', $power)[0])->toBeLessThanOrEqual(1500);
});

test('engine power value', function () {
    $power = $this->faker->vehicleEnginePowerValue();
    expect((int) explode(' ', $power)[0])->toBeGreaterThanOrEqual(100)
        ->and((int) explode(' ', $power)[0])->toBeLessThanOrEqual(1500);
});

test('engine torque', function () {
    $torque = $this->faker->vehicleEngineTorque();
    expect($torque)->toMatch('/^\d+ nm$/')
        ->and((int) explode(' ', $torque)[0])->toBeGreaterThanOrEqual(100)
        ->and((int) explode(' ', $torque)[0])->toBeLessThanOrEqual(700);
});

test('engine torque value', function () {
    $torque = $this->faker->vehicleEngineTorqueValue();

    expect((int) explode(' ', $torque)[0])->toBeGreaterThanOrEqual(100)
        ->and((int) explode(' ', $torque)[0])->toBeLessThanOrEqual(700);
});

test('is supported check', function () {
    $faker   = (new Factory)::create();
    $fakeCar = new FakeCar($faker);
    $fakeCar->setDataProvider(new FerrariEnzoTestProvider);
    $faker->addProvider($fakeCar);

    expect($fakeCar->isSupported('vehicleEnginePower'))->toBeTrue();

    expect(fn () => $fakeCar->isSupported('vehicleEngineTorque'))
        ->toThrow(InvalidArgumentException::class);

    expect(fn () => $fakeCar->isSupported('invalidMethod'))
        ->toThrow(InvalidArgumentException::class);
});
