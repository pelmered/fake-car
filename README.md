# Fake-Car
Faker provider for fake car data

[![Latest Stable Version](https://poser.pugx.org/pelmered/fake-car/v/stable)](https://packagist.org/packages/pelmered/fake-car)
[![Build Status](https://scrutinizer-ci.com/g/pelmered/fake-car/badges/build.png?b=master)](https://scrutinizer-ci.com/g/pelmered/fake-car/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pelmered/fake-car/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pelmered/fake-car/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/pelmered/fake-car/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/pelmered/fake-car/?branch=master)
[![License](https://poser.pugx.org/pelmered/fake-car/license)](https://packagist.org/packages/pelmered/fake-car)
[![Build Status](https://travis-ci.org/pelmered/fake-car.svg?branch=master)](https://travis-ci.org/pelmered/fake-car)

## Installation

```sh
composer require pelmered/fake-car
```
or add 
```sh
"pelmered/fake-car": "^1.0"
```

## Basic Usage
```php
$faker = (new \Faker\Factory())::create();
$faker->addProvider(new \Faker\Provider\Fakecar($faker));


// generate matching automobile brand and model of car as a string
echo $faker->vehicle; //Volvo 740

// generate matching automobile brand and model of car as an array
echo $faker->vehicleArray; //[ 'brand' => 'Hummer', 'model' => 'H1' ]

// generate only automobile brand
echo $faker->vehicleBrand; //Ford

// generate automobile manufacturer and model of car
echo $faker->vehicleModel; //488 Spider

// generate Vehicle Identification Number(VIN) - https://en.wikipedia.org/wiki/Vehicle_identification_number
echo $faker->vin; //d0vcddxpXAcz1utgz

// generate automobile registration number
echo $faker->vehicleRegistration; //ABC-123

// generate automobile registration number with custom format
echo $faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'); //AB-12345

// generate automobile model type
echo $faker->vehicleType; //hatchback

// generate automobile fuel type
echo $faker->vehicleFuelType; //diesel

// generate automobile door count
echo $faker->vehicleDoorCount; //4

// generate automobile seat count
echo $faker->vehicleSeatCount; //5

// generate automobile properties
echo $faker->vehicleProperties; //['Towbar','Aircondition','GPS', 'Leather seats']

// generate automobile gear type (manual or automatic)
echo $faker->vehicleGearBoxType; //manual
```

### Laravel factory example

```php
<?php

use Faker\Generator as Faker;

$factory->define(App\Vehicle::class, function (Faker $faker) {

    $faker->addProvider(new \Faker\Provider\Fakecar($faker));
    $v = $faker->vehicleArray();

    return [
        'vehicle_type'      => 'car',
        'vin'               => $faker->vin,
        'registration_no'   => $faker->vehicleRegistration,
        'type'              => $faker->vehicleType,
        'fuel'              => $faker->vehicleFuelType,
        'brand'             => $v['brand'],
        'model'             => $v['model'],
        'year'              => $faker->biasedNumberBetween(1998,2017, 'sqrt'),
    ];
});
```
