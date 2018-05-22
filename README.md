# Fake-Car
Faker provider for fake car data

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
$faker->addProvider(new pelmered\Faker\FakeCar\Provider($faker));


// generate matching automobile brand and model of car as a string
echo $faker->vehicle; //Volvo 740

// generate matching automobile brand and model of car as an array
echo $faker->vehicle; //[ 'brand' => 'Hummer', 'model' => 'H1' ]

// generate only automobile brand
echo $faker->vehicleBrand; //Ford

// generate automobile manufacturer and model of car
echo $faker->vehicleModel; //488 Spider

// generate automobile registration number
echo $faker->vehicleRegistration; //ABC-123

// generate automobile registration number with custom format
echo $faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'); //AB-12345

// generate automobile model type
echo $faker->vehicleType; //hatchback

// generate automobile fuel type
echo $faker->vehicleFuelType; //diesel
```

### Laravel seeder example

```php
<?php

use Faker\Generator as Faker;

$factory->define(App\Vehicle::class, function (Faker $faker) {

    $faker->addProvider(new \Faker\Provider\Fakecar($faker));
    $v = $faker->vehicleArray();

    return [
        'vehicle_type'      => 'car',
        'registration_no'   => $faker->vehicleRegistration,
        'type'              => $faker->vehicleType,
        'fuel'              => $faker->vehicleFuelType,
        'brand'             => $v['brand'],
        'model'             => $v['model'],
        'year'              => $faker->biasedNumberBetween(1998,2017, 'sqrt'),
    ];
});
```
