<?php

namespace Faker\Provider;

class CarData
{
    public static function getBrandsWithModels() : array
    {
        return static::$brandsWithModels;
    }
    public static function getVehicleTypes() : array
    {
        return static::$vehicleTypes;
    }
    public static function getVehicleFuelTypes() : array
    {
        return static::$vehicleFuelTypes;
    }
    public static function getVehicleDoorCount() : array
    {
        return static::$vehicleDoorCount;
    }
    public static function getVehicleSeatCount() : array
    {
        return static::$vehicleSeatCount;
    }
    public static function getVehicleProperties() : array
    {
        return static::$vehicleProperties;
    }
    public static function getVehicleGearBoxType() : array
    {
        return static::$vehicleGearBox;
    }

    // phpcs:disable
    protected static $brandsWithModels = array(
        'Abarth' => array(
            'Fiat 595'
        ),
        'Acura' => array(
            'CL', 'Integra', 'MDX', 'NSX', 'RL', 'RSX', 'TL', 'TSX', 'Legend', 'RDX', 'SLX', 'Vigor', 'ZDX', 'EL', 'ILX', 'RLX', 'TLX'
        ),
        'Adler' => array(
            'Trumpf', 'Stromform'
        ),
        'Aero' => array(
            '30'
        ),
        'Aixam' => array(
            '400', '500', 'Scouty', 'City'
        ),
        'Alfa Romeo' => array(
            '145', '146', '147', '155', '156', '164', '166', '33', '75', '90', 'Alfasud', 'Alfetta', 'Arna', 'Giulietta', 'Gold Cloverleaf', 'GTV', 'Spider', 'Sprint', 'SZ', 'GT', 'Imola', '1333', 'Das', 'AR', 'Giulia', 'GTA', '2600', 'Montreal', '159', 'Brera', '169', '149', 'Junior', 'Mito', 'Crosswagon', '6 (119)', '4C', 'Stelvio'
        ),
        'Alpine' => array(
            'A110', 'A310', 'A610'
        ),
        'Altamarea' => array(
            '2E'
        ),
        'Aro' => array(
            '10', '24', 'Spartana', '461', '104', '244', '243', '240', '245', '246'
        ),
        'Artega' => array(
            'GT'
        ),
        'Asia' => array(
            'Rocsta', 'Topic', 'Towner', 'Cosmos'
        ),
        'Aston Martin' => array(
            'DB7', 'Lagonda', 'V8', 'Vanquish', 'Vantage', 'Virage', 'Volante', 'V12', 'DB9', 'Bulldog', 'Tick', 'Tickford Capri', 'Zagato', 'V8 Vantage', 'DBS', 'Rapide', 'Cygnet', 'DB11'
        ),
        'Audi' => array(
            '100', '200', '80', '90', 'A2', 'A3', 'A4', 'A6', 'A8', 'RS6', 'RS4', 'S3', 'S4', 'S6', 'S8', 'V8', 'TT', 'Q7', 'A5', 'R8', 'S5', 'Q5', 'TTS', 'A4 Allroad', 'A6 Allroad', 'S2', 'A1', 'A7', 'RS5', 'DKW', 'TT RS', 'TT (все)', 'RS3', 'Q3', 'S7 Sportback', 'SQ', '50', 'RS7', 'RS 4 Avant', 'RS Q3', 'SQ5', 'Q7 E-tron', 'A3 Sportback E-tron', 'SQ7', 'Q2'
        ),
        'Austin' => array(
            'Allegro', 'Ambassador', 'Maestro', 'Maxi', 'Maxi 2', 'Metro', 'Mini', 'Mini Classic', 'Montego', 'Princess', 'Mini MK', 'Montego Kombi', 'Princess 2', 'Rover', 'FX'
        ),
        'Austin-Healey' => array(
            '3000'
        ),
        'Autobianchi' => array(
            'A 112'
        ),
        'Barkas (Баркас)' => array(
            'B1000', '1001', 'VEB', '1990'
        ),
        'Beijing' => array(
            'BJ 2020', 'Land King', 'BJ 2021', 'BW4Y'
        ),
        'Bentley' => array(
            'Arnage', 'Azure', 'Brooklands', 'Continental', 'Corniche', 'Eight', 'Mulsanne', 'Series II', 'Turbo R', 'Turbo RT', 'T 2', 'T 1', 'S 2', 'S 1', 'Mark VI', 'Speed 8', 'Continental Supersports', 'Flying Spur', 'Bentayga', 'Flying Spur V8', 'Continental GT V8', 'Continental GT V8 S'
        ),
        'Bertone' => array(
            'Freeclimber'
        ),
        'Bio Auto' => array(
            'evA-5', 'evA-2', 'evA-4'
        ),
        'Blonell' => array(
            'TF 2000 MK1'
        ),
        'BMW' => array(
            '8 Series', 'M1', 'X5', 'Z1', 'Z3', 'Z4', 'Z8', 'Alpina', 'E', 'X3', 'M', 'X6', '1 Series', '5 Series', 'X5 M', 'M5', '750', '6 Series', '3 Series', 'M3', 'X6 M', 'M6', 'X1', '7 Series', '325', '324', '316', '320', '318', '328', '523', '740', '520', '728', '525', 'Isetta', '530', '528', '545', '535', 'Dixi', '730', '745', '518', '524', '540', '116', '118', '120', '123', '125', '130', '135', '323', '330', '335', '550', '628', '630', '633', '635', '645', '650', '640', '760', '735', '732', '725', 'X series', 'X8', '340', 'RR', '1 Series М', '321', '315', '6 Series Gran Coupe', 'X2', '4 Series', '428', '435', '420', '2 Series', '3 Series GT', 'X4', '4 Series Gran Coupe', '326', 'I8', '5 Series GT', 'I3', 'M2', 'M4', 'Neue Klasse', '1602', 'Active Hybrid 7', '2002', '2000', 'F10', 'X7', '128', '6 Series GT'
        ),
        'Bristol' => array(
            '412', '603', 'Beaufighter', 'Blenheim', 'Brigand', 'Britannia', 'Fighter', 'Speedster'
        ),
        'Bugatti' => array(
            'EB 110', 'EB 112', 'Veyron', 'Galibier', 'Chiron'
        ),
        'Buick' => array(
            'Century', 'GL 8', 'LaCrosse', 'LE Sabre', 'Park Avenue', 'Rainer', 'Reatta', 'Regal', 'Rendezvous', 'Riviera', 'Enclave', 'LuCerne', 'Enclave USA', 'LaCrosse USA', 'Skylark', 'Wildcat', 'Roadmaster', 'Special', 'Limitet', 'Encore', 'Super', 'Electra', 'Skyhawk', 'Regal GS', 'Cascada', 'Verano', 'Eight', 'Envision'
        ),
        'Cadillac' => array(
            'Seville', 'Allante', 'Brougham', 'Catera', 'CTS', 'DE Ville', 'Eldorado', 'Escalade', 'Evoq', 'LSE', 'SRX', 'Vizon', 'XLR', 'STS', 'DTS', 'Fleetwood', 'CTS-V Coupe', 'Cimarron', 'Convertible', 'BLS', 'XTS', 'ATS', 'Eureka', 'ELR', 'XT5', 'CT6'
        ),
        'Caterham' => array(
            '7', '21', 'Classic'
        ),
        'Chevrolet' => array(
            'Blazer', 'Camaro', 'Corvette', 'Alero', 'Astra', 'Astro пасс.', 'Aveo', 'Beretta', 'Caprice', 'Cavalier', 'Celta', 'Classic', 'Cobalt', 'Corsa', 'Corsica', 'Equinox', 'Evanda', 'Impala', 'Lacetti', 'Lumina', 'Malibu', 'Matiz', 'Metro', 'Monte Carlo', 'Monza', 'Niva', 'Nubira', 'Omega', 'Chery', 'Tacuma', 'Тахо', 'SSR', 'Silverado', 'Avalanche', 'Suburban', 'Colorado', 'HHR', 'Tahoe', 'Epica', 'Express пасс.', 'Captiva', 'S-10', 'Ventura', 'Traverse', 'Cruze', 'Lanos', 'Geo Storm', 'Chevy', 'DeLuxe', 'Sonoma', 'Geo Metro', 'Opala', 'Prizm', 'Astro груз.', 'Express груз.', 'TrailBlazer', 'Bel Air', 'Celebrity', 'Chance', 'Spark', 'Citation', 'Volt', 'Convertible', 'R3500', 'Orlando', 'Master De luxe', 'El Camino', 'Explorer', 'Uplander', 'Camaro Convertible', 'Trans Sport', 'Vandura', 'Spectrum', 'Tracker', 'SS', 'Master', 'Beauville', 'Rezzo', 'Chevelle', 'Kalos', 'Trax', 'Sonic', 'Bolt EV', 'Van G-20'
        ),
        'Chrysler' => array(
            '180', 'Avenger', 'Grand Voyager', 'New Yorker', 'PT Cruiser', 'Viper', 'Voyager', 'Cirrus', 'Concorde', 'Crossfire', 'Daytona Shelby', 'LE Baron', 'LHS', 'Neon', 'Pacifica', 'Prowler', 'Stratus', 'Town & Country', 'Vision', 'Jeep Cherokee', 'Intrepid', 'Sebring', 'Saratoga', 'Aspen', '300 M', 'Simca', 'Reliant', 'Sunbeam', 'Imperial', 'HHR', 'ES', '200', 'Tolbot', 'Phantom', 'Dynasty', 'Laser', '300 C', '300', '300 S', 'Royal', '160'
        ),
        'Citroen' => array(
            'Athena', 'AX', 'Berlingo пасс.', 'BX', 'C3', 'C5', 'C8', 'CX', 'Dyane', 'GSA', 'LNA', 'Reflex', 'Saxo', 'Synergie', 'Visa', 'Xantia', 'XM', 'Xsara', 'Xsara Picasso', 'ZX', 'Jumpy пасс.', 'Jumper груз.', 'ID', 'GS', 'Evasion', 'C6', 'C4', 'C2', 'C15', 'AMI', 'Acadiane', 'Oltcit', 'C1', 'Berlingo груз.', 'Nemo груз.', 'C-Crosser', 'Grand C4 Picasso', 'C4 Picasso', 'Jumpy груз.', 'DS3', 'Nemo пасс.', 'Jumper пасс.', 'C3 Picasso', 'CQ', 'DS4', 'DS5', '2CV', 'C-Elysee', 'Axel', 'C-Zero', 'C4 Cactus', 'Rosalie', 'C4 Aircross', 'Traction Avant', 'Space Tourer'
        ),
        'Dacia' => array(
            'Denem', 'Duster', '1300', '1310', '1325', '1410', 'Nova', 'Solenza', 'Clima', 'SuperNova', 'Rapsodie', 'Logan', 'Sandero', 'Express', '1304', 'Lodgy', 'Dokker', 'Sandero StepWay'
        ),
        'Dadi' => array(
            'Shuttle', 'Aurora', 'Smoothing', 'City Leading', 'Bliss', 'Suv', 'BDD', 'Groz', 'Huabey', 'Soyat'
        ),
        'Daewoo' => array(
            'Espero', 'Kalos', 'Korando', 'Lanos', 'Leganza', 'Matiz', 'Musso', 'Nexia', 'Nubira', 'Tacuma', 'Arcadia', 'Charman', 'Evanda', 'Lacetti', 'LE Mans', 'Magnus', 'Racer', 'Sens', 'Tico', 'Polonez', 'Damas', 'Prince', 'Lublin груз.', 'Nubira Sx', 'BV', 'Super Salon', 'Royale', 'Brougham', 'Gentra', 'Cielo', 'Tosca'
        ),
        'Daf' => array(
            '200', '600', '46'
        ),
        'Dagger' => array(
            'GT'
        ),
        'Daihatsu' => array(
            'Applause', 'Charade', 'Charmant', 'Cuore', 'Domino', 'Fourtrak', 'Gran Move', 'Hijet', 'Mira', 'Move', 'Sirion', 'Sportrak', 'Terios', 'YRV', 'Altis', 'Atrai/extol', 'Copen', 'Delta', 'Feroza', 'Leeza', 'MAX', 'IRV', 'Materia', 'Rocky', 'Tianjin', 'Taft', 'Trevis', 'Ayla', 'Sigra'
        ),
        'Daimler' => array(
            'Limousine', 'Series III', 'Sovereign', 'XJ Series', 'XJ12', 'XJ6', 'Coupe', 'Daimler', 'Landaulette', 'Double Six'
        ),
        'Datsun' => array(
            'on-DO', '100'
        ),
        'De Lorean' => array(
            'DMC'
        ),
        'Detroit Electric' => array(
            'SP:01'
        ),
        'Dodge' => array(
            'Avenger', 'Caravan', 'Dakota', 'Durango', 'Intrepid', 'Magnum', 'Monaco', 'Neon', 'RAM', 'Ramcharger', 'Shadow', 'Spirit', 'Stealth', 'Stratus', 'Viper', 'Charger', 'Caliber', 'D6', 'Nitro', 'Ram Van', 'Power Wagon', 'Daytona', 'Challenger', 'Charger Daytona', 'Journey', 'Polara', 'Arrow', 'Sprinter пасс.', 'Aries', 'Dynasty', 'SXT', 'Diplomat', 'Grand Caravan', 'Omni', 'Dart', 'WC', 'Aspen', 'М 886', 'Colt', 'D2'
        ),
        'Dr. Motor' => array(
            'DR5'
        ),
        'DS' => array(
            '3', '4'
        ),
        'Eagle' => array(
            'Premier', 'Summit', 'Talon', 'Vision'
        ),
        'FAW' => array(
            '6371 груз.', '6350', 'Vita (C1)', 'Besturn', 'HQ3', 'CA  6371 Cargo', '6371 пасс.', 'V2', 'V5', 'Oley'
        ),
        'Ferrari' => array(
            '208/308', '328', '348', '360', '400', '412', '456', '456M', '512', '550', '575M', 'F355', 'F40', 'F50', 'F512', 'Mondial', 'Testarossa', '612 Scaglietti', 'Barchetta', 'Dino', 'Enzo', 'Maranello California', 'Fiorano', 'Modena Spider', 'Maranello California USA', 'Scuderia Spider 16M Convertible', 'F430', '458 Italia', 'California', 'FF', 'F12', '250 GTO', '458', 'LaFerrari', '599 GTO', '599', '488 GTB', '488 Spider'
        ),
        'Fiat' => array(
            '126', '127', '128', '132', 'Abarth', 'Argenta', 'Barchetta', 'Brava', 'Bravo', 'Cinquecento', 'Coupe', 'Marea', 'Multipla', 'Panda', 'Punto', 'Regata', 'Seicento', 'Stilo', 'Strada', 'Tempra', 'Tipo', 'Ulysse', 'Uno', 'X1/9', '124', '130', '131', '238', '242', '500', '900', 'Albea', 'Duna', 'Fiorino пасс.', 'Idea', 'Palio', 'Ritmo', 'Scudo груз.', 'Siena', 'Ibiza', 'Linea', 'Yugo', 'Sedici', 'Cordoba', 'Grande Punto', '1100B', 'Croma', 'Topolino', 'Doblo Panorama', '2300', 'Leon', 'Qubo пасс.', '125', 'Lusso Familiare', 'Ducato груз.', 'Ducato пасс.', 'Scudo пасс.', 'Campagnola', 'Talento пасс.', 'Talento груз.', 'Doblo груз.', 'Doblo пасс.', 'Ducato', 'Scudo', 'Torino', '500 C', 'Mirafiori', 'Freemont', 'Elba', 'Simca', 'Fiorino груз.', '850', 'FSO Polonez', '600', '133', '500 L', '508', '500 X', '1500', 'Punto Evo', 'Qubo груз.', 'Fullback'
        ),
        'Fiat-Abarth' => array(
            '500', '595', '695', '750', '850 TC', '1000 Berlina', '700 spider'
        ),
        'Fisker' => array(
            'Karma'
        ),
        'Ford' => array(
            'Capri', 'Cortina', 'Cougar', 'Escort', 'Explorer', 'Fiesta', 'Focus', 'Fusion', 'Galaxy', 'Granada', 'KA', 'Maverick', 'Mondeo', 'Orion', 'Probe', 'Puma', 'Scorpio', 'Streetka', 'Think', 'Consul', 'Econovan', 'Excursion', 'Expedition', 'Ranger', 'Sport KA', 'Street KA', 'Taunus', 'Tempo', 'Tourneo Connect пасс.', 'Transit груз.', 'Aerostar', 'Aspire', 'Contour', 'Crown Victoria', 'Econoline', 'Escape', 'Five Hundred', 'Freestar', 'GT', 'Mustang Shelby', 'Taurus', 'Thunderbird', 'Courier', 'Windstar', 'Canyon', 'Edge', 'C-Max', 'S-Max', 'Mustang', 'F-150', 'F-250', 'Transit Connect пасс.', 'Bronco', 'Kuga', 'Sierra', 'Flex', 'Mustang GT', 'Transit Chassis', 'Transit Van', 'F-450', 'F-350', 'Otosan', 'Mercury', '3430', 'Telstar', 'Laser', 'Willis', 'E-series', 'Transit пасс.', 'Transit Connect груз.', 'Tourneo Connect груз.', 'Festiva', 'Fireline', 'Eafil', 'Galaxie', 'F-650', 'Eifel', 'Grand C-MAX', 'Ranch Wagon', 'Auborn', 'Transit', 'Transit Connect', 'F-550', 'Diamant', 'Antara', 'Cabster', 'Escort van', 'Raptor', 'Cobra', 'Model A', 'Fairlane', 'Gran Torino', 'LTD', 'Fairmont', 'Т', 'Freestyle', 'Falcon', 'B-Max', 'Transit Custom', 'Tourneo Custom', 'V8', 'Model T', 'EcoSport', 'Tourneo Courier', 'F-Series', 'Escort Express', 'Focus Electric', 'C-Max Energi', 'Transit Courier', 'Torino'
        ),
        'Fornasari' => array(
            'RR'
        ),
        'FSO' => array(
            '125P', '1300', 'Caro', 'Polonez', '126P', '127P', '132P', 'Warszawa', 'Syrena'
        ),
        'FUQI' => array(
            'FQ'
        ),
        'Gac' => array(
            'Gonow'
        ),
        'Geely' => array(
            'HA', 'HS', 'UL', 'CK1', 'BO', 'CK', 'MK', 'FC', 'MK-2', 'CK-2', 'Maple', 'JL', 'MR', 'FS', 'Emgrand 7 (EC7)', 'SL', 'MK Cross', 'SC', 'SMA', 'LC', 'Vision', 'Emgrand X7', 'GC2', 'GХ2', 'Safe', 'Emgrand 8', 'GC6', 'GC5', 'GC7', 'Panda', 'Emgrand X9'
        ),
        'Geo' => array(
            'Storm', 'Metro', 'Prizm', 'Tracker'
        ),
        'GMC' => array(
            'Envoy', 'Jimmy', 'Safari', 'Savana', 'Sierra', 'Sonoma', 'Yukon', 'Acadia', 'Canyon', 'Vandura пасс.', 'T6500', 'Acadia USA', 'Vandura груз.', 'Delorean', 'Terrain', 'C', 'Suburban', '100'
        ),
        'Gonow' => array(
            'DianGo', 'Troy Suv', 'Jetstar', 'Victor Suv', 'GX6'
        ),
        'Great Wall' => array(
            'Deer', 'Safe', 'Hover', 'Pegasus', 'SoCool', 'Wingle', 'Hover F&L', 'Cowry', 'Tianma', 'SUV', 'Florid', 'Haval', 'Voleex', 'CC', 'Sing', 'Haval H3', 'Haval H5', 'Haval H6', 'Haval M2', 'Haval M4', 'C30', 'М4', 'H6', 'Voleex C10'
        ),
        'Hafei' => array(
            'Ruiyi', 'Minyi', 'Zhongyi', 'Saibao', 'Lobo', 'Sigma', 'Saima', 'Princip'
        ),
        'Haima' => array(
            '3'
        ),
        'Honda' => array(
            'Accord', 'Aerodeck', 'Brio', 'Ballade', 'Civic', 'Concerto', 'CR-V', 'CRX', 'HR-V', 'Insight', 'Integra', 'Jazz', 'Legend', 'Logo', 'NSX', 'Prelude', 'Quintet', 'S2000', 'Shuttle', 'Stream', 'Avancier', 'Capa', 'City', 'Domani', 'Element', 'F-mx', 'FIT', 'Fit Aria', 'FR-V', 'Inspire', 'Lagreat', 'Life', 'Mobilio', 'Odyssey', 'Orthia', 'Partner', 'Passport', 'Pilot', 'Saber', 'Sm-X', 'Stepwgn', 'That S', 'Torneo', 'Vamos', 'Vigor', 'Ridgeline', 'Accord Tourer', 'Crosstour', 'CR-Z', 'VLX', 'Acty', 'Rafaga', 'Beat', 'Eve', 'Elysion', 'Freed'
        ),
        'Huabei' => array(
            'HC', 'HG', 'Poni'
        ),
        'Humber' => array(
            'Sceptre', 'Hawk'
        ),
        'Hummer' => array(
            'Hummer', 'H3', 'H2', 'H1', 'H3X', 'H4'
        ),
        'Humvee' => array(
            'C-Series', 'Marshal'
        ),
        'Hyundai' => array(
            'Amica', 'Atos', 'Coupe', 'Lantra', 'Matrix', 'Pony', 'Santa FE', 'S-Coupe', 'Sonata', 'Stellar', 'Trajet', 'Accent', 'Centennial', 'Dynasty', 'Galloper', 'H1 пасс.', 'H 100 пасс.', 'Santamo', 'Terracan', 'Tucson', 'XG', 'H 200 пасс.', 'Grandeur', 'Prest', 'Avante', 'Azera', 'i10', 'i20', 'i30', 'County', 'Tiburon', 'Genesis', 'Elantra', 'ix55 (Veracruz)', 'IX35', 'Starex', 'H1 груз.', 'H 100 груз.', 'H 200 груз.', 'Marcia', 'Excel', 'GLS', 'GX', 'Solaris', 'Getz', 'Veloster', 'Equus', 'H 300 груз.', 'i40', 'Grand Starex', 'Grand Santa Fe', 'H 300 пасс.', 'H 150 пасс.', 'IX20', 'Creta', 'Ioniq', 'HLF', 'Kona'
        ),
        'Infiniti' => array(
            'FX', 'I', 'J', 'M30', 'M45', 'Q45', 'QX4', 'QX', 'G', 'M', 'EX', 'G25', 'Q', 'M25', 'M37', 'G35', 'G37', 'JX', 'Q50', 'Q60', 'Q70', 'QX50', 'QX60', 'QX70', 'QX80', 'EX 30', 'EX 35', 'EX 37', 'M35', 'Q30', 'QX56', 'FX 30', 'FX 37', 'FX 35', 'FX 50', 'FX 45', 'EX 25', 'QX30'
        ),
        'Innocenti' => array(
            'Elba'
        ),
        'Iran Khodro' => array(
            'Runna', 'Samand', 'Soren'
        ),
        'Isuzu' => array(
            'Piazza', 'Trooper', 'Ascender', 'Aska', 'Axiom', 'Campo', 'Gemini', 'Impulse', 'Midi пасс.', 'Rodeo', 'VehiCross', 'Bighorn', 'Fargo', 'D-Max', 'Amigo', 'Midi груз.', 'Florian', 'TFR', 'MD', 'FRR', 'Faster', 'Hombre', 'Pick Up', 'Stylus', 'Panther'
        ),
        'ItalCar' => array(
            'Attiva'
        ),
        'Iveco' => array(
            'Daily пасс.', 'Unic', 'Massif', 'Menarini', 'Daily 4x4'
        ),
        'Jaguar' => array(
            'S-Type', 'Sovereign', 'X-Type', 'XJ', 'XJ6', 'XJR', 'XJR-S', 'XJS', 'XKR', 'E-Type', 'XJ8', 'XF', '4000', 'Mark', 'XK', 'SL', 'Vanden', 'Daimler', 'XFR', 'F-Type', 'DS', 'XJL', 'XE', 'F-Pace'
        ),
        'Jeep' => array(
            'Cherokee', 'Grand Cherokee', 'Wrangler', 'CJ', 'Liberty', 'Patriot', 'Compass', 'Commander', 'Willys', 'Renegade', 'Comanche'
        ),
        'Jinbei Minibusus' => array(
            'SY6482Q2'
        ),
        'JMC' => array(
            'BD', 'YunBa', 'Baodian'
        ),
        'Kia' => array(
            'Carens', 'Clarus', 'Magentis', 'Mentor', 'Mentor II', 'Pride', 'Rio', 'Sedona', 'Shuma', 'Sorento', 'Sportage', 'Picanto', 'Avella', 'Besta', 'Capital', 'Carnival', 'Cerato', 'Concord', 'Enterprise', 'Joice', 'Opirus', 'Potentia', 'Pregio пасс.', 'Retona', 'Roadster', 'Sephia', 'Visto', 'Grand Sportage', 'Jumbo Titan', 'Optima', 'Ceed', 'Ceed SW', 'Pro Ceed', 'Borrego', 'Spectra', 'Soul', 'Mohave', 'Cerato Koup', 'Sephia II', 'Cadenza', 'Koup', 'Ceres', 'Venga', 'Pregio груз.', 'Kosmos', 'Carstar', 'Credos', 'Ceed  Sportswagon', 'Towner', 'Quoris', 'Rio Hatchback 5D', 'Rio Hatchback 3D', 'Forte', 'Niro', 'Stinger', 'Stonic'
        ),
        'King Long' => array(
            'Kingte'
        ),
        'KingWoo' => array(
            'XD-BB', 'KYGDG11A', 'KYGDG08A', 'KYG5S', 'KW 500', 'KW 625', 'KW 625W'
        ),
        'Kirkham' => array(
            '427 KMS'
        ),
        'Koenigsegg' => array(
            'CCXR Trevita', 'CCX', 'Agera'
        ),
        'Konecranes' => array(
            'Steyr 55'
        ),
        'Lamborghini' => array(
            'Countach', 'Diablo', 'Murcielago', 'Espada', 'Gallardo', 'Jalpa', 'Jarama', 'Lm-001', 'Lm-002', 'Urraco', 'Gallardo LP 550-2', 'Reventon', 'Aventador', '400 GT', 'Urus', 'Huracan'
        ),
        'Lancia' => array(
            'Beta', 'Dedra', 'Delta', 'Gamma', 'Monte Carlo', 'Prisma', 'Thema', 'Trevi', 'Y10', 'A 112', 'Fulvia', 'Kappa', 'Lybra', 'Musa', 'Phedra', 'Thesis', 'Y', 'Zeta', 'Ypsilon'
        ),
        'Land Rover' => array(
            'Discovery', 'Freelander', 'Range Rover', 'Range Rover Sport', 'Defender', 'Range Rover Evoque', 'Discovery Sport', 'Range Rover Velar'
        ),
        'LDV' => array(
            'Maxus', 'Pilot'
        ),
        'Lexus' => array(
            'GS', 'IS', 'LS', 'RX', 'SC', 'ES', 'LX', 'GX', 'IS-F', 'HS', 'IS-C', 'RH', 'CT 200H', 'CT', 'LF', 'NX', 'RC', 'ES 250', 'ES 300', 'ES 350', 'ES 330', 'GS 250', 'GS 300', 'GS 350', 'GS 400', 'GS 430', 'GS 450', 'GS 460', 'IS 200', 'IS 220', 'IS 250', 'IS 300', 'IS 350', 'LS 400', 'LS 430', 'LS 460', 'LS 600', 'LX 450', 'LX 470', 'LX 570', 'NX 200', 'NX 300', 'RX 270', 'RX 300', 'RX 330', 'RX 350', 'RX 400', 'RX 450', 'SC 400', 'SC 430', 'RX 200', 'SC 300', 'GS 200', 'ES 200', 'GS F'
        ),
        'Lincoln' => array(
            'Aviator', 'Blackwood', 'Continental', 'LS', 'Mark', 'Navigator', 'Town Car', 'MKZ', 'MKX', 'MKS', 'MKT', 'Excalibur', 'Cartier', 'Mercury', 'Zephyr', 'MKC'
        ),
        'Lotus' => array(
            'Eclat', 'Elan', 'Elise', 'Elite', 'Esprit', 'Excel', 'Exige', 'Europa', 'Super Seven', 'Evora', 'Seven'
        ),
        'LTI' => array(
            'TX'
        ),
        'Luxgen' => array(
            '5', '7'
        ),
        'Marshell' => array(
            'DN', 'DG-C2'
        ),
        'Mahindra' => array(
            'Alturas G4', 'Bolero', 'KUV100', 'KUV100 NXT', 'Marazzo', 'Scorpio', 'Scorpio Getaway', 'TUV300', 'TUV300 PLUS', 'Thar', 'Verito', 'Verito Vibe CS', 'XUV500', 'e20 NXT', 'e2o PLUS', 'eKUV100', 'XUV300'
        ),
        'Maruti' => array(
            '1000', '800', 'Alto', 'Baleno', 'Esteem', 'Gypsy', 'Omni', 'Versa', 'Wagon R', 'Zen', 'Suzuki'
        ),
        'Maserati' => array(
            '222', '3200', '420/430', 'Biturbo', 'Coupe', 'Ghibli', 'Quattroporte', 'Shamal', 'Spyder', '228', 'Barchetta Stradale', 'Bora', 'Chubasco', 'GranSport', 'Indy', 'Karif', 'Khamsin', 'Kyalami', 'Merak', 'Mexico', 'Royale', 'GranTurismo', 'Mc12', 'GranCabrio', 'Levante'
        ),
        'Maybach' => array(
            '57', '62', 'landaulet', 'DS8 Zeppelin', '52', 'Exelero', 'S500', 'S600'
        ),
        'Mazda' => array(
            '121', '2', '323', '6', '626', '929', 'Demio', 'MPV', 'MX-3', 'MX-5', 'MX-6', 'Premacy', 'RX-7', 'RX-8', 'Tribute', 'Xedos 9', 'Xedos', 'Atenza', 'Az-offroad', 'Az-wagon', 'B-series', 'Bongo', 'Business', 'Carol', 'Clef', 'Cronos', 'E-series пасс.', 'E-series груз.', 'Eunos 500', '3', '5', 'CX-7', 'CX-9', 'Millenia', 'Sentia', 'Familia', '3 MPS', 'Persona', 'Protege', 'BT-50', 'Capella', 'Eunos Presso', 'Eunos Cargo', 'Eunos', 'Eunos Cosmo', 'MS-8', 'Luce', '6 MPS', 'Xedos 6', 'Lantis', 'CX-5', 'MS-9', 'MS-6', 'Cosmo', 'CX-3', 'Proceed'
        ),
        'McLaren' => array(
            'MP4', 'F1', '650S', 'P1', '675LT', '570 GT'
        ),
        'Mercedes-Benz' => array(
            '190', '200', '220', '230', '240', '250', '260', '280', '300', '320', '400', '420', '500', '560', '600', 'A-Class', 'AMG', 'C-Class', 'CLC-Class', 'CLK-Class', 'E-Class', 'M-Class', 'S-Class', 'SL-Class', 'SLK-Class', 'V-Class', 'R-Class', 'Vaneo', 'Viano пасс.', 'CL-Class', 'ML-Class', '290', 'GL-Class', 'B-Class', 'GLK-Class', 'CLS-Class', 'G-Class', 'SLR-Class', 'SLS-Class', 'V 230', 'Sprinter груз.', 'Vito груз.', 'Vito пасс.', 'Viano груз.', 'Viano', 'Vito', 'MB пасс.', 'MB груз.', 'Smart', 'V 200', 'V 220', 'V 280', 'GLK 200', 'GLK 220', 'GLK 250', 'GLK 280', 'GLK 300', 'GLK 320', 'GLK 350', 'B 150', 'B 160', 'B 170', 'B 180', 'B 200', 'CLC 160', 'CLC 180', 'CLC 200', 'CLC 230', 'CLC 250', 'CLC 350', 'CLC 220', 'R 280', 'R 300', 'R 320', 'R 350', 'R 500', 'R 63 AMG', 'SL 280', 'SL 300', 'SL 320', 'SL 350', 'SL 380', 'SL 420', 'SL 450', 'SL 500 (550)', 'SL 55 AMG', 'SL 560', 'SL 60 AMG', 'SL 600', 'SL 63 AMG', 'SL 65 AMG', 'SL 70 AMG', 'SL 73 AMG', 'CLK 200', 'CLK 220', 'CLK 230', 'CLK 240', 'CLK 270', 'CLK 280', 'CLK 320', 'CLK 350', 'CLK 430', 'CLK 500', 'CLK 55 AMG', 'CLK 63 AMG', '206 пасс.', 'Citan', 'G 230', 'G 240', 'G 250', 'G 270', 'G 280', 'G 290', 'G 300', 'G 320', 'G 350', 'G 400', 'G 500', 'G 55 AMG', 'G 63 AMG', 'G 65 AMG', 'SLK 200', 'SLK 230', 'SLK 250', 'SLK 280', 'SLK 300', 'SLK 32 AMG', 'SLK 320', 'SLK 350', 'SLK 55 AMG', 'CLS 250', 'CLS 280', 'CLS 300', 'CLS 320', 'CLS 350', 'CLS 500', 'CLS 55 AMG', 'CLS 63 AMG', 'A 140', 'A 150', 'A 160', 'A 170', 'A 180', 'A 190', 'A 200', 'A 210', 'A 220', 'A 250', 'ML 230', 'ML 250', 'ML 270', 'ML 280', 'ML 300', 'ML 320', 'ML 350', 'ML 400', 'ML 420', 'ML 430', 'ML 500', 'ML 55 AMG', 'ML 63 AMG', 'GL 320', 'GL 350', 'GL 420', 'GL 450', 'GL 500', 'GL 55 AMG', 'GL 63 AMG', 'GL 550', 'CL 160', 'CL 180', 'CL 200', 'CL 220', 'CL 230', 'CL 320', 'CL 420', 'CL 500', 'CL 55 AMG', 'CL 600', 'CL 63 AMG', 'CL 65 AMG', 'CLA-Class', 'CLA 180', 'CLA 200', 'CLA 220', 'CLA 250', 'S 250', 'S 260', 'S 280', 'S 300', 'S 320', 'S 350', 'S 400', 'S 420', 'S 430', 'S 450', 'S 500', 'S 55', 'S 550', 'S 600', 'S 63 AMG', 'S 65 AMG', 'S 67', '210', 'Sprinter 208 груз.', 'Sprinter 209 груз.', 'Sprinter 210 груз.', 'Sprinter 211 груз.', 'Sprinter 212 груз.', 'Sprinter 213 груз.', 'Sprinter 216 груз.', 'Sprinter 308 груз.', 'Sprinter 310 груз.', 'Sprinter 311 груз.', 'Sprinter 312 груз.', 'Sprinter 313 груз.', 'Sprinter 315 груз.', 'Sprinter 316 груз.', 'Sprinter 318 груз.', 'Sprinter 410 груз.', 'Sprinter 412 груз.', 'Sprinter 515 груз.', 'Sprinter 516 груз.', 'Sprinter 518 груз.', 'ML 550', 'Sprinter 208 пасс.', 'Sprinter 209 пасс.', 'Sprinter 210 пасс.', 'Sprinter 211 пасс.', 'Sprinter 212 пасс.', 'Sprinter 213 пасс.', 'Sprinter 216 пасс.', 'Sprinter 308 пасс.', 'Sprinter 310 пасс.', 'Sprinter 311 пасс.', 'Sprinter 312 пасс.', 'Sprinter 313 пасс.', 'Sprinter 315 пасс.', 'Sprinter 316 пасс.', 'Sprinter 318 пасс.', 'Sprinter 410 пасс.', 'Sprinter 412 пасс.', 'Sprinter 413 пасс.', 'Sprinter 515 пасс.', 'Sprinter 516 пасс.', 'Sprinter 518 пасс.', 'Sprinter пасс.', 'Sprinter 319 груз.', 'E 500', 'S 140', 'Sprinter 309 пасс.', 'CLA 45 AMG', 'GLA-Class', 'CL 550', 'Sprinter 319 пасс.', 'Sprinter 324 груз.', '10/20 HP Posen', 'V 250', 'CLS 550', 'GLE-Class', 'Sprinter 219 пасс.', 'Maybach', 'GL 400', 'CLS 400', 'GLC-Class', 'Sprinter 324 пасс.', 'GLS-Class', 'GLS 350', 'GLS 400', 'GLS 500', 'GLS 63', 'S-Guard', 'B-Class Electric Drive', 'Sprinter 513 пасс.', 'Electric Drive', 'B 220', '170', 'A45 AMG', 'SL 400', '450', 'SLC-Class', 'N 1300', 'S 220', 'Sprinter 415 пасс.', '1628', 'GLS 450', 'Sprinter 219 груз.', 'N 1000', 'SE', 'X-Class'
        ),
        'Mercury' => array(
            'Cougar', 'Grand Marquis', 'Marauder', 'Montego', 'Monterey', 'Mountaineer', 'Mystique', 'Sable', 'Topaz', 'Tracer', 'Villager', 'Mariner', '50ELPTO', '90ELPTO', 'Zephyr', '50', 'Black Max'
        ),
        'MG' => array(
            'TF', '550', 'ZT', 'F', '6', '6 5D', '350', 'Montego', '3', '5', 'ZR', '750', 'ZS', 'Maestro'
        ),
        'Miles' => array(
            'ZX40', 'OR70'
        ),
        'MINI' => array(
            'Cooper', 'Mini', 'One', 'Cabrio', 'Clubman', 'Cooper S', 'Cooper D', 'Rover', 'Countryman', 'Paceman', 'Coupe', 'Roadster', 'Hatch'
        ),
        'Mitsubishi' => array(
            '3000 GT', 'Carisma', 'Celeste', 'Challenger', 'Colt', 'Cordia', 'FTO', 'Galant', 'Lancer', 'Sapporo', 'Shogun', 'Shogun Pinin', 'Shogun Sport', 'Sigma', 'Space Runner', 'Space Star', 'Space Wagon', 'Starion', 'Tredia', 'Aspire', 'Chariot', 'Debonair', 'Diamante', 'Dingo', 'Dion', 'Eclipse', 'EK Wagon', 'Emeraude', 'Endeavor', 'Grandis', 'GTO', 'Jeep', 'L 200', 'L 300 пасс.', 'L 400 пасс.', 'Legnum', 'Libero', 'Minica', 'Mirage', 'Outlander', 'Pajero', 'Pistachio', 'Proudia', 'RVR', 'Santamo', 'Space Gear', 'Toppo', 'Town Box', 'Montero', 'Eterna', 'Prestij', 'Nativa', 'Lancer X', 'Lancer Evolution', 'Outlander XL', 'Pajero Sport', 'Pajero Wagon', 'Lancer X Sportback', 'Lanser Sportback', 'Eclipse USA', 'Delica', 'Virage', 'Raider', 'ASX', 'Lancer X Ralliart', 'Ralli Art', 'L 400 груз.', 'L 300 груз.', 'Proton', 'Magna', 'i-MiEV', 'Pajero Pinin', 'Galloper', 'Attrage', 'Minicab', 'Outlander PHEV', 'Airtrek', 'Axia ES', 'Xpander', 'Eclipse Cross',
        ),
        'Morgan' => array(
            'Four Four', 'Aero 8', 'Plus 4', 'Plus 8', 'Aero Supersports'
        ),
        'Morris' => array(
            'Ital', 'Marina', 'Minor'
        ),
        'MPM Motors' => array(
            'PS 160'
        ),
        'Nissan' => array(
            '100NX', '120Y Sunny', '140J Violet', '140Y Sunny', '160B Bluebird', '160J Violet', '180B Bluebird', '200', '240K Skyline', '280C', '280ZX', '300', '350Z', 'Almera', 'Almera Tino', 'Bluebird', 'Cherry', 'Laurel', 'Maxima', 'Maxima QX', 'Micra', 'Patrol', 'Patrol GR', 'Prairie', 'Primera', 'QX', 'Serena пасс.', 'Silvia', 'Skyline', 'Stanza', 'Sunny', 'Terrano', 'Terrano II', 'X-Trail', '200 SX', 'Altima', 'Murano', 'Vanette пасс.', 'Pathfinder', 'X-Terra', 'Note', 'Primastar пасс.', 'Teana', 'Interstar', 'Qashqai', 'Rogue', 'Cefiro', 'Cima', 'Trade', 'Navara', 'Armada', 'Frontier', 'GT-R', 'Urvan', 'L35', 'Sentra', 'Kubistar', 'Qashqai+2', 'TIIDA', 'NP300', 'Avenir', 'Cedric', 'Titan', 'Pulsar', 'Versa', 'Gloria', 'Almera Classic', 'Elgrand', 'Quest', 'Langley', 'Presea', 'Paladin', 'Leopard', 'R`nessa', 'Liberta Villa', '370Z', 'Juke', 'Datsun', 'Vehiculos', '300ZX', 'Pickup', '70', 'Tino', 'King Cab', 'Vanette груз.', 'Serena груз.', 'Primastar груз.', 'Sima', 'Bassara', 'Stagea', 'Pixo', 'Auster', 'Gazelle', '100NS', 'Largo', 'Leaf', 'NV', 'Homy', 'Presage', 'Wingroad', 'Cube', 'Arna', 'e-NV200', 'Datsun on-DO', 'Datsun MI-DO', 'Fuga', 'Juke Nismo', 'Caravan', 'Liberty', 'Safari', 'Grand Livina', 'Xtrail'
        ),
        'Norster' => array(
            '600R'
        ),
        'Oldsmobile' => array(
            'Achieva', 'Alero', 'Aurora', 'Bravada', 'Cutlass', 'Eighty-Eight', 'Intrigue', 'Silhouette', 'Omega', 'Regency', 'Delta', 'Ninety Eidht', 'Holiday', 'Royal', 'Tornado', 'Super 88', '98', 'Urbee', 'Cutlass Ciera'
        ),
        'Oltcit' => array(
            'Club'
        ),
        'Opel' => array(
            'Commodore', 'Kadett', 'Manta', 'Monza', 'Rekord', 'Senator', 'Admiral', 'Agila', 'Arena пасс.', 'Ascona', 'Astra', 'Calibra', 'Campo', 'Combo груз.', 'Corsa', 'Diplomat', 'Frontera', 'Meriva', 'Monterey', 'Omega', 'Signum', 'Sintra', 'Speedster', 'Tigra', 'Vectra', 'Zafira', 'Trabant', 'Astra H', 'Vectra C', 'Insignia', 'Olimpia', 'Kapitan', 'Astra G', 'Antara', 'P4', 'Super 6', 'Astra F', 'Vectra B', 'Vectra A', 'Movano груз.', 'Movano пасс.', 'Vivaro пасс.', 'Vivaro груз.', 'Combo пасс.', 'Arena груз.', 'Capitan', 'Chevette', 'Saturn', 'Astra J', 'Diamant', 'Komador', 'GT', 'Cascada', 'Mokka', 'Adam', 'Orion', 'Ampera', 'Corsa OPC', 'Astra K', 'Astra H OPC', 'Ranger'
        ),
        'Packard' => array(
            'Super Eight', 'One Twenty', 'Hawk'
        ),
        'Pagani' => array(
            'Huayra', 'Zonda'
        ),
        'Peg-Perego' => array(
            'Gaucho', 'Ranger'
        ),
        'Peugeot' => array(
            '104', '106', '205', '206', '206 SW', '304', '305', '306', '306 Sedan', '307', '309', '405', '406', '504', '505', '604', '605', '607', '806', '807', 'Partner пасс.', '204', '407', 'Expert груз.', 'Boxer груз.', '404', 'Pars', 'Karsan', '207', '308', '107', 'G 5', '4007', 'Scenic', 'Bipper пасс.', '107 Hatchback (3d)', '107 Hatchback (5d)', '206 Sedan', '206 Hatchback (3d)', '206 Hatchback (5d)', '207 Hatchback (3d)', '207 Hatchback (5d)', '308 Hatchback (3d)', '308 Hatchback (5d)', '407 Coupe', '407 Sedan', '407 SW', 'RCZ', 'Boxer пасс.', 'Bipper груз.', 'Expert пасс.', 'Partner груз.', '3008', '308 SW', '308 CC', '307 CC', 'Boxer', '117', '508', '1007', '4008', '5008', '203', '308 Sportium', '403', '408', 'Ranch', '301', '208', 'P4', '208 Hatchback (5d)', '208 GTI', 'BB1', '2008', '508 RXH', 'iOn', '108', '206 СС', 'Traveller', '207 CC'
        ),
        'Pininfarina' => array(
            'Cambiano'
        ),
        'Pinzgauer' => array(
            '710'
        ),
        'Plymouth' => array(
            'Coltvista', 'Prowler', 'Acclaim', 'Conquest', 'Colt', 'Caravelle', 'Breeze', 'Gran Fury', 'Grand Voyager', 'Horizon', 'Laser', 'Neon', 'Reliant', 'Sapporo', 'Scamp', 'Sundance', 'Turismo', 'Voyager', 'Barracuda', 'Satellite', 'Fury', 'valare'
        ),
        'Pontiac' => array(
            '6000', 'Aztec', 'Bonneville', 'Firebird', 'Grand AM', 'Grand Prix', 'GTO', 'Montana', 'Phoenix', 'Sunbird', 'Sunfire', 'Trans Sport', 'Vibe', 'Solstice', 'Fiero', 'G8', 'G6', 'Tempest', 'Beaumont', 'G5', 'Lemans', 'Catalina', 'Laurentian', 'Strato Chief', 'Parisienne', 'Sunburst'
        ),
        'Porsche' => array(
            '911', '924', '928', '944', '968', 'Boxster', 'Cayenne', '959', 'Cayman', 'Panamera', '356', '997', '550', '964', 'Macan', '996', '918 Spyder'
        ),
        'Praga Baby' => array(
            'Tudor', 'Baby'
        ),
        'Proton' => array(
            'Compact', 'Coupe', 'Impian', 'Persona', 'Proton', 'Satria', 'Wira', 'Iswara', 'Juara', 'Perdana', 'Saga', 'Saloon', 'Waja', '415'
        ),
        'Ram' => array(
            '1500', '2500', '3500', 'Chassis Cab', 'Promaster City', 'Promaster'
        ),
        'Ravon' => array(
            'R2', 'Nexia', 'Gentra', 'Matiz', 'R4'
        ),
        'Renault' => array(
            '11', '12', '14', '15', '16', '17', '18', '19', '20', '21', '25', '30', '4', '5', '6', '9', 'A610', 'Avantime', 'Clio', 'Espace', 'Fuego', 'Grand Espace', 'GTA', 'Kangoo пасс.', 'Laguna', 'Megane', 'Safrane', 'Scenic', 'Sport Spider', 'Vel Satis', 'Estafette', 'Express', 'Logan', 'Master груз.', 'Modus', 'Rapid', 'Rodeo', 'Symbol', 'Trafic груз.', 'Twingo', 'Samsung SM5', 'Koleos', 'Grand Scenic', 'Kangoo груз.', 'Sandero', 'Fluence', 'Trafic пасс.', 'Duster', 'Master пасс.', 'Chamade', 'Latitude', 'Alliance', 'Thalia', 'Nevada', 'Sandero StepWay', 'Supernova', 'Megane RS', 'Twizy', 'Zoe', 'Lodgy', 'Dokker пасс.', 'Captur', 'Wind', 'Dokker VAN', 'Florida', 'Fluence Z.E', '8', 'Grand Modus', 'Scenic Conquest', 'Kadjar', 'Talisman'
        ),
        'Renault Samsung Motors' => array(
            'SM3', 'SM5', 'SM7', 'QM5'
        ),
        'Rezvani' => array(
            'Beast'
        ),
        'Rolls-Royce' => array(
            'Carmargue', 'Corniche', 'Flying Spur', 'Limousine', 'Park Ward', 'Phantom VI', 'Silver Dawn', 'Silver Seraph', 'Silver Shadow', 'Silver Spirit', 'Silver Spur', 'Silver Wraith', 'Ghost', 'Phantom V', 'Phantom VII', 'Drophead', 'Silver Cloud', 'Wraith', 'Phantom', 'Dawn'
        ),
        'Rover' => array(
            '100', '200', '2000', '2300', '2400', '25', '2600', '3500', '400', '45', '600', '75', '75 Tourer', '800', 'Cabriolet', 'Coupe', 'Metro', 'Tourer', 'Maestro', 'MGF', 'Mini MK', 'Montego', 'Land Rover', '414', 'Freelander', 'Range Rover', '214', '216', '416', '620', '420', '827', '825', '820', 'Vitesse', '213', '218', '220', 'Targa', 'Streetwise', '618', 'SD1', '114', '418'
        ),
        'Saab' => array(
            '9-3', '9-5', '90', '900', '9000', '99', '9-7X', '96', '9-3 X', 'Griffin', 'Aero', '9-2'
        ),
        'Saipa' => array(
            'Tiba'
        ),
        'Saleen' => array(
            'S7', 'S281', 'S331'
        ),
        'Samand' => array(
            'LX', 'TAXI', 'EL', 'Soren', 'SPG', 'SE', 'Runna'
        ),
        'Samson' => array(
            'F'
        ),
        'Sceo' => array(
            'C3', 'Shuanghuan'
        ),
        'Scion' => array(
            'tC', 'xB', 'xD', 'xA'
        ),
        'Seat' => array(
            'Alhambra', 'Arosa', 'Cordoba', 'Ibiza', 'Leon', 'Malaga', 'Marbella', 'Terra', 'Toledo', '133', 'Fura', 'Inca', 'Ronda', 'Altea', '127', 'Exeo', 'Freetrack', 'Cupra', '124', '131', 'Leon X-Perience', 'Altea XL', 'Mii', '132L', 'Ateca', 'Arona'
        ),
        'Secma' => array(
            'F16', 'Extrem 500', 'Fun Family'
        ),
        'Shelby' => array(
            'Cobra', 'Cobra Mk III'
        ),
        'Shuanghuan' => array(
            'SCEO'
        ),
        'Sidetracker' => array(
            '418'
        ),
        'Skoda' => array(
            '105', '120', '130', 'Estelle', 'Fabia', 'Favorit', 'Felicia', 'Octavia', 'S 100', 'S 110', 'SuperB New', '100', '110', 'Rapid', 'Forman', 'Ambiente', 'Roomster', 'Liaz', 'Octavia Tour Combi', 'Octavia Tour', 'Octavia Scout', 'Octavia RS', 'Octavia A5', 'Fabia Combi', 'Octavia A5 Combi', 'Octavia Combi', 'Superb', 'Octavia Combi NEW', 'Octavia NEW', 'Yeti', 'Octavia Elegance', 'Praktik', 'SuperВ Combi', '1202', 'Scout', 'Taz', 'Popular', 'Octavia A7', 'Pickup', '440', 'Citigo', 'Octavia A7 Combi', '1201', 'Spaceback', '1000 MB', 'Kodiaq', 'Karoq'
        ),
        'Smart' => array(
            'City', 'Crossblade', 'Roadster', 'Pulse', 'Forfour', 'Fortwo', 'Cabrio', 'MCC', 'Kitas', 'Fortwo ED'
        ),
        'SouEast' => array(
            'Lioncel', 'V3', 'Delica'
        ),
        'Soyat' => array(
            'Unique Van', 'Yuejin'
        ),
        'SsangYong' => array(
            'Korando', 'Musso', 'Chairman', 'Family', 'Istana', 'Kallista', 'Rexton', 'Actyon Sports', 'KYRON DELUXE', 'Rodius', 'Kyron', 'Actyon', 'Rexton II', 'SCEO', 'Rexton W', 'Tivoli', 'XLV'
        ),
        'Studebaker' => array(
            'Lark', 'Diktator', 'Starlight'
        ),
        'Subaru' => array(
            '1600', '1800', 'Forester', 'Impreza', 'Justy', 'Legacy', 'SVX', 'Vivio', 'Baja', 'Bistro', 'Domingo', 'Leone', 'Libero', 'Pleo', 'Traviq', 'XT', 'Outback', 'Tribeca', 'Legacy Wagon', 'Legacy Outback', 'Impreza Sedan', 'Impreza Hatchback', 'WRX STI Hatchback', 'WRX', 'Legacy NEW', 'Alcyone', 'Impreza XV', 'Mini Jumbo', 'WRX STI Sedan', 'Impreza WRX Sedan', 'Rex', 'BRZ', 'XV', 'Impreza  WRX STI', 'Sambar', 'Trezia', 'Crosstrek', 'Levorg'
        ),
        'Suzuki' => array(
            'Alto', 'Baleno', 'Cappuccino', 'Grand Vitara', 'Ignis', 'Jimny', 'Liana', 'SA310 Swift', 'Samurai', 'SC100', 'Swift', 'Vitara', 'Wagon R', 'X90', 'Aerio', 'Carry', 'Cultus', 'Dingo', 'Every Landy', 'KEI', 'LJ 80', 'MR Wagon', 'Super Carry Bus', 'XL7', 'SX4', 'Forenza', 'Splash', 'Kizashi', 'Geo Tracker', 'Cervo', 'Reno', 'Celerio', 'Fronte', 'Esteem', 'UE', 'Ignis II', 'Sidekick', 'Ertiga', 'Karimun'
        ),
        'Talbot' => array(
            'Alpine', 'Avenger', 'Horizon', 'Matra', 'Samba', 'Solara', 'Sunbeam', 'Tagora', 'Simca', '1510'
        ),
        'Tarpan Honker' => array(
            'PW', '237'
        ),
        'TATA' => array(
            'Gurkha', 'Safari', 'Telcoline', 'Nano', 'Indica', 'Xenon', 'Indigo'
        ),
        'Think Global' => array(
            'City'
        ),
        'Thunder Tiger' => array(
            'Gonow'
        ),
        'Tofas' => array(
            'Sahin', 'Dogan'
        ),
        'Toyota' => array(
            '4Runner', 'Avensis', 'Avensis Verso', 'Camry', 'Carina', 'Carina E', 'Celica', 'Corolla', 'Corolla Verso', 'Corona', 'Cressida', 'Crown', 'MR2', 'Paseo', 'Picnic', 'Previa', 'Prius', 'Rav 4', 'Space Cruiser', 'Starlet', 'Supra', 'Tercel', 'Yaris', 'Yaris Verso', 'Echo', 'Hiace пасс.', 'Matrix', 'Solara', 'Avalon', 'Scion', 'XA', 'Mark', 'Sienna', 'FJ Cruiser', 'Aygo', 'Auris', 'Tundra', 'Highlander', 'Fortuner', 'Sequoia', 'Windom', 'Estima', 'Town Ace', 'Tacoma', 'Vista', 'Hilux', 'Chaser', 'Gaia', 'Sprinter', 'Aurion', 'Progres', 'Aristo', 'Land Cruiser 71', 'Land Cruiser 78', 'Venza', 'Lite Ace', 'Soarer', 'Harrier', 'Caldina', 'Hino', 'Mark II', 'Avanza', 'IQ', 'Land Cruiser 76', 'Verossa', 'Cresta', 'Verso', 'Hiace груз.', 'Inova', 'Urban Cruiser', 'Corsa', 'Carib', 'Regular Cab', 'Will Vs', 'Funcargo', 'Land Cruiser (все)', 'Land Cruiser 100', 'Land Cruiser 200', 'Land Cruiser Prado', 'Land Cruiser 80', 'Land Cruiser 90', 'Land Cruiser 70', 'Altezza', 'Land Cruiser 73', 'Land Cruiser 105', 'Land Cruiser 60', 'Land Cruiser 40', '1000 (Publica)', 'Brevis', 'Cavalier', 'Zelas', 'Corolla Levin', 'Sprinter Trueno', 'Ipsum', 'Raum', 'F', 'Master', 'GT 86', 'Isis', 'Sera', 'Cynos', 'Nadia', 'Alphard', 'Century', 'Curren', 'Opa', 'Land Cruiser 79', 'Mirai', 'Voxy', 'Allex', 'Verso-S', 'Celsior', 'Prius C', 'Allion', 'C-HR', 'Proace', '7FBMF16', 'Duet', '8FBMT16', 'Cami', 'Agya', 'Cayla', 'Rush', 'Vios',
        ),
        'Triumph' => array(
            '1500', 'Acclaim', 'Dolomite', 'Spitfire', 'Stag', 'Toledo', 'TR7', 'Daytona', 'Thruxton'
        ),
        'TVR' => array(
            '2500M', '280i', '3000', '3000M', '350i', '390', '400', '420', '450', 'Cerbera', 'Chimaera', 'Griffith', 'S', 'S2', 'S3', 'S4c', 'Speed Eight', 'T350c', 'T400R', 'T440R', 'Taimar', 'Tamora', 'Tasmin', 'Tuscan', 'Tuscan R', 'V8'
        ),
        'Ultima' => array(
            'GTR'
        ),
        'Vauxhall' => array(
            'Agila', 'Astra', 'Astra Belmont', 'Belmont', 'Calibra', 'Carlton', 'Cavalier', 'Chevette', 'Corsa', 'Frontera', 'Lotus Carlton', 'Meriva', 'Monterey', 'Nova', 'Omega', 'Royale', 'Senator', 'Signum', 'Sintra', 'Tigra', 'Vectra', 'Viceroy', 'VX220', 'Zafira', 'Ventora', 'Viva', 'Movano', 'Vivaro', '25 D type', 'VX 2300'
        ),
        'Venturi' => array(
            'Atlantique'
        ),
        'Vepr' => array(
            'Commander'
        ),
        'Volkswagen' => array(
            'Beetle', 'Bora', 'Corrado', 'Derby', 'Golf I', 'Jetta', 'Lupo', 'Phaeton', 'Polo', 'Santana', 'Scirocco', 'Sharan', 'Touareg', 'Vento', 'Caravelle', 'T3 (Transporter)', 'T2 (Transporter)', 'Passat B3', 'Pointer', 'Touran', 'Crafter пасс.', 'New Beetle', 'Tiguan', 'Rabbit', 'Cross', 'Eos', 'Golf GTI', 'Golf Variant', 'Golf Plus', 'Passat CC', 'Caddy груз.', 'Caddy пасс.', 'T5 (Transporter) пасс.', 'T5 (Transporter) груз', 'Crafter груз.', 'Westfalia', 'Cross Golf', 'Passat B4', 'Golf II', 'Passat B5', 'Passat B2', 'Cross Polo', 'Passat B6', 'Golf III', 'Golf IV', 'LT груз.', 'LT пасс.', 'T4 (Transporter) груз', 'T4 (Transporter) пасс.', 'Amarok', 'Multivan', 'Cross Touran', 'Golf V', 'Golf VI', 'Taro', 'Kafer', 'Fox', 'T4', 'T5', 'LT', 'Caddy', 'Golf', 'T6', 'T6 (Transporter) груз', 'T6 (Transporter) пасс.', 'Fontana', 'Passat B7', 'Passat Alltrack', 'Passat', 'Passat B1', 'Syncro', 'T1 (Transporter)', 'Golf VII', 'Up', 'K70', 'Golf R', 'Garbus', 'e-Golf', 'Golf Sportsvan', 'Passat B8', 'Arteon', 'Golf SportWagen'
        ),
        'Volvo' => array(
            '240', '244', '245', '260', '264', '265', '340', '343', '345', '360', '440', '460', '480', '740', '760', '850', '940', '960', 'C70', 'S40', 'S60', 'S70', 'S80', 'S90', 'V40', 'V70', 'V90', 'XC70', 'XC90', '1800', 'VHD', 'C30', 'XC60', '145', 'V50', '142', '144', '670', '610', '140', 'GX', '744', '780', '66', 'V60', '164', '242', 'FS', 'FS 10', '344'
        ),
        'Wanfeng' => array(
            'SHK'
        ),
        'Wuling' => array(
            'Sunshine', 'Xingwang', 'LZW', 'Confero', 'Cortez', 'Almaz'
        ),
        'Xiaolong' => array(
            'XLW'
        ),
        'Yugo' => array(
            '311', '45', '511', '513', '55', '65', 'Sana', 'Tempo', 'ZLC', 'ZLM', 'ZLX', 'ZLXE', 'Florida'
        ),
        'Zastava' => array(
            'Yugo Florida', '750', 'Yugo', '128', '1100'
        ),
        'Zimmer' => array(
            'Golden Spirit'
        ),
        'Zotye' => array(
            'Nomad', 'Z300', 'Z100', 'T600'
        )
    );

    protected static $vehicleTypes = [
        'hatchback', 'sedan', 'small', 'convertible', 'SUV', 'MPV', 'coupe', 'station wagon'
    ];

    protected static $vehicleFuelTypes = [
        'gas', 'electric', 'diesel', 'hybrid'
    ];

    protected static $vehicleDoorCount = [
        '4' => 75,
        '2' => 15,
        '6' => 10,
    ];

    protected static $vehicleSeatCount = [
        '5' => 75,
        '2' => 15,
        '8' => 5,
        '4' => 10,
    ];

    protected static $vehicleProperties = [
        'Towbar', 'Aircondition', 'GPS', 'Leather seats', 'Roof Rack'
    ];

    protected static $vehicleGearBox = [
        'manual'    => 70,
        'automatic' => 30,
    ];

    // phpcs:enable
}
