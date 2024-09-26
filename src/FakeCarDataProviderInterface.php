<?php

namespace Faker\Provider;

interface FakeCarDataProviderInterface
{
    public function getVehicleBrand(): string;

    public function getVehicleModel(?string $brand = null): string;

    /**
     * @return array<string, array<string>>
     */
    public function getBrandsWithModels(): array;

    public function getVehicleType(): string;

    /**
     * @return string|array<string>)
     */
    public function getVehicleFuelType(int $count = 1): string|array;

    public function getVehicleDoorCount(): int;

    public function getVehicleSeatCount(): int;

    /**
     * @return array<string>
     */
    public function getVehicleProperties(int $count = 0): array;

    public function getVehicleGearBoxType(): string;
}
