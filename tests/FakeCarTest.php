<?php

namespace FakeCar\tests;

use Exception;
use Faker\Factory;
use Faker\Generator;
use Faker\Provider\FakeCar;
use Faker\Provider\FakeCarData;
use Faker\Provider\FakeCarDataProvider;
use Faker\Provider\FakeCarHelper;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class FakeCarTest extends TestCase
{
    /**
     * @var Generator
     */
    private $faker;

    public function setUp(): void
    {
        $faker = Factory::create();
        $faker->addProvider(new FakeCar($faker));
        $this->faker = $faker;
    }

    /**
     * @throws ReflectionException
     */
    public function getProtectedProperty($property, $object = null)
    {
        if (is_null($object)) {
            $object = new FakeCarDataProvider;
        }

        $reflection = new \ReflectionClass($object);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);

        return $reflection_property->getValue($object, $property);
    }

    public function callProtectedMethod($args, $method, $object = null)
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

    public function testVehicle(): void
    {
        $this->faker->seed(random_int(1, 9999));

        $vehicleText = $this->faker->vehicle();
        $brands = (new FakeCarDataProvider)->getBrandsWithModels();

        foreach ($brands as $brand => $models) {
            if (substr($vehicleText, 0, strlen($brand)) === $brand) {
                foreach ($models as $model) {
                    if (substr($vehicleText, -strlen($model)) === $model) {
                        $this->assertStringEndsWith($model, $vehicleText);
                        break;
                    }
                }
            }
        }
    }

    public function testVehicleArray(): void
    {
        $vehicleArray = $this->faker->vehicleArray();

        $this->assertArrayHasKey('brand', $vehicleArray);
        $this->assertArrayHasKey('model', $vehicleArray);

        $brandsArray = (new FakeCarDataProvider)->getBrandsWithModels();

        $this->assertContains($vehicleArray['model'], $brandsArray[$vehicleArray['brand']]);
    }

    public function testVehicleBrand(): void
    {
        $this->assertArrayHasKey(
            $this->faker->vehicleBrand,
            (new FakeCarDataProvider)->getBrandsWithModels()
        );
    }

    public function testVehicleModel($make = null): void
    {
        $this->faker->seed(random_int(1, 9999));

        $vehicleBrand = $this->faker->vehicleBrand();

        $this->assertContains(
            $this->faker->vehicleModel($vehicleBrand), ((new FakeCarDataProvider)->getBrandsWithModels())[$vehicleBrand]
        );
    }

    public function testVehicleRegistration(): void
    {
        $this->assertMatchesRegularExpression('/[A-Z]{3}-[0-9]{3}/', $this->faker->vehicleRegistration());
        $this->assertMatchesRegularExpression('/[A-Z]{2}-[0-9]{5}/', $this->faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'));
    }

    public function testVehicleType(): void
    {
        $this->assertContains($this->faker->vehicleType, FakeCarData::$vehicleTypes);
    }

    public function testVehicleFuelType(): void
    {
        $this->assertContains($this->faker->vehicleFuelType, array_keys(FakeCarData::$vehicleFuelTypes));
    }

    public function testVehicleDoorCount(): void
    {
        for ($i = 0; $i<10; $i++) {
            $this->assertThat(
                $this->faker->vehicleDoorCount,
                $this->logicalAnd(
                    $this->isType('int'),
                    $this->greaterThanOrEqual(2),
                    $this->lessThanOrEqual(6)
                )
            );
        }
    }

    public function testVehicleSeatCount(): void
    {
        for ($i = 0; $i<10; $i++) {
            $this->assertThat(
                $this->faker->vehicleSeatCount,
                $this->logicalAnd(
                    $this->isType('int'),
                    $this->greaterThanOrEqual(1),
                    $this->lessThanOrEqual(9)
                )
            );
        }
    }

    public function testVehicleProperties(): void
    {
        $properties = $this->faker->vehicleProperties;
        $this->assertIsArray($properties);

        $properties = $this->faker->vehicleProperties(2);
        $this->assertIsArray($properties);
        $this->assertCount(2, $properties);

        $properties = $this->faker->vehicleProperties(5);
        $this->assertIsArray($properties);
        $this->assertCount(5, $properties);

        //If we pass 0 we should get a random
        $properties = $this->faker->vehicleProperties(0);
        $this->assertIsArray($properties);
        $this->assertGreaterThanOrEqual(0, count($properties));
    }

    public function testVehicleGearBox(): void
    {
        $this->assertContains($this->faker->vehicleGearBoxType, array_keys(FakeCarData::$vehicleGearBoxType));
    }

    /**
     * @throws Exception
     */
    public function testGetRandomElementsFromArray(): void
    {
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

        $this->assertCount(1, FakeCarHelper::getRandomElementsFromArray($data, 1));
        $this->assertCount(3, FakeCarHelper::getRandomElementsFromArray($data, 3));
        $this->assertCount(6, FakeCarHelper::getRandomElementsFromArray($data, 6));
        $this->assertCount(10, FakeCarHelper::getRandomElementsFromArray($data, 10));
        $this->assertEquals([], FakeCarHelper::getRandomElementsFromArray($data, 0));

        for ($i = 0; $i<50; $i++) {
            $result6 = FakeCarHelper::getRandomElementsFromArray($data, null);

            $this->assertGreaterThanOrEqual(0, count($result6));
            $this->assertLessThanOrEqual(10, count($result6));

            foreach ($result6 as $r) {
                $this->assertContains($r, $data);
            }
        }

        $this->expectException(\InvalidArgumentException::class);

        FakeCarHelper::getRandomElementsFromArray($data, 20);
    }


    /**
     * @throws ReflectionException
     */
    public function testGetWeighted(): void
    {
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

            $this->assertGreaterThan($result['key2'], $result['key1']);
            $this->assertGreaterThan($result['key3'], $result['key2']);
            $this->assertGreaterThan($result['key3'], $result['key1']);
        }

        $this->assertEquals('', FakeCarHelper::getWeighted([]));
    }

    public function testValidVin(): void
    {
        //Too short
        $this->assertFalse($this->faker->validateVin('z2j9hhgr8Ahl1e3g'));
        //Too long
        $this->assertFalse($this->faker->validateVin('az2j9hhgr8Ahl1e3gs'));
        //Invalid check digit
        $this->assertFalse($this->faker->validateVin('z2j9hhgr2Ahl1e3gs'));
        //Invalid
        $this->assertFalse($this->faker->validateVin('z2j9hhgr8Ahl1e3gd'));

        // Valid VINs
        $this->assertTrue($this->faker->validateVin('z2j9hhgr8Ahl1e3gs'));
        $this->assertTrue($this->faker->validateVin('n7u30vns7Ajsrb1nc'));
        $this->assertTrue($this->faker->validateVin('3julknxb0A06hj41x'));
        $this->assertTrue($this->faker->validateVin('yj12c8z40Aca2x6p3'));
        $this->assertTrue($this->faker->validateVin('y95wf7gm1A9g7pz5z'));
        $this->assertTrue($this->faker->validateVin('355430557Azf4u0vr'));
    }

    public function testVinReturnsValidVin(): void
    {
        $vin = $this->faker->vin();
        $this->assertTrue($this->faker->validateVin($vin));
    }
    public function testModelYear(): void
    {
        $this->assertEquals('A', $this->faker->modelYear(1980));
        $this->assertEquals('Y', $this->faker->modelYear(2000));
        $this->assertEquals('H', $this->faker->modelYear(2017));
        $this->assertEquals('J', $this->faker->modelYear(2018));
        $this->assertEquals('K', $this->faker->modelYear(2019));
    }
    public function testTransliterate()
    {
        $this->assertEquals(0, $this->callProtectedMethod(['O'], 'transliterate', new FakeCar($this->faker)));
        $this->assertEquals(1, $this->callProtectedMethod(['A'], 'transliterate', new FakeCar($this->faker)));
        $this->assertEquals(2, $this->callProtectedMethod(['K'], 'transliterate', new FakeCar($this->faker)));
    }

    public function testCheckDigit()
    {
        $this->assertEquals('4', $this->callProtectedMethod(['z2j9hhgr8Ahl1e3g'], 'checkDigit', new FakeCar($this->faker)));
        $this->assertEquals('1', $this->callProtectedMethod(['n7u30vns7Ajsrb1n'], 'checkDigit', new FakeCar($this->faker)));
        $this->assertEquals('8', $this->callProtectedMethod(['3julknxb0A06hj41'], 'checkDigit', new FakeCar($this->faker)));
    }

    public function testVin()
    {
        $vin = $this->faker->vin();
        $this->assertMatchesRegularExpression('/[a-zA-Z0-9]{17}/', $vin);
        $this->assertTrue($this->faker->validateVin($vin));
    }

    public function testEnginePower()
    {
        $power = $this->faker->vehicleEnginePower;
        $this->assertMatchesRegularExpression('/^\d+ hp$/', $power);
        $this->assertGreaterThanOrEqual(100, (int)explode(' ', $power)[0]);
        $this->assertLessThanOrEqual(1500, (int)explode(' ', $power)[0]);
    }

    public function testEngineTorque()
    {
        $torque = $this->faker->vehicleEngineTorque;
        $this->assertMatchesRegularExpression('/^\d+ nm$/', $torque);
        $this->assertGreaterThanOrEqual(100, (int)explode(' ', $torque)[0]);
        $this->assertLessThanOrEqual(700, (int)explode(' ', $torque)[0]);
    }

    public function testGetRange()
    {
        for($x = 0; $x<100; $x++) {
            $range = FakeCarHelper::getRange([1, 100], 0);
            $this->assertMatchesRegularExpression('/^\d+$/', $range);
            $this->assertGreaterThanOrEqual(1, (int)$range);
            $this->assertLessThanOrEqual(100, (int)$range);
        }

        for($x = 0; $x<100; $x++) {
            $range = FakeCarHelper::getRange([100, 150], 2);

            $this->assertMatchesRegularExpression('/^\d+\.\d+$/', $range);
            $this->assertGreaterThanOrEqual(100, (int)$range);
            $this->assertLessThanOrEqual(150, (int)$range);
        }
    }
    public function testGetRangeInvalid()
    {
        $this->expectException('\Random\RandomException');
        FakeCarHelper::getRange([100, 50], 2);

        $this->expectException('\InvalidArgumentException');
        FakeCarHelper::getRange([100, 50], -2);
    }

    public function testGetRangeWithUnit()
    {
        for($x = 0; $x<100; $x++) {
            $range = FakeCarHelper::getRangeWithUnit([2065, 2450], 'l', 0);

            $this->assertMatchesRegularExpression('/^\d+ l$/', $range);
            $this->assertGreaterThanOrEqual(2065, (int)$range);
            $this->assertLessThanOrEqual(2450, (int)$range);
        }

        for($x = 0; $x<100; $x++) {
            $range = FakeCarHelper::getRangeWithUnit([200, 250], 'hp', 2);

            $this->assertMatchesRegularExpression('/^\d+\.\d+ hp$/', $range);
            $this->assertGreaterThanOrEqual(200, (int)$range);
            $this->assertLessThanOrEqual(250, (int)$range);
        }
    }
}
