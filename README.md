# Fake-Car
Faker provider for fake car data

[![Latest Stable Version](https://poser.pugx.org/pelmered/fake-car/v/stable)](https://packagist.org/packages/pelmered/fake-car)
[![Total Downloads](https://poser.pugx.org/pelmered/fake-car/d/total)](//packagist.org/packages/pelmered/fake-car/stats)
[![Monthly Downloads](https://poser.pugx.org/pelmered/fake-car/d/monthly)](//packagist.org/packages/pelmered/fake-car/stats)
[![License](https://poser.pugx.org/pelmered/fake-car/license)](https://packagist.org/packages/pelmered/fake-car)

[![Build Status](https://scrutinizer-ci.com/g/pelmered/fake-car/badges/build.png?b=main)](https://scrutinizer-ci.com/g/pelmered/fake-car/build-status/main)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pelmered/fake-car/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/pelmered/fake-car/?branch=master)
[![OtterWise Coverage](https://img.shields.io/endpoint?url=https://otterwise.app/badge/github/pelmered/fake-car)](https://otterwise.app/github/pelmered/fake-car)
[![OtterWise Coverage](https://img.shields.io/endpoint?url=https://otterwise.app/badge/github/pelmered/fake-car/type)](https://otterwise.app/github/pelmered/fake-car)

## Installation

To install as a dev dependency run:
```sh
composer require pelmered/fake-car --dev
```
Remove the `--dev` flag if you need it in production.

## Upgrade to 2.x from 1.x

### Breaking changes:
1. Now requires PHP 8.1+ (previously 7.3+)
2. The provider name has changed from `Fakecar` to `FakeCar`. This will cause problems if you are on a case-sensitive filesystem, but it is strongly recommended to change this even if you are not.
3. The methods `transliterate` and `checkDigit` on the `FakeCar` provider class are now no longer publicly available (Visibility changed to private).
4. The public methods `getRandomElementsFromArray` and `getWeighted` on the `FakeCar` provider class has been moved to a helper class. Access them like this: `\Faker\Provider\FakeCarHelper::getWeighted()`
5. The constants `EBCDIC` and `MODELYEAR` are no longer public.

3, 4 and 5 are changes limited to undocumented features of the public API, 
and should therefore not impact the typical use cases of this package.

## Basic Usage

```php
$faker = (new \Faker\Factory())::create();
$faker->addProvider(new \Faker\Provider\FakeCar($faker));


// generate matching automobile brand and model of a car as a string
echo $faker->vehicle(); // 'Volvo 740'

// generate matching automobile brand and model of a car as an array
echo $faker->vehicleArray(); // [ 'brand' => 'Hummer', 'model' => 'H1' ]

// generate only automobile brand
echo $faker->vehicleBrand(); // 'Ford'

// generate automobile manufacturer and model of car
echo $faker->vehicleModel(); // '488 Spider'

// generate Vehicle Identification Number(VIN) - https://en.wikipedia.org/wiki/Vehicle_identification_number
echo $faker->vin(); // 'd0vcddxpXAcz1utgz'

// generate automobile registration number
echo $faker->vehicleRegistration(); // 'ABC-123'

// generate automobile registration number with custom format
echo $faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'); // AB-12345

// generate automobile model type
echo $faker->vehicleType(); // 'hatchback'

// generate automobile fuel type
echo $faker->vehicleFuelType(); // 'diesel'
echo $faker->vehicleFuelType(2); // ['diesel', 'gasoline']

// generate automobile door count
echo $faker->vehicleDoorCount(); // 4

// generate automobile seat count
echo $faker->vehicleSeatCount(); // 5

// generate automobile properties
echo $faker->vehicleProperties(); // ['Towbar','Aircondition','GPS', 'Leather seats']

// generate automobile gear type (manual or automatic)
echo $faker->vehicleGearBoxType(); // manual

// generate automobile engine power
echo $faker->vehicleEnginePower(); // '250 hp'

// generate automobile engine power without a unit
echo $faker->vehicleEnginePowerValue(); // 175

// generate automobile engine torque
echo $faker->vehicleEngineTorque(); // '300 nm'

// generate automobile engine power without a unit
echo $faker->vehicleEngineTorqueValue(); // 450

// generate automobile engine displacement
echo $faker->vehicleEngineDisplacement(); // '2.0 l'

// generate automobile engine displacement without unit
echo $faker->vehicleEngineDisplacementValue(); // 2.0

// generate automobile engine fuel consumption
echo $faker->vehicleFuelConsumption(); // '5.0 l/100km'

// generate automobile engine fuel consumption without unit
echo $faker->vehicleFuelConsumptionValue(); // 5.0

// generate automobile engine fuel consumption without unit
echo $faker->vehicleEngineCylinders(); // 4
```

### Laravel factory example

```php
<?php
namespace Database\Factories;

use App\Models\Vehicle;
use Faker\Provider\FakeCar;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new FakeCar($this->faker));
        $vehicle = $this->faker->vehicleArray();

        return [
            'vehicle_type'    => 'car',
            'vin'             => $this->faker->vin,
            'registration_no' => $this->faker->vehicleRegistration,
            'chassis_type'    => str_replace(' ', '_', $this->faker->vehicleType),
            'fuel'            => $this->faker->vehicleFuelType,
            'brand'           => $vehicle['brand'],
            'model'           => $vehicle['model'],
            'year'            => $this->faker->biasedNumberBetween(1990, date('Y'), 'sqrt'),
        ];
    }
}
```

## Bring your own data

To bring you own data or override the default you can just provide your own data provider.

### Option 1: Provide your own data object:

First, create the data object:
```php
<?php
class BMWFakeCarData extends \Faker\Provider\FakeCarData
{
    public static $brandsWithModels = [
        'BMW' => [
            '8 Series', 'M1', 'X5', 'Z1', 'Z3', 'Z4', 'Z8', 'Alpina', 'E', 'X3', 'M', 'X6', '1 Series', '5 Series',
            'X5 M', 'M5', '750', '6 Series', '3 Series', 'M3', 'X6 M', 'M6', 'X1', '7 Series', '325', '324', '316',
            '320', '318', '328', '523', '740', '520', '728', '525', 'Isetta', '530', '528', '545', '535', 'Dixi',
            '730', '745', '518', '524', '540', '116', '118', '120', '123', '125', '130', '135', '323', '330', '335',
            '550', '628', '630', '633', '635', '645', '650', '640', '760', '735', '732', '725', 'X series', 'X8',
            '340', 'RR', '1 Series М', '321', '315', '6 Series Gran Coupe', 'X2', '4 Series', '428', '435', '420',
            '2 Series', '3 Series GT', 'X4', '4 Series Gran Coupe', '326', 'I8', '5 Series GT', 'I3', 'M2', 'M4',
            'Neue Klasse', '1602', 'Active Hybrid 7', '2002', '2000', 'F10', 'X7', '128', '6 Series GT'
        ],
    ];

    public static $vehicleTypes = [
        'hatchback', 'sedan', 'convertible', 'SUV', 'coupe',
    ];

    public static $vehicleFuelTypes = [
        'gasoline' => 40,
        'electric' => 10,
        'diesel' => 20,
    ];
}
```

And then add it to faker like this:
```php
$fakeCarDataProvider = new \Faker\Provider\FakeCarDataProvider(new BMWFakeCarData);

$faker = (new \Faker\Factory())::create();
$fakeCar = new \Faker\Provider\FakeCar($faker);
$fakeCar->setDataProvider($fakeCarDataProvider);
$faker->addProvider($fakeCar);

echo $faker->vehicleBrand; // BMW
```

### Option 2: Provide your own data provider:
```php
<?php
namespace FakeCar\Tests\TestProviders;

use Faker\Provider\FakeCarDataProviderInterface;
use Faker\Provider\FakeCarHelper;

class FerrariEnzoTestProvider implements FakeCarDataProviderInterface
{

    public function getVehicleBrand(): string
    {
        return 'Ferrari';
    }

    public function getVehicleModel(): string
    {
        return 'Enzo';
    }

    public function getBrandsWithModels(): array
    {
        return [
            'brand' => $this->getVehicleBrand(),
            'model' => $this->getVehicleModel(),
        ];
    }

    public function getVehicleType(): string
    {
        return 'coupe';
    }

    public function getVehicleFuelType(): string|array
    {
        return 'gasoline';
    }

    public function getVehicleDoorCount(): int
    {
        return 2;
    }

    public function getVehicleSeatCount(): int
    {
        return 2;
    }

    public function getVehicleProperties(int $count = 0): array
    {
        return [
            'Air condition',
            'GPS',
            'Leather seats',
        ];
    }

    public function getVehicleGearBoxType(): string
    {
        return FakeCarHelper::getWeighted([
            'manual'    => 70,
            'automatic' => 30,
        ]);
    }

}
```

And then add the provider to faker:
```php

$fakeCarDataProvider = new FerrariEnzoTestProvider();

$faker = (new \Faker\Factory())::create();
$fakeCar = new \Faker\Provider\FakeCar($faker);
$fakeCar->setDataProvider($fakeCarDataProvider);
$faker->addProvider($fakeCar);

echo $faker->vehicleBrand; // Ferrari
echo $faker->vehicleModel; // Enzo
```

Check the [FakeCarDataProviderTest]() for more examples. 

