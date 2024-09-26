<?php

use FakeCar\Tests\TestCase;
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

        expect($this->faker->vehicleSeatCount())->toBeGreaterThanOrEqual(1)
            ->and($this->faker->vehicleSeatCount())->toBeLessThanOrEqual(9)
            ->and($this->faker->vehicleSeatCount())->toBeInt();
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

test('valid vin', function ($vin, $valid) {
    expect($this->faker->validateVin($vin))->toBe($valid);
})->with([
    ['z2j9hhgr8Ahl1e3g', false], // Too short
    ['az2j9hhgr8Ahl1e3gs', false], // Too long
    ['z2j9hhgr2Ahl1e3gs', false], // Invalid check digit
    ['z2j9hhgr8Ahl1e3gd', false], // Invalid
    ['z2j9hhgr8Ahl1e3gs', true], // Valid VINs
    ['n7u30vns7Ajsrb1nc', true],
    ['3julknxb0A06hj41x', true],
    ['yj12c8z40Aca2x6p3', true],
    ['y95wf7gm1A9g7pz5z', true],
    ['355430557Azf4u0vr', true],
]);

test('vin returns valid vin', function () {
    $vin = $this->faker->vin();
    expect($this->faker->validateVin($vin))->toBeTrue();
});
test('model year', function ($year, $expected) {
    $object = new FakeCar($this->faker);

    expect($this->callProtectedMethod([$year], 'encodeModelYear', $object))->toEqual($expected);
})->with([
    [1980, 'A'],
    [2000, 'Y'],
    [2017, 'H'],
    [2018, 'J'],
    [2019, 'K'],
]);
test('transliterate', function () {
    expect($this->callProtectedMethod(['O'], 'transliterate', new FakeCar($this->faker)))->toEqual(0)
        ->and($this->callProtectedMethod(['A'], 'transliterate', new FakeCar($this->faker)))->toEqual(1)
        ->and($this->callProtectedMethod(['K'], 'transliterate', new FakeCar($this->faker)))->toEqual(2);
});

test('check digit', function () {
    expect($this->callProtectedMethod(['z2j9hhgr8Ahl1e3g'], 'checkDigit', new FakeCar($this->faker)))->toEqual('4')
        ->and($this->callProtectedMethod(['n7u30vns7Ajsrb1n'], 'checkDigit', new FakeCar($this->faker)))->toEqual('1')
        ->and($this->callProtectedMethod(['3julknxb0A06hj41'], 'checkDigit', new FakeCar($this->faker)))->toEqual('8');
});

test('vin', function () {
    $vin = $this->faker->vin();
    expect($vin)->toMatch('/[a-zA-Z0-9]{17}/')
        ->and($this->faker->validateVin($vin))->toBeTrue();
});

test('engine power', function () {
    $power = $this->faker->vehicleEnginePower();
    expect($power)->toMatch('/^\d+ hp$/')
        ->and((int) explode(' ', $power)[0])->toBeGreaterThanOrEqual(100)
        ->and((int) explode(' ', $power)[0])->toBeLessThanOrEqual(1500);
});

test('engine torque', function () {
    $torque = $this->faker->vehicleEngineTorque();
    expect($torque)->toMatch('/^\d+ nm$/')
        ->and((int) explode(' ', $torque)[0])->toBeGreaterThanOrEqual(100)
        ->and((int) explode(' ', $torque)[0])->toBeLessThanOrEqual(700);
});

test('get range', function () {
    for ($x = 0; $x < 100; $x++) {
        $range = FakeCarHelper::getRange([1, 100], 0);

        expect((string) $range)->toMatch('/^\d+$/')
            ->and((int) $range)->toBeGreaterThanOrEqual(1)
            ->and((int) $range)->toBeLessThanOrEqual(100);
    }

    for ($x = 0; $x < 100; $x++) {
        $range = FakeCarHelper::getRange([100, 150], 2);

        expect($range)->toMatch('/^\d+\.\d+$/')
            ->and((int) $range)->toBeGreaterThanOrEqual(100)
            ->and((int) $range)->toBeLessThanOrEqual(150);
    }
});
test('get range invalid', function () {
    $this->expectException('\Random\RandomException');
    FakeCarHelper::getRange([100, 50], 2);

    $this->expectException('\InvalidArgumentException');
    FakeCarHelper::getRange([100, 50], -2);
});

test('get range with unit', function () {
    for ($x = 0; $x < 100; $x++) {
        $range = FakeCarHelper::getRangeWithUnit([2065, 2450], 'l', 0);

        expect($range)->toMatch('/^\d+ l$/')
            ->and((int) $range)->toBeGreaterThanOrEqual(2065)
            ->and((int) $range)->toBeLessThanOrEqual(2450);
    }

    for ($x = 0; $x < 100; $x++) {
        $range = FakeCarHelper::getRangeWithUnit([200, 250], 'hp', 2);

        expect($range)->toMatch('/^\d+\.\d+ hp$/')
            ->and((int) $range)->toBeGreaterThanOrEqual(200)
            ->and((int) $range)->toBeLessThanOrEqual(250);
    }
});
