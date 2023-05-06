<?php

namespace Faker\Provider;

interface FakeCarDataProviderInterface
{
    public function getVehicleBrand(): string;
    public function getVehicleModel(): string;
    public function getBrandsWithModels(): array;
    public function getVehicleType(): string;
    public function getVehicleFuelType(): string|array;
    public function getVehicleDoorCount(): int;
    public function getVehicleSeatCount(): int;
    public function getVehicleProperties(int $count = 0): array;
    public function getVehicleGearBoxType(): string;
}
