<?php

namespace FakeCar\Tests\TestDataProviders;

class BMWFakeCarData extends \Faker\Provider\FakeCarData
{
    public static array $brandsWithModels = [
        'BMW' => [
            '8 Series', 'M1', 'X5', 'Z1', 'Z3', 'Z4', 'Z8', 'Alpina', 'E', 'X3', 'M', 'X6', '1 Series', '5 Series',
            'X5 M', 'M5', '750', '6 Series', '3 Series', 'M3', 'X6 M', 'M6', 'X1', '7 Series', '325', '324', '316',
            '320', '318', '328', '523', '740', '520', '728', '525', 'Isetta', '530', '528', '545', '535', 'Dixi',
            '730', '745', '518', '524', '540', '116', '118', '120', '123', '125', '130', '135', '323', '330', '335',
            '550', '628', '630', '633', '635', '645', '650', '640', '760', '735', '732', '725', 'X series', 'X8',
            '340', 'RR', '1 Series М', '321', '315', '6 Series Gran Coupe', 'X2', '4 Series', '428', '435', '420',
            '2 Series', '3 Series GT', 'X4', '4 Series Gran Coupe', '326', 'I8', '5 Series GT', 'I3', 'M2', 'M4',
            'Neue Klasse', '1602', 'Active Hybrid 7', '2002', '2000', 'F10', 'X7', '128', '6 Series GT',
        ],
    ];

    public static array $vehicleTypes = [
        'hatchback', 'sedan', 'convertible', 'SUV', 'coupe',
    ];

    public static array $vehicleFuelTypes = [
        'gasoline' => 40,
        'electric' => 10,
        'diesel'   => 20,
    ];

    public static array $vehicleEnginePower = [
        'range' => [150, 1200],
        'unit'  => 'hp',
    ];

    public static array $vehicleEngineTorque = [
        'range' => [300, 700],
        'unit'  => 'nm',
    ];
}
