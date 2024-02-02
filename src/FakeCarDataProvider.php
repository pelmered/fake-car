<?php

namespace Faker\Provider;

use Exception;
use InvalidArgumentException;

class FakeCarDataProvider implements FakeCarDataProviderInterface
{
    protected $vehicleData;

    public function __construct($vehicleData = null)
    {
        $this->vehicleData = $vehicleData ?: FakeCarData::class;
    }

    /**
     * @throws Exception
     */
    public function getVehicleBrand(): string
    {
        return (string) FakeCarHelper::getRandomElementFromArray(array_keys($this->vehicleData::$brandsWithModels));
    }

    /**
     * @throws Exception
     */
    public function getVehicleModel(string $brand = null): string
    {
        $brandsWithModels = $this->vehicleData::$brandsWithModels;

        return (string) FakeCarHelper::getRandomElementFromArray($brandsWithModels[$brand ?: $this->getVehicleBrand()]);
    }

    public function getBrandsWithModels(): array
    {
        return $this->vehicleData::$brandsWithModels;
    }

    /**
     * @throws Exception
     */
    public function getVehicleType(): string
    {
        return FakeCarHelper::getArrayData($this->vehicleData::$vehicleTypes);
    }

    /**
     * @throws Exception
     */
    public function getVehicleFuelType(int $count = 1): string|array
    {
        return FakeCarHelper::getArrayData($this->vehicleData::$vehicleFuelTypes, $count);
    }

    /**
     * @throws Exception
     */
    public function getVehicleDoorCount(): int
    {
        return FakeCarHelper::getArrayData($this->vehicleData::$vehicleDoorCount);
    }

    /**
     * @throws Exception
     */
    public function getVehicleSeatCount(): int
    {
        return FakeCarHelper::getArrayData($this->vehicleData::$vehicleSeatCount);
    }

    /**
     * @throws Exception
     */
    public function getVehicleProperties(int $count = 0): array
    {
        return FakeCarHelper::getArrayData($this->vehicleData::$vehicleProperties, $count);
    }

    /**
     * @throws Exception
     */
    public function getVehicleGearBoxType(): string
    {
        return FakeCarHelper::getArrayData($this->vehicleData::$vehicleGearBoxType);
    }
}
