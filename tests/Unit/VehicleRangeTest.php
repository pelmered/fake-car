<?php

use FakeCar\Tests\TestCase;
use Faker\Factory;
use Faker\Provider\FakeCar;
use Faker\Provider\FakeCarHelper;
use Random\RandomException;

uses(TestCase::class);

beforeEach(function () {
    $faker = Factory::create();
    $faker->addProvider(new FakeCar($faker));
    $this->faker = $faker;
});

test('get range', function () {
    $range = [1, 100];
    for ($x = 0; $x < 100; $x++) {
        $result = FakeCarHelper::getRange($range, 0);

        expect((string) $result)->toMatch('/^\d+$/');
        expect($result)->toBeInt();
        expect($result)->toBeGreaterThanOrEqual($range[0]);
        expect($result)->toBeLessThanOrEqual($range[1]);
    }

    $range = [100, 150];
    for ($x = 0; $x < 100; $x++) {
        $result = FakeCarHelper::getRange($range, 2);

        expect($result)->toBeString();
        expect($result)->toMatch('/^\d+\.\d+$/');
        expect($result)->toBeGreaterThanOrEqual($range[0]);
        expect($result)->toBeLessThanOrEqual($range[1]);
    }
});
test('get range invalid', function () {
    $this->expectException('\Random\RandomException');
    FakeCarHelper::getRange([100, 50], 2);

    $this->expectException('\InvalidArgumentException');
    FakeCarHelper::getRange([100, 50], -2);
});

test('get range with unit', function () {
    $unit  = 'l';
    $range = [2065, 2450];
    for ($x = 0; $x < 100; $x++) {
        $result = FakeCarHelper::getRangeWithUnit($range, $unit, 0);

        expect($result)->toBeString();
        expect($result)->toContain($unit);
        expect($result)->toMatch('/^\d+ l$/');
        $value = (int) trim(str_replace($unit, '', $result));
        expect($value)->toBeGreaterThanOrEqual($range[0]);
        expect($value)->toBeLessThanOrEqual($range[1]);
    }

    $unit  = 'hp';
    $range = [200, 250];

    for ($x = 0; $x < 100; $x++) {
        $result = FakeCarHelper::getRangeWithUnit([200, 250], $unit, 2);

        expect($result)->toBeString();
        expect($result)->toContain($unit);
        expect($result)->toMatch('/^\d+\.\d+ hp$/');

        $value = (int) trim(str_replace($unit, '', $result));
        expect($value)->toBeGreaterThanOrEqual($range[0]);
        expect($value)->toBeLessThanOrEqual($range[1]);
    }
});

test('getRange with decimals', function () {
    $range    = [10, 20];
    $decimals = 2;

    $result = FakeCarHelper::getRange($range, $decimals);

    expect($result)->toBeString();
    expect((float) $result)->toBeGreaterThanOrEqual($range[0]);
    expect((float) $result)->toBeLessThanOrEqual($range[1]);
});

test('getRange with invalid range', function () {
    $range    = [20, 10];
    $decimals = 0;

    expect(fn () => FakeCarHelper::getRange($range, $decimals))
        ->toThrow(RandomException::class);
});

test('getRange with invalid decimals', function () {
    $range    = [10, 20];
    $decimals = -1;

    expect(fn () => FakeCarHelper::getRange($range, $decimals))
        ->toThrow(InvalidArgumentException::class);
});

test('getRange with range count not equal to 2', function () {
    $range    = [10];
    $decimals = 0;

    expect(fn () => FakeCarHelper::getRange($range, $decimals))
        ->toThrow(RandomException::class);
});

test('getRangeWithUnit', function () {
    $range    = [10, 20];
    $unit     = 'km/h';
    $decimals = 0;

    $result = FakeCarHelper::getRangeWithUnit($range, $unit, $decimals);

    expect($result)->toBeString();
    expect($result)->toContain($unit);

    $value = (int) str_replace($unit, '', $result);
    expect($value)->toBeGreaterThanOrEqual($range[0]);
    expect($value)->toBeLessThanOrEqual($range[1]);
});

test('getRangeWithUnit with decimals', function () {
    $range    = [10, 20];
    $unit     = 'km/h';
    $decimals = 2;

    $result = FakeCarHelper::getRangeWithUnit($range, $unit, $decimals);

    expect($result)->toBeString();
    expect($result)->toContain($unit);

    $value = (float) str_replace($unit, '', $result);
    expect($value)->toBeGreaterThanOrEqual($range[0]);
    expect($value)->toBeLessThanOrEqual($range[1]);
});

test('getRangeWithUnit with invalid range', function () {
    $range    = [20, 10];
    $unit     = 'km/h';
    $decimals = 0;

    expect(fn () => FakeCarHelper::getRangeWithUnit($range, $unit, $decimals))
        ->toThrow(RandomException::class);
});

test('getRangeWithUnit with invalid decimals', function () {
    $range    = [10, 20];
    $unit     = 'km/h';
    $decimals = -1;

    expect(fn () => FakeCarHelper::getRangeWithUnit($range, $unit, $decimals))
        ->toThrow(InvalidArgumentException::class);
});
