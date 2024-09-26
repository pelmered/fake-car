<?php

namespace Faker\Provider;

use Exception;

class FakeCarDataProvider implements FakeCarDataProviderInterface
{
    protected mixed $vehicleData;

    public function __construct(mixed $vehicleData = null)
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
    public function getVehicleModel(?string $brand = null): string
    {
        $brandsWithModels = $this->vehicleData::$brandsWithModels;

        return (string) FakeCarHelper::getRandomElementFromArray($brandsWithModels[$brand ?: $this->getVehicleBrand()]);
    }

    /**
     * @return array<string, array<string>>
     */
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
     * @return string|array<string>)
     *
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
     * @return array<string>
     *
     * @throws Exception
     */
    public function getVehicleProperties(int $count = 1): array
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

    /**
     * @throws Exception
     */
    public function getVehicleEnginePower(): string
    {
        ['range' => $range, 'unit' => $unit] = $this->vehicleData::$vehicleEnginePower;

        return FakeCarHelper::getRangeWithUnit($range, $unit);
    }

    /**
     * @throws Exception
     */
    public function getVehicleEnginePowerValue(): int|string
    {
        ['range' => $range] = $this->vehicleData::$vehicleEnginePower;

        return FakeCarHelper::getRange($range);
    }

    /**
     * @throws Exception
     */
    public function getVehicleEngineTorque(): string
    {
        ['range' => $range, 'unit' => $unit] = $this->vehicleData::$vehicleEngineTorque;

        return FakeCarHelper::getRangeWithUnit($range, $unit);
    }

    /**
     * @throws Exception
     */
    public function getVehicleEngineTorqueValue(): int|string
    {
        ['range' => $range] = $this->vehicleData::$vehicleEngineTorque;

        return FakeCarHelper::getRange($range);
    }
}
