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
            //$object = new FakeCar($this->faker);
            $object = new FakeCarDataProvider;
        }

        $reflection = new \ReflectionClass($object);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);

        return $reflection_property->getValue($object, $property);
    }

    /**
     * @throws ReflectionException
     */
    public function callProtectedMethod($args, $method, $object = null)
    {
        if (is_null($object)) {
            //$object = new FakeCar($this->faker);
            $object = new FakeCarDataProvider;
        }

        $reflection = new \ReflectionClass($object);
        $reflectionMethod = $reflection->getMethod($method);
        $reflectionMethod->setAccessible(true);

        return $reflectionMethod->invoke($object, ...$args);
    }

    public function testVehicle()
    {
        $this->faker->seed(random_int(1, 9999));

        $vehicleBrand = $this->faker->vehicleBrand();

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

    public function testVehicleArray()
    {
        $vehicleArray = $this->faker->vehicleArray();

        $this->assertArrayHasKey('brand', $vehicleArray);
        $this->assertArrayHasKey('model', $vehicleArray);

        $brandsArray = (new FakeCarDataProvider)->getBrandsWithModels();

        $this->assertTrue(
            in_array(
                $vehicleArray['model'],
                $brandsArray[$vehicleArray['brand']]
            )
        );
    }

    public function testVehicleBrand()
    {
        $this->assertTrue(
            array_key_exists(
                $this->faker->vehicleBrand,
                (new FakeCarDataProvider)->getBrandsWithModels()
            )
        );
    }

    public function testVehicleModel($make = null)
    {
        $this->faker->seed(random_int(1, 9999));

        $modelArray = (new FakeCarDataProvider)->getBrandsWithModels();
        $modelArray = $modelArray[$this->faker->vehicleBrand()];

        $vehicleBrand = $this->faker->vehicleBrand();

        $this->assertContains(
            $this->faker->vehicleModel($vehicleBrand), ((new FakeCarDataProvider)->getBrandsWithModels())[$vehicleBrand]
        );
    }

    public function testVehicleRegistration()
    {
        $this->assertMatchesRegularExpression('/[A-Z]{3}-[0-9]{3}/', $this->faker->vehicleRegistration());
        $this->assertMatchesRegularExpression('/[A-Z]{2}-[0-9]{5}/', $this->faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'));
    }

    public function testVehicleType()
    {
        $this->assertContains($this->faker->vehicleType, FakeCarData::$vehicleTypes);
    }

    public function testVehicleFuelType()
    {
        //dd($this->faker->vehicleFuelType, FakeCarData::$vehicleFuelTypes);
        $this->assertTrue(in_array($this->faker->vehicleFuelType, array_keys(FakeCarData::$vehicleFuelTypes), true));
    }

    public function testVehicleDoorCount()
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

    public function testVehicleSeatCount()
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

    public function testVehicleProperties()
    {
        $properties = $this->faker->vehicleProperties;
        $this->assertTrue(is_array($properties));

        $properties = $this->faker->vehicleProperties(2);
        $this->assertTrue(is_array($properties));
        $this->assertCount(2, $properties);

        $properties = $this->faker->vehicleProperties(5);
        $this->assertTrue(is_array($properties));
        $this->assertCount(5, $properties);

        //If we pass 0 we should get a random
        $properties = $this->faker->vehicleProperties(0);
        $this->assertTrue(is_array($properties));
        $this->assertGreaterThanOrEqual(0, count($properties));
    }

    public function testVehicleGearBox()
    {
        $this->assertTrue(in_array($this->faker->vehicleGearBoxType, array_keys(FakeCarData::$vehicleGearBoxType)));
    }

    /**
     * @throws Exception
     */
    public function testGetRandomElementsFromArray()
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
            //$result6 = $this->assertCount(1, $this->callProtectedMethod([$data], 'getRandomElementsFromArray'));
            //$result6 = $this->callProtectedMethod([$data, null], 'getRandomElementsFromArray');

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
    public function testGetWeighted()
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

    public function testValidVin()
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

    public function testVinReturnsValidVin()
    {
        $vin = $this->faker->vin();
        $this->assertTrue($this->faker->validateVin($vin));
    }
    public function testModelYear()
    {
        $this->assertEquals($this->faker->modelYear(1980), 'A');
        $this->assertEquals($this->faker->modelYear(2000), 'Y');
        $this->assertEquals($this->faker->modelYear(2017), 'H');
        $this->assertEquals($this->faker->modelYear(2018), 'J');
        $this->assertEquals($this->faker->modelYear(2019), 'K');
    }
    public function testTransliterate()
    {
        $this->assertEquals($this->callProtectedMethod(['O'], 'transliterate', new FakeCar($this->faker)), 0);
        $this->assertEquals($this->callProtectedMethod(['A'], 'transliterate', new FakeCar($this->faker)), 1);
        $this->assertEquals($this->callProtectedMethod(['K'], 'transliterate', new FakeCar($this->faker)), 2);
    }
}
