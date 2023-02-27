<?php
namespace Faker\Provider;

interface FakeCarDataProviderInterface
{
    public static function getBrandsWithModels(): array;
    public static function getVehicleType(): string;
    public static function getVehicleFuelType(): string|array;
    public static function getVehicleDoorCount(): int;
    public static function getVehicleSeatCount(): int;
    public static function getVehicleProperties(int $count = 0): array;
    public static function getVehicleGearBoxType(): string;
}
