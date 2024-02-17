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

    public function getVehicleEnginePower(): string
    {
        // TODO: Implement getVehicleEnginePower() method.
    }

    public function getVehicleEngineTorque(): string
    {
        // TODO: Implement getVehicleEngineTorque() method.
    }
}
