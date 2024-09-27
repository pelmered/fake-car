<?php

use FakeCar\Tests\TestCase;
use Faker\Factory;
use Faker\Provider\FakeCar;

uses(TestCase::class);

beforeEach(function () {
    $faker = Factory::create();
    $faker->addProvider(new FakeCar($faker));
    $this->faker = $faker;
});

test('valid vin', function ($vin, $valid) {
    expect($this->faker->validateVin($vin))->toBe($valid);
})->with([
    ['z2j9hhgr8Ahl1e3g', false], // Too short
    ['az2j9hhgr8Ahl1e3gs', false], // Too long
    ['z2j9hhgr-8Ahl1e3gs', false], // Invalid format
    ['z2j9hhgr2Ahl1e3gs', false], // Invalid check digit
    ['z2j9hhgr8Ahl1e3gd', false], // Invalid
    ['z2j9hhgr8Ahl1e3gs', true], // Valid VINs below
    ['n7u30vns7Ajsrb1nc', true],
    ['3julknxb0A06hj41x', true],
    ['yj12c8z40Aca2x6p3', true],
    ['y95wf7gm1A9g7pz5z', true],
    ['355430557Azf4u0vr', true],
]);

test('valid vin non strict', function ($vin, $valid) {
    expect($this->faker->validateVin($vin, strict: false))->toBe($valid);
})->with([
    ['z2j9hhgr-8Ahl1e3gs', true],
    ['z2j_9hhgr-8Ahl1/e3gs', true],
    ['z2j9hhgr9Ahl1e3gs', false], // Invalid check digit
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
test('transliterate', function ($character, $expected) {
    expect($this->callProtectedMethod(
        [$character],
        'transliterate',
        new FakeCar($this->faker))
    )->toEqual($expected);
})->with([
    ['O', 0],
    ['A', 1],
    ['K', 2],
]);

test('check digit', function ($vin, $expected) {
    expect($this->callProtectedMethod(
        [$vin],
        'checkDigit',
        new FakeCar($this->faker)
    ))->toEqual($expected);
})->with([
    ['z2j9hhgr8Ahl1e3g', '4'],
    ['n7u30vns7Ajsrb1n', '1'],
    ['3julknxb0A06hj41', '8'],
]);

test('vin', function () {
    $vin = $this->faker->vin();
    expect($vin)->toMatch('/[a-zA-Z0-9]{17}/');
    expect($this->faker->validateVin($vin))->toBeTrue();
});
