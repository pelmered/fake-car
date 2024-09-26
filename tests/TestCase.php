<?php

namespace FakeCar\Tests;

use Exception;
use Faker\Provider\FakeCarDataProvider;
use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionException;

abstract class TestCase extends BaseTestCase
{
    public function callProtectedMethod($args, $method, $object = null)
    {
        if (is_null($object)) {
            $object = new FakeCarDataProvider;
        }

        try {
            $reflection = new \ReflectionClass($object);

            return $reflection->getMethod($method)->invoke($object, ...$args);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @throws ReflectionException
     */
    public function getProtectedProperty($property, $object = null)
    {
        if (is_null($object)) {
            $object = new FakeCarDataProvider;
        }

        try {
            $reflection = new \ReflectionClass($object);

            return $reflection->getProperty($property)->getValue($object, $property);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
