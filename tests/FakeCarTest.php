<?php

use Faker\Factory;
use Faker\Generator;
use Faker\Provider\FakeCar;
use Faker\Provider\FakeCarData;
use Faker\Provider\FakeCarDataProvider;
use Faker\Provider\FakeCarHelper;

beforeEach(function () {
    $faker = Factory::create();
    $faker->addProvider(new FakeCar($faker));
    $this->faker = $faker;
});

/**
 * @throws ReflectionException
 */
function getProtectedProperty($property, $object = null)
{
    if (is_null($object)) {
        $object = new FakeCarDataProvider;
    }

    $reflection = new \ReflectionClass($object);
    $reflection_property = $reflection->getProperty($property);
    $reflection_property->setAccessible(true);

    return $reflection_property->getValue($object, $property);
}

function callProtectedMethod($args, $method, $object = null)
{
    if (is_null($object)) {
        $object = new FakeCarDataProvider;
    }

    try {
        $reflection = new \ReflectionClass($object);
        $reflectionMethod = $reflection->getMethod($method);
        //$reflectionMethod->setAccessible(true);

        return $reflectionMethod->invoke($object, ...$args);
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

test('vehicle', function () {
    $this->faker->seed(random_int(1, 9999));

    $vehicleText = $this->faker->vehicle();
    $brands = (new FakeCarDataProvider)->getBrandsWithModels();

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
    expect((new FakeCarDataProvider)->getBrandsWithModels())->toHaveKey($this->faker->vehicleBrand);
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
    expect(FakeCarData::$vehicleTypes)->toContain($this->faker->vehicleType);
});

test('vehicle fuel type', function () {
    expect(array_keys(FakeCarData::$vehicleFuelTypes))->toContain($this->faker->vehicleFuelType);
});

test('vehicle door count', function () {
    for ($i = 0; $i<10; $i++) {
        expect($this->logicalAnd(
            $this->isType('int'),
            $this->greaterThanOrEqual(2),
            $this->lessThanOrEqual(6)
        ))->toMatchConstraint($this->faker->vehicleDoorCount);
    }
});

test('vehicle seat count', function () {
    for ($i = 0; $i<10; $i++) {
        expect($this->logicalAnd(
            $this->isType('int'),
            $this->greaterThanOrEqual(1),
            $this->lessThanOrEqual(9)
        ))->toMatchConstraint($this->faker->vehicleSeatCount);
    }
});

test('vehicle properties', function () {
    $properties = $this->faker->vehicleProperties;
    expect($properties)->toBeArray();

    $properties = $this->faker->vehicleProperties(2);
    expect($properties)->toBeArray();
    expect($properties)->toHaveCount(2);

    $properties = $this->faker->vehicleProperties(5);
    expect($properties)->toBeArray();
    expect($properties)->toHaveCount(5);

    //If we pass 0 we should get a random
    $properties = $this->faker->vehicleProperties(0);
    expect($properties)->toBeArray();
    expect(count($properties))->toBeGreaterThanOrEqual(0);
});

test('vehicle gear box', function () {
    expect(array_keys(FakeCarData::$vehicleGearBoxType))->toContain($this->faker->vehicleGearBoxType);
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

    expect(FakeCarHelper::getRandomElementsFromArray($data, 1))->toHaveCount(1);
    expect(FakeCarHelper::getRandomElementsFromArray($data, 3))->toHaveCount(3);
    expect(FakeCarHelper::getRandomElementsFromArray($data, 6))->toHaveCount(6);
    expect(FakeCarHelper::getRandomElementsFromArray($data, 10))->toHaveCount(10);
    expect(FakeCarHelper::getRandomElementsFromArray($data, 0))->toEqual([]);

    for ($i = 0; $i<50; $i++) {
        $result6 = FakeCarHelper::getRandomElementsFromArray($data, null);

        expect(count($result6))->toBeGreaterThanOrEqual(0);
        expect(count($result6))->toBeLessThanOrEqual(10);

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

    for($x = 0; $x<10; $x++) {
        $result = array_fill_keys(array_keys($data), 0);

        for ($i = 0; $i<1000; $i++) {
            $result[FakeCarHelper::getWeighted($data)]++;
        }

        expect($result['key1'])->toBeGreaterThan($result['key2']);
        expect($result['key2'])->toBeGreaterThan($result['key3']);
        expect($result['key1'])->toBeGreaterThan($result['key3']);
    }

    expect(FakeCarHelper::getWeighted([]))->toEqual('');
});

test('valid vin', function () {
    //Too short
    expect($this->faker->validateVin('z2j9hhgr8Ahl1e3g'))->toBeFalse();

    //Too long
    expect($this->faker->validateVin('az2j9hhgr8Ahl1e3gs'))->toBeFalse();

    //Invalid check digit
    expect($this->faker->validateVin('z2j9hhgr2Ahl1e3gs'))->toBeFalse();

    //Invalid
    expect($this->faker->validateVin('z2j9hhgr8Ahl1e3gd'))->toBeFalse();

    // Valid VINs
    expect($this->faker->validateVin('z2j9hhgr8Ahl1e3gs'))->toBeTrue();
    expect($this->faker->validateVin('n7u30vns7Ajsrb1nc'))->toBeTrue();
    expect($this->faker->validateVin('3julknxb0A06hj41x'))->toBeTrue();
    expect($this->faker->validateVin('yj12c8z40Aca2x6p3'))->toBeTrue();
    expect($this->faker->validateVin('y95wf7gm1A9g7pz5z'))->toBeTrue();
    expect($this->faker->validateVin('355430557Azf4u0vr'))->toBeTrue();
});

test('vin returns valid vin', function () {
    $vin = $this->faker->vin();
    expect($this->faker->validateVin($vin))->toBeTrue();
});
test('model year', function () {
    expect($this->faker->modelYear(1980))->toEqual('A');
    expect($this->faker->modelYear(2000))->toEqual('Y');
    expect($this->faker->modelYear(2017))->toEqual('H');
    expect($this->faker->modelYear(2018))->toEqual('J');
    expect($this->faker->modelYear(2019))->toEqual('K');
});
test('transliterate', function () {
    expect(callProtectedMethod(['O'], 'transliterate', new FakeCar($this->faker)))->toEqual(0);
    expect(callProtectedMethod(['A'], 'transliterate', new FakeCar($this->faker)))->toEqual(1);
    expect(callProtectedMethod(['K'], 'transliterate', new FakeCar($this->faker)))->toEqual(2);
});

test('check digit', function () {
    expect(callProtectedMethod(['z2j9hhgr8Ahl1e3g'], 'checkDigit', new FakeCar($this->faker)))->toEqual('4');
    expect(callProtectedMethod(['n7u30vns7Ajsrb1n'], 'checkDigit', new FakeCar($this->faker)))->toEqual('1');
    expect(callProtectedMethod(['3julknxb0A06hj41'], 'checkDigit', new FakeCar($this->faker)))->toEqual('8');
});

test('vin', function () {
    $vin = $this->faker->vin();
    expect($vin)->toMatch('/[a-zA-Z0-9]{17}/');
    expect($this->faker->validateVin($vin))->toBeTrue();
});

test('engine power', function () {
    $power = $this->faker->vehicleEnginePower;
    expect($power)->toMatch('/^\d+ hp$/');
    expect((int)explode(' ', $power)[0])->toBeGreaterThanOrEqual(100);
    expect((int)explode(' ', $power)[0])->toBeLessThanOrEqual(1500);
});

test('engine torque', function () {
    $torque = $this->faker->vehicleEngineTorque;
    expect($torque)->toMatch('/^\d+ nm$/');
    expect((int)explode(' ', $torque)[0])->toBeGreaterThanOrEqual(100);
    expect((int)explode(' ', $torque)[0])->toBeLessThanOrEqual(700);
});

test('get range', function () {
    for($x = 0; $x<100; $x++) {
        $range = FakeCarHelper::getRange([1, 100], 0);
        expect($range)->toMatch('/^\d+$/');
        expect((int)$range)->toBeGreaterThanOrEqual(1);
        expect((int)$range)->toBeLessThanOrEqual(100);
    }

    for($x = 0; $x<100; $x++) {
        $range = FakeCarHelper::getRange([100, 150], 2);

        expect($range)->toMatch('/^\d+\.\d+$/');
        expect((int)$range)->toBeGreaterThanOrEqual(100);
        expect((int)$range)->toBeLessThanOrEqual(150);
    }
});
test('get range invalid', function () {
    $this->expectException('\Random\RandomException');
    FakeCarHelper::getRange([100, 50], 2);

    $this->expectException('\InvalidArgumentException');
    FakeCarHelper::getRange([100, 50], -2);
});

test('get range with unit', function () {
    for($x = 0; $x<100; $x++) {
        $range = FakeCarHelper::getRangeWithUnit([2065, 2450], 'l', 0);

        expect($range)->toMatch('/^\d+ l$/');
        expect((int)$range)->toBeGreaterThanOrEqual(2065);
        expect((int)$range)->toBeLessThanOrEqual(2450);
    }

    for($x = 0; $x<100; $x++) {
        $range = FakeCarHelper::getRangeWithUnit([200, 250], 'hp', 2);

        expect($range)->toMatch('/^\d+\.\d+ hp$/');
        expect((int)$range)->toBeGreaterThanOrEqual(200);
        expect((int)$range)->toBeLessThanOrEqual(250);
    }
});
