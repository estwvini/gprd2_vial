<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('institutions')->insert(array(
            0 =>
                array(
                    'code' => '001-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ASAMBLEA NACIONAL',
                ),
            1 =>
                array(
                    'code' => '003-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PARLAMENTO ANDINO (OFICINA NACIONAL) ',
                ),
            2 =>
                array(
                    'code' => '010-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA - AZUAY',
                ),
            3 =>
                array(
                    'code' => '010-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA BOLIVAR',
                ),
            4 =>
                array(
                    'code' => '010-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA CANAR',
                ),
            5 =>
                array(
                    'code' => '010-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA - CARCHI',
                ),
            6 =>
                array(
                    'code' => '010-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA COTOPAXI',
                ),
            7 =>
                array(
                    'code' => '010-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA - CHIMBORAZO',
                ),
            8 =>
                array(
                    'code' => '010-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA EL ORO',
                ),
            9 =>
                array(
                    'code' => '010-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA - ESMERALDAS',
                ),
            10 =>
                array(
                    'code' => '010-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA - GUAYAS',
                ),
            11 =>
                array(
                    'code' => '010-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA - IMBABURA',
                ),
            12 =>
                array(
                    'code' => '010-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA LOJA',
                ),
            13 =>
                array(
                    'code' => '010-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA LOS RIOS',
                ),
            14 =>
                array(
                    'code' => '010-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA DE MANABI',
                ),
            15 =>
                array(
                    'code' => '010-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA - MORONA SANTIAGO',
                ),
            16 =>
                array(
                    'code' => '010-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA NAPO',
                ),
            17 =>
                array(
                    'code' => '010-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA PASTAZA',
                ),
            18 =>
                array(
                    'code' => '010-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA PICHINCHA',
                ),
            19 =>
                array(
                    'code' => '010-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA TUNGURAHUA',
                ),
            20 =>
                array(
                    'code' => '010-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA ZAMORA',
                ),
            21 =>
                array(
                    'code' => '010-0020',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA - GALAPAGOS',
                ),
            22 =>
                array(
                    'code' => '010-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA SUCUMBIOS',
                ),
            23 =>
                array(
                    'code' => '010-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA DE ORELLANA',
                ),
            24 =>
                array(
                    'code' => '010-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA DE SANTO DOMINGO DE LOS TSACHILAS',
                ),
            25 =>
                array(
                    'code' => '010-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL CONSEJO DE LA JUDICATURA DISTRITO SANTA ELENA',
                ),
            26 =>
                array(
                    'code' => '010-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO DE LA JUDICATURA - PLANTA CENTRAL',
                ),
            27 =>
                array(
                    'code' => '015-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DEFENSORIA PUBLICA PLANTA CENTRAL',
                ),
            28 =>
                array(
                    'code' => '020-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PRESIDENCIA DE LA REPUBLICA - PLANTA CENTRAL',
                ),
            29 =>
                array(
                    'code' => '021-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'VICEPRESIDENCIA DE LA REPUBLICA',
                ),
            30 =>
                array(
                    'code' => '034-1000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1 DEL SERVICIO NACIONAL DE GESTION DE RIESGOS Y EMERGENCIAS',
                ),
            31 =>
                array(
                    'code' => '034-2000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 2 DEL SERVICIO NACIONAL DE GESTION DE RIESGOS Y EMERGENCIAS',
                ),
            32 =>
                array(
                    'code' => '034-3000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 3 DEL SERVICIO NACIONAL DE GESTION DE RIESGOS Y EMERGENCIAS',
                ),
            33 =>
                array(
                    'code' => '034-4000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 DEL SERVICIO NACIONAL DE GESTION DE RIESGOS Y EMERGENCIAS',
                ),
            34 =>
                array(
                    'code' => '034-5000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 5 DEL SERVICIO NACIONAL DE GESTION DE RIESGOS Y EMERGENCIAS',
                ),
            35 =>
                array(
                    'code' => '034-6000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 DEL SERVICIO NACIONAL DE GESTION DE RIESGOS Y EMERGENCIAS',
                ),
            36 =>
                array(
                    'code' => '034-7000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 7 DEL SERVICIO NACIONAL DE GESTION DE RIESGOS Y EMERGENCIAS',
                ),
            37 =>
                array(
                    'code' => '034-9000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 9 DEL SERVICIO NACIONAL DE GESTION DE RIESGOS Y EMERGENCIAS',
                ),
            38 =>
                array(
                    'code' => '034-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO NACIONAL DE GESTION DE RIESGOS Y EMERGENCIAS- PLANTA CENTRAL',
                ),
            39 =>
                array(
                    'code' => '037-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ORGANISMO DE GESTION DE RECURSOS HIDRICOS POR DEMARCACION HIDROGRAFICA DE MANABI',
                ),
            40 =>
                array(
                    'code' => '037-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUBSECRETARIA DE LA DEMARCACION HIDROGRAFICA DE GUAYAS',
                ),
            41 =>
                array(
                    'code' => '037-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' DEMARCACION HIDROGRAFICA DE ESMERALDAS',
                ),
            42 =>
                array(
                    'code' => '037-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DEMARCACION HIDROGRAFICA DE MIRA',
                ),
            43 =>
                array(
                    'code' => '037-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DEMARCACION HIDROGRAFICA DE NAPO',
                ),
            44 =>
                array(
                    'code' => '037-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DEMARCACION HIDROGRAFICA DE PASTAZA',
                ),
            45 =>
                array(
                    'code' => '037-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DEMARCACION HIDROGRAFICA DE JUBONES',
                ),
            46 =>
                array(
                    'code' => '037-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DEMARCACION HIDROGRAFICA DE PUYANGO',
                ),
            47 =>
                array(
                    'code' => '037-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DEMARCACION HIDROGRAFICA DE SANTIAGO',
                ),
            48 =>
                array(
                    'code' => '037-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA NACIONAL DEL AGUA - PLANTA CENTRAL',
                ),
            49 =>
                array(
                    'code' => '038-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA TECNICA DEL PLAN TODA UNA VIDA',
                ),
            50 =>
                array(
                    'code' => '039-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO NACIONAL DE CONTRATACION PUBLICA - SERCOP ',
                ),
            51 =>
                array(
                    'code' => '040-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE ESMERALDAS',
                ),
            52 =>
                array(
                    'code' => '040-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE MANABI',
                ),
            53 =>
                array(
                    'code' => '040-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE GUAYAS',
                ),
            54 =>
                array(
                    'code' => '040-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE IMBABURA',
                ),
            55 =>
                array(
                    'code' => '040-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE PICHINCHA',
                ),
            56 =>
                array(
                    'code' => '040-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE TUNGURAHUA',
                ),
            57 =>
                array(
                    'code' => '040-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE AZUAY',
                ),
            58 =>
                array(
                    'code' => '040-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE LOJA',
                ),
            59 =>
                array(
                    'code' => '040-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE SUCUMBIOS',
                ),
            60 =>
                array(
                    'code' => '040-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE NAPO',
                ),
            61 =>
                array(
                    'code' => '040-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PROGRAMA DE REPARACION AMBIENTAL Y SOCIAL PRAS',
                ),
            62 =>
                array(
                    'code' => '040-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE CARCHI',
                ),
            63 =>
                array(
                    'code' => '040-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE ORELLANA',
                ),
            64 =>
                array(
                    'code' => '040-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE PASTAZA',
                ),
            65 =>
                array(
                    'code' => '040-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE DE COTOPAXI',
                ),
            66 =>
                array(
                    'code' => '040-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE CHIMBORAZO',
                ),
            67 =>
                array(
                    'code' => '040-0020',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE SANTO DOMINGO DE LOS TSACHILAS',
                ),
            68 =>
                array(
                    'code' => '040-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE SANTA ELENA',
                ),
            69 =>
                array(
                    'code' => '040-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE BOLIVAR',
                ),
            70 =>
                array(
                    'code' => '040-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE LOS RIOS',
                ),
            71 =>
                array(
                    'code' => '040-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PORVINCIAL DEL AMBIENTE CANAR',
                ),
            72 =>
                array(
                    'code' => '040-0025',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE MORONA SANTIAGO',
                ),
            73 =>
                array(
                    'code' => '040-0026',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE EL ORO',
                ),
            74 =>
                array(
                    'code' => '040-0027',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DEL AMBIENTE ZAMORA CHINCHIPE',
                ),
            75 =>
                array(
                    'code' => '040-0028',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUBSECRETARIA DE GESTION MARINA Y COSTERA',
                ),
            76 =>
                array(
                    'code' => '040-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DEL AMBIENTE - PLANTA CENTRAL',
                ),
            77 =>
                array(
                    'code' => '045-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO DE GOBIERNO DEL REGIMEN ESPECIAL DE GALAPAGOS',
                ),
            78 =>
                array(
                    'code' => '046-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL DE COMPETENCIAS',
                ),
            79 =>
                array(
                    'code' => '047-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA DE REGULACION Y CONTROL DE LA BIOSEGURIAD Y CUARENTENA PARA GALAPAGOS',
                ),
            80 =>
                array(
                    'code' => '049-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA TECNICA DEL COMITE DE PREVENCION DE ASENTAMIENTOS HUMANOS IRREGULARES',
                ),
            81 =>
                array(
                    'code' => '050-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DEL AZUAY',
                ),
            82 =>
                array(
                    'code' => '050-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DEL BOLIVAR',
                ),
            83 =>
                array(
                    'code' => '050-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DEL CANAR',
                ),
            84 =>
                array(
                    'code' => '050-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DEL CARCHI',
                ),
            85 =>
                array(
                    'code' => '050-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DEL COTOPAXI',
                ),
            86 =>
                array(
                    'code' => '050-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DEL CHIMBORAZO',
                ),
            87 =>
                array(
                    'code' => '050-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE EL ORO',
                ),
            88 =>
                array(
                    'code' => '050-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE ESMERALDAS',
                ),
            89 =>
                array(
                    'code' => '050-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE GUAYAS',
                ),
            90 =>
                array(
                    'code' => '050-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE IMBABURA',
                ),
            91 =>
                array(
                    'code' => '050-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE LOJA',
                ),
            92 =>
                array(
                    'code' => '050-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE LOS RIOS',
                ),
            93 =>
                array(
                    'code' => '050-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE MANABI',
                ),
            94 =>
                array(
                    'code' => '050-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE MORONA SANTIAGO',
                ),
            95 =>
                array(
                    'code' => '050-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE NAPO',
                ),
            96 =>
                array(
                    'code' => '050-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE PASTAZA',
                ),
            97 =>
                array(
                    'code' => '050-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE TUNGURAHUA',
                ),
            98 =>
                array(
                    'code' => '050-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE ZAMORA CHINCHIPE',
                ),
            99 =>
                array(
                    'code' => '050-0020',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE GALAPAGOS',
                ),
            100 =>
                array(
                    'code' => '050-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE SUCUMBIOS',
                ),
            101 =>
                array(
                    'code' => '050-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE ORELLANA',
                ),
            102 =>
                array(
                    'code' => '050-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE SANTO DOMINGO DE LOS TSACHILAS',
                ),
            103 =>
                array(
                    'code' => '050-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBERNACION DE SANTA ELENA',
                ),
            104 =>
                array(
                    'code' => '050-1000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1 - MDI',
                ),
            105 =>
                array(
                    'code' => '050-4000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 - MDI',
                ),
            106 =>
                array(
                    'code' => '050-8000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 8 - MDI',
                ),
            107 =>
                array(
                    'code' => '050-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE GOBIERNO - PLANTA CENTRAL',
                ),
            108 =>
                array(
                    'code' => '051-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 DIGERCIC',
                ),
            109 =>
                array(
                    'code' => '051-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 7 DEL REGISTRO CIVIL IDENTIFICACION Y CEDULACION',
                ),
            110 =>
                array(
                    'code' => '051-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 DEL REGISTRO CIVIL IDENTIFICACION Y CEDULACION',
                ),
            111 =>
                array(
                    'code' => '051-1000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1 DEL REGISTRO CIVIL IDENTIFICACION Y CEDULACION',
                ),
            112 =>
                array(
                    'code' => '051-2000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 2 DEL REGISTRO CIVIL IDENTIFICACION Y CEDULACION',
                ),
            113 =>
                array(
                    'code' => '051-3000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 3 DEL REGISTRO CIVIL IDENTIFICACION Y CEDULACION',
                ),
            114 =>
                array(
                    'code' => '051-4000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 DEL REGISTRO CIVIL IDENTIFICACION Y CEDULACION',
                ),
            115 =>
                array(
                    'code' => '051-5000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 5 DEL REGISTRO CIVIL IDENTIFICACION Y CEDULACION',
                ),
            116 =>
                array(
                    'code' => '051-6000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 DEL REGISTRO CIVIL IDENTIFICACION Y CEDULACION',
                ),
            117 =>
                array(
                    'code' => '051-7000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 7 DEL REGISTRO CIVIL IDENTIFICACION Y CEDULACION',
                ),
            118 =>
                array(
                    'code' => '051-8000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 8 DEL REGISTRO CIVIL IDENTIFICACION Y CEDULACION',
                ),
            119 =>
                array(
                    'code' => '051-9000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 9 DEL REGISTRO CIVIL IDENTIFICACION Y CEDULACION',
                ),
            120 =>
                array(
                    'code' => '051-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION GENERAL DE REGISTRO CIVIL  IDENTIFICACION Y CEDULACION - PLANTA CENTRAL',
                ),
            121 =>
                array(
                    'code' => '052-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DISTRITO METROPOLITANO DE QUITO',
                ),
            122 =>
                array(
                    'code' => '052-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION NACIONAL DE BIENESTAR SOCIAL',
                ),
            123 =>
                array(
                    'code' => '052-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION NACIONAL ANTINARCOTICOS',
                ),
            124 =>
                array(
                    'code' => '052-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION NACIONAL DE POLICIA ESPECIALIZADA PARA NINOS NINAS Y ADOLESCENTES DINAPEN',
                ),
            125 =>
                array(
                    'code' => '052-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION NACIONAL DE COMUNICACIONES',
                ),
            126 =>
                array(
                    'code' => '052-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION NACIONAL DE EDUCACION',
                ),
            127 =>
                array(
                    'code' => '052-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION GENERAL DE INTELIGENCIA',
                ),
            128 =>
                array(
                    'code' => '052-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD DE LUCHA CONTRA EL CRIMEN ORGANIZADO',
                ),
            129 =>
                array(
                    'code' => '052-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP-1 COMANDO PROVINCIAL PICHINCHA No. 1',
                ),
            130 =>
                array(
                    'code' => '052-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMANDO PROVINCIAL SANTO DOMINGO DE LOS TSACHILAS',
                ),
            131 =>
                array(
                    'code' => '052-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP-1 UNIDAD VIGILANCIA CENTRO OCCIDENTE',
                ),
            132 =>
                array(
                    'code' => '052-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP-1  UNIDAD VIGILANCIA NORTE',
                ),
            133 =>
                array(
                    'code' => '052-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP-1 UNIDAD VIGILANCIA QUITUMBE',
                ),
            134 =>
                array(
                    'code' => '052-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP- 1 UNIDAD VIGILANCIA SUR',
                ),
            135 =>
                array(
                    'code' => '052-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 10 COMANDO PROVINCIAL CARCHI',
                ),
            136 =>
                array(
                    'code' => '052-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 12 COMANDO PROVINCIAL IMBABURA',
                ),
            137 =>
                array(
                    'code' => '052-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMANDO PROVINCIAL DE POLICIA ESMERALDAS No 14',
                ),
            138 =>
                array(
                    'code' => '052-0020',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 20 COMANDO PROVINCIAL NAPO',
                ),
            139 =>
                array(
                    'code' => '052-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 21 COMANDO PROVINCIAL SUCUMBIOS ',
                ),
            140 =>
                array(
                    'code' => '052-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 22 COMANDO PROVINCIAL ORELLANA',
                ),
            141 =>
                array(
                    'code' => '052-0025',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA SAN PABLO DEL LAGO',
                ),
            142 =>
                array(
                    'code' => '052-0026',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA JOSE EMILIO CASTILLO S',
                ),
            143 =>
                array(
                    'code' => '052-0027',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO SUPERIOR TECNOLOGICO POLICIA NACIONAL',
                ),
            144 =>
                array(
                    'code' => '052-0031',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 5 COMANDO PROVINCIAL CHIMBORAZO',
                ),
            145 =>
                array(
                    'code' => '052-0032',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 11 COMANDO PROVINCIAL BOLIVAR',
                ),
            146 =>
                array(
                    'code' => '052-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 13 COMANDO PROVINCIAL COTOPAXI',
                ),
            147 =>
                array(
                    'code' => '052-0034',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 16 COMANDO PROVINCIAL PASTAZA',
                ),
            148 =>
                array(
                    'code' => '052-0035',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 9 COMANDO PROVINCIAL TUNGURAHUA',
                ),
            149 =>
                array(
                    'code' => '052-0036',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA DE FORMACION DE POLICIAS CABO SEGUNDO VICTOR HUGO USCA PACHACAMA',
                ),
            150 =>
                array(
                    'code' => '052-0037',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA SAN MIGUEL DE BOLIVAR',
                ),
            151 =>
                array(
                    'code' => '052-0038',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EFP. CBOS. EDISON JAVIER ALMACHE QUEVEDO',
                ),
            152 =>
                array(
                    'code' => '052-0039',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EFP. SBOS. Rodrigo Amable Alquinga Concha',
                ),
            153 =>
                array(
                    'code' => '052-0041',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 6 COMANDO PROVINICAL AZUAY',
                ),
            154 =>
                array(
                    'code' => '052-0042',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 15 COMANDO PROVINCIAL CANAR',
                ),
            155 =>
                array(
                    'code' => '052-0043',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 17 COMANDO PROVINCIAL MORONA SANTIAGO',
                ),
            156 =>
                array(
                    'code' => '052-0044',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 18 COMANDO PROVINCIAL ZAMORA CHINCHIPE',
                ),
            157 =>
                array(
                    'code' => '052-0045',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EQUITACION Y REMONTA CUENCA CP-6',
                ),
            158 =>
                array(
                    'code' => '052-0046',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 7 COMANDO PROVINICAL LOJA',
                ),
            159 =>
                array(
                    'code' => '052-0048',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 2 COMANDO PROVINICAL GUAYAS',
                ),
            160 =>
                array(
                    'code' => '052-0049',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 19 COMANDO PROVINCIAL GALAPAGOS',
                ),
            161 =>
                array(
                    'code' => '052-0050',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 3 COMANDO PROVINCIAL EL ORO',
                ),
            162 =>
                array(
                    'code' => '052-0051',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 4 COMANDO PROVINCIAL MANABI',
                ),
            163 =>
                array(
                    'code' => '052-0052',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMANDO CANTONAL DE POLICIA MANTA',
                ),
            164 =>
                array(
                    'code' => '052-0053',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CP 8 COMANDO PROVINCIAL LOS RIOS',
                ),
            165 =>
                array(
                    'code' => '052-0054',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO RURAL LOS RIOS',
                ),
            166 =>
                array(
                    'code' => '052-0055',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA FABIAN ARMIJOS JIMENEZ',
                ),
            167 =>
                array(
                    'code' => '052-0056',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA DE POLICIA CABO SEGUNDO DE POLICIA SOCRATES MANRIQUE ARBOLEDA SANABRIA',
                ),
            168 =>
                array(
                    'code' => '052-0057',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA DE FORMACION DE POLICIAS DE GUAYAQUIL',
                ),
            169 =>
                array(
                    'code' => '052-0058',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA GUSTAVO NOBOA',
                ),
            170 =>
                array(
                    'code' => '052-0059',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA LIZANDRO HERRERA',
                ),
            171 =>
                array(
                    'code' => '052-0060',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA J ROSERO LEON',
                ),
            172 =>
                array(
                    'code' => '052-0061',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA ESTADO MAYOR',
                ),
            173 =>
                array(
                    'code' => '052-0062',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA PERFECCIONAMIENTO OFICIALES',
                ),
            174 =>
                array(
                    'code' => '052-0063',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA SUPERIOR POLICIA',
                ),
            175 =>
                array(
                    'code' => '052-0065',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD NACIONAL DE SERVICIOS ESPECIALIZADOS UNASE',
                ),
            176 =>
                array(
                    'code' => '052-0066',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO AEROPOLICIAL QUITO',
                ),
            177 =>
                array(
                    'code' => '052-0067',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO AEROPOLICIAL GUAYAS',
                ),
            178 =>
                array(
                    'code' => '052-0068',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO DE ESTUDIOS HISTORICOS DE LA POLICIA NACIONAL',
                ),
            179 =>
                array(
                    'code' => '052-0069',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EQUITACION REMONTA QUITO ',
                ),
            180 =>
                array(
                    'code' => '052-0070',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD PROTECCION MEDIO AMBIENTE UPMA',
                ),
            181 =>
                array(
                    'code' => '052-0071',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EQUITACION REMONTA GUAYAS',
                ),
            182 =>
                array(
                    'code' => '052-0072',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GRUPO DE INTERVENCION Y RESCATE GIR QUITO',
                ),
            183 =>
                array(
                    'code' => '052-0073',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GRUPO DE INTERVENCION Y RESCATE GIR GUAYAS',
                ),
            184 =>
                array(
                    'code' => '052-0074',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GRUPO DE INTERVENCION Y RESCATE GIR MANTA',
                ),
            185 =>
                array(
                    'code' => '052-0075',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GRUPO DE OPERACIONES ESPECIALES GOE QUITO',
                ),
            186 =>
                array(
                    'code' => '052-0076',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GRUPO DE OPERACIONES ESPECIALES GOE GUAYAS',
                ),
            187 =>
                array(
                    'code' => '052-0079',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO AEROPOLICIAL SANTO DOMINGO',
                ),
            188 =>
                array(
                    'code' => '052-0080',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMANDO PROVINCIAL SANTA ELENA NO. 24',
                ),
            189 =>
                array(
                    'code' => '052-0082',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD DE INVESTIGACIONES DE DELITOS ENERGETICOS E HIDROCARBURIFEROS',
                ),
            190 =>
                array(
                    'code' => '052-0084',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUBDIRECCION DE INTELIGENCIA ANTIDELINCUENCIAL',
                ),
            191 =>
                array(
                    'code' => '052-0085',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DISTRITO METROPOLITANO DE GUAYAQUIL',
                ),
            192 =>
                array(
                    'code' => '052-0086',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION NACIONAL DE DELITOS CONTRA LA VIDA MUERTES VIOLENTAS DESAPARICIONES EXTORSION Y SECUESTRO',
                ),
            193 =>
                array(
                    'code' => '052-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMANDANCIA GENERAL - PLANTA CENTRAL',
                ),
            194 =>
                array(
                    'code' => '056-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION NACIONAL DE MIGRACION',
                ),
            195 =>
                array(
                    'code' => '057-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION NACIONAL DE LA POLICIA JUDICIAL',
                ),
            196 =>
                array(
                    'code' => '058-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL QUITO No 1',
                ),
            197 =>
                array(
                    'code' => '058-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE LA POLICIA NACIONAL GUAYAQUIL N. 2',
                ),
            198 =>
                array(
                    'code' => '058-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION NACIONAL DE SALUD DE LA POLICIA NACIONAL - PLANTA CENTRAL',
                ),
            199 =>
                array(
                    'code' => '061-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL DE LA SECRETARIA DE DERECHOS HUMANOS 4',
                ),
            200 =>
                array(
                    'code' => '061-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL DE LA SECRETARIA DE DERECHOS HUMANOS 6',
                ),
            201 =>
                array(
                    'code' => '061-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL DE LA SECRETARIA DE DERECHOS HUMANOS 7',
                ),
            202 =>
                array(
                    'code' => '061-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL DE LA SECRETARIA DE DERECHOS HUMANOS 8',
                ),
            203 =>
                array(
                    'code' => '061-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL DE LA SECRETARIA DE DERECHOS HUMANOS 3',
                ),
            204 =>
                array(
                    'code' => '061-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL DE LA SECRETARIA DE DERECHOS HUMANOS 1',
                ),
            205 =>
                array(
                    'code' => '061-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA DE DERECHOS HUMANOS - PLANTA CENTRAL',
                ),
            206 =>
                array(
                    'code' => '063-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE COORDINACION DE LOS SECTORES ESTRATEGICOS',
                ),
            207 =>
                array(
                    'code' => '064-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 3 - INEC',
                ),
            208 =>
                array(
                    'code' => '064-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 8 - INEC',
                ),
            209 =>
                array(
                    'code' => '064-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 - INEC',
                ),
            210 =>
                array(
                    'code' => '064-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO NACIONAL DE ESTADISTICAS Y CENSOS - PLANTA CENTRAL',
                ),
            211 =>
                array(
                    'code' => '067-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 8 - INMOBILIAR',
                ),
            212 =>
                array(
                    'code' => '067-4000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 - INMOBILIAR',
                ),
            213 =>
                array(
                    'code' => '067-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO DE GESTION INMOBILIARIA DEL SECTOR PUBLICO INMOBILIAR - PLANTA CENTRAL',
                ),
            214 =>
                array(
                    'code' => '068-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMISION DE TRANSITO DEL ECUADOR - PLANTA CENTRAL',
                ),
            215 =>
                array(
                    'code' => '069-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA NACIONAL DE REGULACION Y CONTROL DEL TRANSPORTE TERRESTRE TRANSITO Y SEGURIDAD VIAL - PLANTA CENTRAL',
                ),
            216 =>
                array(
                    'code' => '070-1001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PRIMERA DIVISION DE EJERCITO SHIRYS ',
                ),
            217 =>
                array(
                    'code' => '070-1002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BRIGADA DE FUERZAS ESPECIALES No. 9 PATRIA ',
                ),
            218 =>
                array(
                    'code' => '070-1004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GRUPO DE FUERZAS ESPECIALES NO. 26 - CENEPA',
                ),
            219 =>
                array(
                    'code' => '070-1005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BRIGADA DE CABALLERIA BLINDADA No. 11 GALAPAGOS ',
                ),
            220 =>
                array(
                    'code' => '070-1006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BRIGADA DE INFANTERIA No. 13 PICHINCHA ',
                ),
            221 =>
                array(
                    'code' => '070-1007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'IV D.E AMAZONAS',
                ),
            222 =>
                array(
                    'code' => '070-1008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BRIGADA DE INFANTERIA No.31 ANDES',
                ),
            223 =>
                array(
                    'code' => '070-1009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMANDO LOGISTICO NO. 74 HUANCAVILCA',
                ),
            224 =>
                array(
                    'code' => '070-1011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GRUPO DE ARTILLERIA ANTIAEREA No.5 MAYOR VALENCIA',
                ),
            225 =>
                array(
                    'code' => '070-1012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GRUPO DE CABALLERIA BLINDADO No 12 TNTE. ORTIZ ',
                ),
            226 =>
                array(
                    'code' => '070-1014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'TERCERA DIVISION DE EJERCITO TARQUI ',
                ),
            227 =>
                array(
                    'code' => '070-1016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMANDO DE APOYO LOGISTICO NO. 1 EL ORO',
                ),
            228 =>
                array(
                    'code' => '070-1017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EDUCATIVA DE FUERZAS ARMADAS COLEGIO MILITAR No. 3 HEROES DEL 41',
                ),
            229 =>
                array(
                    'code' => '070-1022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BRIGADA DE ARTILLERIA No. 27 PORTETE ',
                ),
            230 =>
                array(
                    'code' => '070-1023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GRUPO DE CABALLERIA MECANIZADA DE LA III D.E GRAL. DAVALOS ',
                ),
            231 =>
                array(
                    'code' => '070-1024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BRIGADA DE INFANTERIA No. 7 LOJA',
                ),
            232 =>
                array(
                    'code' => '070-1025',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EDUCATIVA DE FUERZAS ARMADAS COLEGIO MILITAR No. 4 ABDON CALDERON',
                ),
            233 =>
                array(
                    'code' => '070-1026',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GRUPO DE ARTILLERIA DE 105 MM. No. 7 CABO MINACHO LOJA',
                ),
            234 =>
                array(
                    'code' => '070-1027',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FUERTE MILITAR MIGUEL ITURRALDE',
                ),
            235 =>
                array(
                    'code' => '070-1029',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON DE SELVA No. 17 ZUMBA ',
                ),
            236 =>
                array(
                    'code' => '070-1030',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON DE INFANTERIA No. 19 CARCHI ',
                ),
            237 =>
                array(
                    'code' => '070-1031',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON DE INFANTERIA No. 20 CAPT. DIAZ',
                ),
            238 =>
                array(
                    'code' => '070-1032',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON DE INFANTERIA No. 21 MACARA',
                ),
            239 =>
                array(
                    'code' => '070-1033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GRUPO DE FUERZAS ESPECIALES NO. 53 RAYO',
                ),
            240 =>
                array(
                    'code' => '070-1034',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BRIGADA DE SELVA No. 17 PASTAZA',
                ),
            241 =>
                array(
                    'code' => '070-1038',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BRIGADA DE SELVA N19 NAPO',
                ),
            242 =>
                array(
                    'code' => '070-1039',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON DE SELVA No. 55 PUTUMAYO',
                ),
            243 =>
                array(
                    'code' => '070-1040',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON DE SELVA No. 56 TUNGURAHUA',
                ),
            244 =>
                array(
                    'code' => '070-1042',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON DE OPERAC. ESPEC. DE SELVA No. 54 CAPT.CALLES',
                ),
            245 =>
                array(
                    'code' => '070-1043',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BRIGADA DE SELVA No. 21 CONDOR',
                ),
            246 =>
                array(
                    'code' => '070-1045',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON DE SELVA No. 62 ZAMORA',
                ),
            247 =>
                array(
                    'code' => '070-1046',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON DE SELVA No. 63 GUALAQUIZA',
                ),
            248 =>
                array(
                    'code' => '070-1048',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON DE INGENIEROS No. 69 CHIMBORAZO',
                ),
            249 =>
                array(
                    'code' => '070-1049',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON DE INGENIEROS No. 67 MONTUFAR',
                ),
            250 =>
                array(
                    'code' => '070-1050',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BRIGADA DE AVIACION DEL EJERCITO No. 15 PAQUISHA',
                ),
            251 =>
                array(
                    'code' => '070-1054',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGRUPAMIENTO DE COMUNICACIONES Y GUERRA ELECTRONICA DE LA FUERZA TERRESTRE',
                ),
            252 =>
                array(
                    'code' => '070-1055',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BRIGADA DE APOYO LOGISTICO No. 25 REINO DE QUITO',
                ),
            253 =>
                array(
                    'code' => '070-1056',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL BASICO 11 BCB GALAPAGOS ',
                ),
            254 =>
                array(
                    'code' => '070-1057',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL II DE',
                ),
            255 =>
                array(
                    'code' => '070-1058',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE DIVISION III DE TARQUI',
                ),
            256 =>
                array(
                    'code' => '070-1059',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE BRIGADA N. 1 EL ORO',
                ),
            257 =>
                array(
                    'code' => '070-1060',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL BASICO 7 BI LOJA',
                ),
            258 =>
                array(
                    'code' => '070-1061',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE BRIGADA No. 17 PASTAZA',
                ),
            259 =>
                array(
                    'code' => '070-1062',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMANDO DE EDUCACION Y DOCTRINA MILITAR TERRESTRE',
                ),
            260 =>
                array(
                    'code' => '070-1063',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EDUCATIVA DE FUERZAS ARMADAS COLEGIO MILITAR No. 1 ELOY ALFARO',
                ),
            261 =>
                array(
                    'code' => '070-1064',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA SUPERIOR MILITAR ELOY ALFARO',
                ),
            262 =>
                array(
                    'code' => '070-1065',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA DE FORMACION DE SOLDADOS DE LA F. T.',
                ),
            263 =>
                array(
                    'code' => '070-1066',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA DE AVIACION DEL EJERCITO',
                ),
            264 =>
                array(
                    'code' => '070-1078',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL BASICO IV DE',
                ),
            265 =>
                array(
                    'code' => '070-1079',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON DE INFANTERIA MOTORIZADO No.14',
                ),
            266 =>
                array(
                    'code' => '070-1081',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON DE INFANTERIA MOTORIZADO NO.13 ESMERALDAS',
                ),
            267 =>
                array(
                    'code' => '070-1999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FUERZA TERRESTRE DEL EJERCITO ECUATORIANO',
                ),
            268 =>
                array(
                    'code' => '070-2001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ALA DE COMBATE NO. 31',
                ),
            269 =>
                array(
                    'code' => '070-2002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ALA DE COMBATE No.22',
                ),
            270 =>
                array(
                    'code' => '070-2003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BASE AEREA MARISCAL SUCRE BAMAS',
                ),
            271 =>
                array(
                    'code' => '070-2004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BASE AEREA COTOPAXI',
                ),
            272 =>
                array(
                    'code' => '070-2005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ALA DE COMBATE No.23',
                ),
            273 =>
                array(
                    'code' => '070-2006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMANDO DE EDUCACION Y DOCTRINA MILITAR AEROESPACIAL',
                ),
            274 =>
                array(
                    'code' => '070-2008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA TECNICA DE LA FUERZA AEREA',
                ),
            275 =>
                array(
                    'code' => '070-2009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMANDO DE OPERACIONES AEREAS Y DEFENSA',
                ),
            276 =>
                array(
                    'code' => '070-2010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA DE INFANTERIA AEREA EIA',
                ),
            277 =>
                array(
                    'code' => '070-2011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA SUPERIOR MILITAR DE AVIACION ESMA',
                ),
            278 =>
                array(
                    'code' => '070-2012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA DE PERFECCIONAMIENTO AEREOTECNICOS - FAE',
                ),
            279 =>
                array(
                    'code' => '070-2013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FAE - CENTRO DE OPERACIONES SECTORIAL 1 COS.1',
                ),
            280 =>
                array(
                    'code' => '070-2014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FAE - CENTRO DE OPERACIONES SECTORIAL 2 COS.2',
                ),
            281 =>
                array(
                    'code' => '070-2016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ALA 21 DE COMBATE TAURA',
                ),
            282 =>
                array(
                    'code' => '070-2017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DE LA ADMINISTRATIVA CENTRAL',
                ),
            283 =>
                array(
                    'code' => '070-2018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BASE AEREA DE GALAPAGOS',
                ),
            284 =>
                array(
                    'code' => '070-2019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA DE ARTILLERIA ANTIAEREA CONJUNTA CORONEL OCTAVIO YCAZA',
                ),
            285 =>
                array(
                    'code' => '070-2021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE INVESTIGACION Y DESARROLLO DE LA FUERZA AEREA ECUATORIANA CID',
                ),
            286 =>
                array(
                    'code' => '070-2027',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GRUPO DE TRANSPORTE AEREO ESPECIAL DE LA FUERZA AEREA ECUATORIANA - GTAE',
                ),
            287 =>
                array(
                    'code' => '070-2028',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EDUCATIVA DE FUERZAS ARMADAS FAE No. 3 TAURA',
                ),
            288 =>
                array(
                    'code' => '070-2999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FUERZA AEREA ECUATORIANA',
                ),
            289 =>
                array(
                    'code' => '070-3002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESTACION AERONAVAL GUAYAQUIL',
                ),
            290 =>
                array(
                    'code' => '070-3003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BASE NAVAL DE SALINAS',
                ),
            291 =>
                array(
                    'code' => '070-3004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BASE NAVAL DE JARAMIJO',
                ),
            292 =>
                array(
                    'code' => '070-3008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BATALLON IM No. 11 SAN LORENZO',
                ),
            293 =>
                array(
                    'code' => '070-3009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO TECNOLOGICO NAVAL',
                ),
            294 =>
                array(
                    'code' => '070-3011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMANDO DE GUARDACOSTAS',
                ),
            295 =>
                array(
                    'code' => '070-3012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CAPITANIA DEL PUERTO DE ESMERALDAS',
                ),
            296 =>
                array(
                    'code' => '070-3013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CAPITANIA DEL PUERTO DE GUAYAQUIL',
                ),
            297 =>
                array(
                    'code' => '070-3014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CAPITANIA DEL PUERTO DE MANTA',
                ),
            298 =>
                array(
                    'code' => '070-3015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CAPITANIA DEL PUERTO DE ORELLANA',
                ),
            299 =>
                array(
                    'code' => '070-3016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CAPITANIA DEL PUERTO DE PTO. BOLIVAR',
                ),
            300 =>
                array(
                    'code' => '070-3017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE INFANTERIA DE MARINA',
                ),
            301 =>
                array(
                    'code' => '070-3018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION GENERAL DE INTERESES MARITIMOS',
                ),
            302 =>
                array(
                    'code' => '070-3021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION GENERAL DE TALENTO HUMANO',
                ),
            303 =>
                array(
                    'code' => '070-3022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION GENERAL DEL MATERIAL',
                ),
            304 =>
                array(
                    'code' => '070-3023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EDUCATIVA DE FUERZAS ARMADAS LICEO NAVAL GUAYAQUIL COMANDANTE RAFAEL ANDRADE LALAMA',
                ),
            305 =>
                array(
                    'code' => '070-3024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DE EDUCACION DE LA ARMADA',
                ),
            306 =>
                array(
                    'code' => '070-3025',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DE SANIDAD DE LA ARMADA',
                ),
            307 =>
                array(
                    'code' => '070-3026',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DE VIVIENDA DE LA ARMADA',
                ),
            308 =>
                array(
                    'code' => '070-3027',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESTACION NAVAL DE JAMBELI',
                ),
            309 =>
                array(
                    'code' => '070-3028',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESTACION NAVAL DE QUITO',
                ),
            310 =>
                array(
                    'code' => '070-3029',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EDUCATIVA DE FUERZAS ARMADAS LICEO NAVAL QUITO COMANDANTE CESAR ENDARA PENAHERRERA',
                ),
            311 =>
                array(
                    'code' => '070-3030',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL NAVAL',
                ),
            312 =>
                array(
                    'code' => '070-3039',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESTACION NAVAL CENTRO',
                ),
            313 =>
                array(
                    'code' => '070-3040',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BASE NAVAL SAN CRISTOBAL',
                ),
            314 =>
                array(
                    'code' => '070-3041',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO DE DRAGAS',
                ),
            315 =>
                array(
                    'code' => '070-3045',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'TERCERA ZONA NAVAL',
                ),
            316 =>
                array(
                    'code' => '070-3047',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL NAVAL DE ESMERALDAS 62 ',
                ),
            317 =>
                array(
                    'code' => '070-3048',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESTACION AERONAVAL DE MANTA (ESANMA)',
                ),
            318 =>
                array(
                    'code' => '070-3052',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA DE LA MARINA MERCANTE NACIONAL',
                ),
            319 =>
                array(
                    'code' => '070-3059',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION NACIONAL DE ESPACIOS ACUATICOS - DIRNEA',
                ),
            320 =>
                array(
                    'code' => '070-3999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FUERZA NAVAL - PLANTA CENTRAL',
                ),
            321 =>
                array(
                    'code' => '070-4001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DE MOVILIZACION DEL COMANDO CONJUNTO DE LAS FUERZAS ARMADAS',
                ),
            322 =>
                array(
                    'code' => '070-4004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMANDO DE INTELIGENCIA MILITAR CONJUNTO DE LAS FUERZAS ARMADAS',
                ),
            323 =>
                array(
                    'code' => '070-4999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMANDO CONJUNTO - PLANTA CENTRAL',
                ),
            324 =>
                array(
                    'code' => '070-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE DEFENSA NACIONAL - PLANTA CENTRAL',
                ),
            325 =>
                array(
                    'code' => '072-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO GEOGRAFICO MILITAR',
                ),
            326 =>
                array(
                    'code' => '074-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE ESPECIALIDADES FUERZAS ARMADAS NO. 1',
                ),
            327 =>
                array(
                    'code' => '075-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECCION NACIONAL DEL ECUADOR DEL INSTITUTO PANAMERICANO DE GEOGRAFIA E HISTORIA',
                ),
            328 =>
                array(
                    'code' => '077-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO ANTARTICO ECUATORIANO',
                ),
            329 =>
                array(
                    'code' => '080-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO ESPACIAL ECUATORIANO',
                ),
            330 =>
                array(
                    'code' => '085-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA MILITAR PRESIDENCIAL - PLANTA CENTRAL',
                ),
            331 =>
                array(
                    'code' => '089-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE COORDINACION DE CONOCIMIENTO Y TALENTO HUMANO',
                ),
            332 =>
                array(
                    'code' => '090-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA DE REGULACION Y CONTROL DE LAS TELECOMUNICACIONES ARCOTEL',
                ),
            333 =>
                array(
                    'code' => '095-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OPERADOR NACIONAL DE ELECTRICIDAD - CENACE - PLANTA CENTRAL',
                ),
            334 =>
                array(
                    'code' => '099-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AUTORIDAD PORTUARIA DE PUERTO BOLIVAR',
                ),
            335 =>
                array(
                    'code' => '100-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AUTORIDAD PORTUARIA DE ESMERALDAS',
                ),
            336 =>
                array(
                    'code' => '101-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AUTORIDAD PORTUARIA DE GUAYAQUIL',
                ),
            337 =>
                array(
                    'code' => '102-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AUTORIDAD PORTUARIA DE MANTA',
                ),
            338 =>
                array(
                    'code' => '115-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA DE REGULACION Y CONTROL DEL AGUA - PLANTA CENTRAL',
                ),
            339 =>
                array(
                    'code' => '116-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL PARA LA  IGUALDAD DE GENERO',
                ),
            340 =>
                array(
                    'code' => '120-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 DEL MINISTERIO DE RELACIONES EXTERIORES Y MOVILIDAD HUMANA',
                ),
            341 =>
                array(
                    'code' => '120-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 8 DEL MINISTERIO DE RELACIONES EXTERIORES Y MOVILIDAD HUMANA',
                ),
            342 =>
                array(
                    'code' => '120-1000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1 DEL MINISTERIO DE RELACIONES EXTERIORES  Y MOVILIDAD HUMANA',
                ),
            343 =>
                array(
                    'code' => '120-2000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 2 - RELACIONES EXTERIORES  Y MOVILIDAD HUMANA',
                ),
            344 =>
                array(
                    'code' => '120-3000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 3 DEL MINISTERIO DE RELACIONES EXTERIORES Y MOVILIDAD HUMANA',
                ),
            345 =>
                array(
                    'code' => '120-4000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 DEL MINISTERIO DE RELACIONES EXTERIORES  Y MOVILIDAD HUMANA',
                ),
            346 =>
                array(
                    'code' => '120-7000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 7 DEL MINISTERIO DE RELACIONES EXTERIORES  Y MOVILIDAD HUMANA',
                ),
            347 =>
                array(
                    'code' => '120-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO  DE RELACIONES EXTERIORES Y MOVILIDAD HUMANA - PLANTA CENTRAL',
                ),
            348 =>
                array(
                    'code' => '127-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA TECNICA DEL COMITE NACIONAL DE LIMITES INTERNOS',
                ),
            349 =>
                array(
                    'code' => '128-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA DE ASEGURAMIENTO DE LA CALIDAD DE SERVICIOS DE SALUD Y MEDICINA PREPAGADA ACESS',
                ),
            350 =>
                array(
                    'code' => '129-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO DE PROMOCION DE EXPORTACIONES E INVERSIONES EXTRANJERAS',
                ),
            351 =>
                array(
                    'code' => '130-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE ECONOMIA Y FINANZAS - PLANTA CENTRAL',
                ),
            352 =>
                array(
                    'code' => '135-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO DE RENTAS INTERNAS -SRI',
                ),
            353 =>
                array(
                    'code' => '136-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO NACIONAL DE ADUANA DEL ECUADOR - SUBDIRECCION DE APOYO REGIONAL',
                ),
            354 =>
                array(
                    'code' => '136-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO NACIONAL DE ADUANA DEL ECUADOR - DISTRITO QUITO',
                ),
            355 =>
                array(
                    'code' => '136-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO NACIONAL DE ADUANA DEL ECUADOR - DISTRITO GUAYAQUIL',
                ),
            356 =>
                array(
                    'code' => '136-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO NACIONAL DE ADUANA DEL ECUADOR SENAE',
                ),
            357 =>
                array(
                    'code' => '137-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA DE REGULACION Y CONTROL POSTAL - PLANTA CENTRAL',
                ),
            358 =>
                array(
                    'code' => '140-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL DE EDUCACION ZONA 8 CANTONES GUAYAQUIL DURAN Y SAMBORONDON',
                ),
            359 =>
                array(
                    'code' => '140-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION DE EDUCACION ZONAL 6',
                ),
            360 =>
                array(
                    'code' => '140-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO DE IDIOMAS CIENCIAS Y SABERES ANCESTRALES',
                ),
            361 =>
                array(
                    'code' => '140-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL DE EDUCACION ZONA 2',
                ),
            362 =>
                array(
                    'code' => '140-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL DE EDUCACION ZONA 1',
                ),
            363 =>
                array(
                    'code' => '140-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL DE EDUCACION ZONA 3',
                ),
            364 =>
                array(
                    'code' => '140-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4',
                ),
            365 =>
                array(
                    'code' => '140-0025',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL DE EDUCACION ZONA 5',
                ),
            366 =>
                array(
                    'code' => '140-0027',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL DE EDUCACION ZONA 7',
                ),
            367 =>
                array(
                    'code' => '140-0029',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUBSECRETARIA DE EDUCACION DEL DISTRITO METROPOLITANO DE QUITO',
                ),
            368 =>
                array(
                    'code' => '140-6250',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D08 SIGSIG - EDUCACION',
                ),
            369 =>
                array(
                    'code' => '140-6623',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 04D01 SAN PEDRO DE HUACA - EDUCACION',
                ),
            370 =>
                array(
                    'code' => '140-6624',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 04D02 MONTUFAR BOLIVAR - EDUCACION',
                ),
            371 =>
                array(
                    'code' => '140-6625',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 04D03 ESPEJO MIRA - EDUCACION',
                ),
            372 =>
                array(
                    'code' => '140-6626',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D01 ESMERALDAS - EDUCACION',
                ),
            373 =>
                array(
                    'code' => '140-6627',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D02 ELOY ALFARO - EDUCACION',
                ),
            374 =>
                array(
                    'code' => '140-6628',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D03 MUISNE ATACAMES - EDUCACION',
                ),
            375 =>
                array(
                    'code' => '140-6629',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D04 QUININDE - EDUCACION',
                ),
            376 =>
                array(
                    'code' => '140-6630',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D05 SAN LORENZO - EDUCACION',
                ),
            377 =>
                array(
                    'code' => '140-6631',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D06 RIO VERDE - EDUCACION',
                ),
            378 =>
                array(
                    'code' => '140-6632',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 10D01 IBARRA PIMAMPIRO SAN MIGUEL DE URCUQUI - EDUCACION',
                ),
            379 =>
                array(
                    'code' => '140-6633',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 10D02 ANTONIO ANTE OTAVALO - EDUCACION',
                ),
            380 =>
                array(
                    'code' => '140-6634',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 10D03 COTACACHI - EDUCACION',
                ),
            381 =>
                array(
                    'code' => '140-6635',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 21D01 CASCALES GONZALO PIZARRO SUCUMBIOS - EDUCACION',
                ),
            382 =>
                array(
                    'code' => '140-6636',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 21D02 LAGO AGRIO - EDUCACION',
                ),
            383 =>
                array(
                    'code' => '140-6637',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 21D03 CUYABENO PUTUMAYO - EDUCACION',
                ),
            384 =>
                array(
                    'code' => '140-6638',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 21D04 SHUSHUFINDI - EDUCACION',
                ),
            385 =>
                array(
                    'code' => '140-6639',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D10 CAYAMBE PEDRO MONCAYO - EDUCACION',
                ),
            386 =>
                array(
                    'code' => '140-6640',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D11 MEJIA RUMINAHUI - EDUCACION',
                ),
            387 =>
                array(
                    'code' => '140-6641',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D12 PEDRO VICENTE MALDONADO PUERTO QUITO SAN MIGUEL DE LOS BANCOS - EDUCACION',
                ),
            388 =>
                array(
                    'code' => '140-6642',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 15D01 ARCHIDONA CARLOS JULIO AROSEMENA TOLA TENA - EDUCACION',
                ),
            389 =>
                array(
                    'code' => '140-6643',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 15D02 EL CHACO QUIJOS - EDUCACION',
                ),
            390 =>
                array(
                    'code' => '140-6644',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 22D01 JOYA DE LOS SACHAS - EDUCACION',
                ),
            391 =>
                array(
                    'code' => '140-6645',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 22D02 ORELLANA LORETO - EDUCACION',
                ),
            392 =>
                array(
                    'code' => '140-6646',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 22D03 AGUARICO - EDUCACION',
                ),
            393 =>
                array(
                    'code' => '140-6647',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 16D01 PASTAZA MERA SANTA CLARA - EDUCACION',
                ),
            394 =>
                array(
                    'code' => '140-6648',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 16D02 ARAJUNO - EDUCACION',
                ),
            395 =>
                array(
                    'code' => '140-6649',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 05D01 LATACUNGA - EDUCACION',
                ),
            396 =>
                array(
                    'code' => '140-6650',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 05D02 LA MANA - EDUCACION',
                ),
            397 =>
                array(
                    'code' => '140-6651',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 05D03 PANGUA - EDUCACION',
                ),
            398 =>
                array(
                    'code' => '140-6652',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 05D04 PUJILI SAQUISILI - EDUCACION',
                ),
            399 =>
                array(
                    'code' => '140-6653',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 05D05 SIGCHOS - EDUCACION',
                ),
            400 =>
                array(
                    'code' => '140-6654',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 05D06 SALCEDO - EDUCACION',
                ),
            401 =>
                array(
                    'code' => '140-6655',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 18D01 PARROQUIAS URBANAS LA PENINSULA A SAN FRANCISCO Y PARROQUIAS RURALES AUGUSTO N.MARTINEZ A ATAHUALPA - EDUCACION',
                ),
            402 =>
                array(
                    'code' => '140-6656',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 18D02 PARROQUIAS URBANAS CELIANO MONJE A PISHILATA Y PARROQUIAS RURALES HUACHI GRANDE A TOTORAS - EDUCACION',
                ),
            403 =>
                array(
                    'code' => '140-6657',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 18D03 BANOS DE AGUA SANTA - EDUCACION',
                ),
            404 =>
                array(
                    'code' => '140-6658',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 18D04 PATATE SAN PEDRO DE PELILEO - EDUCACION',
                ),
            405 =>
                array(
                    'code' => '140-6659',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 18D05 SANTIAGO DE PILLARO - EDUCACION',
                ),
            406 =>
                array(
                    'code' => '140-6660',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 18D06 CEVALLOS A TISALEO - EDUCACION',
                ),
            407 =>
                array(
                    'code' => '140-6661',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 06D01 RIOBAMBA CHAMBO - EDUCACION',
                ),
            408 =>
                array(
                    'code' => '140-6662',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 06D02 ALAUSI CHUNCHI - EDUCACION',
                ),
            409 =>
                array(
                    'code' => '140-6663',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 06D03 CUMANDA PALLATANGA - EDUCACION',
                ),
            410 =>
                array(
                    'code' => '140-6664',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 06D04 COLTA GUAMOTE - EDUCACION',
                ),
            411 =>
                array(
                    'code' => '140-6665',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 06D05 GUANO PENIPE - EDUCACION',
                ),
            412 =>
                array(
                    'code' => '140-6666',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D01 PORTOVIEJO - EDUCACION',
                ),
            413 =>
                array(
                    'code' => '140-6667',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D02 JARAMIJO MANTA MONTECRISTI - EDUCACION',
                ),
            414 =>
                array(
                    'code' => '140-6668',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D03 JIPIJAPA PUERTO LOPEZ - EDUCACION',
                ),
            415 =>
                array(
                    'code' => '140-6669',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D04 24 DE MAYO SANTA ANA OLMEDO - EDUCACION',
                ),
            416 =>
                array(
                    'code' => '140-6670',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D05 EL CARMEN - EDUCACION',
                ),
            417 =>
                array(
                    'code' => '140-6671',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D06 JUNIN BOLIVAR - EDUCACION',
                ),
            418 =>
                array(
                    'code' => '140-6672',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D07 CHONE FLAVIO ALFARO - EDUCACION',
                ),
            419 =>
                array(
                    'code' => '140-6673',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D08 PICHINCHA - EDUCACION',
                ),
            420 =>
                array(
                    'code' => '140-6674',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D09 PAJAN - EDUCACION',
                ),
            421 =>
                array(
                    'code' => '140-6675',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D10 JAMA PEDERNALES - EDUCACION',
                ),
            422 =>
                array(
                    'code' => '140-6676',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D11 SAN VICENTE SUCRE - EDUCACION',
                ),
            423 =>
                array(
                    'code' => '140-6677',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D12 ROCAFUERTE TOSAGUA - EDUCACION',
                ),
            424 =>
                array(
                    'code' => '140-6678',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 23D01 PARROQUIAS URBANAS RIO VERDE A CHIGUILPE Y PARROQUIAS RURALES ALLURIQUIN A PERIFERIA - EDUCACION',
                ),
            425 =>
                array(
                    'code' => '140-6679',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 23D02 PARROQUIAS URBANAS ABRAHAM CALAZACON BOMBOLI Y PARROQUIAS RURALES SAN JACINTO DEL BUA A PERIFERIA 2 - EDUCACION',
                ),
            426 =>
                array(
                    'code' => '140-6680',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 23D03 LA CONCORDIA - EDUCACION',
                ),
            427 =>
                array(
                    'code' => '140-6681',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D11 ALFREDO BAQUERIZO MORENO SIMON BOLIVAR- EDUCACION',
                ),
            428 =>
                array(
                    'code' => '140-6682',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D12 NARANJAL BALAO - EDUCACION',
                ),
            429 =>
                array(
                    'code' => '140-6683',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D13 BALZAR COLIMES PALESTINA - EDUCACION',
                ),
            430 =>
                array(
                    'code' => '140-6684',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D14 ISIDRO AYORA LOMAS DE SARGENTILLO PEDRO CARBO - EDUCACION',
                ),
            431 =>
                array(
                    'code' => '140-6685',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D15 EMPALME - EDUCACION',
                ),
            432 =>
                array(
                    'code' => '140-6686',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D16 EL TRIUNFO GRAL ANTONIO ELIZALDE - EDUCACION',
                ),
            433 =>
                array(
                    'code' => '140-6687',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D17 MILAGRO - EDUCACION',
                ),
            434 =>
                array(
                    'code' => '140-6688',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D18 CRNEL MARCELINO MARIDUENA NARANJITO - EDUCACION',
                ),
            435 =>
                array(
                    'code' => '140-6689',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D19 DAULE NOBOL SANTA LUCIA - EDUCACION',
                ),
            436 =>
                array(
                    'code' => '140-6690',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D20 SALITRE - EDUCACION',
                ),
            437 =>
                array(
                    'code' => '140-6691',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D21 SAN JACINTO DE YAGUACHI - EDUCACION',
                ),
            438 =>
                array(
                    'code' => '140-6692',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D22 PLAYAS - EDUCACION',
                ),
            439 =>
                array(
                    'code' => '140-6693',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 12D01 BABAHOYO BABA MONTALVO - EDUCACION',
                ),
            440 =>
                array(
                    'code' => '140-6694',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 12D02 PUEBLO VIEJO URDANETA - EDUCACION',
                ),
            441 =>
                array(
                    'code' => '140-6695',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 12D03 MOCACHE QUEVEDO - EDUCACION',
                ),
            442 =>
                array(
                    'code' => '140-6696',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 12D04 QUISALOMA VENTANAS - EDUCACION',
                ),
            443 =>
                array(
                    'code' => '140-6697',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 12D05 PALENQUE VINCES - EDUCACION',
                ),
            444 =>
                array(
                    'code' => '140-6698',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 12D06 BUENA FE VALENCIA - EDUCACION',
                ),
            445 =>
                array(
                    'code' => '140-6699',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 24D01 SANTA ELENA - EDUCACION',
                ),
            446 =>
                array(
                    'code' => '140-6700',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 24D02 LA LIBERTAD SALINAS - EDUCACION',
                ),
            447 =>
                array(
                    'code' => '140-6701',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 02D01 GUARANDA - EDUCACION',
                ),
            448 =>
                array(
                    'code' => '140-6702',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 02D02 CHILLANES - EDUCACION',
                ),
            449 =>
                array(
                    'code' => '140-6703',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 02D03 CHIMBO SAN MIGUEL - EDUCACION',
                ),
            450 =>
                array(
                    'code' => '140-6704',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 02D04 CALUMA ECHEANDIA LAS NAVES - EDUCACION',
                ),
            451 =>
                array(
                    'code' => '140-6705',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 20D01 SAN CRISTOBAL SANTA CRUZ ISABELA - EDUCACION',
                ),
            452 =>
                array(
                    'code' => '140-6706',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D01 PARROQUIA URBANA MACHANGARA A BELLAVISTA Y PARROQUIAS RURALES NULTI SAYAUSI - EDUCACION',
                ),
            453 =>
                array(
                    'code' => '140-6707',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D02 PARROQUIA URBANA SAN SEBASTIAN A MONAY Y PARROQUIAS RURALES BANOS A SANTA ANA - EDUCACION',
                ),
            454 =>
                array(
                    'code' => '140-6708',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D03 GIRON A SANTA ISABEL - EDUCACION',
                ),
            455 =>
                array(
                    'code' => '140-6709',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D04 CHORDELEG GUALACEO - EDUCACION',
                ),
            456 =>
                array(
                    'code' => '140-6710',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D05 NABON ONA - EDUCACION',
                ),
            457 =>
                array(
                    'code' => '140-6711',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D06 EL PAN A SEVILLA DE ORO - EDUCACION',
                ),
            458 =>
                array(
                    'code' => '140-6712',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D07 CAMILO PONCE ENRIQUEZ - EDUCACION',
                ),
            459 =>
                array(
                    'code' => '140-6713',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 03D01 AZOGUES BIBLIAN DELEG - EDUCACION',
                ),
            460 =>
                array(
                    'code' => '140-6714',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 03D02 CANAR EL TAMBO SUSCAL - EDUCACION',
                ),
            461 =>
                array(
                    'code' => '140-6715',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 03D03 LA TRONCAL - EDUCACION',
                ),
            462 =>
                array(
                    'code' => '140-6716',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 14D01 MORONA - EDUCACION',
                ),
            463 =>
                array(
                    'code' => '140-6717',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 14D02 HUAMBOYA PABLO SEXTO PALORA - EDUCACION',
                ),
            464 =>
                array(
                    'code' => '140-6718',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 14D03 LOGRONO SUCUA - EDUCACION',
                ),
            465 =>
                array(
                    'code' => '140-6719',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 14D04 GUALAQUIZA SAN JUAN BOSCO - EDUCACION',
                ),
            466 =>
                array(
                    'code' => '140-6720',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 14D05 TAISHA - EDUCACION',
                ),
            467 =>
                array(
                    'code' => '140-6721',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 14D06 LIMON INDANZA SANTIAGO TIWINTZA - EDUCACION',
                ),
            468 =>
                array(
                    'code' => '140-7001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 07D02 MACHALA - EDUCACION',
                ),
            469 =>
                array(
                    'code' => '140-7002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 07D01 CHILLA -EL GUABO-PASAJE - EDUCACION',
                ),
            470 =>
                array(
                    'code' => '140-7003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 07D03 ATAHUALPA PORTOVELO ZARUMA - EDUCACION',
                ),
            471 =>
                array(
                    'code' => '140-7004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 07D04 BALSAS MARCABELI PINAS - EDUCACION',
                ),
            472 =>
                array(
                    'code' => '140-7005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 07D05 ARENILLAS HUAQUILLAS LAS LAJAS - EDUCACION',
                ),
            473 =>
                array(
                    'code' => '140-7006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 07D06 SANTA ROSA - EDUCACION',
                ),
            474 =>
                array(
                    'code' => '140-7007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D01 LOJA - EDUCACION',
                ),
            475 =>
                array(
                    'code' => '140-7008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D02 CATAMAYO CHAGUARPAMBA OLMEDO - EDUCACION',
                ),
            476 =>
                array(
                    'code' => '140-7009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D03 PALTAS - EDUCACION',
                ),
            477 =>
                array(
                    'code' => '140-7010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D04 CELICA PINDAL PUYANGO - EDUCACION',
                ),
            478 =>
                array(
                    'code' => '140-7011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D05 ESPINDOLA - EDUCACION',
                ),
            479 =>
                array(
                    'code' => '140-7012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D06 CALVAS GONZANAMA QUILANGA - EDUCACION',
                ),
            480 =>
                array(
                    'code' => '140-7013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D07 MACARA SOZORANGA - EDUCACION',
                ),
            481 =>
                array(
                    'code' => '140-7014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D08 SARAGURO - EDUCACION',
                ),
            482 =>
                array(
                    'code' => '140-7015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D09 ZAPOTILLO - EDUCACION',
                ),
            483 =>
                array(
                    'code' => '140-7016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 19D01 YACUAMBI ZAMORA - EDUCACION',
                ),
            484 =>
                array(
                    'code' => '140-7017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 19D02 CENTINELA DEL CONDOR NANGARITZA PAQUISHA- EDUCACION',
                ),
            485 =>
                array(
                    'code' => '140-7018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 19D03 CHINCHIPE PALANDA - EDUCACION',
                ),
            486 =>
                array(
                    'code' => '140-7019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 19D04 EL PANGUI YANTZAZA - EDUCACION',
                ),
            487 =>
                array(
                    'code' => '140-8110',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D01 XIMENA 1 PARROQUIAS RURALES PUNA ESTUARIO DEL RIO - EDUCACION',
                ),
            488 =>
                array(
                    'code' => '140-8120',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D02 XIMENA 2 - EDUCACION',
                ),
            489 =>
                array(
                    'code' => '140-8130',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D03 PARROQUIAS URBANAS MORENO AROCA - EDUCACION',
                ),
            490 =>
                array(
                    'code' => '140-8140',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D04 FEBRES CORDERO - EDUCACION',
                ),
            491 =>
                array(
                    'code' => '140-8150',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D05 TARQUI 1 TENGUEL - EDUCACION',
                ),
            492 =>
                array(
                    'code' => '140-8160',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D06 TARQUI 2 - EDUCACION',
                ),
            493 =>
                array(
                    'code' => '140-8210',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D07 PASCUALES 1 - EDUCACION',
                ),
            494 =>
                array(
                    'code' => '140-8230',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D08 PASCUALES 2 - EDUCACION',
                ),
            495 =>
                array(
                    'code' => '140-8240',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D09 TARQUI 3 - EDUCACION',
                ),
            496 =>
                array(
                    'code' => '140-8250',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D10 PARROQUIAS RURALES (PROGRESO A AREA DE EXPANSION GUAYAQUIL) - EDUCACION',
                ),
            497 =>
                array(
                    'code' => '140-8260',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D23 SAMBORONDON - EDUCACION',
                ),
            498 =>
                array(
                    'code' => '140-8270',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D24 DURAN - EDUCACION',
                ),
            499 =>
                array(
                    'code' => '140-9001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D02 PARROQUIAS RURALES CALDERON LLANO CHICO GUAYLLABAMBA - EDUCACION',
                ),
        ));
        DB::table('institutions')->insert(array(
            0 =>
                array(
                    'code' => '140-9002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D04 PARROQUIAS URBANAS PUENGASI ECHEANDIA - EDUCACION',
                ),
            1 =>
                array(
                    'code' => '140-9003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D06 PARROQUIAS URBANAS CHILIBULO A LA FERROVIARIA Y PARROQUIAS RURALES LLOA - EDUCACION',
                ),
            2 =>
                array(
                    'code' => '140-9004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D08 PARROQUIAS RURALES CONOCOTO A LA MERCED - EDUCACION',
                ),
            3 =>
                array(
                    'code' => '140-9005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D09 PARROQUIAS RURALES TUMBACO A TABABELA - EDUCACION',
                ),
            4 =>
                array(
                    'code' => '140-9110',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D01 PARROQUIAS RURALES NANEGAL A NANEGALITO - EDUCACION',
                ),
            5 =>
                array(
                    'code' => '140-9140',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D03 PARROQUIAS URBANAS-EL CONDADO A CARCELEN Y PARROQUIAS RURALES PUELLARO A CALACALI - EDUCACION',
                ),
            6 =>
                array(
                    'code' => '140-9180',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D05 PARROQUIAS URBANAS LA CONCEPCION A JIPIJAPA Y PARROQUIAS RURALES NAYON ZAMBIZA - EDUCACION',
                ),
            7 =>
                array(
                    'code' => '140-9230',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D07 PARROQUIAS URBANAS CHILLOGALLO A LA ECUATORIANA - EDUCACION',
                ),
            8 =>
                array(
                    'code' => '140-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE EDUCACION - PLANTA  CENTRAL',
                ),
            9 =>
                array(
                    'code' => '141-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO NACIONAL DE PATRIMONIO CULTURAL',
                ),
            10 =>
                array(
                    'code' => '148-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1 - DEPORTE',
                ),
            11 =>
                array(
                    'code' => '148-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 2 - DEPORTE',
                ),
            12 =>
                array(
                    'code' => '148-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 3 - DEPORTE',
                ),
            13 =>
                array(
                    'code' => '148-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 - DEPORTE',
                ),
            14 =>
                array(
                    'code' => '148-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 8 - DEPORTE',
                ),
            15 =>
                array(
                    'code' => '148-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 - DEPORTE',
                ),
            16 =>
                array(
                    'code' => '148-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 7 - DEPORTE',
                ),
            17 =>
                array(
                    'code' => '148-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA DEL DEPORTE - PLANTA CENTRAL',
                ),
            18 =>
                array(
                    'code' => '149-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA DE REGULACION Y CONTROL DE ELECTRICIDAD ARCONEL - PLANTA CENTRAL',
                ),
            19 =>
                array(
                    'code' => '150-0029',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL DE CULTURA DEL GUAYAS',
                ),
            20 =>
                array(
                    'code' => '150-0034',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ARCHIVO HISTORICO NACIONAL',
                ),
            21 =>
                array(
                    'code' => '150-0035',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CORPORACION CIUDAD ALFARO',
                ),
            22 =>
                array(
                    'code' => '150-0036',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'TEATRO BENJAMIN CARRION MORA DE LOJA',
                ),
            23 =>
                array(
                    'code' => '150-0037',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMPLEJO FABRICA IMBABURA',
                ),
            24 =>
                array(
                    'code' => '150-0038',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUSEO NACIONAL DEL ECUADOR MUNA',
                ),
            25 =>
                array(
                    'code' => '150-0039',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUSEO ANTROPOLOGICO Y DE ARTE CONTEMPORANEO MAAC',
                ),
            26 =>
                array(
                    'code' => '150-0040',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUSEO Y PARQUE ARQUEOLOGICO PUMAPUNGO',
                ),
            27 =>
                array(
                    'code' => '150-0041',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUSEO Y CENTRO CULTURAL DE MANTA',
                ),
            28 =>
                array(
                    'code' => '150-0042',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BIBLIOTECA NACIONAL EUGENIO ESPEJO',
                ),
            29 =>
                array(
                    'code' => '150-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE CULTURA Y PATRIMONIO - PLANTA CENTRAL',
                ),
            30 =>
                array(
                    'code' => '155-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE MONTALVO',
                ),
            31 =>
                array(
                    'code' => '158-1000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1 - IFTH',
                ),
            32 =>
                array(
                    'code' => '158-2000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 2 - IFTH',
                ),
            33 =>
                array(
                    'code' => '158-3000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 3 - IFTH',
                ),
            34 =>
                array(
                    'code' => '158-4000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 - IFTH',
                ),
            35 =>
                array(
                    'code' => '158-5000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 5 - IFTH',
                ),
            36 =>
                array(
                    'code' => '158-6000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 - IFTH',
                ),
            37 =>
                array(
                    'code' => '158-7000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 7 - IFTH',
                ),
            38 =>
                array(
                    'code' => '158-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO DE FOMENTO AL TALENTO HUMANO - PLANTA CENTRAL',
                ),
            39 =>
                array(
                    'code' => '159-0048',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO TECNOLOGICO SUPERIOR HUAQUILLAS',
                ),
            40 =>
                array(
                    'code' => '159-0056',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO TECNOLOGICO SUPERIOR QUININDE',
                ),
            41 =>
                array(
                    'code' => '159-0058',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO TECNOLOGICO SUPERIOR PROVINCIA DE TUNGURAHUA',
                ),
            42 =>
                array(
                    'code' => '159-0059',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO TECNOLOGICO SUPERIOR VICENTE ROCAFUERTE',
                ),
            43 =>
                array(
                    'code' => '159-0132',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PROYECTO DE RECONVERSION DE LA EDUCACION TECNICA Y TECNOLOGICA SUPERIOR PUBLICA DEL ECUADOR',
                ),
            44 =>
                array(
                    'code' => '159-1000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1 - SENESCYT',
                ),
            45 =>
                array(
                    'code' => '159-4000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 - SENESCYT',
                ),
            46 =>
                array(
                    'code' => '159-5000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 5 - SENESCYT',
                ),
            47 =>
                array(
                    'code' => '159-6000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 - SENESCYT',
                ),
            48 =>
                array(
                    'code' => '159-8000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 8 - SENESCYT',
                ),
            49 =>
                array(
                    'code' => '159-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA DE EDUCACION SUPERIOR CIENCIA TECNOLOGIA E INNOVACION - PLANTA CENTRAL',
                ),
            50 =>
                array(
                    'code' => '214-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO NACIONAL DE EVALUACION EDUCATIVA',
                ),
            51 =>
                array(
                    'code' => '217-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1 - ARCSA',
                ),
            52 =>
                array(
                    'code' => '217-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 2 - ARCSA',
                ),
            53 =>
                array(
                    'code' => '217-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 3 - ARCSA',
                ),
            54 =>
                array(
                    'code' => '217-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 - ARCSA',
                ),
            55 =>
                array(
                    'code' => '217-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 5 - ARCSA',
                ),
            56 =>
                array(
                    'code' => '217-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 - ARCSA',
                ),
            57 =>
                array(
                    'code' => '217-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 7 - ARCSA',
                ),
            58 =>
                array(
                    'code' => '217-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 8 - ARCSA',
                ),
            59 =>
                array(
                    'code' => '217-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 9 - ARCSA',
                ),
            60 =>
                array(
                    'code' => '217-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA NACIONAL DE REGULACION CONTROL Y VIGILANCIA SANITARIA ARCSA-PLANTA CENTRAL',
                ),
            61 =>
                array(
                    'code' => '218-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE PRODUCCION COMERCIO EXTERIOR INVERSIONES Y PESCA PLANTA CENTRAL',
                ),
            62 =>
                array(
                    'code' => '219-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA TECNICA DE PREVENCION INTEGRAL DE DROGAS - PLANTA CENTRAL',
                ),
            63 =>
                array(
                    'code' => '220-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO DE REGULACION DESARROLLO Y PROMOCION DE LA INFORMACION Y COMUNICACION',
                ),
            64 =>
                array(
                    'code' => '222-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO PUBLICO PARA PAGO DE ACCIDENTES DE TRANSITO - PLANTA CENTRAL',
                ),
            65 =>
                array(
                    'code' => '224-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA TECNICA DEL COMITE DE COORDINACION DE LA FUNCION DE TRANSPARENCIA Y CONTROL SOCIAL',
                ),
            66 =>
                array(
                    'code' => '226-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL PARA LA  IGUALDAD DE PUEBLOS Y NACIONALIDADES',
                ),
            67 =>
                array(
                    'code' => '227-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL PARA LA  IGUALDAD DE MOVILIDAD HUMANA',
                ),
            68 =>
                array(
                    'code' => '229-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO NACIONAL DE MEDICINA LEGAL Y CIENCIAS FORENSES - PLANTA CENTRAL',
                ),
            69 =>
                array(
                    'code' => '236-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO DE CINE Y CREACION AUDIOVISUAL',
                ),
            70 =>
                array(
                    'code' => '237-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO DE ASEGURAMIENTO DE LA CALIDAD DE LA EDUCACION SUPERIOR',
                ),
            71 =>
                array(
                    'code' => '250-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DEL AZUAY',
                ),
            72 =>
                array(
                    'code' => '250-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE BOLIVAR',
                ),
            73 =>
                array(
                    'code' => '250-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE CANAR',
                ),
            74 =>
                array(
                    'code' => '250-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE CARCHI',
                ),
            75 =>
                array(
                    'code' => '250-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE COTOPAXI',
                ),
            76 =>
                array(
                    'code' => '250-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE CHIMBORAZO',
                ),
            77 =>
                array(
                    'code' => '250-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE EL ORO',
                ),
            78 =>
                array(
                    'code' => '250-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE ESMERALDAS',
                ),
            79 =>
                array(
                    'code' => '250-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE GUAYAS',
                ),
            80 =>
                array(
                    'code' => '250-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE IMBABURA',
                ),
            81 =>
                array(
                    'code' => '250-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE LOJA',
                ),
            82 =>
                array(
                    'code' => '250-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE LOS RIOS',
                ),
            83 =>
                array(
                    'code' => '250-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE MANABI',
                ),
            84 =>
                array(
                    'code' => '250-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE MORONA SANTIAGO',
                ),
            85 =>
                array(
                    'code' => '250-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE NAPO',
                ),
            86 =>
                array(
                    'code' => '250-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE PASTAZA',
                ),
            87 =>
                array(
                    'code' => '250-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO PROVINCIAL DE PICHINCHA',
                ),
            88 =>
                array(
                    'code' => '250-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE TUNGURAHUA',
                ),
            89 =>
                array(
                    'code' => '250-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE ZAMORA',
                ),
            90 =>
                array(
                    'code' => '250-0020',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE GALAPAGOS',
                ),
            91 =>
                array(
                    'code' => '250-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE SUCUMBIOS',
                ),
            92 =>
                array(
                    'code' => '250-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO DE ORELLANA',
                ),
            93 =>
                array(
                    'code' => '250-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO PROVINCIAL DE SANTO DOMINGO DE LOS TSACHILAS',
                ),
            94 =>
                array(
                    'code' => '250-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA NUCLEO PROVINCIAL DE SANTA ELENA',
                ),
            95 =>
                array(
                    'code' => '250-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CASA DE LA CULTURA ECUATORIANA BENJAMIN CARRION - PLANTA CENTRAL',
                ),
            96 =>
                array(
                    'code' => '254-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA TECNICA DE LA CIRCUNSCRIPCION TERRITORIAL ESPECIAL AMAZONICA',
                ),
            97 =>
                array(
                    'code' => '255-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA DEL SISTEMA DE EDUCACION INTERCULTURAL BILINGUE',
                ),
            98 =>
                array(
                    'code' => '260-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE INTELIGENCIA ESTRATEGICA',
                ),
            99 =>
                array(
                    'code' => '266-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL - 1 SERVICIO INTEGRADO DE SEGURIDAD ECU 911',
                ),
            100 =>
                array(
                    'code' => '266-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL - 3 SERVICIO INTEGRADO DE SEGURIDAD ECU 911',
                ),
            101 =>
                array(
                    'code' => '266-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL - 4 SERVICIO INTEGRADO DE SEGURIDAD ECU 911',
                ),
            102 =>
                array(
                    'code' => '266-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL - 5 y 8 SERVICIO INTEGRADO DE SEGURIDAD ECU 911',
                ),
            103 =>
                array(
                    'code' => '266-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL - 6 SERVICIO INTEGRADO DE SEGURIDAD ECU 911',
                ),
            104 =>
                array(
                    'code' => '266-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL - 7 SERVICIO INTEGRADO DE SEGURIDAD ECU 911',
                ),
            105 =>
                array(
                    'code' => '266-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO INTEGRADO DE SEGURIDAD ECU 911 - PLANTA CENTRAL',
                ),
            106 =>
                array(
                    'code' => '267-6000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 - INSPI',
                ),
            107 =>
                array(
                    'code' => '267-9000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 9 - INSPI',
                ),
            108 =>
                array(
                    'code' => '267-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO NACIONAL DE INVESTIGACION EN SALUD PUBLICA INSPI DR LEOPOLDO IZQUIETA PEREZ- PLANTA CENTRAL',
                ),
            109 =>
                array(
                    'code' => '269-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA NACIONAL DE GESTION DE LA POLITICA PLANTA CENTRAL',
                ),
            110 =>
                array(
                    'code' => '271-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO OCEANOGRAFICO',
                ),
            111 =>
                array(
                    'code' => '274-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO NACIONAL DE ECONOMIA POPULAR Y SOLIDARIA - IEPS PLANTA CENTRAL',
                ),
            112 =>
                array(
                    'code' => '280-0031',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MIES - DIRECCION DE TRANSFERENCIA ',
                ),
            113 =>
                array(
                    'code' => '280-1000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1 - MIES',
                ),
            114 =>
                array(
                    'code' => '280-1110',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL O4D01-SAN PEDRO DE HUACA-TULCAN-MIES',
                ),
            115 =>
                array(
                    'code' => '280-1210',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D01-ESMERALDAS-MIES',
                ),
            116 =>
                array(
                    'code' => '280-1330',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D05-SAN LORENZO-MIES',
                ),
            117 =>
                array(
                    'code' => '280-1410',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-10D01-IBARRA-PIMAMPIRO-SAN MIGUEL DE URCUQUI-MIES',
                ),
            118 =>
                array(
                    'code' => '280-1520',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-21D02-LAGO AGRIO-MIES',
                ),
            119 =>
                array(
                    'code' => '280-2000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 2 - MIES',
                ),
            120 =>
                array(
                    'code' => '280-2110',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-15D01-ARCHIDONA-CARLOS JULIO AROSEMENA TOLA-TENA-MIES',
                ),
            121 =>
                array(
                    'code' => '280-2230',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-17D11-MEJIA-RUMINAHUI-MIES',
                ),
            122 =>
                array(
                    'code' => '280-2320',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL--22D02-LORETO-ORELLANA-MIES',
                ),
            123 =>
                array(
                    'code' => '280-3000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 3 - MIES',
                ),
            124 =>
                array(
                    'code' => '280-3110',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-05D01-LATACUNGA-MIES',
                ),
            125 =>
                array(
                    'code' => '280-3310',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-06D01-CHAMBO-RIOBAMBA-MIES',
                ),
            126 =>
                array(
                    'code' => '280-3410',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-16D01-PASTAZA-MERA-SANTA CLARA-MIES',
                ),
            127 =>
                array(
                    'code' => '280-3510',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-18D01-PARROQUIAS URBANAS (LAPENINSULA a SAN FRANCISCO) Y PARROQUIAS RURALES (AUGUSTO N. MARTINEZ a ATAHUALPA)-MIES',
                ),
            128 =>
                array(
                    'code' => '280-4000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 - MIES',
                ),
            129 =>
                array(
                    'code' => '280-4110',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-13D01-PORTOVIEJO-MIES',
                ),
            130 =>
                array(
                    'code' => '280-4130',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D02-JARAMIJO-MANTA-MONTECRISTI-MIES',
                ),
            131 =>
                array(
                    'code' => '280-4250',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-13D07-CHONE-FLAVIO ALFARO-MIES',
                ),
            132 =>
                array(
                    'code' => '280-4330',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-13D10-JAMA-PEDERNALES-MIES',
                ),
            133 =>
                array(
                    'code' => '280-4410',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-23D01-PARROQUIAS URBANAS(RIO VERDE a CHIGUILPE) Y PARROQUIAS RURALES (ALLURIQUIN a PERIFERIA)-MIES',
                ),
            134 =>
                array(
                    'code' => '280-5000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 5 - MIES',
                ),
            135 =>
                array(
                    'code' => '280-5110',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-02D01-GUARANDA-MIES',
                ),
            136 =>
                array(
                    'code' => '280-5270',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-09D15-EMPALME-MIES',
                ),
            137 =>
                array(
                    'code' => '280-5310',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-09D17-MILAGRO-MIES',
                ),
            138 =>
                array(
                    'code' => '280-5360',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-09D20-SALITRE-MIES',
                ),
            139 =>
                array(
                    'code' => '280-5410',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-12D01-BABA-BABAHOYO-MONTALVO-MIES',
                ),
            140 =>
                array(
                    'code' => '280-5450',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-12D03-MOCACHE-QUEVEDO-MIES',
                ),
            141 =>
                array(
                    'code' => '280-5610',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-20D01-SAN CRISTOBAL-SANTA CRUZ-ISABELA-MIES',
                ),
            142 =>
                array(
                    'code' => '280-5730',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-24D02-LA LIBERTAD-SALINAS-MIES',
                ),
            143 =>
                array(
                    'code' => '280-6000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 - MIES',
                ),
            144 =>
                array(
                    'code' => '280-6110',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-01D01-PARROQUIAS URBANAS(MACHANGARA a BELLAVISTA) Y PARROQUIAS RURALES (NULTI a SAYAUSI)-MIES',
                ),
            145 =>
                array(
                    'code' => '280-6210',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-01D04-CHORDELEG-GUALACEO-MIES',
                ),
            146 =>
                array(
                    'code' => '280-6310',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-03D01-AZOGUES-BILIAN-DELEG-MIES',
                ),
            147 =>
                array(
                    'code' => '280-6410',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-14D01-MORONA-MIES',
                ),
            148 =>
                array(
                    'code' => '280-7000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 7 - MIES',
                ),
            149 =>
                array(
                    'code' => '280-7130',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-07D02-MACHALA-MIES',
                ),
            150 =>
                array(
                    'code' => '280-7210',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-07D04-BALSAS-MARCABELI-PINAS-MIES',
                ),
            151 =>
                array(
                    'code' => '280-7310',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-11D01-LOJA-MIES',
                ),
            152 =>
                array(
                    'code' => '280-7420',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-11D06-CALVAS-GONZANAMA-QUILANGA-MIES',
                ),
            153 =>
                array(
                    'code' => '280-7510',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-19D01-YACUAMBI--ZAMORA-MIES',
                ),
            154 =>
                array(
                    'code' => '280-8000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 8 - MIES',
                ),
            155 =>
                array(
                    'code' => '280-8130',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-09D03-GARCIA MORENO a ROCA-MIES',
                ),
            156 =>
                array(
                    'code' => '280-8240',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-09D09-TARQUI-MIES',
                ),
            157 =>
                array(
                    'code' => '280-8270',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-09D24-DURAN-MIES',
                ),
            158 =>
                array(
                    'code' => '280-9000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 9 - MIES',
                ),
            159 =>
                array(
                    'code' => '280-9120',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-17D02-PARROQUIAS RURALES (CALDERON a GUAYLLABAMBA)-MIES',
                ),
            160 =>
                array(
                    'code' => '280-9180',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-17D05-PARROQUIAS URBANAS(LA CONCEPCION a JIPIJAPA) Y PARROQUIAL RURALES (NAYON a ZAMBIZA)-MIES',
                ),
            161 =>
                array(
                    'code' => '280-9240',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL-17D08-PARROQUIAS RURALES (CONOCOTO a LA MERCED)-MIES',
                ),
            162 =>
                array(
                    'code' => '280-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE INCLUSION ECONOMICA Y SOCIAL - PLANTA CENTRAL',
                ),
            163 =>
                array(
                    'code' => '283-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL PARA LA IGUALDAD DE DISCAPACIDADES',
                ),
            164 =>
                array(
                    'code' => '289-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL PARA LA IGUALDAD INTERGENERACIONAL',
                ),
            165 =>
                array(
                    'code' => '298-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL  DE CAPACITACION Y  FORMACION  PROFESIONAL -CNCF',
                ),
            166 =>
                array(
                    'code' => '302-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO NACIONAL DE BIODIVERSIDAD',
                ),
            167 =>
                array(
                    'code' => '303-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ORQUESTA SINFONICA DE CUENCA',
                ),
            168 =>
                array(
                    'code' => '303-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ORQUESTA SINFONICA DE GUAYAQUIL',
                ),
            169 =>
                array(
                    'code' => '303-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ORQUESTA SINFONICA DE LOJA',
                ),
            170 =>
                array(
                    'code' => '303-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ORQUESTA SINFONICA NACIONAL',
                ),
            171 =>
                array(
                    'code' => '303-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMPANIA NACIONAL DE DANZA',
                ),
            172 =>
                array(
                    'code' => '303-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO DE FOMENTO DE LAS ARTES INNOVACION Y CREATIVIDADES - PLANTA CENTRAL',
                ),
            173 =>
                array(
                    'code' => '311-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO SUPERIOR TECNOLOGICO SECAP - AMBATO',
                ),
            174 =>
                array(
                    'code' => '311-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO ECUATORIANO DE CAPACITACION PROFESIONAL -SECAP-PLANTA CENTRAL',
                ),
            175 =>
                array(
                    'code' => '312-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO DE EDUCACION SUPERIOR',
                ),
            176 =>
                array(
                    'code' => '315-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DEL TRABAJO REGIONAL 2 LITORAL Y GALAPAGOS',
                ),
            177 =>
                array(
                    'code' => '315-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DEL TRABAJO REGIONAL 3 CENTRO DE LA SIERRA Y AMAZONIA',
                ),
            178 =>
                array(
                    'code' => '315-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DEL TRABAJO DIRECCION REGIONAL DE TRABAJO Y SERVICIO PUBLICO DE CUENCA REGIONAL 6',
                ),
            179 =>
                array(
                    'code' => '315-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION REGIONAL DE TRABAJO 1 DE IBARRA',
                ),
            180 =>
                array(
                    'code' => '315-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION REGIONAL DEL MINISTERIO DEL TRABAJO No 7 LOJA EL ORO Y ZAMORA',
                ),
            181 =>
                array(
                    'code' => '315-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION REGIONAL DE TRABAJO Y SERVICIO PUBLICO - DIRECCION REGIONAL MANTA',
                ),
            182 =>
                array(
                    'code' => '315-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DEL TRABAJO - PLANTA CENTRAL',
                ),
            183 =>
                array(
                    'code' => '319-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA NACIONAL DE DEFENSA DEL ARTESANO',
                ),
            184 =>
                array(
                    'code' => '320-0051',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1 - SALUD',
                ),
            185 =>
                array(
                    'code' => '320-0052',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 2 - SALUD',
                ),
            186 =>
                array(
                    'code' => '320-0053',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 3 - SALUD',
                ),
            187 =>
                array(
                    'code' => '320-0054',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 - SALUD',
                ),
            188 =>
                array(
                    'code' => '320-0055',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 5 - SALUD',
                ),
            189 =>
                array(
                    'code' => '320-0056',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 - SALUD',
                ),
            190 =>
                array(
                    'code' => '320-0057',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 7 - SALUD',
                ),
            191 =>
                array(
                    'code' => '320-0058',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 8 - SALUD',
                ),
            192 =>
                array(
                    'code' => '320-0059',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 9 - SALUD',
                ),
            193 =>
                array(
                    'code' => '320-0128',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO MEDICO  ASDRUBAL DE LA TORRE',
                ),
            194 =>
                array(
                    'code' => '320-1000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL GENERAL DOCENTE VICENTE CORRAL MOSCOSO',
                ),
            195 =>
                array(
                    'code' => '320-1001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DERMATOLOGICO MARIANO ESTRELLA',
                ),
            196 =>
                array(
                    'code' => '320-1003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D01 - PARROQUIAS URBANAS (MACHANGARA A BELLAVISTA) Y PARROQUIAS RURALES (NULTI A SAYAUSI) - SALUD',
                ),
            197 =>
                array(
                    'code' => '320-1005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D02 - PARROQUIAS URBANAS (SAN SEBASTIAN A MONAY) Y PARROQUIAS RURALES (BANOS A SANTA ANA) - SALUD',
                ),
            198 =>
                array(
                    'code' => '320-1009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D04 - CHORDELEG-GUALACEO - SALUD',
                ),
            199 =>
                array(
                    'code' => '320-1010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D06 - EL PAN A SEVILLA DE ORO - SALUD',
                ),
            200 =>
                array(
                    'code' => '320-1011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D03 - GIRON A SANTA ISABEL - SALUD',
                ),
            201 =>
                array(
                    'code' => '320-1012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D08 - SIGSIG - SALUD',
                ),
            202 =>
                array(
                    'code' => '320-1014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D05 - NABON-ONA - SALUD',
                ),
            203 =>
                array(
                    'code' => '320-1015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D07 - CAMILO PONCE ENRIQUEZ - SALUD',
                ),
            204 =>
                array(
                    'code' => '320-1020',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL CANTONAL DE GIRON  AIDA LEON DE RODRIGUEZ LARA',
                ),
            205 =>
                array(
                    'code' => '320-1030',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL DOCENTE ALFREDO NOBOA MONTENEGRO',
                ),
            206 =>
                array(
                    'code' => '320-1031',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 02D01 - GUARANDA-SALUD',
                ),
            207 =>
                array(
                    'code' => '320-1032',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 02D03 - CHIMBO-SAN MIGUEL - SALUD',
                ),
            208 =>
                array(
                    'code' => '320-1033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 02D02 - CHILLANES - SALUD',
                ),
            209 =>
                array(
                    'code' => '320-1034',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 02D04 - CALUMA-ECHEANDIA-LAS NAVES- SALUD',
                ),
            210 =>
                array(
                    'code' => '320-1050',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL GENERAL HOMERO CASTANIER',
                ),
            211 =>
                array(
                    'code' => '320-1051',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 03D01 - AZOGUEZ-BIBLIAN-DELEG - SALUD',
                ),
            212 =>
                array(
                    'code' => '320-1054',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL LUIS F. MARTINEZ',
                ),
            213 =>
                array(
                    'code' => '320-1055',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 03D03 - LA TRONCAL- SALUD',
                ),
            214 =>
                array(
                    'code' => '320-1070',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL GENERAL LUIS G. DAVILA',
                ),
            215 =>
                array(
                    'code' => '320-1071',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 04D01 - SAN PEDRO DE HUACA TULCAN - SALUD',
                ),
            216 =>
                array(
                    'code' => '320-1072',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 04D02 - MONTUFAR-BOLIVAR - SALUD',
                ),
            217 =>
                array(
                    'code' => '320-1073',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 04D03 - ESPEJO-MIRA - SALUD',
                ),
            218 =>
                array(
                    'code' => '320-1090',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL GENERAL DE LATACUNGA',
                ),
            219 =>
                array(
                    'code' => '320-1091',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 05D01 - LATACUNGA - SALUD',
                ),
            220 =>
                array(
                    'code' => '320-1092',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 05D04 - PUJILI-SAQUISILI - SALUD',
                ),
            221 =>
                array(
                    'code' => '320-1093',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 05D06 - SALCEDO - SALUD',
                ),
            222 =>
                array(
                    'code' => '320-1095',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 05D02 - LA MANA - SALUD',
                ),
            223 =>
                array(
                    'code' => '320-1096',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 05D03 - PANGUA - SALUD',
                ),
            224 =>
                array(
                    'code' => '320-1098',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 05D05 - SIGCHOS - SALUD',
                ),
            225 =>
                array(
                    'code' => '320-1110',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL GENERAL DOCENTE DE RIOBAMBA',
                ),
            226 =>
                array(
                    'code' => '320-1111',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PEDIATRICO  ALFONSO VILLAGOMEZ',
                ),
            227 =>
                array(
                    'code' => '320-1112',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GERIATRICO DOCTOR BOLIVAR ARGUELLO P',
                ),
            228 =>
                array(
                    'code' => '320-1113',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 06D01 - CHAMBO-RIOBAMBA - SALUD',
                ),
            229 =>
                array(
                    'code' => '320-1115',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 06D04 - COLTA-GUAMOTE - SALUD',
                ),
            230 =>
                array(
                    'code' => '320-1116',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE  ALAUSI',
                ),
            231 =>
                array(
                    'code' => '320-1118',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 06D05 - GUANO-PENIPE - SALUD',
                ),
            232 =>
                array(
                    'code' => '320-1130',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL GENERAL TEOFILO DAVILA',
                ),
            233 =>
                array(
                    'code' => '320-1131',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL  OBSTETRICO ANGELA LOAYZA DE OLLAGE',
                ),
            234 =>
                array(
                    'code' => '320-1132',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 07D02 - MACHALA - SALUD',
                ),
            235 =>
                array(
                    'code' => '320-1134',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL MARIA LORENA SERRANO',
                ),
            236 =>
                array(
                    'code' => '320-1135',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL SAN VICENTE PAUL',
                ),
            237 =>
                array(
                    'code' => '320-1136',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 07D06 - SANTA ROSA - SALUD',
                ),
            238 =>
                array(
                    'code' => '320-1138',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 07D05 - ARENILLAS-HUAQUILLAS-LAS LAJAS - SALUD',
                ),
            239 =>
                array(
                    'code' => '320-1139',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 07D04 - BALSAS-MARCABELI-PINAS - SALUD',
                ),
            240 =>
                array(
                    'code' => '320-1140',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 07D03 - ATAHUALPA-PORTOVELO-ZARUMA - SALUD',
                ),
            241 =>
                array(
                    'code' => '320-1160',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL GENERAL DELFINA TORRES DE CONCHA',
                ),
            242 =>
                array(
                    'code' => '320-1162',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D01 - ESMERALDAS - SALUD',
                ),
            243 =>
                array(
                    'code' => '320-1164',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D06 - RIO VERDE - SALUD',
                ),
            244 =>
                array(
                    'code' => '320-1165',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D03 - MUISNE ATACAMES - SALUD',
                ),
            245 =>
                array(
                    'code' => '320-1166',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D04 - QUININDE - SALUD',
                ),
            246 =>
                array(
                    'code' => '320-1167',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D05 - SAN LORENZO - SALUD',
                ),
            247 =>
                array(
                    'code' => '320-1168',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D02 - ELOY ALFARO - SALUD',
                ),
            248 =>
                array(
                    'code' => '320-1190',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL  PEDIATRICO FRANCISCO ICAZA BUSTAMANTE',
                ),
            249 =>
                array(
                    'code' => '320-1191',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL NEUMOLOGICO ALFREDO J. VALENZUELA',
                ),
            250 =>
                array(
                    'code' => '320-1192',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE ESPECIALIDADES GENERAL ABEL GILBERT PONTON',
                ),
            251 =>
                array(
                    'code' => '320-1193',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE INFECTOLOGIA JOSE D RODRIGUEZ MARIDUENA',
                ),
            252 =>
                array(
                    'code' => '320-1194',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL MATILDE HIDALGO DE PROCEL',
                ),
            253 =>
                array(
                    'code' => '320-1195',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL GUASMO SUR',
                ),
            254 =>
                array(
                    'code' => '320-1197',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D02 - XIMENA 2 - SALUD',
                ),
            255 =>
                array(
                    'code' => '320-1198',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D01 - XIMENA 1-PARROQUIA RURAL PUNA-ESTUARIO DEL RIO GUAYAS - SALUD',
                ),
            256 =>
                array(
                    'code' => '320-1202',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL MARIANA DE JESUS',
                ),
            257 =>
                array(
                    'code' => '320-1204',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D04 - FEBRES CORDERO - SALUD',
                ),
            258 =>
                array(
                    'code' => '320-1206',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D03 - GARCIA MORENO A ROCA - SALUD',
                ),
            259 =>
                array(
                    'code' => '320-1208',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D05 - TARQUI 1-TENGUEL - SALUD',
                ),
            260 =>
                array(
                    'code' => '320-1210',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D06 - TARQUI 2 - SALUD',
                ),
            261 =>
                array(
                    'code' => '320-1213',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D07 - PASCUALES 1 - SALUD',
                ),
            262 =>
                array(
                    'code' => '320-1217',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 24D02 - LA LIBERTAD-SALINAS - SALUD',
                ),
            263 =>
                array(
                    'code' => '320-1218',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D22 - PLAYAS - SALUD',
                ),
            264 =>
                array(
                    'code' => '320-1219',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D15 - EL EMPALME - SALUD',
                ),
            265 =>
                array(
                    'code' => '320-1220',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D13 - BALZAR-COLIMES-PALESTINA - SALUD',
                ),
            266 =>
                array(
                    'code' => '320-1222',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D19 - DAULE-NOBOL-SANTA LUCIA - SALUD',
                ),
            267 =>
                array(
                    'code' => '320-1223',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D14 - ISIDRO AYORA-LOMAS DE SARGENTILLO-PEDRO CARBO - SALUD',
                ),
            268 =>
                array(
                    'code' => '320-1224',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D20 - SALITRE - SALUD',
                ),
            269 =>
                array(
                    'code' => '320-1225',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D21 - SAN JACINTO DE YAGUACHI - SALUD',
                ),
            270 =>
                array(
                    'code' => '320-1226',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL LEON BECERRA DE MILAGRO',
                ),
            271 =>
                array(
                    'code' => '320-1227',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D18 - CRNEL MARCELINO MARIDUENA-NARANJITO - SALUD',
                ),
            272 =>
                array(
                    'code' => '320-1228',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D12 - BALAO-NARANJAL - SALUD',
                ),
            273 =>
                array(
                    'code' => '320-1230',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D16 - EL TRIUNFO-GNRAL ANTONIO ELIZALDE - SALUD',
                ),
            274 =>
                array(
                    'code' => '320-1231',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D23 - SAMBORONDON - SALUD',
                ),
            275 =>
                array(
                    'code' => '320-1232',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D24 - DURAN - SALUD',
                ),
            276 =>
                array(
                    'code' => '320-1234',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D11-ALFREDO BAQUERIZO MORENO-SIMON BOLIVAR - SALUD',
                ),
            277 =>
                array(
                    'code' => '320-1235',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 24D01 - SANTA ELENA - SALUD',
                ),
            278 =>
                array(
                    'code' => '320-1236',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL DR. LIBORIO PANCHANA SOTOMAYOR',
                ),
            279 =>
                array(
                    'code' => '320-1250',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL GENERAL SAN VICENTE DE PAUL',
                ),
            280 =>
                array(
                    'code' => '320-1253',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 10D01 - IBARRA-PIMAMPIRO-SAN MIGUEL DE URCUQUI - SALUD',
                ),
            281 =>
                array(
                    'code' => '320-1255',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 10D03 - COTACACHI - SALUD',
                ),
            282 =>
                array(
                    'code' => '320-1256',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL SAN LUIS DE OTAVALO',
                ),
            283 =>
                array(
                    'code' => '320-1257',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 10D02 - ANTONIO ANTE-OTAVALO - SALUD',
                ),
            284 =>
                array(
                    'code' => '320-1270',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL GENERAL ISIDRO AYORA',
                ),
            285 =>
                array(
                    'code' => '320-1271',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D01 - LOJA - SALUD',
                ),
            286 =>
                array(
                    'code' => '320-1274',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D02 - CATAMAYO-CHAGUARPAMBA-OLMEDO - SALUD',
                ),
            287 =>
                array(
                    'code' => '320-1275',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D06 - CALVAS-GONZANAMA-QUILANGA - SALUD',
                ),
            288 =>
                array(
                    'code' => '320-1276',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D05 - ESPINDOLA - SALUD',
                ),
            289 =>
                array(
                    'code' => '320-1277',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D07 - MACARA-SOZORANGA - SALUD',
                ),
            290 =>
                array(
                    'code' => '320-1278',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D03 - PALTAS - SALUD',
                ),
            291 =>
                array(
                    'code' => '320-1279',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D04 - CELICA-PINDAL-PUYANGO - SALUD',
                ),
            292 =>
                array(
                    'code' => '320-1280',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D08 - SARAGURO - SALUD',
                ),
            293 =>
                array(
                    'code' => '320-1283',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D09 - ZAPOTILLO - SALUD',
                ),
            294 =>
                array(
                    'code' => '320-1300',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL GENERAL MARTIN ICAZA',
                ),
            295 =>
                array(
                    'code' => '320-1301',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 12D01 - BABA-BABAHOYO-MONTALVO - SALUD',
                ),
            296 =>
                array(
                    'code' => '320-1302',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL SAGRADO CORAZON DE JESUS',
                ),
            297 =>
                array(
                    'code' => '320-1303',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL NICOLAS COTTO INFANTE',
                ),
            298 =>
                array(
                    'code' => '320-1304',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 12D02 - PUEBLO VIEJO-URDANETA - SALUD',
                ),
            299 =>
                array(
                    'code' => '320-1306',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 12D04 - QUINSALOMA-VENTANAS - SALUD',
                ),
            300 =>
                array(
                    'code' => '320-1330',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL DE PORTOVIEJO',
                ),
            301 =>
                array(
                    'code' => '320-1331',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL RODRIGUEZ ZAMBRANO DE MANTA',
                ),
            302 =>
                array(
                    'code' => '320-1332',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL GENERAL MIGUEL ALCIVAR DE BAHIA',
                ),
            303 =>
                array(
                    'code' => '320-1333',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL DE CHONE',
                ),
            304 =>
                array(
                    'code' => '320-1334',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL DE JIPIJAPA',
                ),
            305 =>
                array(
                    'code' => '320-1335',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D01 - PORTOVIEJO - SALUD',
                ),
            306 =>
                array(
                    'code' => '320-1336',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D02 - JARAMIJO-MANTA MONTECRISTI - SALUD',
                ),
            307 =>
                array(
                    'code' => '320-1337',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D07 - CHONE-FLAVIO ALFARO - SALUD',
                ),
            308 =>
                array(
                    'code' => '320-1338',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D03 - JIPIJAPA-PUERTO LOPEZ - SALUD',
                ),
            309 =>
                array(
                    'code' => '320-1339',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D11 - SAN VICENTE-SUCRE - SALUD',
                ),
            310 =>
                array(
                    'code' => '320-1340',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D06 - JUNIN-BOLIVAR - SALUD',
                ),
            311 =>
                array(
                    'code' => '320-1341',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D12 - ROCAFUERTE-TOSAGUA - SALUD',
                ),
            312 =>
                array(
                    'code' => '320-1342',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D05 - EL CARMEN - SALUD',
                ),
            313 =>
                array(
                    'code' => '320-1343',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D09 - PAJAN - SALUD',
                ),
            314 =>
                array(
                    'code' => '320-1344',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D04 - 24 DE MAYO-SANTA ANA-OLMEDO - SALUD',
                ),
            315 =>
                array(
                    'code' => '320-1345',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D08 - PICHINCHA - SALUD',
                ),
            316 =>
                array(
                    'code' => '320-1346',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D10 - JAMA-PEDERNALES - SALUD',
                ),
            317 =>
                array(
                    'code' => '320-1347',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL SAN ANDRES',
                ),
            318 =>
                array(
                    'code' => '320-1348',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL BASICO DEL CANTON PICHINCHA',
                ),
            319 =>
                array(
                    'code' => '320-1360',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL DE MACAS',
                ),
            320 =>
                array(
                    'code' => '320-1361',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 14D04 - GUALAQUIZA-SAN JUAN BOSCO - SALUD',
                ),
            321 =>
                array(
                    'code' => '320-1363',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 14D02 - HUAMBOYA-PABLO SEXTO-PALORA - SALUD',
                ),
            322 =>
                array(
                    'code' => '320-1364',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 14D06 - LIMON INDANZA-SANTIAGO TIWINZA - SALUD',
                ),
            323 =>
                array(
                    'code' => '320-1365',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 14D03 - LOGRONO-SUCUA - SALUD',
                ),
            324 =>
                array(
                    'code' => '320-1366',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 14D05 - TAISHA - SALUD',
                ),
            325 =>
                array(
                    'code' => '320-1367',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 14D01 - MORONA - SALUD',
                ),
            326 =>
                array(
                    'code' => '320-1380',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL  JOSE MARIA VELASCO IBARRA DE TENA',
                ),
            327 =>
                array(
                    'code' => '320-1381',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 15D01 - ARCHIDONA-CARLOS JULIO AROSEMENA TOLA -TENA - SALUD',
                ),
            328 =>
                array(
                    'code' => '320-1382',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL  15D02 - EL CHACO-QUIJOS - SALUD',
                ),
            329 =>
                array(
                    'code' => '320-1400',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL PUYO',
                ),
            330 =>
                array(
                    'code' => '320-1401',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 16D01 - PASTAZA-MERA SANTA CLARA - SALUD',
                ),
            331 =>
                array(
                    'code' => '320-1420',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE ESPECIALIDADES EUGENIO ESPEJO',
                ),
            332 =>
                array(
                    'code' => '320-1421',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PEDIATRICO BACA ORTIZ',
                ),
            333 =>
                array(
                    'code' => '320-1423',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PSIQUIATRICO JULIO ENDARA',
                ),
            334 =>
                array(
                    'code' => '320-1424',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PSIQUIATRICO SAN LAZARO',
                ),
            335 =>
                array(
                    'code' => '320-1426',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL GENERAL PABLO ARTURO SUAREZ',
                ),
            336 =>
                array(
                    'code' => '320-1427',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL  PROVINCIAL GENERAL ENRIQUE GARCES',
                ),
            337 =>
                array(
                    'code' => '320-1428',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL  DR. GUSTAVO DOMINGUEZ  Z.',
                ),
            338 =>
                array(
                    'code' => '320-1429',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE ATENCION INTEGRAL DEL ADULTO MAYOR',
                ),
            339 =>
                array(
                    'code' => '320-1432',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D05 - LA CONCEPCION A ZAMBIZA - SALUD',
                ),
            340 =>
                array(
                    'code' => '320-1433',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D04 - PUENGASI A ITCHIMBIA - SALUD',
                ),
            341 =>
                array(
                    'code' => '320-1435',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D06 - CHILIBULO A LLOA - SALUD',
                ),
            342 =>
                array(
                    'code' => '320-1438',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D03 - EL CONDADO A CALACALI - SALUD',
                ),
            343 =>
                array(
                    'code' => '320-1441',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D12 - PEDRO VICENTE MALDONADO-PUERTO QUITO-SAN MIGUEL DE LOS BANCOS - SALUD',
                ),
            344 =>
                array(
                    'code' => '320-1442',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D10 - CAYAMBE-PEDRO MONCAYO - SALUD',
                ),
            345 =>
                array(
                    'code' => '320-1444',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D09 - TUMBACO A TABABELA - SALUD',
                ),
            346 =>
                array(
                    'code' => '320-1445',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D11 - MEJIA-RUMINAHUI - SALUD',
                ),
            347 =>
                array(
                    'code' => '320-1447',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 23D01 - PARROQUIAS URBANAS (RIO VERDE A CHIGUILPE) Y PARROQUIAS RURALES (ALLURIQUIN A PERIFERIA) - SALUD',
                ),
            348 =>
                array(
                    'code' => '320-1448',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D01 - NANEGAL A GUALEA - SALUD',
                ),
            349 =>
                array(
                    'code' => '320-1449',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D07 - PARROQUIAS URBANAS (CHILLOGALLO A LA ECUATORIANA) - SALUD',
                ),
            350 =>
                array(
                    'code' => '320-1452',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D02 - PARROQUIAS RURALES (CALDERON-LLANO CHICO-GUAYLLABAMBA) - SALUD',
                ),
            351 =>
                array(
                    'code' => '320-1453',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 23D02 - PARROQUIAS URBANAS (ABRAHAN CALAZACON-BOMBOLI) Y PARROQUIAS RURALES (SAN JACINTO DEL BUA  A PERIFERIA 2) - SALUD',
                ),
            352 =>
                array(
                    'code' => '320-1454',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 23D03 - LA CONCORDIA - SALUD',
                ),
            353 =>
                array(
                    'code' => '320-1455',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D08 - CONOCOTO A LA MERCED - SALUD',
                ),
            354 =>
                array(
                    'code' => '320-1460',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL GENERAL DOCENTE DE AMBATO',
                ),
            355 =>
                array(
                    'code' => '320-1461',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 18D01 - PARROQUIAS URBANAS (LA PENINSULA A SAN FRANCISCO) Y PARROQUIAS RURALES (AUGUSTO N MARTINEZ A ATAHUALPA) - SALUD',
                ),
            356 =>
                array(
                    'code' => '320-1463',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 18D02 - PARROQUIAS URBANAS (CELIANO MONGE A PISHILATA) Y PARROQUIAS RURALES (HUACHI GRANDE A TOTORAS) - SALUD',
                ),
            357 =>
                array(
                    'code' => '320-1464',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 18D03 - BANOS DE AGUA SANTA - SALUD',
                ),
            358 =>
                array(
                    'code' => '320-1465',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 18D04 - PATATE-SAN PEDRO DE PELILEO - SALUD',
                ),
            359 =>
                array(
                    'code' => '320-1466',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 18D05 - SANTIAGO DE PILLARO - SALUD',
                ),
            360 =>
                array(
                    'code' => '320-1467',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 18D06 - CEVALLOS A TISALEO - SALUD',
                ),
            361 =>
                array(
                    'code' => '320-1490',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL GENERAL JULUIS DOEPFNER',
                ),
            362 =>
                array(
                    'code' => '320-1491',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 19D04 - EL PANGUI-YANTZAZA - SALUD',
                ),
            363 =>
                array(
                    'code' => '320-1492',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 19D03 - CHINCHIPE-PALANDA - SALUD',
                ),
            364 =>
                array(
                    'code' => '320-1510',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 20D01 - SAN CRISTOBAL-SANTA CRUZ-ISABELA - SALUD',
                ),
            365 =>
                array(
                    'code' => '320-1511',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL  REPUBLICA DEL ECUADOR',
                ),
            366 =>
                array(
                    'code' => '320-1512',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL OSKAR JANDL',
                ),
            367 =>
                array(
                    'code' => '320-1530',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL PROVINCIAL DR. MARCO VINICIO IZA',
                ),
            368 =>
                array(
                    'code' => '320-1531',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL  21D04 - SHUSHUFINDI - SALUD',
                ),
            369 =>
                array(
                    'code' => '320-1532',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 21D02 - LAGO AGRIO - SALUD',
                ),
            370 =>
                array(
                    'code' => '320-1533',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 21D01 - CASCALES-GONZALO PIZARRO-SUCUMBIOS - SALUD',
                ),
            371 =>
                array(
                    'code' => '320-1534',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 21D03 - CUYABENO-PUTUMAYO - SALUD',
                ),
            372 =>
                array(
                    'code' => '320-1540',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL FRANCISCO DE ORELLANA',
                ),
            373 =>
                array(
                    'code' => '320-1541',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 22D01 - LA JOYA DE LOS SACHAS - SALUD',
                ),
            374 =>
                array(
                    'code' => '320-1601',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL MOVIL N 1',
                ),
            375 =>
                array(
                    'code' => '320-1602',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL MOVIL N 2',
                ),
            376 =>
                array(
                    'code' => '320-1605',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL SANTO DOMINGO',
                ),
            377 =>
                array(
                    'code' => '320-2320',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 22D02 - ORELLANA-LORETO (A) - SALUD',
                ),
            378 =>
                array(
                    'code' => '320-2340',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 22D03 - AGUARICO - SALUD',
                ),
            379 =>
                array(
                    'code' => '320-3340',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 06D02 - ALAUSI-CHUNCHI  - SALUD',
                ),
            380 =>
                array(
                    'code' => '320-3350',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 06D03 - CUMANDA-PALLATANGA  - SALUD',
                ),
            381 =>
                array(
                    'code' => '320-3430',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 16D02 - ARAJUNO - SALUD',
                ),
            382 =>
                array(
                    'code' => '320-5320',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D17 - MILAGRO - SALUD',
                ),
            383 =>
                array(
                    'code' => '320-5450',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 12D03 - QUEVEDO-MOCACHE  - SALUD',
                ),
            384 =>
                array(
                    'code' => '320-5520',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 12D05 - PALENQUE -VINCES  - SALUD',
                ),
            385 =>
                array(
                    'code' => '320-5540',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 12D06 - BUENA FE-VALENCIA  - SALUD',
                ),
            386 =>
                array(
                    'code' => '320-6330',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 03D02 - CANAR-EL TAMBO-SUSCAL - SALUD',
                ),
            387 =>
                array(
                    'code' => '320-7110',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 07D01 - CHILLA-EL GUABO-PASAJE - SALUD',
                ),
            388 =>
                array(
                    'code' => '320-7520',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 19D01 - YACUAMBI-ZAMORA - SALUD',
                ),
            389 =>
                array(
                    'code' => '320-7530',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 19D02 - CENTINELA DEL CONDOR-NANGARITZA-PAQUISHA - SALUD',
                ),
            390 =>
                array(
                    'code' => '320-8001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL UNIVERSITARIO DE GUAYAQUIL',
                ),
            391 =>
                array(
                    'code' => '320-8230',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D08 - PASCUALES 2 - SALUD',
                ),
            392 =>
                array(
                    'code' => '320-8240',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D09 - TARQUI 3 - SALUD',
                ),
            393 =>
                array(
                    'code' => '320-8250',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D10 - PROGRESO-EL MORRO-POSORJA - SALUD',
                ),
            394 =>
                array(
                    'code' => '320-9001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL DOCENTE DE CALDERON',
                ),
            395 =>
                array(
                    'code' => '320-9002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GINECO OBSTETRICO PEDIATRICO DE NUEVA AURORA LUZ ELENA ARISMENDI',
                ),
            396 =>
                array(
                    'code' => '320-9003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL BASICO DE YANTZAZA',
                ),
            397 =>
                array(
                    'code' => '320-9004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE ESPECIALIDADES PORTOVIEJO',
                ),
            398 =>
                array(
                    'code' => '320-9005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO ESPECIALIZADO EN GENETICA MEDICA',
                ),
            399 =>
                array(
                    'code' => '320-9006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL MONTE SINAI',
                ),
            400 =>
                array(
                    'code' => '320-9007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO ESPECIALIZADO EN REHABILITACION INTEGRAL N 1 CONOCOTO',
                ),
            401 =>
                array(
                    'code' => '320-9008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL DURAN',
                ),
            402 =>
                array(
                    'code' => '320-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE SALUD PUBLICA - PLANTA CENTRAL',
                ),
            403 =>
                array(
                    'code' => '323-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL DE SALUD  CONASA',
                ),
            404 =>
                array(
                    'code' => '326-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO NACIONAL DE DONACION Y TRANSPLANTES DE ORGANOS TEJIDOS Y CELULAS - INDOT - PLANTA CENTRAL',
                ),
            405 =>
                array(
                    'code' => '330-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION TECNICA OPERATIVA SAN CRISTOBAL',
                ),
            406 =>
                array(
                    'code' => '330-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION TECNICA OPERATIVA ISABELA',
                ),
            407 =>
                array(
                    'code' => '330-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PARQUE NACIONAL GALAPAGOS- PLANTA CENTRAL',
                ),
            408 =>
                array(
                    'code' => '334-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA DE REGULACION Y CONTROL FITO Y ZOOSANITARIO - PLANTA CENTRAL',
                ),
            409 =>
                array(
                    'code' => '360-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DEL AZUAY',
                ),
            410 =>
                array(
                    'code' => '360-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE BOLIVAR',
                ),
            411 =>
                array(
                    'code' => '360-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE CANAR',
                ),
            412 =>
                array(
                    'code' => '360-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE CARCHI',
                ),
            413 =>
                array(
                    'code' => '360-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE COTOPAXI',
                ),
            414 =>
                array(
                    'code' => '360-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE CHIMBORAZO',
                ),
            415 =>
                array(
                    'code' => '360-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE EL ORO',
                ),
            416 =>
                array(
                    'code' => '360-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE ESMERALDAS',
                ),
            417 =>
                array(
                    'code' => '360-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE GUAYAS',
                ),
            418 =>
                array(
                    'code' => '360-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE IMBABURA',
                ),
            419 =>
                array(
                    'code' => '360-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE LOJA',
                ),
            420 =>
                array(
                    'code' => '360-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE LOS RIOS',
                ),
            421 =>
                array(
                    'code' => '360-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE MANABI',
                ),
            422 =>
                array(
                    'code' => '360-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE MORONA SANTIAGO',
                ),
            423 =>
                array(
                    'code' => '360-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE NAPO',
                ),
            424 =>
                array(
                    'code' => '360-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE PASTAZA',
                ),
            425 =>
                array(
                    'code' => '360-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE PICHINCHA',
                ),
            426 =>
                array(
                    'code' => '360-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE TUNGURAHUA',
                ),
            427 =>
                array(
                    'code' => '360-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE ZAMORA CHINCHIPE',
                ),
            428 =>
                array(
                    'code' => '360-0020',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE GALAPAGOS',
                ),
            429 =>
                array(
                    'code' => '360-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE SUCUMBIOS',
                ),
            430 =>
                array(
                    'code' => '360-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE ORELLANA',
                ),
            431 =>
                array(
                    'code' => '360-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE SANTO DOMINGO DE LOS TSACHILAS',
                ),
            432 =>
                array(
                    'code' => '360-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION PROVINCIAL AGROPECUARIA DE SANTA ELENA',
                ),
            433 =>
                array(
                    'code' => '360-0025',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD DE GESTION DEL PROYECTO PIT UGP-PIT',
                ),
            434 =>
                array(
                    'code' => '360-0101',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 5',
                ),
            435 =>
                array(
                    'code' => '360-0102',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4',
                ),
            436 =>
                array(
                    'code' => '360-0103',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 3',
                ),
            437 =>
                array(
                    'code' => '360-0104',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6',
                ),
            438 =>
                array(
                    'code' => '360-0111',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EJECUTORA MAGAP - PRAT (PROGRAMA DE REGULARIZACION Y ADMINISTRACION DE TIERRAS RURALES)',
                ),
            439 =>
                array(
                    'code' => '360-0113',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD DE GESTION DEL PROGRAMA DEL BUEN VIVIR RURAL - UGP',
                ),
            440 =>
                array(
                    'code' => '360-0115',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1',
                ),
            441 =>
                array(
                    'code' => '360-0116',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 2',
                ),
            442 =>
                array(
                    'code' => '360-0117',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 7',
                ),
            443 =>
                array(
                    'code' => '360-0118',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'VICEMINISTERIO DE AGRICULTURA Y GANADERIA',
                ),
            444 =>
                array(
                    'code' => '360-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE AGRICULTURA Y GANADERIA - PLANTA CENTRAL',
                ),
            445 =>
                array(
                    'code' => '361-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUPERINTENDENCIA DE ORDENAMIENTO TERRITORIAL USO Y GESTION DEL SUELO - PLANTA CENTRAL',
                ),
            446 =>
                array(
                    'code' => '364-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONFERENCIA PLURINACIONAL E INTERCULTURAL DE SOBERANIA ALIMENTARIA',
                ),
            447 =>
                array(
                    'code' => '371-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO NACIONAL DE EFICIENCIA ENERGETICA Y ENERGIAS RENOVABLES',
                ),
            448 =>
                array(
                    'code' => '378-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MISION F.A.O. EN EL ECUADOR',
                ),
            449 =>
                array(
                    'code' => '390-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INIAP ESTACION EXPERIMENTAL PORTOVIEJO',
                ),
            450 =>
                array(
                    'code' => '390-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INIAP ESTACION EXPERIMENTAL SANTA CATALINA',
                ),
            451 =>
                array(
                    'code' => '390-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INIAP ESTACION EXPERIMENTAL SANTO DOMINGO',
                ),
            452 =>
                array(
                    'code' => '390-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INIAP ESTACION EXPERIMENTAL TROPICAL PICHILINGUE',
                ),
            453 =>
                array(
                    'code' => '390-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESTACION EXPERIMENTAL DEL AUSTRO',
                ),
            454 =>
                array(
                    'code' => '390-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESTACION EXPERIMENTAL DEL LITORAL SUR DR. ENRIQUE AMPUERO PAREJA',
                ),
            455 =>
                array(
                    'code' => '390-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INIAP ESTACION EXPERIMENTAL NAPO',
                ),
            456 =>
                array(
                    'code' => '390-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO NACIONAL DE INVESTIGACIONES AGROPECUARIAS  -  I.N.I.A.P. - PLANTA CENTRAL',
                ),
            457 =>
                array(
                    'code' => '416-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA DE REGULACION Y CONTROL HIDROCARBURIFERO ARCH',
                ),
            458 =>
                array(
                    'code' => '419-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE ENERGIA Y RECURSOS NATURALES NO RENOVABLES',
                ),
            459 =>
                array(
                    'code' => '422-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO NACIONAL DE METEOROLOGIA E HIDROLOGIA -INAMHI',
                ),
            460 =>
                array(
                    'code' => '426-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA DE REGULACION Y CONTROL MINERO',
                ),
            461 =>
                array(
                    'code' => '427-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO DE INVESTIGACION GEOLOGICO Y ENERGETICO',
                ),
            462 =>
                array(
                    'code' => '470-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 DEL MINISTERIO DE INDUSTRIAS Y PRODUCTIVIDAD',
                ),
            463 =>
                array(
                    'code' => '470-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 5 DEL MINISTERIO DE INDUSTRIAS Y PRODUCTIVIDAD',
                ),
            464 =>
                array(
                    'code' => '470-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1 DEL MINISTERIO DE INDUSTRIAS Y PRODUCTIVIDAD',
                ),
            465 =>
                array(
                    'code' => '470-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION REGIONAL CENTRO DEL MINISTERIO DE INDUSTRIAS Y PRODUCTIVIDAD',
                ),
            466 =>
                array(
                    'code' => '470-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION REGIONAL PACIFICO DEL MINISTERIO DE INDUSTRIAS Y PRODUCTIVIDAD',
                ),
            467 =>
                array(
                    'code' => '470-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION REGIONAL SUR DEL MINISTERIO DE INDUSTRIAS Y PRODUCTIVIDAD',
                ),
            468 =>
                array(
                    'code' => '470-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE  INDUSTRIAS Y PRODUCTIVIDAD - PLANTA CENTRAL',
                ),
            469 =>
                array(
                    'code' => '471-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA TECNICA DEL SISTEMA NACIONAL DE CUALIFICACIONES PROFESIONALES',
                ),
            470 =>
                array(
                    'code' => '472-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO ECUATORIANO DE NORMALIZACION',
                ),
            471 =>
                array(
                    'code' => '473-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO NACIONAL DE PESCA -INP',
                ),
            472 =>
                array(
                    'code' => '475-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO DE ACREDITACION ECUATORIANO',
                ),
            473 =>
                array(
                    'code' => '476-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO INTERAMERICANO DE ARTESANIAS Y ARTES POPULARES  CIDAP',
                ),
            474 =>
                array(
                    'code' => '510-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1 DEL MINISTERIO DE TURISMO',
                ),
            475 =>
                array(
                    'code' => '510-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 2 DEL MINISTERIO DE TURISMO',
                ),
            476 =>
                array(
                    'code' => '510-0025',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 3 DEL MINISTERIO DE TURISMO',
                ),
            477 =>
                array(
                    'code' => '510-0026',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 DEL MINISTERIO DE TURISMO',
                ),
            478 =>
                array(
                    'code' => '510-0027',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 5 DEL MINISTERIO DE TURISMO',
                ),
            479 =>
                array(
                    'code' => '510-0028',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 DEL MINISTERIO DE TURISMO',
                ),
            480 =>
                array(
                    'code' => '510-0029',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 7 DEL MINISTERIO DE TURISMO',
                ),
            481 =>
                array(
                    'code' => '510-0207',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GERENCIA REGIONAL GALAPAGOS',
                ),
            482 =>
                array(
                    'code' => '510-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE TURISMO - PLANTA CENTRAL',
                ),
            483 =>
                array(
                    'code' => '511-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DEL CANTON CUENCA',
                ),
            484 =>
                array(
                    'code' => '511-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DEL CANTON RIOBAMBA',
                ),
            485 =>
                array(
                    'code' => '511-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DE CANTON MACHALA',
                ),
            486 =>
                array(
                    'code' => '511-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DEL CANTON ESMERALDAS',
                ),
            487 =>
                array(
                    'code' => '511-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DEL CANTON GUAYAQUIL',
                ),
            488 =>
                array(
                    'code' => '511-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DEL CANTON IBARRA',
                ),
            489 =>
                array(
                    'code' => '511-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DEL CANTON LOJA',
                ),
            490 =>
                array(
                    'code' => '511-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DEL CANTON BABAHOYO',
                ),
            491 =>
                array(
                    'code' => '511-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DEL CANTON PORTOVIEJO',
                ),
            492 =>
                array(
                    'code' => '511-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DE CANTON QUITO',
                ),
            493 =>
                array(
                    'code' => '511-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DEL CANTON AMBATO',
                ),
            494 =>
                array(
                    'code' => '511-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DE LOS CANTONES DE SAMBORONDON Y DURAN',
                ),
            495 =>
                array(
                    'code' => '511-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DEL CANTON SANTO DOMINGO DE LOS TSACHILAS',
                ),
            496 =>
                array(
                    'code' => '511-0025',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MERCANTIL DEL CANTON MANTA',
                ),
            497 =>
                array(
                    'code' => '511-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION NACIONAL DE REGISTRO DE DATOS PUBLICOS - PLANTA CENTRA',
                ),
            498 =>
                array(
                    'code' => '520-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 01D01C01_CUENCA_CANARIBAMBA_AZUAY_MTOP',
                ),
            499 =>
                array(
                    'code' => '520-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 02D01_GUARANDA_BOLIVAR_MTOP',
                ),
        ));
        DB::table('institutions')->insert(array(
            0 =>
                array(
                    'code' => '520-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 03D01_AZOGUES_BIBLIAN_DELEG_CANAR_MTOP',
                ),
            1 =>
                array(
                    'code' => '520-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 04D01_SAN PEDRO DE HUACA_TULCAN_CARCHI_MTOP',
                ),
            2 =>
                array(
                    'code' => '520-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 05D01_LATACUNGA_COTOPAXI_MTOP',
                ),
            3 =>
                array(
                    'code' => '520-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 06D01_CHAMBO_RIOBAMBA_CHIMBORAZO_MTOP',
                ),
            4 =>
                array(
                    'code' => '520-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 07D02_MACHALA_EL ORO_MTOP',
                ),
            5 =>
                array(
                    'code' => '520-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 08D01_ESMERALDAS_ESMERALDAS_MTOP',
                ),
            6 =>
                array(
                    'code' => '520-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 09D05_TARQUI_1TENGEL_GUAYAS_MTOP',
                ),
            7 =>
                array(
                    'code' => '520-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 10D01_IBARRA_PIMAMPIRO_SAN MIGUEL DE URCUQUI_IMBABURA_MTOP',
                ),
            8 =>
                array(
                    'code' => '520-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 11D01_LOJA_LOJA_MTOP',
                ),
            9 =>
                array(
                    'code' => '520-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 12D01 BABA_BABAHOYO_MONTALVO_LOS RIOS_MTOP',
                ),
            10 =>
                array(
                    'code' => '520-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 13D01_PORTOVIEJO_MANABI_MTOP',
                ),
            11 =>
                array(
                    'code' => '520-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 14D01C05_MACAS_MORONA SANTIAGO_MTOP',
                ),
            12 =>
                array(
                    'code' => '520-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 15D01_ARCHIDONA_CARLOS JULIO AROSEMENA TOLA_TENA_NAPO_MTOP',
                ),
            13 =>
                array(
                    'code' => '520-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 16D01C01_PUYO_PASTAZA_MTOP',
                ),
            14 =>
                array(
                    'code' => '520-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 17D02_CALDERON_LLANO CHICO_GUAYLLABAMBA_PICHINCHA-MTOP',
                ),
            15 =>
                array(
                    'code' => '520-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 18D01C01_AMBATO_TUNGURAHUA_MTOP',
                ),
            16 =>
                array(
                    'code' => '520-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 19D01_YACUAMBI_ZAMORA_ZAMORA CHINCHIPE_MTOP',
                ),
            17 =>
                array(
                    'code' => '520-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 21D02C01_NUEVA LOJA_SUCUMBIOS_MTOP',
                ),
            18 =>
                array(
                    'code' => '520-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 22D02C04_PUERTO FRANCISCO DE ORELLANA (COCA)_ORELLANA_MTOP',
                ),
            19 =>
                array(
                    'code' => '520-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 23D01_PARROQUIAS URBANAS RIO VERDE A CHIGUILPE Y PARROQUIAS RURALES ALLURIQUIN A PERIFERIA_SANTO DOMINGO DE LOS TSACHILAS_MTOP',
                ),
            20 =>
                array(
                    'code' => '520-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DISTRITAL 24D01_SANTA ELENA_SANTA ELENA_MTOP',
                ),
            21 =>
                array(
                    'code' => '520-0026',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUPERINTENDENCIA DEL TERMINAL PETROLERO DE EL SALITRAL',
                ),
            22 =>
                array(
                    'code' => '520-0027',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUPERINTENDENCIA DEL TERMINAL PETROLERO DE BALAO DE ESMERALDAS',
                ),
            23 =>
                array(
                    'code' => '520-0028',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUPERINTENDENCIA DEL TERMINAL PETROLERO DE LA LIBERTAD',
                ),
            24 =>
                array(
                    'code' => '520-0029',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUBSECRETARIA DE PUERTOS  TRANSPORTE MARITIMO Y FLUVIAL',
                ),
            25 =>
                array(
                    'code' => '520-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE TRANSPORTE Y OBRAS PUBLICAS - PLANTA CENTRAL',
                ),
            26 =>
                array(
                    'code' => '522-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION GENERAL DE AVIACION CIVIL - DIRECCION REGIONAL II',
                ),
            27 =>
                array(
                    'code' => '522-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DE EMPRESAS DGAC',
                ),
            28 =>
                array(
                    'code' => '522-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA TECNICA DE AVIACION CIVIL ETAC',
                ),
            29 =>
                array(
                    'code' => '522-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION GENERAL DE AVIACION CIVIL - DIRECCION REGIONAL I',
                ),
            30 =>
                array(
                    'code' => '522-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION GENERAL DE AVIACION CIVIL - DIRECCION REGIONAL III',
                ),
            31 =>
                array(
                    'code' => '522-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION GENERAL DE AVIACION CIVIL - PLANTA CENTRAL',
                ),
            32 =>
                array(
                    'code' => '540-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE TELECOMUNICACIONES Y DE LA SOCIEDAD DE LA INFORMACION',
                ),
            33 =>
                array(
                    'code' => '550-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI AZUAY',
                ),
            34 =>
                array(
                    'code' => '550-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI BOLIVAR',
                ),
            35 =>
                array(
                    'code' => '550-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI CANAR',
                ),
            36 =>
                array(
                    'code' => '550-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI CARCHI',
                ),
            37 =>
                array(
                    'code' => '550-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI COTOPAXI',
                ),
            38 =>
                array(
                    'code' => '550-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI CHIMBORAZO',
                ),
            39 =>
                array(
                    'code' => '550-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI EL ORO',
                ),
            40 =>
                array(
                    'code' => '550-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI ESMERALDAS',
                ),
            41 =>
                array(
                    'code' => '550-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI GUAYAS',
                ),
            42 =>
                array(
                    'code' => '550-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI IMBABURA',
                ),
            43 =>
                array(
                    'code' => '550-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI LOJA',
                ),
            44 =>
                array(
                    'code' => '550-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI LOS RIOS',
                ),
            45 =>
                array(
                    'code' => '550-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI MANABI',
                ),
            46 =>
                array(
                    'code' => '550-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI MORONA SANTIAGO',
                ),
            47 =>
                array(
                    'code' => '550-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI NAPO',
                ),
            48 =>
                array(
                    'code' => '550-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI PASTAZA',
                ),
            49 =>
                array(
                    'code' => '550-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI PICHINCHA',
                ),
            50 =>
                array(
                    'code' => '550-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI TUNGURAHUA',
                ),
            51 =>
                array(
                    'code' => '550-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI ZAMORA CHINCHIPE',
                ),
            52 =>
                array(
                    'code' => '550-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI SUCUMBIOS',
                ),
            53 =>
                array(
                    'code' => '550-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI ORELLANA',
                ),
            54 =>
                array(
                    'code' => '550-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI SANTO DOMINGO DE LOS TSACHILAS',
                ),
            55 =>
                array(
                    'code' => '550-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OFICINA TECNICA MIDUVI SANTA ELENA',
                ),
            56 =>
                array(
                    'code' => '550-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MINISTERIO DE DESARROLLO URBANO Y VIVIENDA - PLANTA CENTRAL',
                ),
            57 =>
                array(
                    'code' => '560-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 1 - SECOB',
                ),
            58 =>
                array(
                    'code' => '560-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 2 - SECOB',
                ),
            59 =>
                array(
                    'code' => '560-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 3 - SECOB',
                ),
            60 =>
                array(
                    'code' => '560-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 4 - SECOB',
                ),
            61 =>
                array(
                    'code' => '560-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 5 - SECOB',
                ),
            62 =>
                array(
                    'code' => '560-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 6 - SECOB',
                ),
            63 =>
                array(
                    'code' => '560-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 7 - SECOB',
                ),
            64 =>
                array(
                    'code' => '560-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINACION ZONAL 8 - SECOB',
                ),
            65 =>
                array(
                    'code' => '560-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO DE CONTRATACION DE OBRAS - SECOB PLANTA CENTRAL',
                ),
            66 =>
                array(
                    'code' => '576-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA TECNICA DE JUVENTUDES - PLANTA CENTRAL',
                ),
            67 =>
                array(
                    'code' => '577-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO NACIONAL DE DERECHOS INTELECTUALES',
                ),
            68 =>
                array(
                    'code' => '578-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO NACIONAL DE ATENCION INTEGRAL A PERSONAS ADULTAS PRIVADAS DE LA LIBERTAD Y A ADOLESCENTES INFRACTORES - PLANTA CENTRAL',
                ),
            69 =>
                array(
                    'code' => '580-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE AZUAY',
                ),
            70 =>
                array(
                    'code' => '580-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE BOLIVAR',
                ),
            71 =>
                array(
                    'code' => '580-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE CANAR',
                ),
            72 =>
                array(
                    'code' => '580-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE CARCHI',
                ),
            73 =>
                array(
                    'code' => '580-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE COTOPAXI',
                ),
            74 =>
                array(
                    'code' => '580-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE CHIMBORAZO',
                ),
            75 =>
                array(
                    'code' => '580-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE EL ORO',
                ),
            76 =>
                array(
                    'code' => '580-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE  ESMERALDAS',
                ),
            77 =>
                array(
                    'code' => '580-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL  ELECTORAL DELEGACION PROVINCIAL DEL GUAYAS',
                ),
            78 =>
                array(
                    'code' => '580-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE IMBABURA',
                ),
            79 =>
                array(
                    'code' => '580-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE LOJA ',
                ),
            80 =>
                array(
                    'code' => '580-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE LOS RIOS',
                ),
            81 =>
                array(
                    'code' => '580-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE MANABI',
                ),
            82 =>
                array(
                    'code' => '580-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE MORONA SANTIAGO',
                ),
            83 =>
                array(
                    'code' => '580-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE NAPO',
                ),
            84 =>
                array(
                    'code' => '580-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE PASTAZA',
                ),
            85 =>
                array(
                    'code' => '580-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE PICHINCHA',
                ),
            86 =>
                array(
                    'code' => '580-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE TUNGURAHUA',
                ),
            87 =>
                array(
                    'code' => '580-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE ZAMORA CHINCHIPE',
                ),
            88 =>
                array(
                    'code' => '580-0020',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE GALAPAGOS',
                ),
            89 =>
                array(
                    'code' => '580-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE SUCUMBIOS',
                ),
            90 =>
                array(
                    'code' => '580-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE ORELLANA',
                ),
            91 =>
                array(
                    'code' => '580-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE SANTO DOMINIGO DE LOS TSACHILAS',
                ),
            92 =>
                array(
                    'code' => '580-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL DELEGACION PROVINCIAL DE SANTA ELENA',
                ),
            93 =>
                array(
                    'code' => '580-0030',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO DE INVESTIGACION CAPACITACION Y PROMOCION POLITICO ELECTORAL',
                ),
            94 =>
                array(
                    'code' => '580-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL ELECTORAL - PLANTA CENTRAL',
                ),
            95 =>
                array(
                    'code' => '581-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CORTE CONSTITUCIONAL',
                ),
            96 =>
                array(
                    'code' => '582-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'TRIBUNAL CONTENCIOSO ELECTORAL',
                ),
            97 =>
                array(
                    'code' => '583-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO DE PARTICIPACION CIUDADANA Y CONTROL SOCIAL',
                ),
            98 =>
                array(
                    'code' => '590-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PROCURADURIA GENERAL DEL ESTADO - DIRECCION REGIONAL 1',
                ),
            99 =>
                array(
                    'code' => '590-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PROCURADURIA GENERAL DEL ESTADO - PLANTA CENTRAL',
                ),
            100 =>
                array(
                    'code' => '591-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONTRALORIA GENERAL DEL ESTADO',
                ),
            101 =>
                array(
                    'code' => '592-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUPERINTENDENCIA DE BANCOS',
                ),
            102 =>
                array(
                    'code' => '593-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INTENDENCIA REGIONAL DE QUITO',
                ),
            103 =>
                array(
                    'code' => '593-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUPERINTENDENCIA DE COMPANIAS VALORES Y SEGUROS - PLANTA CENTRAL',
                ),
            104 =>
                array(
                    'code' => '598-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DEL AZUAY',
                ),
            105 =>
                array(
                    'code' => '598-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE  BOLIVAR                                                  ',
                ),
            106 =>
                array(
                    'code' => '598-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE CANAR',
                ),
            107 =>
                array(
                    'code' => '598-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE CARCHI',
                ),
            108 =>
                array(
                    'code' => '598-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE COTOPAXI',
                ),
            109 =>
                array(
                    'code' => '598-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE CHIMBORAZO                                            ',
                ),
            110 =>
                array(
                    'code' => '598-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE EL ORO',
                ),
            111 =>
                array(
                    'code' => '598-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE ESMERALDAS',
                ),
            112 =>
                array(
                    'code' => '598-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DEL GUAYAS',
                ),
            113 =>
                array(
                    'code' => '598-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE IMBABURA',
                ),
            114 =>
                array(
                    'code' => '598-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE LOJA',
                ),
            115 =>
                array(
                    'code' => '598-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE LOS RIOS',
                ),
            116 =>
                array(
                    'code' => '598-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE MANABI',
                ),
            117 =>
                array(
                    'code' => '598-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE MORONA SANTIAGO',
                ),
            118 =>
                array(
                    'code' => '598-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE NAPO',
                ),
            119 =>
                array(
                    'code' => '598-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE PASTAZA',
                ),
            120 =>
                array(
                    'code' => '598-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE PICHINCHA',
                ),
            121 =>
                array(
                    'code' => '598-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE TUNGURAHUA                                       ',
                ),
            122 =>
                array(
                    'code' => '598-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE ZAMORA CHINCHIPE',
                ),
            123 =>
                array(
                    'code' => '598-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE SUCUMBIOS',
                ),
            124 =>
                array(
                    'code' => '598-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE ORELLANA',
                ),
            125 =>
                array(
                    'code' => '598-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE SANTO DOMINGO TSACHILLAS          ',
                ),
            126 =>
                array(
                    'code' => '598-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA DE SANTA ELENA',
                ),
            127 =>
                array(
                    'code' => '598-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FISCALIA GENERAL DEL ESTADO - PLANTA CENTRAL',
                ),
            128 =>
                array(
                    'code' => '607-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD DEL REGISTRO SOCIAL',
                ),
            129 =>
                array(
                    'code' => '608-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUBSECRETARIA ZONAL DE PLANIFICACION - 1',
                ),
            130 =>
                array(
                    'code' => '608-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUBSECRETARIA ZONAL DE PLANIFICACION - 2',
                ),
            131 =>
                array(
                    'code' => '608-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUBSECRETARIA ZONAL DE PLANIFICACION - 3',
                ),
            132 =>
                array(
                    'code' => '608-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUBSECRETARIA ZONAL DE PLANIFICACION - 4',
                ),
            133 =>
                array(
                    'code' => '608-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUBSECRETARIA ZONAL DE PLANIFICACION - 5',
                ),
            134 =>
                array(
                    'code' => '608-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUBSECRETARIA ZONAL DE PLANIFICACION - 6',
                ),
            135 =>
                array(
                    'code' => '608-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUBSECRETARIA ZONAL DE PLANIFICACION - 7',
                ),
            136 =>
                array(
                    'code' => '608-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUBSECRETARIA ZONAL DE PLANIFICACION - 8',
                ),
            137 =>
                array(
                    'code' => '608-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA TECNICA DE PLANIFICACION PLANIFICA ECUADOR - PLANTA CENTRAL',
                ),
            138 =>
                array(
                    'code' => '643-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DEFENSORIA DEL PUEBLO',
                ),
            139 =>
                array(
                    'code' => '679-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD DE ANALISIS FINANCIERO Y ECONOMICO UAFE',
                ),
            140 =>
                array(
                    'code' => '690-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CORPORACION DEL SEGURO DE DEPOSITOS COSEDE',
                ),
            141 =>
                array(
                    'code' => '916-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUPERINTENDENCIA DE ECONOMIA POPULAR Y SOLIDARIA',
                ),
            142 =>
                array(
                    'code' => '935-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUPERINTENDENCIA DE CONTROL DEL PODER DE MERCADO',
                ),
            143 =>
                array(
                    'code' => '974-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INTENDENCIA ZONAL 1 - NORTE',
                ),
            144 =>
                array(
                    'code' => '974-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INTENDENCIA ZONAL 3 - CENTRO',
                ),
            145 =>
                array(
                    'code' => '974-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INTENDENCIA ZONAL 4 - PACIFICO',
                ),
            146 =>
                array(
                    'code' => '974-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INTENDENCIA ZONAL 6 - AUSTRO',
                ),
            147 =>
                array(
                    'code' => '974-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INTENDENCIA ZONAL 7 - SUR',
                ),
            148 =>
                array(
                    'code' => '974-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INTENDENCIA ZONAL 8',
                ),
            149 =>
                array(
                    'code' => '974-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUPERINTENDENCIA DE LA INFORMACION Y COMUNICACION - PLANTA CENTRAL',
                ),
            150 =>
                array(
                    'code' => '086-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD DE LAS ARTES - PLANTA CENTRAL',
                ),
            151 =>
                array(
                    'code' => '087-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD REGIONAL AMAZONICA IKIAM - PLANTA CENTRAL',
                ),
            152 =>
                array(
                    'code' => '088-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD NACIONAL DE EDUCACION UNAE - PLANTA CENTRAL',
                ),
            153 =>
                array(
                    'code' => '161-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD DE CUENCA',
                ),
            154 =>
                array(
                    'code' => '162-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD ESTATAL DE BOLIVAR',
                ),
            155 =>
                array(
                    'code' => '163-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA SUPERIOR POLITECNICA DEL CHIMBORAZO - PLANTA CENTRAL',
                ),
            156 =>
                array(
                    'code' => '164-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD TECNICA DE MACHALA',
                ),
            157 =>
                array(
                    'code' => '165-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD TECNICA LUIS VARGAS TORRES DE ESMERALDAS',
                ),
            158 =>
                array(
                    'code' => '166-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD DE GUAYAQUIL',
                ),
            159 =>
                array(
                    'code' => '167-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA SUPERIOR POLITECNICA DEL LITORAL',
                ),
            160 =>
                array(
                    'code' => '168-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD AGRARIA DEL ECUADOR',
                ),
            161 =>
                array(
                    'code' => '169-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD TECNICA DEL NORTE - PLANTA CENTRAL',
                ),
            162 =>
                array(
                    'code' => '170-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD NACIONAL DE LOJA',
                ),
            163 =>
                array(
                    'code' => '171-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD TECNICA DE BABAHOYO',
                ),
            164 =>
                array(
                    'code' => '172-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD TECNICA DE QUEVEDO',
                ),
            165 =>
                array(
                    'code' => '173-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD TECNICA DE MANABI',
                ),
            166 =>
                array(
                    'code' => '174-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD LAICA ELOY ALFARO DE MANABI - PLANTA CENTRAL',
                ),
            167 =>
                array(
                    'code' => '175-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE ARQUITECTURA',
                ),
            168 =>
                array(
                    'code' => '175-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE ARTES',
                ),
            169 =>
                array(
                    'code' => '175-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE CIENCIAS ADMINISTRATIVAS',
                ),
            170 =>
                array(
                    'code' => '175-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE CIENCIAS AGRICOLAS',
                ),
            171 =>
                array(
                    'code' => '175-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE CIENCIAS ECONOMICAS',
                ),
            172 =>
                array(
                    'code' => '175-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE CIENCIAS MEDICAS',
                ),
            173 =>
                array(
                    'code' => '175-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE CIENCIAS PSICOLOGICAS',
                ),
            174 =>
                array(
                    'code' => '175-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE CIENCIAS QUIMICAS',
                ),
            175 =>
                array(
                    'code' => '175-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE COMUNICACION SOCIAL',
                ),
            176 =>
                array(
                    'code' => '175-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE FILOSOFIA  LETRAS Y CIENCIAS DE LA EDUCACION',
                ),
            177 =>
                array(
                    'code' => '175-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE INGENIERIA FISICA Y MATEMATICA',
                ),
            178 =>
                array(
                    'code' => '175-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE INGENIERIA EN GEOLOGIA MINAS  PETROLEO Y AMBIENTAL',
                ),
            179 =>
                array(
                    'code' => '175-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE JURISPRUDENCIA',
                ),
            180 =>
                array(
                    'code' => '175-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE MEDICINA VETERINARIA',
                ),
            181 =>
                array(
                    'code' => '175-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE ODONTOLOGIA',
                ),
            182 =>
                array(
                    'code' => '175-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DE INVESTIGACION',
                ),
            183 =>
                array(
                    'code' => '175-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SERVICIO MEDICO UNIVERSITARIO - HOSPITAL DEL DIA',
                ),
            184 =>
                array(
                    'code' => '175-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE TRANSFERENCIA  DESARROLLO Y TECNOLOGIA (CTT)',
                ),
            185 =>
                array(
                    'code' => '175-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE INGENIERIA QUIMICA',
                ),
            186 =>
                array(
                    'code' => '175-0025',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE CULTURA FISICA DE LA UNIVERSIDAD CENTRAL DEL ECUADOR',
                ),
            187 =>
                array(
                    'code' => '175-0026',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE CIENCIAS DE LA DISCAPACIDAD ATENCION PREHOSPITALARIA Y DESASTRES DE LA UNIVERSIDAD CENTRAL DEL ECUADOR',
                ),
            188 =>
                array(
                    'code' => '175-0030',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE CIENCIAS BIOLOGICAS',
                ),
            189 =>
                array(
                    'code' => '175-0031',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FACULTAD DE CIENCIAS SOCIALES Y HUMANAS',
                ),
            190 =>
                array(
                    'code' => '175-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD CENTRAL DEL ECUADOR - PLANTA CENTRAL',
                ),
            191 =>
                array(
                    'code' => '176-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DE INVESTIGACION Y DESARROLLO - DIDE',
                ),
            192 =>
                array(
                    'code' => '176-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD CENTRALIZADA DE TRANSFERENCIA Y DESARROLLO DE TECNOLOGIAS',
                ),
            193 =>
                array(
                    'code' => '176-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD CENTRALIZADA DE PRESTACION DE SERVICIOS',
                ),
            194 =>
                array(
                    'code' => '176-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD TECNICA DE AMBATO - PLANTA CENTRAL',
                ),
            195 =>
                array(
                    'code' => '177-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE EDUCACION CONTINUA EPN',
                ),
            196 =>
                array(
                    'code' => '177-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO GEOFISICO',
                ),
            197 =>
                array(
                    'code' => '177-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE TRANSFERENCIA TECNOLOGICA PARA LA CAPACITACION E INVESTIGACION EN CONTROL DE EMISIONES VEHICULARES',
                ),
            198 =>
                array(
                    'code' => '177-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD DE GESTION DE INVESTIGACION Y PROYECCION SOCIAL',
                ),
            199 =>
                array(
                    'code' => '177-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA POLITECNICA NACIONAL - PLANTA CENTRAL',
                ),
            200 =>
                array(
                    'code' => '179-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD TECNICA DE COTOPAXI',
                ),
            201 =>
                array(
                    'code' => '180-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD NACIONAL DE CHIMBORAZO',
                ),
            202 =>
                array(
                    'code' => '181-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD ESTATAL DE MILAGRO',
                ),
            203 =>
                array(
                    'code' => '182-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD ESTATAL DEL SUR DE MANABI',
                ),
            204 =>
                array(
                    'code' => '183-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD DE INVESTIGACION DE TECNOLOGIA EXPERIMENTAL YACHAY',
                ),
            205 =>
                array(
                    'code' => '185-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD ESTATAL AMAZONICA',
                ),
            206 =>
                array(
                    'code' => '187-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD ESTATAL PENINSULA DE SANTA ELENA - PLANTA CENTRAL',
                ),
            207 =>
                array(
                    'code' => '188-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA SUPERIOR POLITECNICA AGROPECUARIA DE MANABI MANUEL FELIX LOPEZ',
                ),
            208 =>
                array(
                    'code' => '189-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD DE LAS FUERZAS ARMADAS ESPE EXTENSION SANTO DOMINGO DE LOS TSACHILAS',
                ),
            209 =>
                array(
                    'code' => '189-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD DE LAS FUERZAS ARMADAS ESPE - EXTENSION LATACUNGA',
                ),
            210 =>
                array(
                    'code' => '189-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CARRERA DE INGENIERIA AGROPECUARIA IASA 1',
                ),
            211 =>
                array(
                    'code' => '189-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD DE LAS FUERZAS ARMADAS ESPE - PLANTA CENTRAL',
                ),
            212 =>
                array(
                    'code' => '215-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO SUPERIOR TECNOLOGICO DE ARTES DEL ECUADOR',
                ),
            213 =>
                array(
                    'code' => '232-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO DE ALTOS ESTUDIOS NACIONALES (IAEN)',
                ),
            214 =>
                array(
                    'code' => '233-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD POLITECNICA ESTATAL DEL CARCHI',
                ),
            215 =>
                array(
                    'code' => '584-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIVERSIDAD INTERCULTURAL DE LAS NACIONALIDADES Y PUEBLOS INDIGENAS AMAWTAY WASI',
                ),
            216 =>
                array(
                    'code' => '016-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL DEL NORTE DE GUAYAQUIL LOS CEIBOS',
                ),
            217 =>
                array(
                    'code' => '091-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE ESPECIALIDADES - TEODORO MALDONADO CARBO',
                ),
            218 =>
                array(
                    'code' => '092-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE ESPECIALIDADES - CARLOS ANDRADE MARIN',
                ),
            219 =>
                array(
                    'code' => '093-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO HOSPITAL DEL DIA COTOCOLLAO',
                ),
            220 =>
                array(
                    'code' => '104-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL SAN FRANCISCO',
                ),
            221 =>
                array(
                    'code' => '105-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE ESPECIALIDADES - COMITE DEL PUEBLO',
                ),
            222 =>
                array(
                    'code' => '107-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL DE ESPECIALIDADES - JOSE CARRASCO ARTEAGA',
                ),
            223 =>
                array(
                    'code' => '131-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL DEL SUR DE QUITO',
                ),
            224 =>
                array(
                    'code' => '132-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO HOSPITAL DEL DIA SANGOLQUI',
                ),
            225 =>
                array(
                    'code' => '225-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO MEDICO FAMILIAR INTEGRAL Y ESPECIALIDADES DIALISIS LA MARISCAL ',
                ),
            226 =>
                array(
                    'code' => '297-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B -ATUNTAQUI',
                ),
            227 =>
                array(
                    'code' => '304-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO DE SEGURIDAD SOCIAL DE LAS FUERZAS ARMADAS - ISSFA',
                ),
            228 =>
                array(
                    'code' => '305-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO  DE SEGURIDAD SOCIAL DE LA POLICIA - ISSPOL',
                ),
            229 =>
                array(
                    'code' => '314-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL QUEVEDO',
                ),
            230 =>
                array(
                    'code' => '317-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE REHABILITACION INTEGRAL ESPECIALIZADO AZOGUEZ',
                ),
            231 =>
                array(
                    'code' => '384-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE ESPECIALIDADES OTAVALO',
                ),
            232 =>
                array(
                    'code' => '388-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL BASICO - ESMERALDAS',
                ),
            233 =>
                array(
                    'code' => '389-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - SAN LORENZO',
                ),
            234 =>
                array(
                    'code' => '396-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - QUININDE',
                ),
            235 =>
                array(
                    'code' => '397-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - TULCAN',
                ),
            236 =>
                array(
                    'code' => '403-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - EL ANGEL',
                ),
            237 =>
                array(
                    'code' => '404-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - SAN GABRIEL',
                ),
            238 =>
                array(
                    'code' => '405-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'IESS HOSPITAL DE IBARRA',
                ),
            239 =>
                array(
                    'code' => '406-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - COTACACHI',
                ),
            240 =>
                array(
                    'code' => '407-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE ESPECIALIDADES NUEVA LOJA',
                ),
            241 =>
                array(
                    'code' => '408-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO HOSPITAL DEL DIA CENTRAL QUITO',
                ),
            242 =>
                array(
                    'code' => '410-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO (HOSPITAL DEL DIA) - CHIMBACALLE',
                ),
            243 =>
                array(
                    'code' => '411-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO HOSPITAL DEL DIA EL BATAN',
                ),
            244 =>
                array(
                    'code' => '413-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE ESPECIALIDADES SUR OCCIDENTAL',
                ),
            245 =>
                array(
                    'code' => '468-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE ESPECIALIDADES SAN JUAN',
                ),
            246 =>
                array(
                    'code' => '469-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE ESPECIALIDADES - LA ECUATORIANA',
                ),
            247 =>
                array(
                    'code' => '479-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - MACHACHI',
                ),
            248 =>
                array(
                    'code' => '480-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B -CAYAMBE',
                ),
            249 =>
                array(
                    'code' => '481-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - TABACUNDO',
                ),
            250 =>
                array(
                    'code' => '483-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD  A - AMAGUANA',
                ),
            251 =>
                array(
                    'code' => '484-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO HOSPITAL DEL DIA - EL TENA',
                ),
            252 =>
                array(
                    'code' => '485-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - EL COCA',
                ),
            253 =>
                array(
                    'code' => '486-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL BASICO LATACUNGA',
                ),
            254 =>
                array(
                    'code' => '487-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL - AMBATO',
                ),
            255 =>
                array(
                    'code' => '488-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - BANOS',
                ),
            256 =>
                array(
                    'code' => '489-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - PILLARO',
                ),
            257 =>
                array(
                    'code' => '490-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL RIOBAMBA',
                ),
            258 =>
                array(
                    'code' => '491-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - ALAUSI',
                ),
            259 =>
                array(
                    'code' => '492-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PUESTO DE SALUD DE CHUNCHI',
                ),
            260 =>
                array(
                    'code' => '493-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - PARQUE INDUSTRIAL',
                ),
            261 =>
                array(
                    'code' => '494-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL BASICO EL PUYO',
                ),
            262 =>
                array(
                    'code' => '495-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL PORTOVIEJO',
                ),
            263 =>
                array(
                    'code' => '496-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD C - BAHIA DE CARAQUEZ',
                ),
            264 =>
                array(
                    'code' => '497-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL - MANTA',
                ),
            265 =>
                array(
                    'code' => '498-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO (HOSPITAL DEL DIA)JIPIJAPA',
                ),
            266 =>
                array(
                    'code' => '499-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL BASICO CHONE',
                ),
            267 =>
                array(
                    'code' => '501-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD  B - PORTOVIEJO',
                ),
            268 =>
                array(
                    'code' => '502-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - EL CARMEN',
                ),
            269 =>
                array(
                    'code' => '503-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A -CALCETA',
                ),
            270 =>
                array(
                    'code' => '504-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - PAJAN',
                ),
            271 =>
                array(
                    'code' => '505-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD  A - LOS ESTEROS',
                ),
            272 =>
                array(
                    'code' => '506-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO HOSPITAL DEL DIA SANTO DOMINGO',
                ),
            273 =>
                array(
                    'code' => '507-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL - SANTO DOMINGO',
                ),
            274 =>
                array(
                    'code' => '508-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL - MILAGRO',
                ),
            275 =>
                array(
                    'code' => '512-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE ESPECIALIDADES BALZAR',
                ),
            276 =>
                array(
                    'code' => '513-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - BUCAY',
                ),
            277 =>
                array(
                    'code' => '514-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE ESPECIALIDADES DAULE',
                ),
            278 =>
                array(
                    'code' => '515-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD C - NARANJAL',
                ),
            279 =>
                array(
                    'code' => '516-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - EL EMPALME',
                ),
            280 =>
                array(
                    'code' => '517-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL BASICO ANCON',
                ),
            281 =>
                array(
                    'code' => '518-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE ESPECIALIDADES - LA LIBERTAD',
                ),
            282 =>
                array(
                    'code' => '519-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL - BABAHOYO',
                ),
            283 =>
                array(
                    'code' => '523-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - VENTANAS',
                ),
            284 =>
                array(
                    'code' => '525-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - VINCES',
                ),
            285 =>
                array(
                    'code' => '526-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL BASICO GUARANDA',
                ),
            286 =>
                array(
                    'code' => '527-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - SAN MIGUEL DE BOLIVAR',
                ),
            287 =>
                array(
                    'code' => '528-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - SAN CRISTOBAL',
                ),
            288 =>
                array(
                    'code' => '531-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - SANTA CRUZ',
                ),
            289 =>
                array(
                    'code' => '537-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO (HOSPITAL DEL DIA) EFREN JURADO LOPEZ',
                ),
            290 =>
                array(
                    'code' => '538-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL BASICO - DURAN',
                ),
            291 =>
                array(
                    'code' => '539-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE ESPECIALIDADES CENTRAL GUAYAS',
                ),
            292 =>
                array(
                    'code' => '542-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO HOSPITAL DEL DIA NORTE - TARQUI',
                ),
            293 =>
                array(
                    'code' => '543-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE ESPECIALIDADES -LETAMENDI',
                ),
            294 =>
                array(
                    'code' => '544-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO HOSPITAL DEL DIA SUR VALDIVIA',
                ),
            295 =>
                array(
                    'code' => '545-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - QUEVEDO',
                ),
            296 =>
                array(
                    'code' => '546-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO HOSPITAL DEL DIA AZOGUES',
                ),
            297 =>
                array(
                    'code' => '547-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - LA TRONCAL',
                ),
            298 =>
                array(
                    'code' => '548-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - CANAR',
                ),
            299 =>
                array(
                    'code' => '549-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE ESPECIALIDADES CENTRAL CUENCA',
                ),
            300 =>
                array(
                    'code' => '551-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO (HOSPITAL DEL DIA) - MACAS',
                ),
            301 =>
                array(
                    'code' => '552-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - SUCUA',
                ),
            302 =>
                array(
                    'code' => '553-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A GUALAQUIZA',
                ),
            303 =>
                array(
                    'code' => '554-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL MANUEL YGNACIO MONTEROS',
                ),
            304 =>
                array(
                    'code' => '555-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO HOSPITAL DEL DIA DE LOJA',
                ),
            305 =>
                array(
                    'code' => '556-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - CARIAMANGA',
                ),
            306 =>
                array(
                    'code' => '559-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B MACARA',
                ),
            307 =>
                array(
                    'code' => '561-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - CATAMAYO',
                ),
            308 =>
                array(
                    'code' => '563-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - PALTAS',
                ),
            309 =>
                array(
                    'code' => '564-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - CELICA',
                ),
            310 =>
                array(
                    'code' => '566-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL GENERAL - MACHALA',
                ),
            311 =>
                array(
                    'code' => '567-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - SANTA ROSA',
                ),
            312 =>
                array(
                    'code' => '568-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD C - MATERNO INFANTIL Y EMERGENCIAS - ZARUMA ',
                ),
            313 =>
                array(
                    'code' => '569-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - PASAJE',
                ),
            314 =>
                array(
                    'code' => '570-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - PORTOVELO',
                ),
            315 =>
                array(
                    'code' => '571-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B -PINAS',
                ),
            316 =>
                array(
                    'code' => '572-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD B - HUAQUILLAS',
                ),
            317 =>
                array(
                    'code' => '573-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO CLINICO QUIRURGICO AMBULATORIO HOSPITAL DEL DIA ZAMORA',
                ),
            318 =>
                array(
                    'code' => '574-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD A - ZUMBA',
                ),
            319 =>
                array(
                    'code' => '575-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE SALUD C MATERNO INFANTIL Y EMERGENCIAS CUENCA',
                ),
            320 =>
                array(
                    'code' => '409-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DEL NORTE DEL ECUADOR',
                ),
            321 =>
                array(
                    'code' => '652-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSORCIO DE GOBIERNOS AUTONOMOS PROVINCIALES DEL ECUADOR-CONGOPE',
                ),
            322 =>
                array(
                    'code' => '653-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSORCIO DE CONSEJOS PROVINCIALES DEL NORTE - CONNOR',
                ),
            323 =>
                array(
                    'code' => '701-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO PROVINCIAL DEL AZUAY',
                ),
            324 =>
                array(
                    'code' => '718-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PROVINCIA BOLIVAR',
                ),
            325 =>
                array(
                    'code' => '718-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO PROVINCIAL DE ASISTENCIA SOCIAL DE BOLIVAR - IPASB',
                ),
            326 =>
                array(
                    'code' => '728-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PROVINCIA DEL CANAR',
                ),
            327 =>
                array(
                    'code' => '728-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE GESTION Y DESARROLLO SOCIAL DEL GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PROVINCIA DEL CAÃ‘AR',
                ),
            328 =>
                array(
                    'code' => '738-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PROVINCIA DEL CARCHI',
                ),
            329 =>
                array(
                    'code' => '738-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA DE DESARROLLO ECONOMICO TERRITORIAL DEL CARCHI - ADECARCHI',
                ),
            330 =>
                array(
                    'code' => '747-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PROVINCIA DE COTOPAXI',
                ),
            331 =>
                array(
                    'code' => '747-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO DE PROTECCION A GRUPOS DE ATENCION PRIORITARIA DE COTOPAXI',
                ),
            332 =>
                array(
                    'code' => '757-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PROVINCIA DE CHIMBORAZO',
                ),
            333 =>
                array(
                    'code' => '757-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO PROVINCIAL DEL GADPCH',
                ),
            334 =>
                array(
                    'code' => '770-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PROVINCIAL AUTONOMO DE EL ORO',
                ),
            335 =>
                array(
                    'code' => '787-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PROVINCIA DE ESMERALDAS',
                ),
            336 =>
                array(
                    'code' => '787-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD DE ASISTENCIA MEDICA DESARROLLO SOCIAL Y CULTURAL ADSCRITA AL GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PROVINCIA DE ESMERALDAS',
                ),
            337 =>
                array(
                    'code' => '797-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PROVINCIAL DEL GUAYAS',
                ),
            338 =>
                array(
                    'code' => '828-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO PROVINCIAL DE IMBABURA',
                ),
            339 =>
                array(
                    'code' => '828-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO DE ACCION SOCIAL DEL GOBIERNO PROVINCIAL DE IMBABURA',
                ),
            340 =>
                array(
                    'code' => '837-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PROVINCIAL DE LOJA',
                ),
            341 =>
                array(
                    'code' => '856-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PROVINCIAL DE LOS RIOS',
                ),
            342 =>
                array(
                    'code' => '856-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO DE GESTION SOCIAL DEL GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PROVINCIA DE LOS RIOS',
                ),
            343 =>
                array(
                    'code' => '871-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PROVINCIAL DE MANABI',
                ),
            344 =>
                array(
                    'code' => '871-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO PROVINCIAL DE MANABI',
                ),
            345 =>
                array(
                    'code' => '871-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA DE PROMOCION REGIONAL DE INVERSIONES DE MANABI APRIM',
                ),
            346 =>
                array(
                    'code' => '871-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA DE DESARROLLO DE LA PROVINCIA DE MANABI',
                ),
            347 =>
                array(
                    'code' => '896-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO PROVINCIAL DE MORONA SANTIAGO',
                ),
            348 =>
                array(
                    'code' => '896-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CEFAS - PATRONATO DEL GAPMS',
                ),
            349 =>
                array(
                    'code' => '910-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PROVINCIAL DE NAPO',
                ),
            350 =>
                array(
                    'code' => '910-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUMAK KAWSAY WASI INSTITUTO PROVINCIAL DE ATENCION SOCIAL PRIORITARIA DEL GOBIERNO AUTONOMO DESCENTRALIZADO PROVINCIAL DE NAPO',
                ),
            351 =>
                array(
                    'code' => '918-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PROVINCIAL DE PASTAZA',
                ),
            352 =>
                array(
                    'code' => '918-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO PROVINCIAL DE SERVICIO SOCIAL DE PASTAZA',
                ),
            353 =>
                array(
                    'code' => '925-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PROVINCIA DE PICHINCHA',
                ),
            354 =>
                array(
                    'code' => '925-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MISION PICHINCHA GESTION SOCIAL DE LA PROVINCIA',
                ),
            355 =>
                array(
                    'code' => '937-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PROVINCIAL DE TUNGURAHUA',
                ),
            356 =>
                array(
                    'code' => '937-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO PROVINCIAL DE TUNGURAHUA',
                ),
            357 =>
                array(
                    'code' => '949-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PROVINCIAL DE ZAMORA CHINCHIPE',
                ),
            358 =>
                array(
                    'code' => '960-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO PROVINCIAL DE GALAPAGOS',
                ),
            359 =>
                array(
                    'code' => '966-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PROVINCIA DE SUCUMBIOS',
                ),
            360 =>
                array(
                    'code' => '966-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SUCUMBIOS SOLIDARIO',
                ),
            361 =>
                array(
                    'code' => '966-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE INVESTIGACION Y SERVICIOS AGROPECUARIOS SUCUMBIOS',
                ),
            362 =>
                array(
                    'code' => '966-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD ADSCRITA DE DESARROLLO PRODUCTIVO AGROPECUARIO DE INDUSTRIALIZACION COMERCIALIZACION Y EMPRESARIAL CORPOSUCUMBIOS',
                ),
            363 =>
                array(
                    'code' => '976-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PROVINCIA DE ORELLANA',
                ),
            364 =>
                array(
                    'code' => '976-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO DE SERVICIO SOCIAL  DE ORELLANA',
                ),
            365 =>
                array(
                    'code' => '981-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PROVINCIAL DE SANTO DOMINGO DE LOS TSACHILAS',
                ),
            366 =>
                array(
                    'code' => '982-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PROVINCIAL DE SANTA ELENA',
                ),
            367 =>
                array(
                    'code' => '984-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE GOBIERNOS AUTONOMOS DESCENTRALIZADOS PROVINCIALES DE LA AMAZONIA ECUATORIANA - CONGA',
                ),
            368 =>
                array(
                    'code' => '984-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSORCIO PARA LA GESTION AMBIENTAL DEL AREA ECOLOGICA DE DESARROLLO SOSTENIBLE PROVINCIAL DE PASTAZA',
                ),
            369 =>
                array(
                    'code' => '313-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD RIO DUE-AGUA PARA EL BUEN VIVIR',
                ),
            370 =>
                array(
                    'code' => '372-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE LOS GOBIERNOS AUTONOMOS DESCENTRALIZADOS MUNICIPALES DE LA PROVINCIA DE MORONA SANTIAGO',
                ),
            371 =>
                array(
                    'code' => '412-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DEL PUEBLO CANARI ENTRE LAS MUNICIPALIDADES DE LOS CANTONES CANAR  EL TAMBO Y SUSCAL',
                ),
            372 =>
                array(
                    'code' => '414-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD CENTRO NORTE',
                ),
            373 =>
                array(
                    'code' => '651-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ASOCIACION  DE  MUNICIPALIDADES DEL ECUADOR - AME',
                ),
            374 =>
                array(
                    'code' => '654-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSORCIO DE MUNICIPIOS AMAZONICOS Y GALAPAGOS',
                ),
            375 =>
                array(
                    'code' => '683-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE MUNICIPALIDADES PARA LA DINAMIZACION TURISTICA DE LA REGION NORORIENTAL AMAZONICA',
                ),
            376 =>
                array(
                    'code' => '702-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON CUENCA',
                ),
            377 =>
                array(
                    'code' => '702-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BENEMERITO CUERPO DE BOMBEROS VOLUNTARIOS DE CUENCA.',
                ),
            378 =>
                array(
                    'code' => '702-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ACCION SOCIAL MUNICIPAL DEL CANTON CUENCA',
                ),
            379 =>
                array(
                    'code' => '702-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON CUENCA',
                ),
            380 =>
                array(
                    'code' => '702-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GUARDIA DE SEGURIDAD CIUDADANA DE CUENCA',
                ),
            381 =>
                array(
                    'code' => '702-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO DE SEGURIDAD CIUDADANA DEL CANTON CUENCA',
                ),
            382 =>
                array(
                    'code' => '703-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE GIRON',
                ),
            383 =>
                array(
                    'code' => '703-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MUNICIPAL DE LA PROPIEDAD DEL CANTON GIRON',
                ),
            384 =>
                array(
                    'code' => '703-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON GIRON',
                ),
            385 =>
                array(
                    'code' => '703-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE GIRON',
                ),
            386 =>
                array(
                    'code' => '704-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON GUALACEO',
                ),
            387 =>
                array(
                    'code' => '704-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE PROTECCION DE DERECHOS DE GUALACEO',
                ),
            388 =>
                array(
                    'code' => '704-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE SEGURIDAD CIUDADANA DE GUALACEO',
                ),
            389 =>
                array(
                    'code' => '704-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON GUALACEO',
                ),
            390 =>
                array(
                    'code' => '704-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE GUALACEO',
                ),
            391 =>
                array(
                    'code' => '705-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL NABON',
                ),
            392 =>
                array(
                    'code' => '705-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE NABON',
                ),
            393 =>
                array(
                    'code' => '705-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON NABON',
                ),
            394 =>
                array(
                    'code' => '706-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON PAUTE',
                ),
            395 =>
                array(
                    'code' => '706-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION INTEGRAL DE DERECHOS DEL CANTON PAUTE',
                ),
            396 =>
                array(
                    'code' => '706-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON PAUTE ',
                ),
            397 =>
                array(
                    'code' => '706-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PAUTE',
                ),
            398 =>
                array(
                    'code' => '707-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON PUCARA',
                ),
            399 =>
                array(
                    'code' => '707-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON PUCARA',
                ),
            400 =>
                array(
                    'code' => '708-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SAN FERNANDO',
                ),
            401 =>
                array(
                    'code' => '708-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SAN FERNANDO',
                ),
            402 =>
                array(
                    'code' => '709-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SANTA ISABEL',
                ),
            403 =>
                array(
                    'code' => '709-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DE SANTA ISABEL',
                ),
            404 =>
                array(
                    'code' => '709-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON SANTA ISABEL',
                ),
            405 =>
                array(
                    'code' => '710-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SIGSIG',
                ),
            406 =>
                array(
                    'code' => '710-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS VOLUNTARIOS DEL SIGSIG',
                ),
            407 =>
                array(
                    'code' => '711-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON ONA',
                ),
            408 =>
                array(
                    'code' => '711-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ACCION SOCIAL MUNICIPAL DEL CANTON ONA',
                ),
            409 =>
                array(
                    'code' => '711-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE PROTECCION DE DERECHOS DE ONA',
                ),
            410 =>
                array(
                    'code' => '711-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS VOLUNTARIOS DEL CANTON ONA',
                ),
            411 =>
                array(
                    'code' => '712-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE CHORDELEG',
                ),
            412 =>
                array(
                    'code' => '712-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA EN EL CANTON CHORDELEG',
                ),
            413 =>
                array(
                    'code' => '712-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE CHORDELEG',
                ),
            414 =>
                array(
                    'code' => '713-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON EL PAN',
                ),
            415 =>
                array(
                    'code' => '713-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON EL PAN',
                ),
            416 =>
                array(
                    'code' => '713-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON EL PAN',
                ),
            417 =>
                array(
                    'code' => '714-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON SEVILLA DE ORO',
                ),
            418 =>
                array(
                    'code' => '714-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE SEVILLA DE ORO',
                ),
            419 =>
                array(
                    'code' => '714-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SEVILLA DE ORO',
                ),
            420 =>
                array(
                    'code' => '715-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON GUACHAPALA',
                ),
            421 =>
                array(
                    'code' => '715-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL PARA LA PROTECCION DE DERECHOS DEL CANTON GUACHAPALA',
                ),
            422 =>
                array(
                    'code' => '715-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON GUACHAPALA',
                ),
            423 =>
                array(
                    'code' => '715-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON GUACHAPALA',
                ),
            424 =>
                array(
                    'code' => '716-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON CAMILO  PONCE  ENRIQUEZ',
                ),
            425 =>
                array(
                    'code' => '716-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON PONCE ENRIQUEZ',
                ),
            426 =>
                array(
                    'code' => '717-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE EL COLLAY',
                ),
            427 =>
                array(
                    'code' => '719-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON GUARANDA',
                ),
            428 =>
                array(
                    'code' => '719-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON GUARANDA CCPDCG',
                ),
            429 =>
                array(
                    'code' => '719-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ACCION SOCIAL COMO ENTIDAD DE INCLUSION SOCIAL MUNICIPAL DEL GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON GUARANDA',
                ),
            430 =>
                array(
                    'code' => '719-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MUNICIPAL DE LA PROPIEDAD DEL CANTON GUARANDA',
                ),
            431 =>
                array(
                    'code' => '719-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS BOLIVAR DE GUARANDA',
                ),
            432 =>
                array(
                    'code' => '720-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE CHILLANES',
                ),
            433 =>
                array(
                    'code' => '720-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON CHILLANES',
                ),
            434 =>
                array(
                    'code' => '721-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON CHIMBO',
                ),
            435 =>
                array(
                    'code' => '721-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON CHIMBO',
                ),
            436 =>
                array(
                    'code' => '721-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SAN JOSE DE CHIMBO',
                ),
            437 =>
                array(
                    'code' => '722-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON ECHEANDIA',
                ),
            438 =>
                array(
                    'code' => '722-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON ECHEANDIA',
                ),
            439 =>
                array(
                    'code' => '722-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE ECHEANDIA',
                ),
            440 =>
                array(
                    'code' => '723-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE SAN MIGUEL',
                ),
            441 =>
                array(
                    'code' => '723-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS SAN MIGUEL DE BOLIVAR',
                ),
            442 =>
                array(
                    'code' => '723-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SAN MIGUEL DE BOLIVAR',
                ),
            443 =>
                array(
                    'code' => '724-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE CALUMA',
                ),
            444 =>
                array(
                    'code' => '724-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE PROTECCION DE DERECHOS DE CALUMA',
                ),
            445 =>
                array(
                    'code' => '724-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON CALUMA',
                ),
            446 =>
                array(
                    'code' => '724-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE CALUMA',
                ),
            447 =>
                array(
                    'code' => '725-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON LAS NAVES',
                ),
            448 =>
                array(
                    'code' => '725-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE LAS NAVES',
                ),
            449 =>
                array(
                    'code' => '725-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD Y MERCANTIL DEL CANTON LAS NAVES',
                ),
            450 =>
                array(
                    'code' => '725-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE LAS NAVES',
                ),
            451 =>
                array(
                    'code' => '726-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE MUNICIPALIDADES DEL SUROCCIDENTE DE LA PROVINCIA DE LOJA BOSQUE SECO',
                ),
            452 =>
                array(
                    'code' => '728-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON CANAR',
                ),
            453 =>
                array(
                    'code' => '729-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE AZOGUES',
                ),
            454 =>
                array(
                    'code' => '729-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON AZOGUES',
                ),
            455 =>
                array(
                    'code' => '729-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE AZOGUES',
                ),
            456 =>
                array(
                    'code' => '729-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DERECHOS DEL CANTON AZOGUES',
                ),
            457 =>
                array(
                    'code' => '730-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE BIBLIAN',
                ),
            458 =>
                array(
                    'code' => '731-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO INTERCULTURAL DEL CANTON CANAR',
                ),
            459 =>
                array(
                    'code' => '731-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DEL CANTON CANAR',
                ),
            460 =>
                array(
                    'code' => '731-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL PARA LA PROTECCION DE DERECHOS DEL CANTON CANAR',
                ),
            461 =>
                array(
                    'code' => '732-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE LA TRONCAL',
                ),
            462 =>
                array(
                    'code' => '732-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE LA TRONCAL',
                ),
            463 =>
                array(
                    'code' => '732-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON LA TRONCAL',
                ),
            464 =>
                array(
                    'code' => '732-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO DE SEGURIDAD CIUDADANA DEL CANTON LA TRONCAL',
                ),
            465 =>
                array(
                    'code' => '732-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON LA TRONCAL',
                ),
            466 =>
                array(
                    'code' => '733-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO INTERCULTURAL MUNICIPAL EL TAMBO',
                ),
            467 =>
                array(
                    'code' => '733-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DEL CANTON EL TAMBO',
                ),
            468 =>
                array(
                    'code' => '733-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL GOBIERNO MUNICIPAL DEL CANTON EL TAMBO',
                ),
            469 =>
                array(
                    'code' => '733-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE EL CANTON EL TAMBO',
                ),
            470 =>
                array(
                    'code' => '734-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON DELEG',
                ),
            471 =>
                array(
                    'code' => '734-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON DELEG',
                ),
            472 =>
                array(
                    'code' => '735-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO INTERCULTURAL PARTICIPATIVO DEL CANTON SUSCAL',
                ),
            473 =>
                array(
                    'code' => '735-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DE SUSCAL',
                ),
            474 =>
                array(
                    'code' => '735-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO DEL GOBIERNO AUTONOMO DESCENTRALIZADO INTERCULTURAL Y PARTICIPATIVO DEL CANTO SUSCAL',
                ),
            475 =>
                array(
                    'code' => '739-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE TULCAN',
                ),
            476 =>
                array(
                    'code' => '739-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO DE AMPARO SOCIAL DEL GAD MUNICIPAL DE TULCAN',
                ),
            477 =>
                array(
                    'code' => '739-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE TULCAN',
                ),
            478 =>
                array(
                    'code' => '739-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MUNICIPAL DE LA PROPIEDAD DEL CANTON TULCAN',
                ),
            479 =>
                array(
                    'code' => '740-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON BOLIVAR',
                ),
            480 =>
                array(
                    'code' => '740-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DEL CANTON BOLIVAR',
                ),
            481 =>
                array(
                    'code' => '740-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON BOLIVAR (CARCHI)',
                ),
            482 =>
                array(
                    'code' => '741-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE ESPEJO',
                ),
            483 =>
                array(
                    'code' => '741-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON ESPEJO',
                ),
            484 =>
                array(
                    'code' => '742-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE MIRA',
                ),
            485 =>
                array(
                    'code' => '742-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD Y MERCANTIL DEL CANTON MIRA',
                ),
            486 =>
                array(
                    'code' => '742-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON MIRA',
                ),
            487 =>
                array(
                    'code' => '743-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON MONTUFAR',
                ),
            488 =>
                array(
                    'code' => '743-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON MONTUFAR',
                ),
            489 =>
                array(
                    'code' => '744-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL SAN PEDRO DE HUACA',
                ),
            490 =>
                array(
                    'code' => '744-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON SAN PEDRO DE HUACA',
                ),
            491 =>
                array(
                    'code' => '744-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON SAN PEDRO DE HUACA',
                ),
            492 =>
                array(
                    'code' => '744-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON SAN PEDRO DE HUACA',
                ),
            493 =>
                array(
                    'code' => '748-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON LATACUNGA',
                ),
            494 =>
                array(
                    'code' => '748-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DE AMPARO SOCIAL DEL GAD MUNICIPAL DEL CANTON LATACUNGA',
                ),
            495 =>
                array(
                    'code' => '748-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE LATACUNGA',
                ),
            496 =>
                array(
                    'code' => '749-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE LA MANA',
                ),
            497 =>
                array(
                    'code' => '749-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE LA MANA',
                ),
            498 =>
                array(
                    'code' => '749-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO DE AMPARO SOCIAL DEL GAD MUNICIPAL DE LA MANA',
                ),
            499 =>
                array(
                    'code' => '749-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE LA MANA',
                ),
        ));
        DB::table('institutions')->insert(array(
            0 =>
                array(
                    'code' => '750-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE PANGUA',
                ),
            1 =>
                array(
                    'code' => '750-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS EL CORAZON',
                ),
            2 =>
                array(
                    'code' => '750-0034',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON PANGUA',
                ),
            3 =>
                array(
                    'code' => '751-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GAD MUNICIPAL DEL CANTON SALCEDO',
                ),
            4 =>
                array(
                    'code' => '751-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA SALCEDO',
                ),
            5 =>
                array(
                    'code' => '751-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SAN MIGUEL DE SALCEDO',
                ),
            6 =>
                array(
                    'code' => '751-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DE AMPARO SOCIAL DE SAN MIGUEL DE SALCEDO',
                ),
            7 =>
                array(
                    'code' => '752-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON PUJILI',
                ),
            8 =>
                array(
                    'code' => '752-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON PUJILI',
                ),
            9 =>
                array(
                    'code' => '752-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON PUJILI',
                ),
            10 =>
                array(
                    'code' => '753-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON SAQUISILI',
                ),
            11 =>
                array(
                    'code' => '753-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE SAQUISILI',
                ),
            12 =>
                array(
                    'code' => '753-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DE AMPARO SOCIAL DE SAQUISILI',
                ),
            13 =>
                array(
                    'code' => '754-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SIGCHOS',
                ),
            14 =>
                array(
                    'code' => '754-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DEL CANTON SIGCHOS',
                ),
            15 =>
                array(
                    'code' => '758-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE RIOBAMBA',
                ),
            16 =>
                array(
                    'code' => '758-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON RIOBAMBA',
                ),
            17 =>
                array(
                    'code' => '759-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON ALAUSI',
                ),
            18 =>
                array(
                    'code' => '759-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE ALAUSI',
                ),
            19 =>
                array(
                    'code' => '759-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMITE GENERAL PERMANENTE DE FIESTAS DE CARNAVAL CANTONIZACION SAN PEDRO DE ALAUSI ANIVERSARIO DE INDEPENDENCIA Y DEMAS ACTIVIDADES TURISTICAS Y CULTURALES',
                ),
            20 =>
                array(
                    'code' => '759-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE ALAUSI',
                ),
            21 =>
                array(
                    'code' => '760-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON COLTA',
                ),
            22 =>
                array(
                    'code' => '760-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL PARA LA PROTECCION DE DERECHOS DE COLTA',
                ),
            23 =>
                array(
                    'code' => '760-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON COLTA',
                ),
            24 =>
                array(
                    'code' => '761-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE CHAMBO',
                ),
            25 =>
                array(
                    'code' => '761-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON CHAMBO',
                ),
            26 =>
                array(
                    'code' => '761-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON CHAMBO',
                ),
            27 =>
                array(
                    'code' => '762-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE CHUNCHI',
                ),
            28 =>
                array(
                    'code' => '762-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE CHUNCHI',
                ),
            29 =>
                array(
                    'code' => '763-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON GUAMOTE',
                ),
            30 =>
                array(
                    'code' => '763-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE GUAMOTE',
                ),
            31 =>
                array(
                    'code' => '763-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE GUAMOTE',
                ),
            32 =>
                array(
                    'code' => '764-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON GUANO',
                ),
            33 =>
                array(
                    'code' => '764-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON GUANO',
                ),
            34 =>
                array(
                    'code' => '765-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE PALLATANGA',
                ),
            35 =>
                array(
                    'code' => '765-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL PARA LA PROTECCION INTEGRAL DE LA NINEZ Y ADOLESCENCIA DEL CANTON PALLATANGA',
                ),
            36 =>
                array(
                    'code' => '765-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PALLATANGA',
                ),
            37 =>
                array(
                    'code' => '766-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON PENIPE',
                ),
            38 =>
                array(
                    'code' => '766-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE PENIPE',
                ),
            39 =>
                array(
                    'code' => '767-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON CUMANDA',
                ),
            40 =>
                array(
                    'code' => '767-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE CUMANDA',
                ),
            41 =>
                array(
                    'code' => '767-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MUNICIPAL DE LA PROPIEDAD Y MERCANTIL DEL CANTON CUMANDA',
                ),
            42 =>
                array(
                    'code' => '767-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE CUMANDA',
                ),
            43 =>
                array(
                    'code' => '771-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE MACHALA',
                ),
            44 =>
                array(
                    'code' => '771-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MUNICIPAL DE LA PROPIEDAD DEL CANTON MACHALA',
                ),
            45 =>
                array(
                    'code' => '771-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS MUNICIPAL DE MACHALA',
                ),
            46 =>
                array(
                    'code' => '772-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE ARENILLAS',
                ),
            47 =>
                array(
                    'code' => '772-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON ARENILLAS',
                ),
            48 =>
                array(
                    'code' => '773-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON ATAHUALPA',
                ),
            49 =>
                array(
                    'code' => '774-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO MUNICIPAL DE BALSAS',
                ),
            50 =>
                array(
                    'code' => '774-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE BALSAS',
                ),
            51 =>
                array(
                    'code' => '775-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE CHILLA',
                ),
            52 =>
                array(
                    'code' => '775-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE CHILLA',
                ),
            53 =>
                array(
                    'code' => '776-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE EL GUABO',
                ),
            54 =>
                array(
                    'code' => '776-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO DE AMPARO SOCIAL DEL GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON EL GUABO',
                ),
            55 =>
                array(
                    'code' => '776-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE EL GUABO',
                ),
            56 =>
                array(
                    'code' => '776-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'LA MANCOMUNIDAD PARA LA GESTION INTEGRAL DE DESECHOS Y SANEAMIENTO AMBIENTAL ENTRE LOS GOBIERNOS AUTONOMOS DESCENTRALIZADOS',
                ),
            57 =>
                array(
                    'code' => '777-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE HUAQUILLAS',
                ),
            58 =>
                array(
                    'code' => '777-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE HUAQUILLAS',
                ),
            59 =>
                array(
                    'code' => '777-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE HUAQUILLAS',
                ),
            60 =>
                array(
                    'code' => '778-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON MARCABELI',
                ),
            61 =>
                array(
                    'code' => '778-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE MARCABELI',
                ),
            62 =>
                array(
                    'code' => '779-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE PASAJE',
                ),
            63 =>
                array(
                    'code' => '779-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON PASAJE (CCPD)',
                ),
            64 =>
                array(
                    'code' => '779-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PASAJE',
                ),
            65 =>
                array(
                    'code' => '780-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZDO MUNICIPAL DE PINAS',
                ),
            66 =>
                array(
                    'code' => '780-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PINAS',
                ),
            67 =>
                array(
                    'code' => '781-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE PORTOVELO',
                ),
            68 =>
                array(
                    'code' => '781-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DE PORTOVELO',
                ),
            69 =>
                array(
                    'code' => '781-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PORTOVELO',
                ),
            70 =>
                array(
                    'code' => '782-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE SANTA ROSA',
                ),
            71 =>
                array(
                    'code' => '782-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DE SANTA ROSA',
                ),
            72 =>
                array(
                    'code' => '782-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SANTA ROSA',
                ),
            73 =>
                array(
                    'code' => '783-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE ZARUMA',
                ),
            74 =>
                array(
                    'code' => '783-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS VOLUNTARIOS DE ZARUMA',
                ),
            75 =>
                array(
                    'code' => '784-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE LAS LAJAS',
                ),
            76 =>
                array(
                    'code' => '784-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON LAS LAJAS (CCPD)',
                ),
            77 =>
                array(
                    'code' => '784-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON LAS LAJAS',
                ),
            78 =>
                array(
                    'code' => '788-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON ESMERALDAS',
                ),
            79 =>
                array(
                    'code' => '788-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE PROTECCON DE DERECHOS DE ESMERALDAS',
                ),
            80 =>
                array(
                    'code' => '788-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON ESMERALDAS',
                ),
            81 =>
                array(
                    'code' => '788-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE ESMERALDAS',
                ),
            82 =>
                array(
                    'code' => '789-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE ELOY ALFARO',
                ),
            83 =>
                array(
                    'code' => '789-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DE AMPARO SOCIAL DE SAN MARTIN DE PORRES DEL GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE ELOY ALFARO',
                ),
            84 =>
                array(
                    'code' => '789-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON ELOY ALFARO',
                ),
            85 =>
                array(
                    'code' => '790-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE MUISNE',
                ),
            86 =>
                array(
                    'code' => '790-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON MUISNE',
                ),
            87 =>
                array(
                    'code' => '790-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE MUISNE',
                ),
            88 =>
                array(
                    'code' => '791-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE QUININDE',
                ),
            89 =>
                array(
                    'code' => '791-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE QUININDE',
                ),
            90 =>
                array(
                    'code' => '791-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON QUININDE',
                ),
            91 =>
                array(
                    'code' => '791-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE QUININDE',
                ),
            92 =>
                array(
                    'code' => '792-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE SAN LORENZO',
                ),
            93 =>
                array(
                    'code' => '792-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SAN LORENZO ESMERALDAS',
                ),
            94 =>
                array(
                    'code' => '793-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE ATACAMES',
                ),
            95 =>
                array(
                    'code' => '793-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON ATACAMES',
                ),
            96 =>
                array(
                    'code' => '794-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE RIOVERDE',
                ),
            97 =>
                array(
                    'code' => '794-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DE RIOVERDE',
                ),
            98 =>
                array(
                    'code' => '794-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON RIOVERDE',
                ),
            99 =>
                array(
                    'code' => '795-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON LA CONCORDIA',
                ),
            100 =>
                array(
                    'code' => '795-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL PARA LA PROTECCION DE DERECHOS DE LA CONCORDIA',
                ),
            101 =>
                array(
                    'code' => '795-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE LA CONCORDIA',
                ),
            102 =>
                array(
                    'code' => '798-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE GUAYAQUIL',
                ),
            103 =>
                array(
                    'code' => '798-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BENEMERITO CUERPO DE BOMBEROS DE GUAYAQUIL  BCBG.',
                ),
            104 =>
                array(
                    'code' => '798-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' CONCEJO CANTONAL DE PROTECCION INTEGRAL DE DERECHOS DE GUAYAQUIL',
                ),
            105 =>
                array(
                    'code' => '799-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE ALFREDO BAQUERIZO MORENO',
                ),
            106 =>
                array(
                    'code' => '799-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE PROTECCION INTEGRAL DE LA NINEZ Y ADOLESCENCIA DE ALFREDO BAQUERIZO MORENO',
                ),
            107 =>
                array(
                    'code' => '799-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE ALFREDO BAQUERIZO MORENO JUJAN',
                ),
            108 =>
                array(
                    'code' => '800-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE BALAO',
                ),
            109 =>
                array(
                    'code' => '800-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO DE PROTECCION DE DERECHOS DE BALAO',
                ),
            110 =>
                array(
                    'code' => '800-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE BALAO',
                ),
            111 =>
                array(
                    'code' => '801-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON BALZAR',
                ),
            112 =>
                array(
                    'code' => '801-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y LA ADOLESCENCIA DEL CANTON BALZAR',
                ),
            113 =>
                array(
                    'code' => '801-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON BALZAR',
                ),
            114 =>
                array(
                    'code' => '801-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE BALZAR',
                ),
            115 =>
                array(
                    'code' => '802-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE COLIMES',
                ),
            116 =>
                array(
                    'code' => '802-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON COLIMES',
                ),
            117 =>
                array(
                    'code' => '802-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE COLIMES',
                ),
            118 =>
                array(
                    'code' => '803-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO ILUSTRE MUNICIPALIDAD DEL CANTON DAULE',
                ),
            119 =>
                array(
                    'code' => '803-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS VOLUNTARIOS DE DAULE',
                ),
            120 =>
                array(
                    'code' => '804-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE DURAN',
                ),
            121 =>
                array(
                    'code' => '804-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL PARA LA PROTECCION DE DERECHOS DEL CANTON DURAN',
                ),
            122 =>
                array(
                    'code' => '804-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON DURAN',
                ),
            123 =>
                array(
                    'code' => '804-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'SECRETARIA EJECUTIVA DEL CONSEJO DE SEGURIDAD DEL CANTON DURAN',
                ),
            124 =>
                array(
                    'code' => '804-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON DURAN',
                ),
            125 =>
                array(
                    'code' => '805-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE EL EMPALME',
                ),
            126 =>
                array(
                    'code' => '805-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON EL EMPALME',
                ),
            127 =>
                array(
                    'code' => '805-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON EL EMPALME',
                ),
            128 =>
                array(
                    'code' => '806-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON EL TRIUNFO',
                ),
            129 =>
                array(
                    'code' => '806-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL PARA LA PROTECCION DE DERECHOS DEL CANTON EL TRIUNFO',
                ),
            130 =>
                array(
                    'code' => '806-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON EL TRIUNFO',
                ),
            131 =>
                array(
                    'code' => '807-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE MILAGRO',
                ),
            132 =>
                array(
                    'code' => '807-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON MILAGRO',
                ),
            133 =>
                array(
                    'code' => '807-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD Y MERCANTIL DEL CANTON SAN FRANCISCO DE MILAGRO',
                ),
            134 =>
                array(
                    'code' => '808-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON NARANJAL',
                ),
            135 =>
                array(
                    'code' => '808-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON NARANJAL',
                ),
            136 =>
                array(
                    'code' => '808-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD Y MERCANTIL DEL CANTON NARANJAL',
                ),
            137 =>
                array(
                    'code' => '808-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE NARANJAL',
                ),
            138 =>
                array(
                    'code' => '809-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE NARANJITO',
                ),
            139 =>
                array(
                    'code' => '809-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON NARANJITO',
                ),
            140 =>
                array(
                    'code' => '809-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE NARANJITO',
                ),
            141 =>
                array(
                    'code' => '810-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE PALESTINA',
                ),
            142 =>
                array(
                    'code' => '810-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON PALESTINA',
                ),
            143 =>
                array(
                    'code' => '810-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON PALESTINA',
                ),
            144 =>
                array(
                    'code' => '811-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON PEDRO CARBO',
                ),
            145 =>
                array(
                    'code' => '811-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON PEDRO CARBO',
                ),
            146 =>
                array(
                    'code' => '811-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PEDRO CARBO',
                ),
            147 =>
                array(
                    'code' => '812-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SALINAS',
                ),
            148 =>
                array(
                    'code' => '812-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON SALINAS',
                ),
            149 =>
                array(
                    'code' => '812-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SALINAS',
                ),
            150 =>
                array(
                    'code' => '813-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON SAMBORONDON',
                ),
            151 =>
                array(
                    'code' => '813-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON SAMBORONDON',
                ),
            152 =>
                array(
                    'code' => '814-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE SANTA ELENA',
                ),
            153 =>
                array(
                    'code' => '814-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE SANTA ELENA',
                ),
            154 =>
                array(
                    'code' => '814-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SANTA ELENA',
                ),
            155 =>
                array(
                    'code' => '815-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON SANTA LUCIA',
                ),
            156 =>
                array(
                    'code' => '815-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DEL CANTON SANTA LUCIA',
                ),
            157 =>
                array(
                    'code' => '815-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON SANTA LUCIA',
                ),
            158 =>
                array(
                    'code' => '816-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SALITRE',
                ),
            159 =>
                array(
                    'code' => '816-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DE SALITRE',
                ),
            160 =>
                array(
                    'code' => '816-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SALITRE',
                ),
            161 =>
                array(
                    'code' => '817-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SAN JACINTO DE YAGUACHI',
                ),
            162 =>
                array(
                    'code' => '817-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLECENCIA DEL CANTON SAN JACINTO DE YAGUACHI',
                ),
            163 =>
                array(
                    'code' => '817-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON SAN JACINTO DE YAGUACHI',
                ),
            164 =>
                array(
                    'code' => '817-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON SAN JACINTO DE YAGUACHI',
                ),
            165 =>
                array(
                    'code' => '817-0034',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD MUNICIPAL DE GESTION DE LOS SERVICIOS DE PREVENCION SOCORRO Y EXTINCION DE INCENDIOS DE SAN JACINTO DE YAGUACHI',
                ),
            166 =>
                array(
                    'code' => '818-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON PLAYAS',
                ),
            167 =>
                array(
                    'code' => '818-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON PLAYAS',
                ),
            168 =>
                array(
                    'code' => '818-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MUNICIPAL DE LA PROPIEDAD DEL CANTON PLAYAS',
                ),
            169 =>
                array(
                    'code' => '818-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON PLAYAS',
                ),
            170 =>
                array(
                    'code' => '819-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON SIMON BOLIVAR',
                ),
            171 =>
                array(
                    'code' => '819-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MUNICIPAL DE LA PROPIEDAD DEL CANTON SIMON BOLIVAR',
                ),
            172 =>
                array(
                    'code' => '820-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE MARCELINO  MARIDUENA',
                ),
            173 =>
                array(
                    'code' => '820-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON CORONEL MARCELINO MARIDUENA',
                ),
            174 =>
                array(
                    'code' => '820-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE MARCELINO MARIDUENA',
                ),
            175 =>
                array(
                    'code' => '821-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON LOMAS DE SARGENTILLO',
                ),
            176 =>
                array(
                    'code' => '821-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DERECHOS DEL CANTON LOMAS DE SARGENTILLO',
                ),
            177 =>
                array(
                    'code' => '821-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON LOMAS DE SARGENTILLO',
                ),
            178 =>
                array(
                    'code' => '821-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON LOMAS DE SARGENTILLO',
                ),
            179 =>
                array(
                    'code' => '822-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE NOBOL',
                ),
            180 =>
                array(
                    'code' => '822-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON NOBOL',
                ),
            181 =>
                array(
                    'code' => '822-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE EL CANTON NOBOL',
                ),
            182 =>
                array(
                    'code' => '823-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON LA LIBERTAD',
                ),
            183 =>
                array(
                    'code' => '823-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE LA LIBERTAD',
                ),
            184 =>
                array(
                    'code' => '823-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE EL CANTON LA LIBERTAD',
                ),
            185 =>
                array(
                    'code' => '824-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE GENERAL ANTONIO ELIZALDE',
                ),
            186 =>
                array(
                    'code' => '824-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON GENERAL ANTONIO ELIZALDE DE BUCAY',
                ),
            187 =>
                array(
                    'code' => '824-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DE DESARROLLO SOCIAL DEL CANTON GENERAL ANTONIO ELIZALDE',
                ),
            188 =>
                array(
                    'code' => '824-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON GENERAL ANTONIO ELIZALDE (BUCAY)',
                ),
            189 =>
                array(
                    'code' => '825-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE ISIDRO AYORA',
                ),
            190 =>
                array(
                    'code' => '825-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON ISIDRO AYORA',
                ),
            191 =>
                array(
                    'code' => '825-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON ISIDRO AYORA',
                ),
            192 =>
                array(
                    'code' => '829-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE IBARRA',
                ),
            193 =>
                array(
                    'code' => '829-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON IBARRA',
                ),
            194 =>
                array(
                    'code' => '829-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE IBARRA',
                ),
            195 =>
                array(
                    'code' => '830-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE ANTONIO ANTE',
                ),
            196 =>
                array(
                    'code' => '830-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON ANTONIO ANTE',
                ),
            197 =>
                array(
                    'code' => '830-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE ANTONIO ANTE',
                ),
            198 =>
                array(
                    'code' => '831-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SANTA ANA DE COTACACHI',
                ),
            199 =>
                array(
                    'code' => '831-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE COTACACHI',
                ),
            200 =>
                array(
                    'code' => '832-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON OTAVALO',
                ),
            201 =>
                array(
                    'code' => '832-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON OTAVALO',
                ),
            202 =>
                array(
                    'code' => '832-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON OTAVALO',
                ),
            203 =>
                array(
                    'code' => '833-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SAN PEDRO DE PIMAMPIRO',
                ),
            204 =>
                array(
                    'code' => '833-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON PIMAMPIRO',
                ),
            205 =>
                array(
                    'code' => '833-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PIMAMPIRO',
                ),
            206 =>
                array(
                    'code' => '834-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SAN MIGUEL DE URCUQUI',
                ),
            207 =>
                array(
                    'code' => '834-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE URCUQUI',
                ),
            208 =>
                array(
                    'code' => '838-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE LOJA',
                ),
            209 =>
                array(
                    'code' => '838-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DEL CANTON LOJA',
                ),
            210 =>
                array(
                    'code' => '838-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO DE AMPARO SOCIAL MUNICIPAL',
                ),
            211 =>
                array(
                    'code' => '838-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE LOJA',
                ),
            212 =>
                array(
                    'code' => '838-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE SEGURIDAD CIUDADANA DE LOJA',
                ),
            213 =>
                array(
                    'code' => '838-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON LOJA',
                ),
            214 =>
                array(
                    'code' => '839-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON CALVAS',
                ),
            215 =>
                array(
                    'code' => '839-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE GRUPOS DE ATENCION PRIORITARIA DEL CANTON CALVAS',
                ),
            216 =>
                array(
                    'code' => '839-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE DESARROLLO SOCIAL DEL GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON CALVAS',
                ),
            217 =>
                array(
                    'code' => '839-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE CARIAMANGA-CALVAS',
                ),
            218 =>
                array(
                    'code' => '840-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE CATAMAYO',
                ),
            219 =>
                array(
                    'code' => '840-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CONTONAL PARA LA PROTECCION DE DERECHOS A GRUPOS DE ATENCION PRIORITARIA DE CATAMAYO',
                ),
            220 =>
                array(
                    'code' => '840-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON CATAMAYO',
                ),
            221 =>
                array(
                    'code' => '841-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE CELICA',
                ),
            222 =>
                array(
                    'code' => '841-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DE ATENCION SOCIAL PRIORITARIA DEL CANTON CELICA',
                ),
            223 =>
                array(
                    'code' => '841-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE CELICA',
                ),
            224 =>
                array(
                    'code' => '842-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON CHAGUARPAMBA',
                ),
            225 =>
                array(
                    'code' => '842-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE CHAGUARPAMBA',
                ),
            226 =>
                array(
                    'code' => '843-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE ESPINDOLA',
                ),
            227 =>
                array(
                    'code' => '843-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON ESPINDOLA',
                ),
            228 =>
                array(
                    'code' => '844-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO MUNICIPAL DEL CANTON GONZANAMA',
                ),
            229 =>
                array(
                    'code' => '844-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON GONZANAMA',
                ),
            230 =>
                array(
                    'code' => '845-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON MACARA',
                ),
            231 =>
                array(
                    'code' => '845-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE MACARA',
                ),
            232 =>
                array(
                    'code' => '846-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON PALTAS',
                ),
            233 =>
                array(
                    'code' => '846-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL PARA LA PROTECCION INTEGRAL DE DERECHOS A GRUPOS DE ATENCION PRIORITARIA DEL CANTON PALTAS',
                ),
            234 =>
                array(
                    'code' => '847-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE PUYANGO',
                ),
            235 =>
                array(
                    'code' => '847-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DE PUYANGO',
                ),
            236 =>
                array(
                    'code' => '847-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE ALAMOR CANTON PUYANGO',
                ),
            237 =>
                array(
                    'code' => '848-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL INTERCULTURAL DE SARAGURO',
                ),
            238 =>
                array(
                    'code' => '848-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL INTEGRAL DE PROTECCION DE DERECHOS DEL CANTON SARAGURO',
                ),
            239 =>
                array(
                    'code' => '848-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SARAGURO',
                ),
            240 =>
                array(
                    'code' => '849-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE SOZORANGA',
                ),
            241 =>
                array(
                    'code' => '849-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON SOZORANGA',
                ),
            242 =>
                array(
                    'code' => '850-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON ZAPOTILLO',
                ),
            243 =>
                array(
                    'code' => '850-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE ZAPOTILLO',
                ),
            244 =>
                array(
                    'code' => '851-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE PINDAL',
                ),
            245 =>
                array(
                    'code' => '851-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO DE AMPARO SOCIAL DEL GOBIERNO CANTONAL DE PINDAL',
                ),
            246 =>
                array(
                    'code' => '851-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON PINDAL',
                ),
            247 =>
                array(
                    'code' => '852-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON QUILANGA',
                ),
            248 =>
                array(
                    'code' => '852-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON QUILANGA',
                ),
            249 =>
                array(
                    'code' => '853-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON OLMEDO',
                ),
            250 =>
                array(
                    'code' => '853-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON OLMEDO  LOJA',
                ),
            251 =>
                array(
                    'code' => '857-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON BABAHOYO',
                ),
            252 =>
                array(
                    'code' => '857-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON BABAHOYO',
                ),
            253 =>
                array(
                    'code' => '857-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO DE ACCION SOCIAL DEL GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON BABAHOYO',
                ),
            254 =>
                array(
                    'code' => '857-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS MUNICIPAL DEL CANTON BABAHOYO',
                ),
            255 =>
                array(
                    'code' => '858-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE BABA',
                ),
            256 =>
                array(
                    'code' => '858-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON BABA',
                ),
            257 =>
                array(
                    'code' => '858-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD Y MERCANTIL DEL CANTON BABA',
                ),
            258 =>
                array(
                    'code' => '858-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE BABA',
                ),
            259 =>
                array(
                    'code' => '858-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO DE SEGURIDAD CIUDADANA DEL CANTON BABA',
                ),
            260 =>
                array(
                    'code' => '859-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON MONTALVO',
                ),
            261 =>
                array(
                    'code' => '859-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON MONTALVO',
                ),
            262 =>
                array(
                    'code' => '859-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON MONTALVO',
                ),
            263 =>
                array(
                    'code' => '860-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON SAN FRANCISCO DE PUEBLOVIEJO',
                ),
            264 =>
                array(
                    'code' => '860-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON SAN FRANCISCO DE PUEBLOVIEJO',
                ),
            265 =>
                array(
                    'code' => '860-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS MUNICIPAL DE PUEBLOVIEJO',
                ),
            266 =>
                array(
                    'code' => '861-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON QUEVEDO',
                ),
            267 =>
                array(
                    'code' => '861-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD ADMINISTRATIVA MUNICIPAL QUEVEDO SHOPPING CENTER',
                ),
            268 =>
                array(
                    'code' => '861-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD MUNICPAL DEL CANTON QUEVEDO',
                ),
            269 =>
                array(
                    'code' => '861-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE QUEVEDO',
                ),
            270 =>
                array(
                    'code' => '862-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE URDANETA',
                ),
            271 =>
                array(
                    'code' => '862-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON URDANETA',
                ),
            272 =>
                array(
                    'code' => '862-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE CATARAMA',
                ),
            273 =>
                array(
                    'code' => '863-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO MUNICIPAL DEL CANTON VENTANAS',
                ),
            274 =>
                array(
                    'code' => '863-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE VENTANAS',
                ),
            275 =>
                array(
                    'code' => '864-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRAIZADO MUNICIPAL DEL CANTON VINCES',
                ),
            276 =>
                array(
                    'code' => '864-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON VINCES',
                ),
            277 =>
                array(
                    'code' => '864-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON VINCES',
                ),
            278 =>
                array(
                    'code' => '864-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE VINCES',
                ),
            279 =>
                array(
                    'code' => '865-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE PALENQUE',
                ),
            280 =>
                array(
                    'code' => '865-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON PALENQUE',
                ),
            281 =>
                array(
                    'code' => '865-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PALENQUE',
                ),
            282 =>
                array(
                    'code' => '866-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SAN JACINTO DE BUENA FE',
                ),
            283 =>
                array(
                    'code' => '866-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE SAN JACINTO DE BUENA FE',
                ),
            284 =>
                array(
                    'code' => '866-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON BUENA FE',
                ),
            285 =>
                array(
                    'code' => '867-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON VALENCIA',
                ),
            286 =>
                array(
                    'code' => '868-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON MOCACHE',
                ),
            287 =>
                array(
                    'code' => '868-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE MOCACHE',
                ),
            288 =>
                array(
                    'code' => '869-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON QUINSALOMA',
                ),
            289 =>
                array(
                    'code' => '869-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE PROTECCION DE DERECHOS DE QUINSALOMA',
                ),
            290 =>
                array(
                    'code' => '869-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE QUINSALOMA',
                ),
            291 =>
                array(
                    'code' => '872-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON PORTOVIEJO',
                ),
            292 =>
                array(
                    'code' => '872-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL PARA LA PROTECCION DE DERECHOS DE PORTOVIEJO',
                ),
            293 =>
                array(
                    'code' => '872-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PORTOVIEJO',
                ),
            294 =>
                array(
                    'code' => '873-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON BOLIVAR',
                ),
            295 =>
                array(
                    'code' => '873-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS CASIMIRO FARFAN DEL CANTON BOLIVAR',
                ),
            296 =>
                array(
                    'code' => '873-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD Y MERCANTIL DEL CANTON BOLIVAR',
                ),
            297 =>
                array(
                    'code' => '874-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON CHONE',
                ),
            298 =>
                array(
                    'code' => '874-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD Y MERCANTIL DEL CANTON CHONE',
                ),
            299 =>
                array(
                    'code' => '874-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE CHONE',
                ),
            300 =>
                array(
                    'code' => '875-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE EL CARMEN',
                ),
            301 =>
                array(
                    'code' => '876-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON FLAVIO ALFARO',
                ),
            302 =>
                array(
                    'code' => '876-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD TECNICA ESPECIALIZADA DE ATENCION A LAS PERSONAS Y GRUPOS DE ATENCION PRIORITARIA ADSCRITA AL GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON FLAVIO ALFARO',
                ),
            303 =>
                array(
                    'code' => '876-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS VOLUNTARIOS DEL CANTON FLAVIO ALFARO',
                ),
            304 =>
                array(
                    'code' => '877-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE JIPIJAPA',
                ),
            305 =>
                array(
                    'code' => '877-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE PROTECCION INTEGRAL DE LA NINEZ Y ADOLESCENCIA DEL CANTON JIPIJAPA',
                ),
            306 =>
                array(
                    'code' => '877-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE JIPIJAPA',
                ),
            307 =>
                array(
                    'code' => '878-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON JUNIN',
                ),
            308 =>
                array(
                    'code' => '878-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE JUNIN',
                ),
            309 =>
                array(
                    'code' => '879-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON MANTA',
                ),
            310 =>
                array(
                    'code' => '879-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE MANTA CCPD-M',
                ),
            311 =>
                array(
                    'code' => '879-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE MANTA',
                ),
            312 =>
                array(
                    'code' => '880-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON MONTECRISTI',
                ),
            313 =>
                array(
                    'code' => '880-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DE AMPARO SOCIAL DE  MONTECRISTI',
                ),
            314 =>
                array(
                    'code' => '880-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE MONTECRISTI',
                ),
            315 =>
                array(
                    'code' => '881-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE PAJAN',
                ),
            316 =>
                array(
                    'code' => '881-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DEL NINO Y LA MUJER DE DESARROLLO SOCIAL DEL CANTON PAJAN AURA ALMEIDA DE MORAN',
                ),
            317 =>
                array(
                    'code' => '881-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PAJAN',
                ),
            318 =>
                array(
                    'code' => '882-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE PICHINCHA',
                ),
            319 =>
                array(
                    'code' => '882-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DEL CANTON PICHINCHA',
                ),
            320 =>
                array(
                    'code' => '882-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD Y MERCANTIL DEL CANTON PICHINCHA',
                ),
            321 =>
                array(
                    'code' => '882-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS RAMON ZAMBRANO REZAVALA DE PICHINCHA',
                ),
            322 =>
                array(
                    'code' => '883-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE ROCAFUERTE',
                ),
            323 =>
                array(
                    'code' => '883-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE ROCAFUERTE',
                ),
            324 =>
                array(
                    'code' => '884-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON SANTA ANA',
                ),
            325 =>
                array(
                    'code' => '884-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MUNICIPAL DE LA PROPIEDAD Y MERCANTIL DEL CANTON SANTA ANA',
                ),
            326 =>
                array(
                    'code' => '884-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON SANTA ANA',
                ),
            327 =>
                array(
                    'code' => '884-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SANTA ANA',
                ),
            328 =>
                array(
                    'code' => '885-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON SUCRE',
                ),
            329 =>
                array(
                    'code' => '885-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION INTEGRAL DE LOS DERECHOS DE LOS GRUPOS DE ATENCION PRIORITARIA DEL CANTON SUCRE',
                ),
            330 =>
                array(
                    'code' => '885-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON SUCRE',
                ),
            331 =>
                array(
                    'code' => '885-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON SUCRE',
                ),
            332 =>
                array(
                    'code' => '886-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON TOSAGUA',
                ),
            333 =>
                array(
                    'code' => '886-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE TOSAGUA',
                ),
            334 =>
                array(
                    'code' => '887-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE 24 DE MAYO',
                ),
            335 =>
                array(
                    'code' => '887-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PEDERNALES',
                ),
            336 =>
                array(
                    'code' => '888-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE PEDERNALES',
                ),
            337 =>
                array(
                    'code' => '888-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD Y MERCANTIL EN EL CANTON PERDERNALES',
                ),
            338 =>
                array(
                    'code' => '888-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS 24 DE MAYO',
                ),
            339 =>
                array(
                    'code' => '889-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON OLMEDO-MANABI',
                ),
            340 =>
                array(
                    'code' => '889-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON OLMEDO',
                ),
            341 =>
                array(
                    'code' => '890-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON PUERTO LOPEZ',
                ),
            342 =>
                array(
                    'code' => '890-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DE DESARROLLO SOCIAL DEL GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON PUERTO LOPEZ',
                ),
            343 =>
                array(
                    'code' => '890-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MUNICIPAL DE LA PROPIEDAD DEL CANTON PUERTO LOPEZ',
                ),
            344 =>
                array(
                    'code' => '890-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON PUERTO LOPEZ',
                ),
            345 =>
                array(
                    'code' => '891-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE JAMA',
                ),
            346 =>
                array(
                    'code' => '891-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE JAMA',
                ),
            347 =>
                array(
                    'code' => '892-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON JARAMIJO',
                ),
            348 =>
                array(
                    'code' => '892-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE JARAMIJO - CCPDJAR',
                ),
            349 =>
                array(
                    'code' => '892-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MUNICIPAL DE LA PROPIEDAD DEL CANTON JARAMIJO',
                ),
            350 =>
                array(
                    'code' => '892-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE JARAMIJO',
                ),
            351 =>
                array(
                    'code' => '893-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON SAN VICENTE',
                ),
            352 =>
                array(
                    'code' => '893-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON SAN VICENTE',
                ),
            353 =>
                array(
                    'code' => '893-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SAN VICENTE',
                ),
            354 =>
                array(
                    'code' => '897-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO MUNICIPAL DEL CANTON MORONA',
                ),
            355 =>
                array(
                    'code' => '897-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS PARA GRUPOS DE ATENCION PRIORITARIA DEL CANTON MORONA',
                ),
            356 =>
                array(
                    'code' => '897-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL GOBIERNO MUNICIPAL DEL CANTON MORONA',
                ),
            357 =>
                array(
                    'code' => '898-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE GUALAQUIZA',
                ),
            358 =>
                array(
                    'code' => '898-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON GUALAQUIZA',
                ),
            359 =>
                array(
                    'code' => '898-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE GUALAQUIZA',
                ),
            360 =>
                array(
                    'code' => '899-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE LIMON INDANZA',
                ),
            361 =>
                array(
                    'code' => '899-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON LIMON INDANZA',
                ),
            362 =>
                array(
                    'code' => '899-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS TENIENTE HUGO ORTIZ DE LIMON I NDANZA',
                ),
            363 =>
                array(
                    'code' => '900-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE PALORA',
                ),
            364 =>
                array(
                    'code' => '900-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON PALORA',
                ),
            365 =>
                array(
                    'code' => '900-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON PALORA',
                ),
            366 =>
                array(
                    'code' => '901-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON SANTIAGO',
                ),
            367 =>
                array(
                    'code' => '901-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON SANTIAGO',
                ),
            368 =>
                array(
                    'code' => '902-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON SUCUA',
                ),
            369 =>
                array(
                    'code' => '902-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MUNICIPAL DE LA PROPIEDAD DEL CANTON SUCUA',
                ),
            370 =>
                array(
                    'code' => '902-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL GAD MUNICIPAL DEL CANTON SUCUA',
                ),
            371 =>
                array(
                    'code' => '903-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE HUAMBOYA',
                ),
            372 =>
                array(
                    'code' => '903-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON HUAMBOYA',
                ),
            373 =>
                array(
                    'code' => '904-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SAN JUAN BOSCO',
                ),
            374 =>
                array(
                    'code' => '904-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON SAN JUAN BOSCO',
                ),
            375 =>
                array(
                    'code' => '905-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE TAISHA',
                ),
            376 =>
                array(
                    'code' => '905-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE TAISHA',
                ),
            377 =>
                array(
                    'code' => '905-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON TAISHA',
                ),
            378 =>
                array(
                    'code' => '906-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE LOGRONO',
                ),
            379 =>
                array(
                    'code' => '906-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON LOGRONO',
                ),
            380 =>
                array(
                    'code' => '907-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON PABLO SEXTO',
                ),
            381 =>
                array(
                    'code' => '907-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PABLO SEXTO No 1. KAKARAM ',
                ),
            382 =>
                array(
                    'code' => '908-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE TIWINTZA',
                ),
            383 =>
                array(
                    'code' => '911-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE TENA',
                ),
            384 =>
                array(
                    'code' => '911-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'DIRECCION DE DESARROLLO SOCIALDEL GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE TENA',
                ),
            385 =>
                array(
                    'code' => '911-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE TENA',
                ),
            386 =>
                array(
                    'code' => '911-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE TENA',
                ),
            387 =>
                array(
                    'code' => '912-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE ARCHIDONA',
                ),
            388 =>
                array(
                    'code' => '912-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS MUNICIPAL DEL CANTON ARCHIDONA',
                ),
            389 =>
                array(
                    'code' => '913-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE EL CHACO',
                ),
            390 =>
                array(
                    'code' => '913-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CHACO',
                ),
            391 =>
                array(
                    'code' => '914-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE QUIJOS',
                ),
            392 =>
                array(
                    'code' => '914-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON QUIJOS',
                ),
            393 =>
                array(
                    'code' => '914-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON QUIJOS',
                ),
            394 =>
                array(
                    'code' => '915-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE CARLOS JULIO AROSEMENA',
                ),
            395 =>
                array(
                    'code' => '915-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON CARLOS JULIO AROSEMENA TOLA',
                ),
            396 =>
                array(
                    'code' => '915-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON CARLOS JULIO AROSEMENA TOLA',
                ),
            397 =>
                array(
                    'code' => '919-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE PASTAZA',
                ),
            398 =>
                array(
                    'code' => '919-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS MUNICIPAL DEL CANTON PASTAZA',
                ),
            399 =>
                array(
                    'code' => '920-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON MERA',
                ),
            400 =>
                array(
                    'code' => '920-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL PROTECCION DE DERECHOS DEL CANTON MERA',
                ),
            401 =>
                array(
                    'code' => '920-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO DE AMPARO SOCIAL MUNICIPAL DEL CANTON MERA',
                ),
            402 =>
                array(
                    'code' => '920-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE MERA',
                ),
            403 =>
                array(
                    'code' => '921-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SANTA CLARA',
                ),
            404 =>
                array(
                    'code' => '921-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON SANTA CLARA',
                ),
            405 =>
                array(
                    'code' => '922-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE ARAJUNO',
                ),
            406 =>
                array(
                    'code' => '922-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE ARAJUNO',
                ),
            407 =>
                array(
                    'code' => '926-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE DISTRITO METROPOLITANO DE QUITO',
                ),
            408 =>
                array(
                    'code' => '926-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO METROPOLITANO DE PROTECCION INTEGRAL A LA NINEZ Y ADOLESCENCIA',
                ),
            409 =>
                array(
                    'code' => '926-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD PATRONATO MUNICIPAL SAN JOSE',
                ),
            410 =>
                array(
                    'code' => '926-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD ESPECIAL REGULA TU BARRIO',
                ),
            411 =>
                array(
                    'code' => '926-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO METROPOLITANO DE PATRIMONIO',
                ),
            412 =>
                array(
                    'code' => '926-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ADMINISTRACION MUNICIPAL ZONA CENTRO',
                ),
            413 =>
                array(
                    'code' => '926-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ADMINISTRACION MUNICIPAL ZONA ELOY ALFARO',
                ),
            414 =>
                array(
                    'code' => '926-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ADMINISTRACION ZONAL CALDERON MDMQ',
                ),
            415 =>
                array(
                    'code' => '926-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE QUITO ZONA LA DELICIA',
                ),
            416 =>
                array(
                    'code' => '926-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE QUITO ZONA NORTE',
                ),
            417 =>
                array(
                    'code' => '926-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE QUITO ZONA QUITUMBE',
                ),
            418 =>
                array(
                    'code' => '926-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE QUITO ZONA VALLE DE LOS CHILLOS',
                ),
            419 =>
                array(
                    'code' => '926-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE QUITO ZONA VALLE DE TUMBACO',
                ),
            420 =>
                array(
                    'code' => '926-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EDUCATIVA MUNICIPAL EXPERIMENTAL ANTONIO JOSE DE SUCRE',
                ),
            421 =>
                array(
                    'code' => '926-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE QUITO UNIDAD EDUCATIVA MUNICIPAL EXPERIMENTAL EUGENIO ESPEJO',
                ),
            422 =>
                array(
                    'code' => '926-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EDUCATIVA MUNICIPAL QUITUMBE',
                ),
            423 =>
                array(
                    'code' => '926-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE QUITO COLEGIO FERNANDEZ MADRID',
                ),
            424 =>
                array(
                    'code' => '926-0020',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE QUITO COLEGIO SEBASTIAN DE BENALCAZAR',
                ),
            425 =>
                array(
                    'code' => '926-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD METROPOLITANA DE SALUD CENTRO',
                ),
            426 =>
                array(
                    'code' => '926-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD METROPOLITANA DE SALUD NORTE',
                ),
            427 =>
                array(
                    'code' => '926-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD MUNICIPAL DE SALUD SUR',
                ),
            428 =>
                array(
                    'code' => '926-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'POLICIA METROPOLITANA DE QUITO',
                ),
            429 =>
                array(
                    'code' => '926-0025',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL DISTRITO METROPOLITANO DE QUITO',
                ),
            430 =>
                array(
                    'code' => '926-0027',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EDUCATIVA MILENIO BICENTENARIO',
                ),
            431 =>
                array(
                    'code' => '926-0028',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EDUCATIVA MUNICIPAL OSWALDO LOMBEYDA',
                ),
            432 =>
                array(
                    'code' => '926-0029',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EDUCATIVA MUNICIPAL TECNICA Y EN CIENCIAS SAN FRANCISCO DE QUITO',
                ),
            433 =>
                array(
                    'code' => '926-0030',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EDUCATIVA MUNICIPAL JULIO E MORENO',
                ),
            434 =>
                array(
                    'code' => '926-0031',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EJECUTORA DE COMERCIO POPULAR',
                ),
            435 =>
                array(
                    'code' => '926-0032',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA DE COORDINACION DISTRITAL DEL COMERCIO',
                ),
            436 =>
                array(
                    'code' => '926-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL DISTRITO METROPOLITANO DE QUITO',
                ),
            437 =>
                array(
                    'code' => '926-0034',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ADMINISTRACION ESPECIAL TURISTICA LA MARISCAL',
                ),
            438 =>
                array(
                    'code' => '926-0035',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'AGENCIA METROPOLITANA DE CONTROL DE TRANSPORTE TERRESTRE TRANSITO Y SEGURIDAD VIAL DEL DISTRITO METROPOLITANO DE QUITO',
                ),
            439 =>
                array(
                    'code' => '926-0036',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FONDO AMBIENTAL',
                ),
            440 =>
                array(
                    'code' => '926-0037',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO METROPOLITANO DE PLANIFICACION URBANA IMPU',
                ),
            441 =>
                array(
                    'code' => '927-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON CAYAMBE',
                ),
            442 =>
                array(
                    'code' => '927-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON CAYAMBE',
                ),
            443 =>
                array(
                    'code' => '927-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EJECUTORA PARA LA PROTECCION DE DERECHOS',
                ),
            444 =>
                array(
                    'code' => '927-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON CAYAMBE',
                ),
            445 =>
                array(
                    'code' => '927-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON CAYAMBE',
                ),
            446 =>
                array(
                    'code' => '927-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO DE SEGURIDAD CIUDADANA DEL GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON CAYAMBE',
                ),
            447 =>
                array(
                    'code' => '928-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON MEJIA',
                ),
            448 =>
                array(
                    'code' => '928-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' CONSEJO CANTONAL PARA LA PROTECCION DE DERECHOS DEL CANTON MEJIA',
                ),
            449 =>
                array(
                    'code' => '928-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ACCION SOCIAL DEL GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON MEJIA ',
                ),
            450 =>
                array(
                    'code' => '928-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON MEJIA',
                ),
            451 =>
                array(
                    'code' => '929-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE PEDRO MONCAYO',
                ),
            452 =>
                array(
                    'code' => '929-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' CONSEJO CANTONAL PARA LA PROTECCION INTEGRAL DE DERECHOS DEL CANTON PEDRO MONCAYO',
                ),
            453 =>
                array(
                    'code' => '929-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD Y MERCANTIL DEL CANTON PEDRO MONCAYO',
                ),
            454 =>
                array(
                    'code' => '929-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PEDRO MONCAYO',
                ),
            455 =>
                array(
                    'code' => '930-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON RUMINAHUI GADMUR',
                ),
            456 =>
                array(
                    'code' => '930-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE RUMINAHUI (COPRODER)',
                ),
            457 =>
                array(
                    'code' => '930-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MISION SOCIAL RUMINAHUI',
                ),
            458 =>
                array(
                    'code' => '930-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD Y MERCANTIL DEL CANTON RUMINAHUI',
                ),
            459 =>
                array(
                    'code' => '931-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SANTO DOMINGO',
                ),
            460 =>
                array(
                    'code' => '931-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DE INCLUSION SOCIAL DEL GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SANTO DOM',
                ),
            461 =>
                array(
                    'code' => '931-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL PARA LA PROTECCION DE DERECHOS DE SANTO DOMINGO',
                ),
            462 =>
                array(
                    'code' => '931-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON SANTO DOMINGO',
                ),
            463 =>
                array(
                    'code' => '931-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SANTO DOMINGO',
                ),
            464 =>
                array(
                    'code' => '932-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE SAN MIGUEL DE  LOS BANCOS',
                ),
            465 =>
                array(
                    'code' => '932-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SAN MIGUEL DE LOS BANCOS',
                ),
            466 =>
                array(
                    'code' => '933-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE PEDRO VICENTE MALDONADO',
                ),
            467 =>
                array(
                    'code' => '933-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DEL CANTON PEDRO VICENTE MALDONADO',
                ),
            468 =>
                array(
                    'code' => '933-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON PEDRO VICENTE MALDONADO',
                ),
            469 =>
                array(
                    'code' => '933-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON PEDRO VICENTE MALDONADO',
                ),
            470 =>
                array(
                    'code' => '934-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON PUERTO QUITO',
                ),
            471 =>
                array(
                    'code' => '934-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DEL CANTON PUERTO QUITO',
                ),
            472 =>
                array(
                    'code' => '934-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON PUERTO QUITO',
                ),
            473 =>
                array(
                    'code' => '934-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DE PUERTO QUITO',
                ),
            474 =>
                array(
                    'code' => '934-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PUERTO QUITO',
                ),
            475 =>
                array(
                    'code' => '938-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL PARA LA PROTECCION DE DERECHOS DE AMBATO',
                ),
            476 =>
                array(
                    'code' => '938-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMITE PERMANENTE DE LA FIESTA DE LA FRUTA Y DE LAS  FLORES',
                ),
            477 =>
                array(
                    'code' => '938-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HOSPITAL MUNICIPAL',
                ),
            478 =>
                array(
                    'code' => '938-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE AMBATO - PLANTA CENTRAL',
                ),
            479 =>
                array(
                    'code' => '939-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON BANOS DE AGUA SANTA',
                ),
            480 =>
                array(
                    'code' => '939-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO PARA LA PROTECCION DE DERECHOS DEL CANTON BANOS DE AGUA SANTA',
                ),
            481 =>
                array(
                    'code' => '939-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE BANOS DE AGUA SANTA',
                ),
            482 =>
                array(
                    'code' => '940-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON CEVALLOS',
                ),
            483 =>
                array(
                    'code' => '940-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE CEVALLOS',
                ),
            484 =>
                array(
                    'code' => '941-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE MOCHA',
                ),
            485 =>
                array(
                    'code' => '941-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON MOCHA',
                ),
            486 =>
                array(
                    'code' => '942-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SAN CRISTOBAL DE PATATE',
                ),
            487 =>
                array(
                    'code' => '942-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON SAN CRISTOBAL DE PATATE',
                ),
            488 =>
                array(
                    'code' => '942-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMITE PERMANENTE PARA LA GESTION Y PROMOCION TURISTICA CULTURAL Y DEPORTIVA DEL CANTON SAN CRISTOBAL DE PATATE ',
                ),
            489 =>
                array(
                    'code' => '942-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PATATE',
                ),
            490 =>
                array(
                    'code' => '942-0034',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PATATE',
                ),
            491 =>
                array(
                    'code' => '943-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON SANTIAGO DE QUERO',
                ),
            492 =>
                array(
                    'code' => '943-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON SANTIAGO DE QUERO',
                ),
            493 =>
                array(
                    'code' => '943-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON QUERO',
                ),
            494 =>
                array(
                    'code' => '944-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO MUNICIPAL DEL CANTON SAN PEDRO DE PELILEO',
                ),
            495 =>
                array(
                    'code' => '944-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL PARA LA PROTECCION DE DERECHOS DEL CANTON SAN PEDRO DE PELILEO (CCPD)',
                ),
            496 =>
                array(
                    'code' => '944-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO MUNICIPAL DE LA PROPIEDAD DEL CANTON SAN PEDRO DE PELILEO',
                ),
            497 =>
                array(
                    'code' => '944-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUCION AUTONOMA CUERPO DE BOMBEROS DEL CANTON PELILEO',
                ),
            498 =>
                array(
                    'code' => '945-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO MUNICIPAL DEL CANTON SANTIAGO DE  PILLARO',
                ),
            499 =>
                array(
                    'code' => '945-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON SANTIAGO DE PILLARO',
                ),
        ));
        DB::table('institutions')->insert(array(
            0 =>
                array(
                    'code' => '945-0034',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS SANTIAGO DE PILLARO',
                ),
            1 =>
                array(
                    'code' => '946-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE TISALEO',
                ),
            2 =>
                array(
                    'code' => '946-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON TISALEO',
                ),
            3 =>
                array(
                    'code' => '946-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON TISALEO',
                ),
            4 =>
                array(
                    'code' => '950-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE ZAMORA',
                ),
            5 =>
                array(
                    'code' => '950-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD EJECUTORA PARA LA EJECUCION DE LA OBRA READECUACION Y AMPLIACION DEL CENTRO RECREACIONAL CULTURAL Y TURISTICO BOMBUSCARO',
                ),
            6 =>
                array(
                    'code' => '950-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE ZAMORA',
                ),
            7 =>
                array(
                    'code' => '951-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE CHINCHIPE',
                ),
            8 =>
                array(
                    'code' => '951-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON CHINCHIPE',
                ),
            9 =>
                array(
                    'code' => '952-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE NANGARITZA',
                ),
            10 =>
                array(
                    'code' => '952-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BENEMERITO CUERPO DE BOMBEROS DEL CANTON NANGARITZA',
                ),
            11 =>
                array(
                    'code' => '953-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON YACUAMBI',
                ),
            12 =>
                array(
                    'code' => '954-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE YANTZAZA',
                ),
            13 =>
                array(
                    'code' => '954-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON YANTZAZA',
                ),
            14 =>
                array(
                    'code' => '955-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE EL PANGUI',
                ),
            15 =>
                array(
                    'code' => '955-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON EL PANGUI',
                ),
            16 =>
                array(
                    'code' => '955-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON EL PANGUI',
                ),
            17 =>
                array(
                    'code' => '956-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON CENTINELA DEL CONDOR',
                ),
            18 =>
                array(
                    'code' => '956-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON CENTINELA DEL CONDOR',
                ),
            19 =>
                array(
                    'code' => '956-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON CENTINELA DEL CONDOR',
                ),
            20 =>
                array(
                    'code' => '957-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON PALANDA',
                ),
            21 =>
                array(
                    'code' => '957-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON PALANDA',
                ),
            22 =>
                array(
                    'code' => '958-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON PAQUISHA',
                ),
            23 =>
                array(
                    'code' => '958-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON PAQUISHA',
                ),
            24 =>
                array(
                    'code' => '961-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON SAN CRISTOBAL',
                ),
            25 =>
                array(
                    'code' => '961-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON SAN CRISTOBAL',
                ),
            26 =>
                array(
                    'code' => '961-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON SAN CRISTOBAL DE LA PROVINCIA DE GALAPAGOS',
                ),
            27 =>
                array(
                    'code' => '962-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE ISABELA',
                ),
            28 =>
                array(
                    'code' => '962-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON ISABELA',
                ),
            29 =>
                array(
                    'code' => '963-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SANTA CRUZ',
                ),
            30 =>
                array(
                    'code' => '963-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION INTEGRAL DE DERECHOS DE NINEZ Y ADOLESCENCIA Y GRUPOS DE ATENCION PRIORITARIA',
                ),
            31 =>
                array(
                    'code' => '963-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON SANTA CRUZ - GALAPAGOS',
                ),
            32 =>
                array(
                    'code' => '963-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON SANTA CRUZ',
                ),
            33 =>
                array(
                    'code' => '966-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE LA CIUDAD DE LA BONITA',
                ),
            34 =>
                array(
                    'code' => '967-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE LAGO AGRIO',
                ),
            35 =>
                array(
                    'code' => '967-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DE LAGO AGRIO',
                ),
            36 =>
                array(
                    'code' => '967-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD DE ACCION SOCIAL DEL GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE LAGO AGRIO',
                ),
            37 =>
                array(
                    'code' => '967-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO PUBLICO DE LA PROPIEDAD Y MERCANTIL DEL CANTON LAGO AGRIO',
                ),
            38 =>
                array(
                    'code' => '967-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNIDAD MUNICIPAL DE DESARROLLO SUSTENTABLE DE LAGO AGRIO',
                ),
            39 =>
                array(
                    'code' => '967-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON LAGO AGRIO',
                ),
            40 =>
                array(
                    'code' => '968-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON GONZALO PIZARRO',
                ),
            41 =>
                array(
                    'code' => '968-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON GONZALO PIZARRO',
                ),
            42 =>
                array(
                    'code' => '968-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS MUNICIPAL DEL CANTON GONZALO PIZARRO',
                ),
            43 =>
                array(
                    'code' => '969-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO MUNICIPAL DEL CANTON PUTUMAYO',
                ),
            44 =>
                array(
                    'code' => '969-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DE AMPARO SOCIAL DEL CANTON PUTUMAYO',
                ),
            45 =>
                array(
                    'code' => '969-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE PUERTO EL CARMEN DE PUTUMAYO',
                ),
            46 =>
                array(
                    'code' => '970-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON SHUSHUFINDI',
                ),
            47 =>
                array(
                    'code' => '970-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONCEJO CANTONAL DE LA NINEZ Y ADOLESCENCIA DEL CANTON SHUSHUFINDI',
                ),
            48 =>
                array(
                    'code' => '970-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CENTRO DE RESPONSABILIDAD SOCIAL Y SOLIDARIA MUNICIPAL JORGE CAJAS GARZON DEL CANTON SHUSHUFINDI',
                ),
            49 =>
                array(
                    'code' => '970-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DE LAS CIUDADANAS-OS DEL CANTON SHUSHUFINDI',
                ),
            50 =>
                array(
                    'code' => '970-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON SHUSHUFINDI',
                ),
            51 =>
                array(
                    'code' => '970-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE SHUSHUFINDI',
                ),
            52 =>
                array(
                    'code' => '971-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SUCUMBIOS',
                ),
            53 =>
                array(
                    'code' => '971-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DE ATENCION SOCIAL PRIORITARIA DE SUCUMBIOS',
                ),
            54 =>
                array(
                    'code' => '972-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE CASCALES',
                ),
            55 =>
                array(
                    'code' => '972-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL PARA LA PROTECCION DE DERECHOS DE CASCALES',
                ),
            56 =>
                array(
                    'code' => '972-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PATRONATO MUNICIPAL DE ATENCION SOCIAL PRIORITARIA DE CASCALES',
                ),
            57 =>
                array(
                    'code' => '972-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON CASCALES',
                ),
            58 =>
                array(
                    'code' => '973-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE CUYABENO',
                ),
            59 =>
                array(
                    'code' => '973-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON CUYABENO',
                ),
            60 =>
                array(
                    'code' => '976-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON  FRANCISCO DE ORELLANA',
                ),
            61 =>
                array(
                    'code' => '977-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE FRANCISCO DE ORELLANA',
                ),
            62 =>
                array(
                    'code' => '977-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE PROTECCION DE DERECHOS DEL CANTON FRANCISCO DE ORELLANA',
                ),
            63 =>
                array(
                    'code' => '977-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'REGISTRO DE LA PROPIEDAD DEL CANTON FRANCISCO DE ORELLANA',
                ),
            64 =>
                array(
                    'code' => '978-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON AGUARICO',
                ),
            65 =>
                array(
                    'code' => '978-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON AGUARICO',
                ),
            66 =>
                array(
                    'code' => '979-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MUNICIPIO DE JOYA DE LOS SACHAS',
                ),
            67 =>
                array(
                    'code' => '979-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DE JOYA DE LOS SACHAS',
                ),
            68 =>
                array(
                    'code' => '980-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON LORETO',
                ),
            69 =>
                array(
                    'code' => '980-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL PARA LA PROTECCION DE DERECHOS DE LORETO',
                ),
            70 =>
                array(
                    'code' => '980-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO CANTONAL DE SALUD DE LORETO',
                ),
            71 =>
                array(
                    'code' => '980-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CUERPO DE BOMBEROS DEL CANTON LORETO',
                ),
            72 =>
                array(
                    'code' => '985-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD PARA LA GESTION DESCENTRALIDADA DE LA COMPETENCIA DE TRANSITO TRANSPORTE TERRESTRE Y SEGURIDAD VIAL DE LOS GADS MUNICIPALES DE NARANJITO MARCELINO MARIDUENA Y SAN JACINTO DE YAGUACHI',
                ),
            73 =>
                array(
                    'code' => '985-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE SEGURIDAD CIUDADANA Y LA GESTION DEL DESARROLLO DE LOS GOBIERNOS AUTONOMOS DESCENTRALIZADOS MUNICIPALES DEL NORTE DE LA PROVINCIA DE ESMERALDAS',
                ),
            74 =>
                array(
                    'code' => '985-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE INTEGRACION MUNICIPAL DE ZAMORA CHINCHIPE',
                ),
            75 =>
                array(
                    'code' => '985-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE GOBIERNOS AUTONOMOS DESCENTRALIZADOS MUNICIPALES DEL FRENTE SUR OCCIDENTAL DE LA PROVINCIA DE TUNGURAHUA',
                ),
            76 =>
                array(
                    'code' => '985-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD PARA LA GESTION DESCENTRALIZADA DE LA COMPETENCIA DE TRANSITO TRANSPORTE TERRESTRE Y SEGURIDAD VIAL  DE LOS GOBIERNOS AUTONOMOS DESCENTRALIZADOS MUNICIPALES DE BANOS DE AGUA SANTA CEVALLO',
                ),
            77 =>
                array(
                    'code' => '985-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE TRANSITO TRANSPORTE TERRESTRE Y SEGURIDAD VIAL DE LA PROVINCIA DE PASTAZA',
                ),
            78 =>
                array(
                    'code' => '985-0020',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ASAMBLEA DE UNIDAD CANTONAL DE MONTUFAR',
                ),
            79 =>
                array(
                    'code' => '985-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD PARA LA GESTION DESCENTRALIZADA DE LA COMPETENCIA DE TRANSITO TRANSPORTE TERRESTRE Y SEGURIDAD VIAL  DE LOS GOBIERNOS AUTONOMOS DESCENTRALIZADOS MUNICIPALES DE PUJILI SAQUISILI SIGCHOS PA',
                ),
            80 =>
                array(
                    'code' => '985-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE TRANSITO TRANSPORTE TERRESTRE Y SEGURIDAD VIAL  DE LA PROVINCIA DE SUCUMBIOS',
                ),
            81 =>
                array(
                    'code' => '985-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD PARA LA GESTION DESCENTRALIZADA DE LA COMPETENCIA DE TRANSITO TRANSPORTE TERRESTRE Y SEGURIDAD VIAL DE LA REGION NORTE',
                ),
            82 =>
                array(
                    'code' => '985-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE MOVILIDAD CENTRO - GUAYAS',
                ),
            83 =>
                array(
                    'code' => '985-0025',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD PARA LA GESTION INTEGRAL DE DESECHOS SOLIDOS Y SANEAMIENTO AMBIENTAL',
                ),
            84 =>
                array(
                    'code' => '985-0026',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ASOCIACION DE MUNICIPALIDADES DEL AZUAY',
                ),
            85 =>
                array(
                    'code' => '985-0027',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD MUNDO VERDE O DEL BUEN VIVIR SUMAK KAWSAY',
                ),
            86 =>
                array(
                    'code' => '985-0028',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD PARA LA GESTION DESCENTRALIZADA DE LA COMPETENCIA DE TRANSITO TRANSPORTE TERRESTRE Y SEGURIDAD VIAL DE LOS GADS MUNICIPALES DE AGUARICO Y FRANCISCO DE ORELLANA',
                ),
            87 =>
                array(
                    'code' => '985-0029',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE LA CUENCA ALTA DEL RIO CATAMAYO',
                ),
            88 =>
                array(
                    'code' => '985-0030',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD TURISTICA LA RUTA DEL AGUA',
                ),
            89 =>
                array(
                    'code' => '985-0031',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD PARA LA PRESTACION DEL SERVICIO DE AGUA POTABLE DE LOS GOBIERNOS AUTONOMOS DESCENTRALIZADOS MUNICIPALES DE FRANCISCO DE ORELLANA JOYAS DE LOS SACHAS Y LORETO RIO SUNO',
                ),
            90 =>
                array(
                    'code' => '985-0032',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSORCIO PARA LA GESTION DEL AREA ECOLOGICA DE CONSERVACION TAITA IMBABURA',
                ),
            91 =>
                array(
                    'code' => '987-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE LA CUENCA MEDIA BAJA DEL RIO PAUTE JUNTA MANCOMUNADA DE PROTECCION DE DERECHOS DE NI',
                ),
            92 =>
                array(
                    'code' => '988-0050',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD RIO-DUE AGUA PARA EL BUEN VIVIR',
                ),
            93 =>
                array(
                    'code' => '988-0051',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD PARA LA GESTION INTEGRAL DE LOS DESECHOS SOLIDOS DE LOS CANTONES DE PUJILI Y SQUISILI',
                ),
            94 =>
                array(
                    'code' => '657-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSEJO NACIONAL DE GOBIERNOS PARROQUIALES RURALES DEL ECUADOR -CONAGOPARE',
                ),
            95 =>
                array(
                    'code' => '988-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE AZUAY',
                ),
            96 =>
                array(
                    'code' => '988-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - BOLIVAR',
                ),
            97 =>
                array(
                    'code' => '988-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - CANAR',
                ),
            98 =>
                array(
                    'code' => '988-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE-CARCHI',
                ),
            99 =>
                array(
                    'code' => '988-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - COTOPAXI',
                ),
            100 =>
                array(
                    'code' => '988-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - CHIMBORAZO',
                ),
            101 =>
                array(
                    'code' => '988-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ASOCIACION DE GOBIERNOS PARROQUIALES RURALES DE EL ORO (ASOGOPAR EL ORO)',
                ),
            102 =>
                array(
                    'code' => '988-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - ESMERALDAS',
                ),
            103 =>
                array(
                    'code' => '988-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - GUAYAS',
                ),
            104 =>
                array(
                    'code' => '988-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE IMBABURA',
                ),
            105 =>
                array(
                    'code' => '988-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE-LOJA',
                ),
            106 =>
                array(
                    'code' => '988-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - LOS RIOS',
                ),
            107 =>
                array(
                    'code' => '988-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - MANABI',
                ),
            108 =>
                array(
                    'code' => '988-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - MORONA SANTIAGO',
                ),
            109 =>
                array(
                    'code' => '988-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE-NAPO',
                ),
            110 =>
                array(
                    'code' => '988-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - PASTAZA',
                ),
            111 =>
                array(
                    'code' => '988-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - PICHINCHA',
                ),
            112 =>
                array(
                    'code' => '988-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - TUNGURAHUA',
                ),
            113 =>
                array(
                    'code' => '988-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - ZAMORA CHINCHIPE',
                ),
            114 =>
                array(
                    'code' => '988-0020',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ASOCIACION DE JUNTAS PARROQUIALES RURALES DE LA PROVINCIAL DE GALAPAGOS',
                ),
            115 =>
                array(
                    'code' => '988-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - SUCUMBIOS',
                ),
            116 =>
                array(
                    'code' => '988-0022',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - ORELLANA',
                ),
            117 =>
                array(
                    'code' => '988-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - SANTA ELENA',
                ),
            118 =>
                array(
                    'code' => '988-0025',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONAGOPARE - SANTO DOMINGO DE LOS TSACHILAS',
                ),
            119 =>
                array(
                    'code' => '988-0026',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE LOS GOBIERNOS AUTONOMOS DESCENTRALIZADOS PARROQUIALES DE LA CUENCA DEL LAGO SAN PABLO',
                ),
            120 =>
                array(
                    'code' => '988-0030',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE GOBIERNOS AUTONOMOS DESCENTRALIZADOS PARROQUIALES RURALES DE LA ZONA NORCENTRAL DEL DISTRITO METROPOLITANO DE QUITO PROVINCIA DE PICHINCHA',
                ),
            121 =>
                array(
                    'code' => '988-0031',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD CORREDOR TURISTICO CENTRO AMAZONICO ATILLO MCTACAA',
                ),
            122 =>
                array(
                    'code' => '988-0032',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSORCIO AGUARONGO',
                ),
            123 =>
                array(
                    'code' => '988-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD LAS MELIPONAS',
                ),
            124 =>
                array(
                    'code' => '988-0034',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE GOBIERNOS AUTONOMOS DESCENTRALIZADOS PARROQUIALES RURALES DEL CANTON NANGARITZA',
                ),
            125 =>
                array(
                    'code' => '988-0052',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSORCIO UNIDAD DE GOBIERNOS AUTONOMOS DESCENTRALIZADOS DE ESMERALDAS',
                ),
            126 =>
                array(
                    'code' => '988-0053',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE LA BIO REGION DE CHOCO-ANDINO DEL NOROCCIDENTE DE QUITO',
                ),
            127 =>
                array(
                    'code' => '988-0055',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSORCIO SAN LORENZO DEL PAILON',
                ),
            128 =>
                array(
                    'code' => '988-0056',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSORCIO DE LOS RIOS SANTIAGO-WIMBI-CACHAVI',
                ),
            129 =>
                array(
                    'code' => '988-0057',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD PARA LA GESTION Y MANEJO DEL AREA ECOLOGICA DE CONSERVACION PARROQUIAL AGUA ETERNA-AMUICHA ENTSA',
                ),
            130 =>
                array(
                    'code' => '988-0058',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CONSORCIO EL ROCIO',
                ),
            131 =>
                array(
                    'code' => '998-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE BANOS',
                ),
            132 =>
                array(
                    'code' => '998-0002',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CUMBE',
                ),
            133 =>
                array(
                    'code' => '998-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CHAUCHA',
                ),
            134 =>
                array(
                    'code' => '998-0004',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE CHECA',
                ),
            135 =>
                array(
                    'code' => '998-0005',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CHIQUINTAD',
                ),
            136 =>
                array(
                    'code' => '998-0006',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LLACAO',
                ),
            137 =>
                array(
                    'code' => '998-0007',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE MOLLETURO',
                ),
            138 =>
                array(
                    'code' => '998-0008',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE NULTI',
                ),
            139 =>
                array(
                    'code' => '998-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE OCTAVIO CORDERO PALACIOS',
                ),
            140 =>
                array(
                    'code' => '998-0010',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PACCHA',
                ),
            141 =>
                array(
                    'code' => '998-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE QUINGEO',
                ),
            142 =>
                array(
                    'code' => '998-0012',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE RICAURTE',
                ),
            143 =>
                array(
                    'code' => '998-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN JOAQUIN',
                ),
            144 =>
                array(
                    'code' => '998-0014',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SANTA ANA',
                ),
            145 =>
                array(
                    'code' => '998-0015',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAYAUSI',
                ),
            146 =>
                array(
                    'code' => '998-0016',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE SIDCAY',
                ),
            147 =>
                array(
                    'code' => '998-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SININCAY',
                ),
            148 =>
                array(
                    'code' => '998-0018',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE TARQUI',
                ),
            149 =>
                array(
                    'code' => '998-0019',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TURI',
                ),
            150 =>
                array(
                    'code' => '998-0020',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE EL VALLE',
                ),
            151 =>
                array(
                    'code' => '998-0021',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL VICTORIA DEL PORTETE',
                ),
            152 =>
                array(
                    'code' => '998-0023',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE LA ASUNCION',
                ),
            153 =>
                array(
                    'code' => '998-0024',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE SAN GERARDO',
                ),
            154 =>
                array(
                    'code' => '998-0026',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DANIEL CORDOVA TORAL',
                ),
            155 =>
                array(
                    'code' => '998-0027',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL JADAN',
                ),
            156 =>
                array(
                    'code' => '998-0028',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MARIANO MORENO',
                ),
            157 =>
                array(
                    'code' => '998-0029',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL  REMIGIO CRESPO TORAL',
                ),
            158 =>
                array(
                    'code' => '998-0030',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN JUAN',
                ),
            159 =>
                array(
                    'code' => '998-0031',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ZHIDMAD',
                ),
            160 =>
                array(
                    'code' => '998-0032',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LUIS CORDERO VEGA',
                ),
            161 =>
                array(
                    'code' => '998-0033',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SIMON BOLIVAR DE GANANZOL',
                ),
            162 =>
                array(
                    'code' => '998-0034',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL COCHAPATA',
                ),
            163 =>
                array(
                    'code' => '998-0035',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL EL PROGRESO',
                ),
            164 =>
                array(
                    'code' => '998-0036',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIADO PARROQUIAL DE LAS NIEVES',
                ),
            165 =>
                array(
                    'code' => '998-0038',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE BULAN (JOSE VICTOR  IZQUIERDO )',
                ),
            166 =>
                array(
                    'code' => '998-0039',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CHICAN ( GUILLERMO ORTEGA )',
                ),
            167 =>
                array(
                    'code' => '998-0040',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE EL CABO',
                ),
            168 =>
                array(
                    'code' => '998-0041',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE GUARAINAG',
                ),
            169 =>
                array(
                    'code' => '998-0042',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN CRISTOBAL',
                ),
            170 =>
                array(
                    'code' => '998-0043',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL TOMEBAMBA',
                ),
            171 =>
                array(
                    'code' => '998-0044',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA DUG-DUG',
                ),
            172 =>
                array(
                    'code' => '998-0046',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE SAN RAFAEL DE SHARUG',
                ),
            173 =>
                array(
                    'code' => '998-0048',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE CHUMBLIN',
                ),
            174 =>
                array(
                    'code' => '998-0050',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PARROQUIAL AUTONOMO DESCENTRALIZADO DE ABDON CALDERON',
                ),
            175 =>
                array(
                    'code' => '998-0051',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL EL CARMEN DE PIJILI',
                ),
            176 =>
                array(
                    'code' => '998-0052',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SHAGLLI',
                ),
            177 =>
                array(
                    'code' => '998-0054',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CUTCHIL',
                ),
            178 =>
                array(
                    'code' => '998-0055',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE JIMA',
                ),
            179 =>
                array(
                    'code' => '998-0056',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE GUEL',
                ),
            180 =>
                array(
                    'code' => '998-0057',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE LUDO',
                ),
            181 =>
                array(
                    'code' => '998-0058',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN BARTOLOME',
                ),
            182 =>
                array(
                    'code' => '998-0059',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE SAN JOSE DE RARANGA',
                ),
            183 =>
                array(
                    'code' => '998-0061',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SUSUDEL',
                ),
            184 =>
                array(
                    'code' => '998-0063',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE PRINCIPAL',
                ),
            185 =>
                array(
                    'code' => '998-0064',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE LA UNION',
                ),
            186 =>
                array(
                    'code' => '998-0065',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE LUIS GARZA ORELLANA ( CAB. DELEGSOL )',
                ),
            187 =>
                array(
                    'code' => '998-0066',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN MARTIN DE PUZHIO',
                ),
            188 =>
                array(
                    'code' => '998-0068',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN VICENTE',
                ),
            189 =>
                array(
                    'code' => '998-0070',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PARROQUIAL DE AMALUZA',
                ),
            190 =>
                array(
                    'code' => '998-0071',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA PALMAS',
                ),
            191 =>
                array(
                    'code' => '998-0073',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE FACUNDO VELA',
                ),
            192 =>
                array(
                    'code' => '998-0074',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE JULIO E MORENO',
                ),
            193 =>
                array(
                    'code' => '998-0075',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SALINAS',
                ),
            194 =>
                array(
                    'code' => '998-0076',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIALRURAL DE SAN LORENZO',
                ),
            195 =>
                array(
                    'code' => '998-0077',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO INTERCULTURAL ALTERNATIVO PARTICIPATIVO DE LA PARROQUIA SAN SIMON',
                ),
            196 =>
                array(
                    'code' => '998-0078',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SANTA FE',
                ),
            197 =>
                array(
                    'code' => '998-0079',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SIMIATUG',
                ),
            198 =>
                array(
                    'code' => '998-0080',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN LUIS DE PAMBIL',
                ),
            199 =>
                array(
                    'code' => '998-0082',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN JOSE DEL TAMBO',
                ),
            200 =>
                array(
                    'code' => '998-0084',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LA ASUNCION',
                ),
            201 =>
                array(
                    'code' => '998-0085',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LA MAGDALENA',
                ),
            202 =>
                array(
                    'code' => '998-0086',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN SEBASTIAN',
                ),
            203 =>
                array(
                    'code' => '998-0087',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TELIMBELA',
                ),
            204 =>
                array(
                    'code' => '998-0089',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE BALZAPAMBA',
                ),
            205 =>
                array(
                    'code' => '998-0090',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE BILOVAN',
                ),
            206 =>
                array(
                    'code' => '998-0091',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE REGULO DE MORA',
                ),
            207 =>
                array(
                    'code' => '998-0092',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN PABLO DE ATENAS ',
                ),
            208 =>
                array(
                    'code' => '998-0093',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SANTIAGO',
                ),
            209 =>
                array(
                    'code' => '998-0094',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN VICENTE',
                ),
            210 =>
                array(
                    'code' => '998-0096',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL COJITAMBO',
                ),
            211 =>
                array(
                    'code' => '998-0097',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL GUAPAN',
                ),
            212 =>
                array(
                    'code' => '998-0098',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE JAVIER LOYOLA CHUQUIPATA',
                ),
            213 =>
                array(
                    'code' => '998-0099',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL LUIS CORDERO',
                ),
            214 =>
                array(
                    'code' => '998-0100',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE PINDILIG',
                ),
            215 =>
                array(
                    'code' => '998-0101',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE RIVERA',
                ),
            216 =>
                array(
                    'code' => '998-0102',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN MIGUEL',
                ),
            217 =>
                array(
                    'code' => '998-0103',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SAN ANDRES DE TADAY',
                ),
            218 =>
                array(
                    'code' => '998-0105',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE NAZON',
                ),
            219 =>
                array(
                    'code' => '998-0106',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SAN FRANCISCO DE SAGEO',
                ),
            220 =>
                array(
                    'code' => '998-0107',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TURUPAMBA',
                ),
            221 =>
                array(
                    'code' => '998-0108',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE JERUSALEN',
                ),
            222 =>
                array(
                    'code' => '998-0110',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE CHONTAMARCA',
                ),
            223 =>
                array(
                    'code' => '998-0111',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE CHOROCOPTE',
                ),
            224 =>
                array(
                    'code' => '998-0112',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL GENERAL MORALES',
                ),
            225 =>
                array(
                    'code' => '998-0113',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE GUALLETURO',
                ),
            226 =>
                array(
                    'code' => '998-0114',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL HONORATO VASQUEZ',
                ),
            227 =>
                array(
                    'code' => '998-0115',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL INGAPIRCA',
                ),
            228 =>
                array(
                    'code' => '998-0116',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE JUNCAL',
                ),
            229 =>
                array(
                    'code' => '998-0117',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE SAN ANTONIO',
                ),
            230 =>
                array(
                    'code' => '998-0118',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE ZHUD',
                ),
            231 =>
                array(
                    'code' => '998-0119',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE VENTURA',
                ),
            232 =>
                array(
                    'code' => '998-0120',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE DUCUR',
                ),
            233 =>
                array(
                    'code' => '998-0122',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL  MANUEL DE J CALLE',
                ),
            234 =>
                array(
                    'code' => '998-0123',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PANCHO NEGRO',
                ),
            235 =>
                array(
                    'code' => '998-0125',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SOLANO',
                ),
            236 =>
                array(
                    'code' => '998-0127',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE EL CARMELO',
                ),
            237 =>
                array(
                    'code' => '998-0128',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL JULIO ANDRADE',
                ),
            238 =>
                array(
                    'code' => '998-0129',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL DE MALDONADO',
                ),
            239 =>
                array(
                    'code' => '998-0130',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL DE PIOTER',
                ),
            240 =>
                array(
                    'code' => '998-0131',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE TOBAR DONOSO',
                ),
            241 =>
                array(
                    'code' => '998-0132',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL TUFINO',
                ),
            242 =>
                array(
                    'code' => '998-0133',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL DE URBINA',
                ),
            243 =>
                array(
                    'code' => '998-0134',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE EL CHICAL',
                ),
            244 =>
                array(
                    'code' => '998-0135',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL DE SANTA MARTHA DE CUBA',
                ),
            245 =>
                array(
                    'code' => '998-0137',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE GARCIA MORENO',
                ),
            246 =>
                array(
                    'code' => '998-0138',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LOS ANDES',
                ),
            247 =>
                array(
                    'code' => '998-0139',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL DE MONTE OLIVO',
                ),
            248 =>
                array(
                    'code' => '998-0140',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN VICENTE DE PUSIR',
                ),
            249 =>
                array(
                    'code' => '998-0141',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SAN RAFAEL',
                ),
            250 =>
                array(
                    'code' => '998-0143',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL DE EL GOALTAL',
                ),
            251 =>
                array(
                    'code' => '998-0144',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LA LIBERTAD',
                ),
            252 =>
                array(
                    'code' => '998-0145',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL DE SAN ISIDRO',
                ),
            253 =>
                array(
                    'code' => '998-0147',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL LA CONCEPCION',
                ),
            254 =>
                array(
                    'code' => '998-0148',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL JACINTO JIJON Y CAAMANO',
                ),
            255 =>
                array(
                    'code' => '998-0149',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL DE JUAN MONTALVO',
                ),
            256 =>
                array(
                    'code' => '998-0151',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL DE CRISTOBAL COLON',
                ),
            257 =>
                array(
                    'code' => '998-0152',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL DE CHITAN DE NAVARRETE',
                ),
            258 =>
                array(
                    'code' => '998-0153',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE FERNANDEZ SALVADOR',
                ),
            259 =>
                array(
                    'code' => '998-0154',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL DE LA PAZ',
                ),
            260 =>
                array(
                    'code' => '998-0155',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL PIARTAL',
                ),
            261 =>
                array(
                    'code' => '998-0157',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL MARISCAL SUCRE',
                ),
            262 =>
                array(
                    'code' => '998-0159',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ALAQUES ( ALAQUEZ )',
                ),
            263 =>
                array(
                    'code' => '998-0160',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA  PARROQUIA RURAL DE BELISARIO QUEVEDO',
                ),
            264 =>
                array(
                    'code' => '998-0161',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE GUAYTACAMA',
                ),
            265 =>
                array(
                    'code' => '998-0162',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL JOSEGUANGO BAJO',
                ),
            266 =>
                array(
                    'code' => '998-0163',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL MULALO',
                ),
            267 =>
                array(
                    'code' => '998-0164',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL 11 DE NOVIEMBRE',
                ),
            268 =>
                array(
                    'code' => '998-0165',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SAN JOSE DE POALO',
                ),
            269 =>
                array(
                    'code' => '998-0166',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN JUAN DE PASTOCALLE',
                ),
            270 =>
                array(
                    'code' => '998-0167',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TANICUCHI',
                ),
            271 =>
                array(
                    'code' => '998-0168',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TOACASO',
                ),
            272 =>
                array(
                    'code' => '998-0170',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE GUASAGANDA  ( CAB. EN GUASAGANDA CENTRO )',
                ),
            273 =>
                array(
                    'code' => '998-0171',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PUCAYACU',
                ),
            274 =>
                array(
                    'code' => '998-0173',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE MORASPUNGO',
                ),
            275 =>
                array(
                    'code' => '998-0174',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PINLLOPATA',
                ),
            276 =>
                array(
                    'code' => '998-0175',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE RAMON CAMPANA',
                ),
            277 =>
                array(
                    'code' => '998-0177',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ANGAMARCA',
                ),
            278 =>
                array(
                    'code' => '998-0178',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE GUANGAJE',
                ),
            279 =>
                array(
                    'code' => '998-0179',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LA VICTORIA',
                ),
            280 =>
                array(
                    'code' => '998-0180',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PILALO',
                ),
            281 =>
                array(
                    'code' => '998-0181',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE EL TINGO',
                ),
            282 =>
                array(
                    'code' => '998-0182',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL DE ZUMBAHUA',
                ),
            283 =>
                array(
                    'code' => '998-0184',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ANTONIO JOSE HOLGUIN',
                ),
            284 =>
                array(
                    'code' => '998-0185',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL CUSUBAMBA',
                ),
            285 =>
                array(
                    'code' => '998-0186',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL MULALILLO',
                ),
            286 =>
                array(
                    'code' => '998-0187',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE MULLIQUINDIL ( SANTA ANA )',
                ),
            287 =>
                array(
                    'code' => '998-0188',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PANZALEO',
                ),
            288 =>
                array(
                    'code' => '998-0190',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA  PARROQUIA DE CANCHAGUA',
                ),
            289 =>
                array(
                    'code' => '998-0191',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CHANTILIN',
                ),
            290 =>
                array(
                    'code' => '998-0192',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE COCHAPAMBA',
                ),
            291 =>
                array(
                    'code' => '998-0194',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CHUGCHILAN ',
                ),
            292 =>
                array(
                    'code' => '998-0195',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ISINLIVI',
                ),
            293 =>
                array(
                    'code' => '998-0196',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LAS PAMPAS',
                ),
            294 =>
                array(
                    'code' => '998-0197',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL PALO QUEMADO',
                ),
            295 =>
                array(
                    'code' => '998-0199',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CACHA',
                ),
            296 =>
                array(
                    'code' => '998-0200',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SANTIAGO DE CALPI',
                ),
            297 =>
                array(
                    'code' => '998-0201',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CUBIJIES',
                ),
            298 =>
                array(
                    'code' => '998-0202',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE FLORES',
                ),
            299 =>
                array(
                    'code' => '998-0203',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE LICTO',
                ),
            300 =>
                array(
                    'code' => '998-0204',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PUNGALA',
                ),
            301 =>
                array(
                    'code' => '998-0205',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PUNIN',
                ),
            302 =>
                array(
                    'code' => '998-0206',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL QUIMIAG',
                ),
            303 =>
                array(
                    'code' => '998-0207',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN JUAN',
                ),
            304 =>
                array(
                    'code' => '998-0208',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN LUIS',
                ),
            305 =>
                array(
                    'code' => '998-0209',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LICAN',
                ),
            306 =>
                array(
                    'code' => '998-0211',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ACHUPALLAS',
                ),
            307 =>
                array(
                    'code' => '998-0212',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE GUASUNTOS',
                ),
            308 =>
                array(
                    'code' => '998-0213',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE HUIGRA',
                ),
            309 =>
                array(
                    'code' => '998-0214',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MULTITUD',
                ),
            310 =>
                array(
                    'code' => '998-0215',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PISTISHI',
                ),
            311 =>
                array(
                    'code' => '998-0216',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL PUMALLACTA',
                ),
            312 =>
                array(
                    'code' => '998-0217',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SEVILLA',
                ),
            313 =>
                array(
                    'code' => '998-0218',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SIBAMBE',
                ),
            314 =>
                array(
                    'code' => '998-0219',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TIXAN',
                ),
            315 =>
                array(
                    'code' => '998-0221',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL CANI',
                ),
            316 =>
                array(
                    'code' => '998-0222',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE COLUMBE',
                ),
            317 =>
                array(
                    'code' => '998-0223',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL JUAN DE VELASCO',
                ),
            318 =>
                array(
                    'code' => '998-0224',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SANTIAGO DE QUITO ( CAB. EN SANTIAGO DE QUITO )',
                ),
            319 =>
                array(
                    'code' => '998-0226',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL CAPSOL',
                ),
            320 =>
                array(
                    'code' => '998-0227',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE COMPUD',
                ),
            321 =>
                array(
                    'code' => '998-0228',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL GONZOL',
                ),
            322 =>
                array(
                    'code' => '998-0229',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LLAGOS',
                ),
            323 =>
                array(
                    'code' => '998-0231',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CEBADAS',
                ),
            324 =>
                array(
                    'code' => '998-0232',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PALMIRA',
                ),
            325 =>
                array(
                    'code' => '998-0234',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE GUANANDO',
                ),
            326 =>
                array(
                    'code' => '998-0235',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE ILAPO',
                ),
            327 =>
                array(
                    'code' => '998-0236',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL LA PROVIDENCIA',
                ),
            328 =>
                array(
                    'code' => '998-0237',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN ANDRES',
                ),
            329 =>
                array(
                    'code' => '998-0238',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN GERARDO',
                ),
            330 =>
                array(
                    'code' => '998-0239',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SAN ISIDRO',
                ),
            331 =>
                array(
                    'code' => '998-0240',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SAN JOSE DE CHAZO',
                ),
            332 =>
                array(
                    'code' => '998-0241',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA SANTA FE DE GALAN',
                ),
            333 =>
                array(
                    'code' => '998-0242',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE VALPARAISO',
                ),
            334 =>
                array(
                    'code' => '998-0244',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE EL ALTAR',
                ),
            335 =>
                array(
                    'code' => '998-0245',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL MATUS',
                ),
            336 =>
                array(
                    'code' => '998-0246',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL PUELA',
                ),
            337 =>
                array(
                    'code' => '998-0247',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SAN ANTONIO DE BAYUSHIG',
                ),
            338 =>
                array(
                    'code' => '998-0248',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LA CANDELARIA',
                ),
            339 =>
                array(
                    'code' => '998-0249',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE BILBAO',
                ),
            340 =>
                array(
                    'code' => '998-0251',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE EL RETIRO',
                ),
            341 =>
                array(
                    'code' => '998-0253',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CHACRAS',
                ),
            342 =>
                array(
                    'code' => '998-0254',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PALMALES',
                ),
            343 =>
                array(
                    'code' => '998-0255',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CARCABON',
                ),
            344 =>
                array(
                    'code' => '998-0257',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE AYAPAMBA',
                ),
            345 =>
                array(
                    'code' => '998-0258',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CORDONCILLO',
                ),
            346 =>
                array(
                    'code' => '998-0259',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MILAGRO',
                ),
            347 =>
                array(
                    'code' => '998-0260',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN JOSE',
                ),
            348 =>
                array(
                    'code' => '998-0261',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN JUAN DE CERRO AZUL',
                ),
            349 =>
                array(
                    'code' => '998-0262',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GIBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE BELLAMARIA',
                ),
            350 =>
                array(
                    'code' => '998-0264',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE BARBONES',
                ),
            351 =>
                array(
                    'code' => '998-0265',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LA IBERIA',
                ),
            352 =>
                array(
                    'code' => '998-0266',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TENDALES',
                ),
            353 =>
                array(
                    'code' => '998-0267',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE RIO BONITO',
                ),
            354 =>
                array(
                    'code' => '998-0268',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL EL INGENIO',
                ),
            355 =>
                array(
                    'code' => '998-0270',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE BUENAVISTA',
                ),
            356 =>
                array(
                    'code' => '998-0271',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CASACAY',
                ),
            357 =>
                array(
                    'code' => '998-0272',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LA PEANA',
                ),
            358 =>
                array(
                    'code' => '998-0273',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PROGRESO',
                ),
            359 =>
                array(
                    'code' => '998-0274',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE UZHCURRUMI',
                ),
            360 =>
                array(
                    'code' => '998-0275',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CANA QUEMADA',
                ),
            361 =>
                array(
                    'code' => '998-0277',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CAPIRO',
                ),
            362 =>
                array(
                    'code' => '998-0278',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LA BOCANA',
                ),
            363 =>
                array(
                    'code' => '998-0279',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MOROMORO',
                ),
            364 =>
                array(
                    'code' => '998-0280',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PIEDRAS',
                ),
            365 =>
                array(
                    'code' => '998-0281',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN ROQUE',
                ),
            366 =>
                array(
                    'code' => '998-0282',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SARACAY',
                ),
            367 =>
                array(
                    'code' => '998-0284',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CURTINCAPAC',
                ),
            368 =>
                array(
                    'code' => '998-0285',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MORALES',
                ),
            369 =>
                array(
                    'code' => '998-0286',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SALATI',
                ),
            370 =>
                array(
                    'code' => '998-0288',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE BELLAVISTA EL ORO',
                ),
            371 =>
                array(
                    'code' => '998-0289',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE JAMBELI',
                ),
            372 =>
                array(
                    'code' => '998-0290',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LA AVANZADA',
                ),
            373 =>
                array(
                    'code' => '998-0291',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN ANTONIO',
                ),
            374 =>
                array(
                    'code' => '998-0292',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TORATA',
                ),
            375 =>
                array(
                    'code' => '998-0293',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LA VICTORIA',
                ),
            376 =>
                array(
                    'code' => '998-0294',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE BELLA MARIA',
                ),
            377 =>
                array(
                    'code' => '998-0296',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ABANIN',
                ),
            378 =>
                array(
                    'code' => '998-0297',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ARCAPAMPA',
                ),
            379 =>
                array(
                    'code' => '998-0298',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE GUANAZAN',
                ),
            380 =>
                array(
                    'code' => '998-0299',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE GUIZHAGUINA',
                ),
            381 =>
                array(
                    'code' => '998-0300',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE HUERTAS',
                ),
            382 =>
                array(
                    'code' => '998-0301',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MALVAS',
                ),
            383 =>
                array(
                    'code' => '998-0302',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MULANCAY',
                ),
            384 =>
                array(
                    'code' => '998-0303',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SINSAO',
                ),
            385 =>
                array(
                    'code' => '998-0304',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURALES-GADPR DE SALVIAS',
                ),
            386 =>
                array(
                    'code' => '998-0306',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LA LIBERTAD',
                ),
            387 =>
                array(
                    'code' => '998-0307',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL EL PARAISO',
                ),
            388 =>
                array(
                    'code' => '998-0308',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN ISIDRO',
                ),
            389 =>
                array(
                    'code' => '998-0310',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE CAMARONES',
                ),
            390 =>
                array(
                    'code' => '998-0311',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CORONEL.CARLOS CONCHA TORRES ( CAB. EN HUELE )',
                ),
            391 =>
                array(
                    'code' => '998-0312',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CHINCA',
                ),
            392 =>
                array(
                    'code' => '998-0313',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE MAJUA',
                ),
            393 =>
                array(
                    'code' => '998-0314',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN MATEO',
                ),
            394 =>
                array(
                    'code' => '998-0315',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TABIAZO',
                ),
            395 =>
                array(
                    'code' => '998-0316',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TACHINA',
                ),
            396 =>
                array(
                    'code' => '998-0317',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE VUELTA LARGA',
                ),
            397 =>
                array(
                    'code' => '998-0319',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO RURAL DE LA PARROQUIA DE ANCHAYACU',
                ),
            398 =>
                array(
                    'code' => '998-0320',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ATAHUALPA ( CAB. EN CAMARONES )',
                ),
            399 =>
                array(
                    'code' => '998-0321',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE BORBON',
                ),
            400 =>
                array(
                    'code' => '998-0322',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO RURAL PARROQUIAL LA TOLA',
                ),
            401 =>
                array(
                    'code' => '998-0323',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE LUIS VARGAS TORRES ( CAB. EN PLAYA DE ORO )',
                ),
            402 =>
                array(
                    'code' => '998-0324',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL MALDONADO',
                ),
            403 =>
                array(
                    'code' => '998-0325',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PAMPANAL DE BOLIVAR',
                ),
            404 =>
                array(
                    'code' => '998-0326',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN FRANCISCO  DE ONZOLE',
                ),
            405 =>
                array(
                    'code' => '998-0327',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SANTO DOMINGO DE ONZOLE',
                ),
            406 =>
                array(
                    'code' => '998-0328',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SELVA ALEGRE',
                ),
            407 =>
                array(
                    'code' => '998-0329',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TELEMBI',
                ),
            408 =>
                array(
                    'code' => '998-0330',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE COLON ELOY DEL  MARIA',
                ),
            409 =>
                array(
                    'code' => '998-0331',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN JOSE DE CAYAPAS',
                ),
            410 =>
                array(
                    'code' => '998-0332',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE TIMBIRE',
                ),
            411 =>
                array(
                    'code' => '998-0334',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE BOLIVAR',
                ),
            412 =>
                array(
                    'code' => '998-0335',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE DAULE',
                ),
            413 =>
                array(
                    'code' => '998-0336',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE GALERA',
                ),
            414 =>
                array(
                    'code' => '998-0337',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE QUINGUE ( OLMEDO PERDOMO FRANCO )',
                ),
            415 =>
                array(
                    'code' => '998-0338',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA SALIMA',
                ),
            416 =>
                array(
                    'code' => '998-0339',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN FRANCISCO',
                ),
            417 =>
                array(
                    'code' => '998-0340',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN GREGORIO',
                ),
            418 =>
                array(
                    'code' => '998-0341',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN JOSE DE CHAMANGA ( CAB. EN CHAMANGA )',
                ),
            419 =>
                array(
                    'code' => '998-0343',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA CUBE',
                ),
            420 =>
                array(
                    'code' => '998-0344',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CHURA',
                ),
            421 =>
                array(
                    'code' => '998-0345',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA MALIMPIA',
                ),
            422 =>
                array(
                    'code' => '998-0346',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE VICHE',
                ),
            423 =>
                array(
                    'code' => '998-0347',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA LA UNION',
                ),
            424 =>
                array(
                    'code' => '998-0349',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ALTO TAMBO ( CAB. EN GUADAL )',
                ),
            425 =>
                array(
                    'code' => '998-0350',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA ANCON',
                ),
            426 =>
                array(
                    'code' => '998-0351',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CALDERON',
                ),
            427 =>
                array(
                    'code' => '998-0352',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CARONDELET',
                ),
            428 =>
                array(
                    'code' => '998-0353',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE 5 DE JUNIO ( CAB. EN UIMBI )',
                ),
            429 =>
                array(
                    'code' => '998-0354',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE CONCEPCION',
                ),
            430 =>
                array(
                    'code' => '998-0355',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE MATAJE ( CAB. EN SANTANDER )',
                ),
            431 =>
                array(
                    'code' => '998-0356',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE SAN JAVIER DE CACHAVI',
                ),
            432 =>
                array(
                    'code' => '998-0357',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SANTA RITA',
                ),
            433 =>
                array(
                    'code' => '998-0358',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TAMBILLO',
                ),
            434 =>
                array(
                    'code' => '998-0359',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TULULBI ( CAB. EN RICAURTE )',
                ),
            435 =>
                array(
                    'code' => '998-0360',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA URBINA',
                ),
            436 =>
                array(
                    'code' => '998-0362',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA UNION DE ATACAMES',
                ),
            437 =>
                array(
                    'code' => '998-0363',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SUA ( CAB. EN BOCANA )',
                ),
            438 =>
                array(
                    'code' => '998-0364',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TONCHIGUE',
                ),
            439 =>
                array(
                    'code' => '998-0365',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TONSUPA',
                ),
            440 =>
                array(
                    'code' => '998-0367',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CHONTADURO',
                ),
            441 =>
                array(
                    'code' => '998-0368',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CHUMUNDE',
                ),
            442 =>
                array(
                    'code' => '998-0369',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE LAGARTO',
                ),
            443 =>
                array(
                    'code' => '998-0370',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE MONTALVO ( CAB. EN HORQUETA )',
                ),
            444 =>
                array(
                    'code' => '998-0371',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ROCAFUERTE',
                ),
            445 =>
                array(
                    'code' => '998-0373',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO  PARROQUIAL RURAL DE JUAN GOMEZ RENDON PROGRESO ',
                ),
            446 =>
                array(
                    'code' => '998-0374',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL EL MORRO',
                ),
            447 =>
                array(
                    'code' => '998-0375',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE POSORJA',
                ),
            448 =>
                array(
                    'code' => '998-0376',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PUNA',
                ),
            449 =>
                array(
                    'code' => '998-0377',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TENGUEL',
                ),
            450 =>
                array(
                    'code' => '998-0379',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL JUAN BAUTISTA AGUIRRE',
                ),
            451 =>
                array(
                    'code' => '998-0380',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL EL LAUREL',
                ),
            452 =>
                array(
                    'code' => '998-0381',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LIMONAL',
                ),
            453 =>
                array(
                    'code' => '998-0382',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO PARROQUIAL LOS LOJAS',
                ),
            454 =>
                array(
                    'code' => '998-0384',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL GUAYAS',
                ),
            455 =>
                array(
                    'code' => '998-0385',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL EL ROSARIO',
                ),
            456 =>
                array(
                    'code' => '998-0387',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CHOBO',
                ),
            457 =>
                array(
                    'code' => '998-0388',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE MARISCAL SUCRE',
                ),
            458 =>
                array(
                    'code' => '998-0389',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ROBERTO ASTUDILLO',
                ),
            459 =>
                array(
                    'code' => '998-0391',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA JESUS MARIA',
                ),
            460 =>
                array(
                    'code' => '998-0392',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SAN CARLOS',
                ),
            461 =>
                array(
                    'code' => '998-0393',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SANTA  ROSA DE FLANDES',
                ),
            462 =>
                array(
                    'code' => '998-0394',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TAURA',
                ),
            463 =>
                array(
                    'code' => '998-0396',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO VALLE DE LA VIRGEN',
                ),
            464 =>
                array(
                    'code' => '998-0397',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SABANILLA GUAYAS',
                ),
            465 =>
                array(
                    'code' => '998-0399',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ANCONCITO',
                ),
            466 =>
                array(
                    'code' => '998-0400',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE JOSE LUIS TAMAYO',
                ),
            467 =>
                array(
                    'code' => '998-0402',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TARIFA',
                ),
            468 =>
                array(
                    'code' => '998-0404',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ATAHUALPA',
                ),
            469 =>
                array(
                    'code' => '998-0405',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE COLONCHE',
                ),
            470 =>
                array(
                    'code' => '998-0406',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CHANDUY',
                ),
            471 =>
                array(
                    'code' => '998-0407',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MANGLARALTO',
                ),
            472 =>
                array(
                    'code' => '998-0408',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SIMON BOLIVAR',
                ),
            473 =>
                array(
                    'code' => '998-0409',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN JOSE DE ANCON',
                ),
            474 =>
                array(
                    'code' => '998-0410',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE GENERAL VERNAZA ',
                ),
            475 =>
                array(
                    'code' => '998-0411',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LA VICTORIA',
                ),
            476 =>
                array(
                    'code' => '998-0412',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO RURAL PARROQUIAL DE JUNQUILLAL',
                ),
            477 =>
                array(
                    'code' => '998-0414',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL GRAL. PEDRO J.  MONTERO',
                ),
            478 =>
                array(
                    'code' => '998-0415',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE YAGUACHI VIEJO ( CONE )',
                ),
            479 =>
                array(
                    'code' => '998-0416',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE VIRGEN DE FATIMA',
                ),
            480 =>
                array(
                    'code' => '998-0418',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL CRNL. LORENZO DE GARAICOA ',
                ),
            481 =>
                array(
                    'code' => '998-0419',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SAN JACINTO',
                ),
            482 =>
                array(
                    'code' => '998-0420',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE AMBUQUI',
                ),
            483 =>
                array(
                    'code' => '998-0421',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ANGOCHAGUA GADPRA',
                ),
            484 =>
                array(
                    'code' => '998-0422',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CAROLINA',
                ),
            485 =>
                array(
                    'code' => '998-0423',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE LA ESPERANZA',
                ),
            486 =>
                array(
                    'code' => '998-0424',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE LITA',
                ),
            487 =>
                array(
                    'code' => '998-0425',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SALINAS',
                ),
            488 =>
                array(
                    'code' => '998-0426',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN ANTONIO',
                ),
            489 =>
                array(
                    'code' => '998-0428',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE IMBAYA',
                ),
            490 =>
                array(
                    'code' => '998-0429',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN FRANCISCO DE  NATABUELA',
                ),
            491 =>
                array(
                    'code' => '998-0430',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN JOSE DE CHALTURA',
                ),
            492 =>
                array(
                    'code' => '998-0431',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN ROQUE',
                ),
            493 =>
                array(
                    'code' => '998-0433',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE APUELA',
                ),
            494 =>
                array(
                    'code' => '998-0434',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE GARCIA MORENO',
                ),
            495 =>
                array(
                    'code' => '998-0435',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE IMANTAG',
                ),
            496 =>
                array(
                    'code' => '998-0436',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PENAHERRERA',
                ),
            497 =>
                array(
                    'code' => '998-0437',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PLAZA GUTIERREZ ( CALVARIO )',
                ),
            498 =>
                array(
                    'code' => '998-0438',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE QUIROGA',
                ),
            499 =>
                array(
                    'code' => '998-0439',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE 6 DE JULIO CUELLAJE ( CAB. EN CUELLAJE )',
                ),
        ));
        DB::table('institutions')->insert(array(
            0 =>
                array(
                    'code' => '998-0440',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE VACAS GALINDO',
                ),
            1 =>
                array(
                    'code' => '998-0442',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE DR MIGUEL EGAS ( PEGUCHE )',
                ),
            2 =>
                array(
                    'code' => '998-0443',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE EUGENIO ESPEJO',
                ),
            3 =>
                array(
                    'code' => '998-0444',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE GONZALEZ SUAREZ',
                ),
            4 =>
                array(
                    'code' => '998-0445',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PATAQUI',
                ),
            5 =>
                array(
                    'code' => '998-0446',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN JOSE DE QUICHINCHE',
                ),
            6 =>
                array(
                    'code' => '998-0447',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN JUAN DE ILUMAN',
                ),
            7 =>
                array(
                    'code' => '998-0448',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN PABLO',
                ),
            8 =>
                array(
                    'code' => '998-0449',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN RAFAEL',
                ),
            9 =>
                array(
                    'code' => '998-0450',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SELVA ALEGRE',
                ),
            10 =>
                array(
                    'code' => '998-0452',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CHUGA',
                ),
            11 =>
                array(
                    'code' => '998-0453',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL MARIANO ACOSTA',
                ),
            12 =>
                array(
                    'code' => '998-0454',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN FRANCISCO SIGSIPAMBA',
                ),
            13 =>
                array(
                    'code' => '998-0456',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CAHUASQUI',
                ),
            14 =>
                array(
                    'code' => '998-0457',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE LA MERCED DE BUENOS AIRES',
                ),
            15 =>
                array(
                    'code' => '998-0458',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL PABLO ARENAS',
                ),
            16 =>
                array(
                    'code' => '998-0459',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN BLAS',
                ),
            17 =>
                array(
                    'code' => '998-0460',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE TUMBABIRO',
                ),
            18 =>
                array(
                    'code' => '998-0462',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE CHANTACO',
                ),
            19 =>
                array(
                    'code' => '998-0463',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CHUQUIRIBAMBA',
                ),
            20 =>
                array(
                    'code' => '998-0464',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE EL CISNE',
                ),
            21 =>
                array(
                    'code' => '998-0465',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL GUALEL',
                ),
            22 =>
                array(
                    'code' => '998-0466',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE JIMBILLA',
                ),
            23 =>
                array(
                    'code' => '998-0467',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE MALACATOS ( VALLADOLID )',
                ),
            24 =>
                array(
                    'code' => '998-0468',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN LUCAS',
                ),
            25 =>
                array(
                    'code' => '998-0469',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN PEDRO DE VILCABAMBA',
                ),
            26 =>
                array(
                    'code' => '998-0470',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SANTIAGO',
                ),
            27 =>
                array(
                    'code' => '998-0471',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TAQUIL ( MIGUEL RIOFRIO )',
                ),
            28 =>
                array(
                    'code' => '998-0472',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA VILCABAMBA',
                ),
            29 =>
                array(
                    'code' => '998-0473',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE YANGANA-GAD PARROQUIAL YANGANA',
                ),
            30 =>
                array(
                    'code' => '998-0474',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE QUINARA',
                ),
            31 =>
                array(
                    'code' => '998-0476',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA COLAISACA',
                ),
            32 =>
                array(
                    'code' => '998-0477',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA EL LUCERO',
                ),
            33 =>
                array(
                    'code' => '998-0478',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA UTUANA',
                ),
            34 =>
                array(
                    'code' => '998-0479',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SANGUILLIN',
                ),
            35 =>
                array(
                    'code' => '998-0481',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE EL TAMBO',
                ),
            36 =>
                array(
                    'code' => '998-0482',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE GUAYQUICHUMA',
                ),
            37 =>
                array(
                    'code' => '998-0483',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN PEDRO DE LA BENDITA',
                ),
            38 =>
                array(
                    'code' => '998-0484',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ZAMBI',
                ),
            39 =>
                array(
                    'code' => '998-0486',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CRUZPAMBA ( CAB. EN CARLOS BUSTAMANTE )',
                ),
            40 =>
                array(
                    'code' => '998-0487',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE POZUL ( SAN JUAN DE POZUL )',
                ),
            41 =>
                array(
                    'code' => '998-0488',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMA DESCENTRALIZADO PARROQUIAL RURAL DE SABANILLA',
                ),
            42 =>
                array(
                    'code' => '998-0489',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TNTE. MAXIMILIANO RODRIGUEZ LOAIZA',
                ),
            43 =>
                array(
                    'code' => '998-0491',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE BUENAVISTA',
                ),
            44 =>
                array(
                    'code' => '998-0492',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE EL ROSARIO',
                ),
            45 =>
                array(
                    'code' => '998-0493',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SANTA RUFINA',
                ),
            46 =>
                array(
                    'code' => '998-0494',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE AMARILLOS',
                ),
            47 =>
                array(
                    'code' => '998-0496',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA BELLAVISTA',
                ),
            48 =>
                array(
                    'code' => '998-0497',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE JIMBURA ',
                ),
            49 =>
                array(
                    'code' => '998-0498',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SANTA TERESITA GADPRST',
                ),
            50 =>
                array(
                    'code' => '998-0499',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE 27 DE ABRIL ( CAB. EN LA NARANJA )',
                ),
            51 =>
                array(
                    'code' => '998-0500',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA EL INGENIO (LOJA)',
                ),
            52 =>
                array(
                    'code' => '998-0501',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE EL AIRO',
                ),
            53 =>
                array(
                    'code' => '998-0503',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CHANGAIMINA ( LA LIBERTAD )',
                ),
            54 =>
                array(
                    'code' => '998-0504',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE NAMBACOLA',
                ),
            55 =>
                array(
                    'code' => '998-0505',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PURUNUMA ( EGUIGUREN )',
                ),
            56 =>
                array(
                    'code' => '998-0506',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE SACAPALCA',
                ),
            57 =>
                array(
                    'code' => '998-0508',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE LARAMA',
                ),
            58 =>
                array(
                    'code' => '998-0509',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE LA VICTORIA',
                ),
            59 =>
                array(
                    'code' => '998-0510',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SABIANGO ( LA CAPILLA )',
                ),
            60 =>
                array(
                    'code' => '998-0512',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA CANGONAMA',
                ),
            61 =>
                array(
                    'code' => '998-0513',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE GUACHANAMA',
                ),
            62 =>
                array(
                    'code' => '998-0514',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LAURO GUERRERO',
                ),
            63 =>
                array(
                    'code' => '998-0515',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ORIANGA',
                ),
            64 =>
                array(
                    'code' => '998-0516',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA SAN ANTONIO',
                ),
            65 =>
                array(
                    'code' => '998-0517',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA  PARROQUIA DE CASANGA',
                ),
            66 =>
                array(
                    'code' => '998-0518',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA  PARROQUIA YAMANA',
                ),
            67 =>
                array(
                    'code' => '998-0520',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE CIANO',
                ),
            68 =>
                array(
                    'code' => '998-0521',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE EL ARENAL',
                ),
            69 =>
                array(
                    'code' => '998-0522',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL EL LIMO ',
                ),
            70 =>
                array(
                    'code' => '998-0523',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE MERCADILLO',
                ),
            71 =>
                array(
                    'code' => '998-0524',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE VICENTINO',
                ),
            72 =>
                array(
                    'code' => '998-0526',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL EL PARAISO DE CELEN',
                ),
            73 =>
                array(
                    'code' => '998-0527',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL EL TABLON',
                ),
            74 =>
                array(
                    'code' => '998-0528',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE LLUZHAPA',
                ),
            75 =>
                array(
                    'code' => '998-0529',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MANU',
                ),
            76 =>
                array(
                    'code' => '998-0530',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE SAN ANTONIO DE CUMBE',
                ),
            77 =>
                array(
                    'code' => '998-0531',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO SAN PABLO DE TENTA',
                ),
            78 =>
                array(
                    'code' => '998-0532',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN SEBASTIAN DE YULUC',
                ),
            79 =>
                array(
                    'code' => '998-0533',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SELVA ALEGRE',
                ),
            80 =>
                array(
                    'code' => '998-0534',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE URDANETA ( PAQUISHAPA )',
                ),
            81 =>
                array(
                    'code' => '998-0535',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SUMAYPAMBA',
                ),
            82 =>
                array(
                    'code' => '998-0536',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE NUEVA FATIMA',
                ),
            83 =>
                array(
                    'code' => '998-0537',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA TACAMOROS',
                ),
            84 =>
                array(
                    'code' => '998-0539',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE MANGAURCO',
                ),
            85 =>
                array(
                    'code' => '998-0540',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA GARZAREAL',
                ),
            86 =>
                array(
                    'code' => '998-0541',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA LIMONES',
                ),
            87 =>
                array(
                    'code' => '998-0542',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PALETILLAS',
                ),
            88 =>
                array(
                    'code' => '998-0543',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE BOLASPAMBA',
                ),
            89 =>
                array(
                    'code' => '998-0544',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CHAQUINAL',
                ),
            90 =>
                array(
                    'code' => '998-0545',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA DOCE DE DICIEMBRE',
                ),
            91 =>
                array(
                    'code' => '998-0547',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE FUNDOCHAMBA',
                ),
            92 =>
                array(
                    'code' => '998-0548',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA SAN ANTONIO DE LAS ARADAS',
                ),
            93 =>
                array(
                    'code' => '998-0550',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE LA TINGUE',
                ),
            94 =>
                array(
                    'code' => '998-0552',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CARACOL',
                ),
            95 =>
                array(
                    'code' => '998-0553',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE FEBRES CORDERO ( LAS JUNTAS CAB. EN MATA DE CACAO )',
                ),
            96 =>
                array(
                    'code' => '998-0554',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONO DESCENTRALIZADO PARROQUIAL RURAL DE PIMOCHA',
                ),
            97 =>
                array(
                    'code' => '998-0555',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE LA UNION',
                ),
            98 =>
                array(
                    'code' => '998-0557',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE GUARE',
                ),
            99 =>
                array(
                    'code' => '998-0558',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ISLA DE BEJUCAL',
                ),
            100 =>
                array(
                    'code' => '998-0560',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PUERTO PECHICHE',
                ),
            101 =>
                array(
                    'code' => '998-0561',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN JUAN',
                ),
            102 =>
                array(
                    'code' => '998-0563',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN CARLOS',
                ),
            103 =>
                array(
                    'code' => '998-0564',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LA ESPERANZA',
                ),
            104 =>
                array(
                    'code' => '998-0566',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE RICAURTE',
                ),
            105 =>
                array(
                    'code' => '998-0569',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO RURAL DE ZAPOTAL',
                ),
            106 =>
                array(
                    'code' => '998-0571',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ANTONIO SOTOMAYOR ( CAB. EN PLAYAS DE VINCES )',
                ),
            107 =>
                array(
                    'code' => '998-0573',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL PATRICIA PILAR',
                ),
            108 =>
                array(
                    'code' => '998-0575',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ABDON CALDERON ( SAN FRANCISCO )',
                ),
            109 =>
                array(
                    'code' => '998-0576',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL ALHAJUELA',
                ),
            110 =>
                array(
                    'code' => '998-0577',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CRUCITA',
                ),
            111 =>
                array(
                    'code' => '998-0578',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PUEBLO NUEVO',
                ),
            112 =>
                array(
                    'code' => '998-0579',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE RIOCHICO ( RIO CHICO )',
                ),
            113 =>
                array(
                    'code' => '998-0580',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL SAN PLACIDO',
                ),
            114 =>
                array(
                    'code' => '998-0581',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA CHIRIJOS',
                ),
            115 =>
                array(
                    'code' => '998-0583',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MEMBRILLO',
                ),
            116 =>
                array(
                    'code' => '998-0584',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL DE QUIROGA',
                ),
            117 =>
                array(
                    'code' => '998-0586',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE BOYACA',
                ),
            118 =>
                array(
                    'code' => '998-0587',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CANUTO',
                ),
            119 =>
                array(
                    'code' => '998-0588',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CONVENTO',
                ),
            120 =>
                array(
                    'code' => '998-0589',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CHIBUNGA',
                ),
            121 =>
                array(
                    'code' => '998-0590',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL ELOY ALFARO',
                ),
            122 =>
                array(
                    'code' => '998-0591',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE RICAURTE',
                ),
            123 =>
                array(
                    'code' => '998-0592',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL SAN ANTONIO',
                ),
            124 =>
                array(
                    'code' => '998-0594',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE WILFRIDO LOOR MOREIRA ( MAICITO )',
                ),
            125 =>
                array(
                    'code' => '998-0595',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN PEDRO DE SUMA',
                ),
            126 =>
                array(
                    'code' => '998-0597',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN FRANCISCO DE NOVILLO ( CAB. EN NOVILLO )',
                ),
            127 =>
                array(
                    'code' => '998-0598',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ZAPALLO',
                ),
            128 =>
                array(
                    'code' => '998-0600',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PAROQUIAL RURAL DE AMERICA',
                ),
            129 =>
                array(
                    'code' => '998-0601',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL  EL ANEGADO',
                ),
            130 =>
                array(
                    'code' => '998-0602',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA  PARROQUIA RURAL DE JULCUY',
                ),
            131 =>
                array(
                    'code' => '998-0603',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LA UNION',
                ),
            132 =>
                array(
                    'code' => '998-0604',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL MEMBRILLAL',
                ),
            133 =>
                array(
                    'code' => '998-0605',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUI RURAL PEDRO PABLO GOMEZ',
                ),
            134 =>
                array(
                    'code' => '998-0606',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PUERTO DE  CAYO',
                ),
            135 =>
                array(
                    'code' => '998-0608',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL SAN LORENZO',
                ),
            136 =>
                array(
                    'code' => '998-0609',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL DE SANTA MARIANITA',
                ),
            137 =>
                array(
                    'code' => '998-0611',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA LA PILA',
                ),
            138 =>
                array(
                    'code' => '998-0613',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL CAMPOZANO',
                ),
            139 =>
                array(
                    'code' => '998-0614',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL CASCOL',
                ),
            140 =>
                array(
                    'code' => '998-0615',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL GUALE',
                ),
            141 =>
                array(
                    'code' => '998-0616',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL ALEJO LASCANO',
                ),
            142 =>
                array(
                    'code' => '998-0618',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE BARRAGANETE',
                ),
            143 =>
                array(
                    'code' => '998-0619',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN SEBASTIAN',
                ),
            144 =>
                array(
                    'code' => '998-0621',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PARROQUIAL DE AYACUCHO',
                ),
            145 =>
                array(
                    'code' => '998-0622',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL DE HONORATO VASQUEZ',
                ),
            146 =>
                array(
                    'code' => '998-0623',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL LA UNION',
                ),
            147 =>
                array(
                    'code' => '998-0624',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PARROQUIAL DE SAN PABLO DE PUEBLO NUEVO',
                ),
            148 =>
                array(
                    'code' => '998-0626',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALZIADO DE LA PARROQUIA CHARAPOTO',
                ),
            149 =>
                array(
                    'code' => '998-0627',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL DE SAN ISIDRO',
                ),
            150 =>
                array(
                    'code' => '998-0629',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL DE BACHILLERO',
                ),
            151 =>
                array(
                    'code' => '998-0630',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ANGEL PEDRO GILER',
                ),
            152 =>
                array(
                    'code' => '998-0632',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL DE BELLAVISTA',
                ),
            153 =>
                array(
                    'code' => '998-0633',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PARROQUIAL DE NOBOA',
                ),
            154 =>
                array(
                    'code' => '998-0634',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL ARQ. SIXTO DURAN BALLEN E',
                ),
            155 =>
                array(
                    'code' => '998-0636',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE COJIMIES',
                ),
            156 =>
                array(
                    'code' => '998-0637',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL DIEZ DE AGOSTO',
                ),
            157 =>
                array(
                    'code' => '998-0638',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ATAHUALPA',
                ),
            158 =>
                array(
                    'code' => '998-0640',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL DE PUERTO MACHALILLA',
                ),
            159 =>
                array(
                    'code' => '998-0641',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SALANGO',
                ),
            160 =>
                array(
                    'code' => '998-0643',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO SAN ANDRES DE CANOA',
                ),
            161 =>
                array(
                    'code' => '998-0645',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE ALSHI 9 DE OCTUBRE',
                ),
            162 =>
                array(
                    'code' => '998-0646',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE GENERAL PROANO',
                ),
            163 =>
                array(
                    'code' => '998-0647',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO PARROQUIAL DE SAN ISIDRO',
                ),
            164 =>
                array(
                    'code' => '998-0648',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SEVILLA DON BOSCO',
                ),
            165 =>
                array(
                    'code' => '998-0649',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO PARROQUIAL DE SINAI',
                ),
            166 =>
                array(
                    'code' => '998-0650',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ZUNA ( ZUNAC )',
                ),
            167 =>
                array(
                    'code' => '998-0651',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CUCHAENTZA',
                ),
            168 =>
                array(
                    'code' => '998-0652',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN JOSE DE MORONA',
                ),
            169 =>
                array(
                    'code' => '998-0653',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE RIO BLANCO',
                ),
            170 =>
                array(
                    'code' => '998-0655',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE AMAZONAS',
                ),
            171 =>
                array(
                    'code' => '998-0656',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE BERMEJOS',
                ),
            172 =>
                array(
                    'code' => '998-0657',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE BOMBOIZA',
                ),
            173 =>
                array(
                    'code' => '998-0658',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CHIGUINDA',
                ),
            174 =>
                array(
                    'code' => '998-0659',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE EL ROSARIO (MORONA SANTIAGO)',
                ),
            175 =>
                array(
                    'code' => '998-0660',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO PARROQUIAL DE NUEVA TARQUI',
                ),
            176 =>
                array(
                    'code' => '998-0661',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN MIGUEL DE CUYES',
                ),
            177 =>
                array(
                    'code' => '998-0662',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE EL IDEAL',
                ),
            178 =>
                array(
                    'code' => '998-0664',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PARROQUIAL DE INDANZA',
                ),
            179 =>
                array(
                    'code' => '998-0665',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN ANTONIO ( CAB. EN SAN ANTONIO DEL CENTRO )',
                ),
            180 =>
                array(
                    'code' => '998-0666',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN MIGUEL DE CONCHAY',
                ),
            181 =>
                array(
                    'code' => '998-0667',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE SANTA SUSANA DE CHIVIAZA',
                ),
            182 =>
                array(
                    'code' => '998-0668',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL YUNGANZA',
                ),
            183 =>
                array(
                    'code' => '998-0670',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ARAPICOS',
                ),
            184 =>
                array(
                    'code' => '998-0671',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CUMANDA ',
                ),
            185 =>
                array(
                    'code' => '998-0672',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SANGAY',
                ),
            186 =>
                array(
                    'code' => '998-0673',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PARROQUIAL 16 DE AGOSTO',
                ),
            187 =>
                array(
                    'code' => '998-0675',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE COPAL',
                ),
            188 =>
                array(
                    'code' => '998-0676',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA DE CHUPIANZA',
                ),
            189 =>
                array(
                    'code' => '998-0677',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA DE PATUCA',
                ),
            190 =>
                array(
                    'code' => '998-0678',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN LUIS  DE EL ACHO ( CAB. EN EL ACHO  )',
                ),
            191 =>
                array(
                    'code' => '998-0679',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SANTIAGO',
                ),
            192 =>
                array(
                    'code' => '998-0680',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TAYUZA',
                ),
            193 =>
                array(
                    'code' => '998-0681',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA DE SAN FRANCISCO DE CHINIMBIMI',
                ),
            194 =>
                array(
                    'code' => '998-0683',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA ASUNCION',
                ),
            195 =>
                array(
                    'code' => '998-0684',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE HUAMBI',
                ),
            196 =>
                array(
                    'code' => '998-0685',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE SANTA MARIANITA DE JESUS',
                ),
            197 =>
                array(
                    'code' => '998-0687',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CHIGUAZA',
                ),
            198 =>
                array(
                    'code' => '998-0689',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PAN DE AZUCAR',
                ),
            199 =>
                array(
                    'code' => '998-0690',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN CARLOS DE LIMON',
                ),
            200 =>
                array(
                    'code' => '998-0692',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SANTIAGO DE PANANZA',
                ),
            201 =>
                array(
                    'code' => '998-0694',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE HUASAGA ( CAB. EN WAMPUIK )',
                ),
            202 =>
                array(
                    'code' => '998-0695',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE MACUMA',
                ),
            203 =>
                array(
                    'code' => '998-0696',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TUUTINENTZA',
                ),
            204 =>
                array(
                    'code' => '998-0698',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE YAUPI',
                ),
            205 =>
                array(
                    'code' => '998-0699',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO UTONOMO DESCENTRALIZADO PARROQUIAL DE SHIMPIS',
                ),
            206 =>
                array(
                    'code' => '998-0701',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE AHUANO',
                ),
            207 =>
                array(
                    'code' => '998-0702',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CHONTAPUNTA',
                ),
            208 =>
                array(
                    'code' => '998-0703',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PANO',
                ),
            209 =>
                array(
                    'code' => '998-0704',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PUERTO MISAHUALLI',
                ),
            210 =>
                array(
                    'code' => '998-0705',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PUERTO NAPO',
                ),
            211 =>
                array(
                    'code' => '998-0706',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL TALAG',
                ),
            212 =>
                array(
                    'code' => '998-0707',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SAN JUAN DE MUYUNA',
                ),
            213 =>
                array(
                    'code' => '998-0708',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE COTUNDO',
                ),
            214 =>
                array(
                    'code' => '998-0709',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SAN PABLO DE USHPAYACU',
                ),
            215 =>
                array(
                    'code' => '998-0711',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE GONZALO DIAZ DE PINEDA',
                ),
            216 =>
                array(
                    'code' => '998-0712',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE LINARES',
                ),
            217 =>
                array(
                    'code' => '998-0713',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE OYACACHI',
                ),
            218 =>
                array(
                    'code' => '998-0714',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SANTA ROSA',
                ),
            219 =>
                array(
                    'code' => '998-0715',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SARDINAS',
                ),
            220 =>
                array(
                    'code' => '998-0717',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE COSANGA',
                ),
            221 =>
                array(
                    'code' => '998-0718',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CUYUJA',
                ),
            222 =>
                array(
                    'code' => '998-0719',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PAPALLACTA',
                ),
            223 =>
                array(
                    'code' => '998-0720',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN FRANCISCO DE BORJA',
                ),
            224 =>
                array(
                    'code' => '998-0721',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SUMACO',
                ),
            225 =>
                array(
                    'code' => '998-0723',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CANELOS',
                ),
            226 =>
                array(
                    'code' => '998-0724',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => ' GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DIEZ DE AGOSTO',
                ),
            227 =>
                array(
                    'code' => '998-0725',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE FATIMA',
                ),
            228 =>
                array(
                    'code' => '998-0726',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE MONTALVO ( ANDOAS )',
                ),
            229 =>
                array(
                    'code' => '998-0727',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE POMONA',
                ),
            230 =>
                array(
                    'code' => '998-0728',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL RIO CORRIENTES',
                ),
            231 =>
                array(
                    'code' => '998-0729',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE RIO TIGRE',
                ),
            232 =>
                array(
                    'code' => '998-0730',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SARAYACU',
                ),
            233 =>
                array(
                    'code' => '998-0731',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SIMON BOLIVAR ( CAB. EN  MUSHULLACTA )',
                ),
            234 =>
                array(
                    'code' => '998-0732',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TARQUI',
                ),
            235 =>
                array(
                    'code' => '998-0733',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TENIENTE HUGO ORTIZ',
                ),
            236 =>
                array(
                    'code' => '998-0734',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE VERACRUZ ( INDILLANA CAB. EN INDILLANA',
                ),
            237 =>
                array(
                    'code' => '998-0735',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL EL TRIUNFO',
                ),
            238 =>
                array(
                    'code' => '998-0737',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE MADRE TIERRA',
                ),
            239 =>
                array(
                    'code' => '998-0738',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SHELL',
                ),
            240 =>
                array(
                    'code' => '998-0739',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SAN JOSE',
                ),
            241 =>
                array(
                    'code' => '998-0740',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CURARAY',
                ),
            242 =>
                array(
                    'code' => '998-0742',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ALANGASI',
                ),
            243 =>
                array(
                    'code' => '998-0743',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE AMAGUANA',
                ),
            244 =>
                array(
                    'code' => '998-0744',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL ATAHUALPA',
                ),
            245 =>
                array(
                    'code' => '998-0745',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CALACALI',
                ),
            246 =>
                array(
                    'code' => '998-0746',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CALDERON',
                ),
            247 =>
                array(
                    'code' => '998-0747',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CONOCOTO',
                ),
            248 =>
                array(
                    'code' => '998-0748',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CUMBAYA',
                ),
            249 =>
                array(
                    'code' => '998-0749',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CHAVEZPAMBA',
                ),
            250 =>
                array(
                    'code' => '998-0750',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CHECA ( CHILPA )',
                ),
            251 =>
                array(
                    'code' => '998-0751',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DEL QUINCHE',
                ),
            252 =>
                array(
                    'code' => '998-0752',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL GUALEA',
                ),
            253 =>
                array(
                    'code' => '998-0753',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE GUANGOPOLO',
                ),
            254 =>
                array(
                    'code' => '998-0754',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA DE GUAYLLABAMBA',
                ),
            255 =>
                array(
                    'code' => '998-0755',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LA MERCED',
                ),
            256 =>
                array(
                    'code' => '998-0756',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LLANO CHICO',
                ),
            257 =>
                array(
                    'code' => '998-0757',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LLOA',
                ),
            258 =>
                array(
                    'code' => '998-0758',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE NANEGAL',
                ),
            259 =>
                array(
                    'code' => '998-0759',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE NANEGALITO',
                ),
            260 =>
                array(
                    'code' => '998-0760',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE NAYON',
                ),
            261 =>
                array(
                    'code' => '998-0761',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA DE NONO',
                ),
            262 =>
                array(
                    'code' => '998-0762',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL PACTO',
                ),
            263 =>
                array(
                    'code' => '998-0763',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL PERUCHO',
                ),
            264 =>
                array(
                    'code' => '998-0764',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIAL DE PIFO',
                ),
            265 =>
                array(
                    'code' => '998-0765',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO RURAL DE PINTAG',
                ),
            266 =>
                array(
                    'code' => '998-0766',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL POMASQUI',
                ),
            267 =>
                array(
                    'code' => '998-0767',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PUELLARO',
                ),
            268 =>
                array(
                    'code' => '998-0768',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA DE PUEMBO',
                ),
            269 =>
                array(
                    'code' => '998-0769',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SAN ANTONIO DE PICHINCHA',
                ),
            270 =>
                array(
                    'code' => '998-0770',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SAN JOSE DE MINAS',
                ),
            271 =>
                array(
                    'code' => '998-0771',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA DE TABABELA',
                ),
            272 =>
                array(
                    'code' => '998-0772',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE TUMBACO',
                ),
            273 =>
                array(
                    'code' => '998-0773',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE YARUQUI',
                ),
            274 =>
                array(
                    'code' => '998-0774',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA DE ZAMBIZA',
                ),
            275 =>
                array(
                    'code' => '998-0776',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ASCAZUBI',
                ),
            276 =>
                array(
                    'code' => '998-0777',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CANGAHUA',
                ),
            277 =>
                array(
                    'code' => '998-0778',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE OLMEDO ( PESILLO )',
                ),
            278 =>
                array(
                    'code' => '998-0779',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE OTON',
                ),
            279 =>
                array(
                    'code' => '998-0780',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SANTA ROSA DE CUZUBAMBA',
                ),
            280 =>
                array(
                    'code' => '998-0782',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ALOAG',
                ),
            281 =>
                array(
                    'code' => '998-0783',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ALOASI',
                ),
            282 =>
                array(
                    'code' => '998-0784',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CUTUGLAGUA',
                ),
            283 =>
                array(
                    'code' => '998-0785',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE EL CHAUPI',
                ),
            284 =>
                array(
                    'code' => '998-0786',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE MANUEL CORNEJO ASTORGA ( TANDAPI )',
                ),
            285 =>
                array(
                    'code' => '998-0787',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TAMBILLO',
                ),
            286 =>
                array(
                    'code' => '998-0788',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE UYUMBICHO',
                ),
            287 =>
                array(
                    'code' => '998-0790',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LA ESPERANZA',
                ),
            288 =>
                array(
                    'code' => '998-0791',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MALCHINGUI',
                ),
            289 =>
                array(
                    'code' => '998-0792',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TOCACHI',
                ),
            290 =>
                array(
                    'code' => '998-0793',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TUPIGACHI',
                ),
            291 =>
                array(
                    'code' => '998-0795',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE COTOGCHOA',
                ),
            292 =>
                array(
                    'code' => '998-0796',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE RUMIPAMBA',
                ),
            293 =>
                array(
                    'code' => '998-0798',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL ALLURIQUIN',
                ),
            294 =>
                array(
                    'code' => '998-0799',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PUERTO LIMON',
                ),
            295 =>
                array(
                    'code' => '998-0800',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LUZ DE AMERICA',
                ),
            296 =>
                array(
                    'code' => '998-0801',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SAN JACINTO DEL BUA',
                ),
            297 =>
                array(
                    'code' => '998-0802',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL VALLE HERMOSO',
                ),
            298 =>
                array(
                    'code' => '998-0803',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL EL ESFUERZO',
                ),
            299 =>
                array(
                    'code' => '998-0804',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MINDO',
                ),
            300 =>
                array(
                    'code' => '998-0806',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE AMBATILLO',
                ),
            301 =>
                array(
                    'code' => '998-0807',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ATAHUALPA GADPRATAHUALPA',
                ),
            302 =>
                array(
                    'code' => '998-0808',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE AUGUSTO N. MARTINEZ GADPRANM',
                ),
            303 =>
                array(
                    'code' => '998-0809',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA DE CONSTANTINO FERNANDEZ',
                ),
            304 =>
                array(
                    'code' => '998-0810',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE HUACHI GRANDE',
                ),
            305 =>
                array(
                    'code' => '998-0811',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE IZAMBA',
                ),
            306 =>
                array(
                    'code' => '998-0812',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE JUAN BENIGNO VELA',
                ),
            307 =>
                array(
                    'code' => '998-0813',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MONTALVO',
                ),
            308 =>
                array(
                    'code' => '998-0814',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SAN ANTONIO DE PASA',
                ),
            309 =>
                array(
                    'code' => '998-0815',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PICAIHUA',
                ),
            310 =>
                array(
                    'code' => '998-0816',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PILAHUIN',
                ),
            311 =>
                array(
                    'code' => '998-0817',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE QUISAPINCHA',
                ),
            312 =>
                array(
                    'code' => '998-0818',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN BARTOLOME DE PINLLO',
                ),
            313 =>
                array(
                    'code' => '998-0819',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN FERNANDO',
                ),
            314 =>
                array(
                    'code' => '998-0820',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SANTA ROSA',
                ),
            315 =>
                array(
                    'code' => '998-0821',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TOTORAS',
                ),
            316 =>
                array(
                    'code' => '998-0822',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CUNCHIBAMBA',
                ),
            317 =>
                array(
                    'code' => '998-0823',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GAD PARROQUIAL RURAL DE UNAMUNCHO',
                ),
            318 =>
                array(
                    'code' => '998-0825',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL LLIGUA',
                ),
            319 =>
                array(
                    'code' => '998-0826',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE RIO NEGRO',
                ),
            320 =>
                array(
                    'code' => '998-0827',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE RIO VERDE',
                ),
            321 =>
                array(
                    'code' => '998-0828',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ULBA',
                ),
            322 =>
                array(
                    'code' => '998-0830',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PINGUILI',
                ),
            323 =>
                array(
                    'code' => '998-0832',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE EL TRIUNFO',
                ),
            324 =>
                array(
                    'code' => '998-0833',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LOS ANDES',
                ),
            325 =>
                array(
                    'code' => '998-0834',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SUCRE',
                ),
            326 =>
                array(
                    'code' => '998-0836',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE RUMIPAMBA',
                ),
            327 =>
                array(
                    'code' => '998-0837',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE YANAYACU',
                ),
            328 =>
                array(
                    'code' => '998-0839',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE BENITEZ PACHANLICA',
                ),
            329 =>
                array(
                    'code' => '998-0840',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA BOLIVAR',
                ),
            330 =>
                array(
                    'code' => '998-0841',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE COTALO',
                ),
            331 =>
                array(
                    'code' => '998-0842',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA DE CHIQUICHA',
                ),
            332 =>
                array(
                    'code' => '998-0843',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL EL ROSARIO RUMICHACA',
                ),
            333 =>
                array(
                    'code' => '998-0844',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GAD PARROQUIAL RURAL DE GARCIA MORENO',
                ),
            334 =>
                array(
                    'code' => '998-0845',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE  HUAMBALO',
                ),
            335 =>
                array(
                    'code' => '998-0846',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SALASAKA',
                ),
            336 =>
                array(
                    'code' => '998-0848',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE BAQUERIZO MORENO',
                ),
            337 =>
                array(
                    'code' => '998-0849',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE EMILIO MARIA TERAN',
                ),
            338 =>
                array(
                    'code' => '998-0850',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MARCOS ESPINEL',
                ),
            339 =>
                array(
                    'code' => '998-0851',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PRESIDENTE URBINA',
                ),
            340 =>
                array(
                    'code' => '998-0852',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN ANDRES DE PILLARO',
                ),
            341 =>
                array(
                    'code' => '998-0853',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN JOSE DE POALO',
                ),
            342 =>
                array(
                    'code' => '998-0854',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN MIGUELITO',
                ),
            343 =>
                array(
                    'code' => '998-0856',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE QUINCHICOTO',
                ),
            344 =>
                array(
                    'code' => '998-0858',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CUMBARATZA',
                ),
            345 =>
                array(
                    'code' => '998-0859',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PARROQUIAL DE GUADALUPE',
                ),
            346 =>
                array(
                    'code' => '998-0860',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE IMBANA',
                ),
            347 =>
                array(
                    'code' => '998-0861',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SABANILLA CANTON ZAMORA',
                ),
            348 =>
                array(
                    'code' => '998-0862',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TIMBARA',
                ),
            349 =>
                array(
                    'code' => '998-0863',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO PARROQUIAL RURAL DE SAN CARLOS DE LAS MINAS',
                ),
            350 =>
                array(
                    'code' => '998-0865',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CHITO',
                ),
            351 =>
                array(
                    'code' => '998-0866',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE EL CHORRO',
                ),
            352 =>
                array(
                    'code' => '998-0867',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LA CHONTA',
                ),
            353 =>
                array(
                    'code' => '998-0868',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PUCAPAMBA',
                ),
            354 =>
                array(
                    'code' => '998-0869',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN ANDRES',
                ),
            355 =>
                array(
                    'code' => '998-0870',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE ZURMI',
                ),
            356 =>
                array(
                    'code' => '998-0872',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE LA PAZ',
                ),
            357 =>
                array(
                    'code' => '998-0873',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TUTUPALI',
                ),
            358 =>
                array(
                    'code' => '998-0875',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CHICANA',
                ),
            359 =>
                array(
                    'code' => '998-0876',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LOS ENCUENTROS',
                ),
            360 =>
                array(
                    'code' => '998-0877',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LA CANELA',
                ),
            361 =>
                array(
                    'code' => '998-0878',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE EL GUISMI',
                ),
            362 =>
                array(
                    'code' => '998-0879',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PACHICUTZA',
                ),
            363 =>
                array(
                    'code' => '998-0880',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE TUNDAYME',
                ),
            364 =>
                array(
                    'code' => '998-0881',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE NUEVO QUITO',
                ),
            365 =>
                array(
                    'code' => '998-0882',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE EL PORVENIR DEL CARMEN',
                ),
            366 =>
                array(
                    'code' => '998-0883',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN FRANCISCO DEL VERGEL',
                ),
            367 =>
                array(
                    'code' => '998-0884',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE VALLADOLID',
                ),
            368 =>
                array(
                    'code' => '998-0885',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE BELLAVISTA',
                ),
            369 =>
                array(
                    'code' => '998-0886',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE EL PROGRESO ( FLOREANA CAB. EN PTO. VELASCO IBARRA )',
                ),
            370 =>
                array(
                    'code' => '998-0887',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ISLA SANTA MARIA',
                ),
            371 =>
                array(
                    'code' => '998-0888',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TOMAS DE BERLANGA ( SANTO TOMAS )',
                ),
            372 =>
                array(
                    'code' => '998-0890',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE BELLAVISTA',
                ),
            373 =>
                array(
                    'code' => '998-0891',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SANTA ROSA',
                ),
            374 =>
                array(
                    'code' => '998-0893',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE DURENO',
                ),
            375 =>
                array(
                    'code' => '998-0894',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE GENERAL FARFAN',
                ),
            376 =>
                array(
                    'code' => '998-0895',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE EL ENO',
                ),
            377 =>
                array(
                    'code' => '998-0896',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PACAYACU',
                ),
            378 =>
                array(
                    'code' => '998-0897',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE JAMBELI',
                ),
            379 =>
                array(
                    'code' => '998-0898',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SANTA CECILIA',
                ),
            380 =>
                array(
                    'code' => '998-0899',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CHACARITA',
                ),
            381 =>
                array(
                    'code' => '998-0900',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL EL REVENTADOR',
                ),
            382 =>
                array(
                    'code' => '998-0901',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE GONZALO PIZARRO',
                ),
            383 =>
                array(
                    'code' => '998-0902',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE PUERTO LIBRE',
                ),
            384 =>
                array(
                    'code' => '998-0904',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE PALMA ROJA',
                ),
            385 =>
                array(
                    'code' => '998-0905',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PUERTO BOLIVAR',
                ),
            386 =>
                array(
                    'code' => '998-0906',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PUERTO RODRIGUEZ',
                ),
            387 =>
                array(
                    'code' => '998-0907',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SANTA ELENA',
                ),
            388 =>
                array(
                    'code' => '998-0909',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LIMONCOCHA',
                ),
            389 =>
                array(
                    'code' => '998-0910',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PANACOCHA',
                ),
            390 =>
                array(
                    'code' => '998-0911',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SAN ROQUE',
                ),
            391 =>
                array(
                    'code' => '998-0912',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SAN PEDRO DE LOS COFANES',
                ),
            392 =>
                array(
                    'code' => '998-0913',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SIETE DE JULIO',
                ),
            393 =>
                array(
                    'code' => '998-0915',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE EL PLAYON DE SAN FRANCISCO',
                ),
            394 =>
                array(
                    'code' => '998-0916',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LA SOFIA',
                ),
            395 =>
                array(
                    'code' => '998-0917',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL ROSA FLORIDA',
                ),
            396 =>
                array(
                    'code' => '998-0918',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SANTA BARBARA',
                ),
            397 =>
                array(
                    'code' => '998-0920',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SANTA ROSA DE SUCUMBIOS',
                ),
            398 =>
                array(
                    'code' => '998-0921',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SEVILLA',
                ),
            399 =>
                array(
                    'code' => '998-0922',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LA NUEVA TRONCAL',
                ),
            400 =>
                array(
                    'code' => '998-0923',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIA RURAL CUYABENO',
                ),
            401 =>
                array(
                    'code' => '998-0924',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE AGUAS NEGRAS',
                ),
            402 =>
                array(
                    'code' => '998-0926',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DAYUMA',
                ),
            403 =>
                array(
                    'code' => '998-0927',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TARACOA ( CAB. EN NUEVA ESPERANZA YUCA )',
                ),
            404 =>
                array(
                    'code' => '998-0928',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL ALEJANDRO LABAKA',
                ),
            405 =>
                array(
                    'code' => '998-0929',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE EL DORADO',
                ),
            406 =>
                array(
                    'code' => '998-0930',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL EL EDEN',
                ),
            407 =>
                array(
                    'code' => '998-0931',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE GARCIA MORENO',
                ),
            408 =>
                array(
                    'code' => '998-0932',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE INES ARANGO',
                ),
            409 =>
                array(
                    'code' => '998-0933',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LA BELLEZA',
                ),
            410 =>
                array(
                    'code' => '998-0934',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE NUEVO PARAISO',
                ),
            411 =>
                array(
                    'code' => '998-0935',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN JOSE DE GUAYUSA',
                ),
            412 =>
                array(
                    'code' => '998-0936',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN LUIS DE ARMENIA',
                ),
            413 =>
                array(
                    'code' => '998-0938',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CAPITAN AUGUSTO RIVADENEYRA',
                ),
            414 =>
                array(
                    'code' => '998-0939',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE CONONACO',
                ),
            415 =>
                array(
                    'code' => '998-0940',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SANTA MARIA DE HUIRIRIMA',
                ),
            416 =>
                array(
                    'code' => '998-0941',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE TIPUTINI',
                ),
            417 =>
                array(
                    'code' => '998-0942',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL YASUNI',
                ),
            418 =>
                array(
                    'code' => '998-0944',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE ENOKANQUI ( CAB. EN PARAISO )',
                ),
            419 =>
                array(
                    'code' => '998-0945',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL POMPEYA',
                ),
            420 =>
                array(
                    'code' => '998-0946',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN CARLOS',
                ),
            421 =>
                array(
                    'code' => '998-0947',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SAN SEBASTIAN DEL COCA',
                ),
            422 =>
                array(
                    'code' => '998-0948',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LAGO SAN PEDRO',
                ),
            423 =>
                array(
                    'code' => '998-0949',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE RUMIPAMBA',
                ),
            424 =>
                array(
                    'code' => '998-0950',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL TRES DE NOVIEMBRE',
                ),
            425 =>
                array(
                    'code' => '998-0951',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL UNION MILAGRENA',
                ),
            426 =>
                array(
                    'code' => '998-0953',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE AVILA ( CAB. EN HUIRUNO )',
                ),
            427 =>
                array(
                    'code' => '998-0954',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PUERTO MURIALDO',
                ),
            428 =>
                array(
                    'code' => '998-0955',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL SAN JOSE DE PAYAMINO',
                ),
            429 =>
                array(
                    'code' => '998-0956',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN JOSE DE DAHUANO',
                ),
            430 =>
                array(
                    'code' => '998-0957',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA PARROQUIAL DE SAN VICENTE DE HUATICOCHA',
                ),
            431 =>
                array(
                    'code' => '998-0958',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE SANTA MARIA DEL TOACHI',
                ),
            432 =>
                array(
                    'code' => '998-0959',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE NUEVO PARAISO',
                ),
            433 =>
                array(
                    'code' => '998-0960',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO RURAL DE LA PARROQUIA DE SANTA LUCIA DE LAS PENAS',
                ),
            434 =>
                array(
                    'code' => '998-0961',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL DE PUMPUENTSA',
                ),
            435 =>
                array(
                    'code' => '998-0962',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LOS ANGELES GADP RURAL LOS ANGELES',
                ),
            436 =>
                array(
                    'code' => '998-0963',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MILAGROS',
                ),
            437 =>
                array(
                    'code' => '998-0964',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN SALVADOR DE CANARIBAMBA',
                ),
            438 =>
                array(
                    'code' => '998-0965',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL EL TRIUNFO DORADO',
                ),
            439 =>
                array(
                    'code' => '998-0966',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL LA ESMERALDA',
                ),
            440 =>
                array(
                    'code' => '998-0967',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE PANGUINTZA',
                ),
            441 =>
                array(
                    'code' => '998-0968',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA ADMINISTRADORA DE AGUA POTABLE DE LA COMUNIDAD LA AMERICA',
                ),
            442 =>
                array(
                    'code' => '998-0969',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE CAZADEROS',
                ),
            443 =>
                array(
                    'code' => '998-0970',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA ADMINISTRADORA DE AGUA POTABLE DE LA COMUNIDAD DE CUNDUANA Y CORONA',
                ),
            444 =>
                array(
                    'code' => '998-0971',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA ADMINISTRADORA DE AGUA POTABLE Y ALCANTARILLADO REGIONAL YANAHURCO',
                ),
            445 =>
                array(
                    'code' => '998-0972',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE HATUN SUMAKU',
                ),
            446 =>
                array(
                    'code' => '998-0973',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL 10 DE AGOSTO',
                ),
            447 =>
                array(
                    'code' => '998-0974',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL SAN JOSE DE AYORA',
                ),
            448 =>
                array(
                    'code' => '998-0975',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE SAN JACINTO DE WAKAMBEIS',
                ),
            449 =>
                array(
                    'code' => '998-0976',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'JUNTA ADMINISTRADORA DE AGUA POTABLE Y ALCANTARILLADO DE LA PARROQUIA SALINAS',
                ),
            450 =>
                array(
                    'code' => '998-0977',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LA VILLEGAS',
                ),
            451 =>
                array(
                    'code' => '998-0978',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL PLAN PILOTO',
                ),
            452 =>
                array(
                    'code' => '998-0979',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE MONTERREY',
                ),
            453 =>
                array(
                    'code' => '998-0980',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE LA CUCA',
                ),
            454 =>
                array(
                    'code' => '998-0981',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'GOBIERNO AUTONOMO DESCENTRALIZADO PARROQUIAL RURAL DE NANKAIS',
                ),
            455 =>
                array(
                    'code' => '096-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESPE INNOVATIVA E.P.',
                ),
            456 =>
                array(
                    'code' => '098-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA CASA PARA TODOS EP',
                ),
            457 =>
                array(
                    'code' => '108-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MEDIOS PUBLICOS DE COMUNICACION DEL ECUADOR - MEDIOS PUBLICOS EP',
                ),
            458 =>
                array(
                    'code' => '109-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ASTILLEROS NAVALES ECUATORIANOS -ASTINAVE EP-',
                ),
            459 =>
                array(
                    'code' => '111-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA TAME LINEA AEREA DEL ECUADOR  TAME EP',
                ),
            460 =>
                array(
                    'code' => '112-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FLOTA PETROLERA ECUATORIANA -FLOPEC',
                ),
            461 =>
                array(
                    'code' => '113-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'TRANSPORTES NAVIEROS ECUATORIANOS',
                ),
            462 =>
                array(
                    'code' => '114-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA FLOTA PETROLERA ECUATORIANA-EP FLOPEC',
                ),
            463 =>
                array(
                    'code' => '119-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE SERVICIOS GENERALES E INGENIERIA UTM',
                ),
            464 =>
                array(
                    'code' => '121-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA CENTROS DE ENTRENAMIENTO PARA EL ALTO RENDIMIENTO - CEAR EP',
                ),
            465 =>
                array(
                    'code' => '123-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE RADIO TELEVISION Y PRENSA ESPOL',
                ),
            466 =>
                array(
                    'code' => '133-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UTMACH EP EMPRESA PUBLICA DE PRODUCCION Y DESARROLLO ESTRATEGICO DE LA UNIVERSIDAD TECNICA DE MACHALA',
                ),
            467 =>
                array(
                    'code' => '134-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA COORDINADORA DE EMPRESAS PUBLICAS -EMCO EP',
                ),
            468 =>
                array(
                    'code' => '221-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE ADMINISTRACION Y GESTION DE LOS SERVICIOS LA CONSULTORIA ESPECIALIZADA Y LOS PRODUCTOS DE PROYECTOS DE INVESTIGACION DE LA UNIVERSIDAD DE CUENCA UCUENCA EP',
                ),
            469 =>
                array(
                    'code' => '223-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'UNAE-EP',
                ),
            470 =>
                array(
                    'code' => '238-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE SERVICIOS UNESUM -EPSU',
                ),
            471 =>
                array(
                    'code' => '241-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA EP EDUQUIL UG',
                ),
            472 =>
                array(
                    'code' => '245-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'IKIAM EP',
                ),
            473 =>
                array(
                    'code' => '252-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DEL AGUA - EPA  EP',
                ),
            474 =>
                array(
                    'code' => '253-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE PRODUCCION Y DESARROLLO ESTRATEGICO DE LA UNIVERSIDAD LAICA ELOY ALFARO DE MANABI - EP ULEAM',
                ),
            475 =>
                array(
                    'code' => '261-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESTACION DE SERVICIOS ESPOCH GASOLINERA POLITECNICA EP',
                ),
            476 =>
                array(
                    'code' => '262-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE ADMINISTRACION Y GESTION DE SERVICIOS Y PRODUCTOS DE PROYECTOS DE INVESTIGACION DE LA ESCUELA POLITECNICA NACIONAL EPN-TECH EP',
                ),
            477 =>
                array(
                    'code' => '263-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA CEC EP',
                ),
            478 =>
                array(
                    'code' => '270-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA DE MUNICIONES SANTA BARBARA EP',
                ),
            479 =>
                array(
                    'code' => '273-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE INNOVACION Y COMERCIALIZACION INVENTIO-ESPOL EP',
                ),
            480 =>
                array(
                    'code' => '277-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PÃšBLICA ESCUELA DE CONDUCCION ESPOCH CONDUESPOCH EP',
                ),
            481 =>
                array(
                    'code' => '279-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA LA UEMPRENDE EP',
                ),
            482 =>
                array(
                    'code' => '299-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE DESARROLLO ESTRATEGICO ECUADOR ESTRATEGICO EP',
                ),
            483 =>
                array(
                    'code' => '301-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE BIENES Y SERVICIOS UCE PROYECTOS EP',
                ),
            484 =>
                array(
                    'code' => '324-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE PRODUCCION Y DESARROLLO ESTRATEGICO DE LA UNVERSIDAD TECNICA ESTATAL DE QUEVEDO EP PRODEUTEQ EP',
                ),
            485 =>
                array(
                    'code' => '327-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA TAME LINEA AEREA DEL ECUADOR TAME EP',
                ),
            486 =>
                array(
                    'code' => '327-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'TAME - AMAZONIA',
                ),
            487 =>
                array(
                    'code' => '333-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE INVESTIGACION CENTRO E.P.I. CENTRO',
                ),
            488 =>
                array(
                    'code' => '337-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FABRICAMOS ECUADOR FABREC EP',
                ),
            489 =>
                array(
                    'code' => '338-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA ESPOCH',
                ),
            490 =>
                array(
                    'code' => '343-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA YACHAY E.P.',
                ),
            491 =>
                array(
                    'code' => '344-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE PRODUCCION Y DESARROLLO ESTRATEGICO DE LA UNIVERSIDAD ESTATAL DE MILAGRO (EPUNEMI)',
                ),
            492 =>
                array(
                    'code' => '348-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE OBRAS BIENES Y SERVICIOS SANTA ELENA EP',
                ),
            493 =>
                array(
                    'code' => '351-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EP SERVICIO ASESORIA CONSULTA Y CAPACITACION DE INGENIERIA QUIMICA',
                ),
            494 =>
                array(
                    'code' => '354-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE SERVICIOS ESPOL-TECH EP',
                ),
            495 =>
                array(
                    'code' => '355-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ESCUELA DE CONDUCTORES PROFESIONALES ESPOL EP',
                ),
            496 =>
                array(
                    'code' => '429-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA NACIONAL MINERA ENAMI EP',
                ),
            497 =>
                array(
                    'code' => '451-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA ELECTRICA REGIONAL NORTE',
                ),
            498 =>
                array(
                    'code' => '458-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CORPORACION ELECTRICA DEL ECUADOR CELEC EP',
                ),
            499 =>
                array(
                    'code' => '459-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE EXPLORACION Y EXPLOTACION DE HIDROCARBUROS PETROAMAZONAS EP',
                ),
        ));
        DB::table('institutions')->insert(array(
            0 =>
                array(
                    'code' => '460-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE HIDROCARBUROS DEL ECUADOR EP PETROECUADOR',
                ),
            1 =>
                array(
                    'code' => '462-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA ELECTRICA PUBLICA ESTRATEGICA CORPORACION NACIONAL DE ELECTRICIDAD CNEL EP',
                ),
            2 =>
                array(
                    'code' => '477-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ENFARMA EP',
                ),
            3 =>
                array(
                    'code' => '478-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA CEMENTERA DEL ECUADOR EP',
                ),
            4 =>
                array(
                    'code' => '524-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'TRANSESPOL E.P.',
                ),
            5 =>
                array(
                    'code' => '530-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CORPORACION NACIONAL DE TELECOMUNICACIONES - CNT EP',
                ),
            6 =>
                array(
                    'code' => '532-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA CORREOS DEL ECUADOR CDE E.P.',
                ),
            7 =>
                array(
                    'code' => '536-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FERROCARRILES DEL ECUADOR  EMPRESA PUBLICA - FEEP',
                ),
            8 =>
                array(
                    'code' => '565-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE ADMINISTRACION GESTION DE SERVICIOS Y TRANSFERENCIA CIENTIFICA TECNOLOGICA DE LA ESCUELA SUPERIOR POLITECNICA AGROPECUARIA DE MANABI  - ESPAM MFL EP',
                ),
            9 =>
                array(
                    'code' => '604-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA UPEC CREATIVA EP',
                ),
            10 =>
                array(
                    'code' => '605-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA UTE-LVT EP',
                ),
            11 =>
                array(
                    'code' => '606-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA UNIVERSITARIA DE SALUD EP',
                ),
            12 =>
                array(
                    'code' => '627-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA EP. TEC UNACH',
                ),
            13 =>
                array(
                    'code' => '827-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE PRODUCCION Y DE SERVICIOS DE LA UNIVERSIDAD ESTATAL DE BOLIVAR PROSERVI-UEB-EP',
                ),
            14 =>
                array(
                    'code' => '948-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INGENIERIA MATERIALES Y SISTEMAS UG-EP',
                ),
            15 =>
                array(
                    'code' => '964-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA UNIDAD NACIONAL DE ALMACENAMIENTO UNA EP',
                ),
            16 =>
                array(
                    'code' => '975-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE LA UNIVERSIDAD TECNICA DE AMBATO UTA EP',
                ),
            17 =>
                array(
                    'code' => '993-0032',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE ASEO INTEGRAL MONTECRISTI - EP',
                ),
            18 =>
                array(
                    'code' => '993-0095',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE LA MANCOMUNIDAD DE TRANSITO TRANSPORTE TERRESTRE Y SEGURIDAD VIAL DE LA PROVINCIA DE PASTAZA TRANSCOMUNIDAD-EP',
                ),
            19 =>
                array(
                    'code' => '993-0097',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE TURISMO PROMOCION CIVICA Y RELACIONES INTERNACIONALES DE GUAYAQUIL EP',
                ),
            20 =>
                array(
                    'code' => '993-0114',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON QUININDE -EP',
                ),
            21 =>
                array(
                    'code' => '993-0118',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL FARMACIA FRONTERIZA DE TIWINTZA - FARMAFRO EP',
                ),
            22 =>
                array(
                    'code' => '993-0128',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE MERCADOS Y CAMALES',
                ),
            23 =>
                array(
                    'code' => '993-0132',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MANCOMUNADA DE MOVILIDAD SUSTENTABLE DE ZAMORA CHINCHIPE E.P. EMMSZACH EP',
                ),
            24 =>
                array(
                    'code' => '993-0133',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE CENTROS COMERCIALES Y TERMINAL TERRESTRE DEL CANTON PORTOVIEJO',
                ),
            25 =>
                array(
                    'code' => '993-0134',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE VIVIENDA DEL CANTON PORTOVIEJO',
                ),
            26 =>
                array(
                    'code' => '993-0135',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE FAENEAMIENTO INDUSTRIALIZACION Y COMERCIALIZACION DE GANADO PRODUCTOS SUBPRODUCTOS O DERIVADOS DEL GAD DEL CANTON SUCUA',
                ),
            27 =>
                array(
                    'code' => '993-0137',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE PARQUES CEMENTERIOS AREAS VERDES ZONAS DE RECREACION Y ESPACIOS CULTURALES DE PORTOVIEJO',
                ),
            28 =>
                array(
                    'code' => '993-0138',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA PROVINCIAL DE SERVICIO SOCIAL SANTO DOMINGO SOLIDARIO',
                ),
            29 =>
                array(
                    'code' => '993-0219',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE MERCADOS MUNICIPALES DEL CANTON QUEVEDO EPUMEM-Q',
                ),
            30 =>
                array(
                    'code' => '993-0220',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE LA TERMINAL TERRESTRE DEL CANTON CANAR-EP',
                ),
            31 =>
                array(
                    'code' => '993-0221',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE INSFRAESTRUCTURA Y SERVICIOS DE RASTRO SAN LORENZO DE JIPIJAPA EP MSR-SLJ',
                ),
            32 =>
                array(
                    'code' => '993-0222',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE PARQUES Y AREAS VERDES DEL CANTON QUEVEDO',
                ),
            33 =>
                array(
                    'code' => '993-0223',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE COMUNICACION E INFORMACION DEL CANTON EL GUABO EPMCIEG-EP',
                ),
            34 =>
                array(
                    'code' => '993-0224',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE MOVILIDAD DE MACHALA EPMM-M',
                ),
            35 =>
                array(
                    'code' => '993-0225',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE COMUNICACION E INFORMACION PASAJE DE LAS NIEVES CIP-EP',
                ),
            36 =>
                array(
                    'code' => '993-0226',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE TRANSPORTE TERRESTRE TRANSITO Y SEGURIDAD VIAL DEL CANTON PORTOVIEJO EP PORTOVIAL EP',
                ),
            37 =>
                array(
                    'code' => '993-0227',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL AGROINDUSTRIAL EP-EMPROFRUB',
                ),
            38 =>
                array(
                    'code' => '993-0228',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL REGISTRO DE LA PROPIEDAD DEL CANTON SANTO DOMINGO',
                ),
            39 =>
                array(
                    'code' => '993-0229',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON EL GUABO EPAAGUA',
                ),
            40 =>
                array(
                    'code' => '993-0230',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE SERVICIOS TURISTICOS DEL CANTON ZAMORA EMSETURI-EP',
                ),
            41 =>
                array(
                    'code' => '993-0232',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE SERVICIOSMUNICIPALES OLMEDO - MANABI EMASERVI EP',
                ),
            42 =>
                array(
                    'code' => '993-0234',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE MOVILIDAD DE SAMBORONDON EP',
                ),
            43 =>
                array(
                    'code' => '993-0235',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA PROVINCIAL MANABI PRODUCE EP',
                ),
            44 =>
                array(
                    'code' => '993-0236',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE VIVIENDA DE INTERES SOCIAL DE GUARANDA EP-MVISG',
                ),
            45 =>
                array(
                    'code' => '993-0237',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL MANCOMUNADA DE ASEO DE LOS CANTONES ALAUSI COLTA GUAMOTE',
                ),
            46 =>
                array(
                    'code' => '993-0238',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE COMUNICACION E INFORMACION DE PINDAL - EMCIP EP',
                ),
            47 =>
                array(
                    'code' => '993-0239',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA PARQUE INDUSTRIAL DE LOJA EP',
                ),
            48 =>
                array(
                    'code' => '993-0240',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON LOMAS DE SARGENTILLO - EPMAPALS',
                ),
            49 =>
                array(
                    'code' => '993-0243',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE TRANSPORTE EQUIPOS Y MAQUINARIAS DEL CANTON JAMA',
                ),
            50 =>
                array(
                    'code' => '993-0246',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE TURISMO COLTA LINDO Y MILENARIO TOURING',
                ),
            51 =>
                array(
                    'code' => '993-0247',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE ORGANIZACION Y FUNCIONAMIENTO DE LAS OBRAS TURISTICAS DEL CANTON PUERTO LOPEZ - EPMOTPL',
                ),
            52 =>
                array(
                    'code' => '993-0250',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE CONSTRUCCION PROVINCIAL DE ESMERALDAS - ESMERALDAS CONSTRUYE',
                ),
            53 =>
                array(
                    'code' => '993-0251',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA ZONA DE INFRAESTRUCTURA LOGISTICA Y COMPETITIVIDAD EP-ZONA-ILCO',
                ),
            54 =>
                array(
                    'code' => '993-0255',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE COMUNICACION FORMACION E INFORMACION DEL CANTON PUERTO LOPEZ EMCIPLO EP',
                ),
            55 =>
                array(
                    'code' => '993-0256',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA DE BALANCEADOS AMAZONICOS ORELLANA EP',
                ),
            56 =>
                array(
                    'code' => '993-0257',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE URBANIZACION Y VIVIENDA DEL CANTON VALENCIA - EMVI EP',
                ),
            57 =>
                array(
                    'code' => '993-0258',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA DE CONSTRUCCIONES DEL CANAR EP',
                ),
            58 =>
                array(
                    'code' => '993-0260',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA PROVINCIAL RADIO CULTURAL IDENTIDAD EP',
                ),
            59 =>
                array(
                    'code' => '993-0264',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA CORPORACION ORENSE DE DESARROLLO ECONOMICO TERRITORIAL DE EL ORO CORPODET EP',
                ),
            60 =>
                array(
                    'code' => '993-0265',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE VIVIENDA Y DESARROLLO URBANO DEL CANTON SANTA ELENA',
                ),
            61 =>
                array(
                    'code' => '993-0268',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE TRANSPORTE TERRESTRE TRANSITO SEGURIDAD VIAL Y TERMINALES TERRESTRES DE SANTO DOMINGO EPMT SD',
                ),
            62 =>
                array(
                    'code' => '993-0272',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA RED MUNICIPAL DE SALUD MACHALA EP',
                ),
            63 =>
                array(
                    'code' => '993-0273',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DEL REGISTRO DE LA PROPIEDAD DEL CANTON PORTOVIEJO EP',
                ),
            64 =>
                array(
                    'code' => '993-0276',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA TERMINAL TERRESTRE Y COMUNICACION SOCIAL COCA EP',
                ),
            65 =>
                array(
                    'code' => '993-0277',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA CUERPO DE BOMBEROS DEL CANTON VALENCIA EP CBCV',
                ),
            66 =>
                array(
                    'code' => '993-0278',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE TRANSFORMACION Y COMERCIALIZACION DE PRODUCTOS DE TIERRAS ALTAS',
                ),
            67 =>
                array(
                    'code' => '993-0293',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA PARA EL SISTEMA INTEGRAL DE FAENAMIENTO',
                ),
            68 =>
                array(
                    'code' => '993-0294',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE INFORMACION Y COMUNICACION DEL CANTON ZAPOTILLO EMINCOZA-EP',
                ),
            69 =>
                array(
                    'code' => '993-0296',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'PICHINCHA COMUNICACIONES EP',
                ),
            70 =>
                array(
                    'code' => '993-0300',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE INVERSIONES Y DESARROLLO DE NEGOCIOS SOSTENIBLES DEL GOBIERNO AUTONOMO DESCENTRALIZADO PROVINCIAL DEL GUAYAS INVERGUAYAS EP',
                ),
            71 =>
                array(
                    'code' => '993-0301',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL MANCOMUNADA DE ASEO INTEGRAL DE LOS CANTONES DE CAÃ‘AR BIBLIAN EL TAMBO Y SUSCAL',
                ),
            72 =>
                array(
                    'code' => '993-0302',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON MEJIA',
                ),
            73 =>
                array(
                    'code' => '993-0303',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL MANCOMUNADA DE AGUA POTABLE DE LOS CANTONES BOLIVAR JUNIN SAN VICENTE SUCRE Y TOSAGUA - EMMAP-EP',
                ),
            74 =>
                array(
                    'code' => '993-0307',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE AGUA ALCANTARILLADO Y ASEO DE PASAJE AGUAPAS EP',
                ),
            75 =>
                array(
                    'code' => '993-0309',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE SALITRE',
                ),
            76 =>
                array(
                    'code' => '993-0314',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE LATACUNGA EPMAPAL',
                ),
            77 =>
                array(
                    'code' => '993-0315',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE ASEO DEL CANTON PLAYAS EMAPLAYAS EP',
                ),
            78 =>
                array(
                    'code' => '993-0317',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE RASTRO Y PLAZAS DE GANADO DE SANTO DOMINGO',
                ),
            79 =>
                array(
                    'code' => '993-0318',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE ASEO Y GESTION AMBIENTAL DEL CANTON QUEVEDO EPMAGAQ',
                ),
            80 =>
                array(
                    'code' => '993-0319',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE COMUNICACION E INFORMACION DEL CANTON GONZANAMA',
                ),
            81 =>
                array(
                    'code' => '993-0321',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE VIALIDAD IMBAVIAL EP',
                ),
            82 =>
                array(
                    'code' => '993-0322',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE DESARROLLO Y CONSTRUCCIONES DEL GOBIERNO AUTONOMO DESCENTRALIZADO PROVINCIAL DE NAPO',
                ),
            83 =>
                array(
                    'code' => '993-0323',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE VIVIENDA MUNICIPAL DEL CANTON CENTINELA DEL CONDOR',
                ),
            84 =>
                array(
                    'code' => '993-0324',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE MERCADOS CENTROS COMERCIALES Y BAHIAS DEL CANTON BABAHOYO MECECOB EPB',
                ),
            85 =>
                array(
                    'code' => '993-0325',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COORDINADORA NACIONAL DE EMPRESAS PUBLICAS MUNICIPALES MANCOMUNADAS DE ASEO INTEGRAL - EP',
                ),
            86 =>
                array(
                    'code' => '993-0329',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA PISCICOLA CALMITUYACU EP',
                ),
            87 =>
                array(
                    'code' => '993-0331',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA VIAL DEL GOBIERNO AUTONOMO PROVINCIAL DE ORELLANA EP - EMPROVIAL',
                ),
            88 =>
                array(
                    'code' => '993-0332',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE ARIDOS Y ASFALTOS DEL AZUAY ASFALTAR EP',
                ),
            89 =>
                array(
                    'code' => '993-0333',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON QUEVEDO',
                ),
            90 =>
                array(
                    'code' => '993-0336',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO SANITARIO DEL CANTON JIPIJAPA EPMAPAS-J',
                ),
            91 =>
                array(
                    'code' => '993-0338',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON PUERTO LOPEZ EPMAPAPL',
                ),
            92 =>
                array(
                    'code' => '993-0339',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL TRANSPORTES Y TERMINALES JOCAY-EP',
                ),
            93 =>
                array(
                    'code' => '993-0341',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL MANCOMUNADA DE AGUA POTABLE  ALCANTARILLADO SANITARIO Y PLUVIAL Y DEPURACION Y APROVECHAMIENTO DE AGUAS RESIDUALES SANEAMIENTO AGUAPEN-EP',
                ),
            94 =>
                array(
                    'code' => '993-0342',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE  AGUA POTABLE Y ALCANTARILLADO DEL CANTON CHONE',
                ),
            95 =>
                array(
                    'code' => '993-0345',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA METROPOLITANA DEL MERCADO MAYORISTA DE QUITO (MMQ-EP)',
                ),
            96 =>
                array(
                    'code' => '993-0346',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA - EMPRESA MUNICIPAL MERCADO MAYORISTA AMBATO (EP-EMA)',
                ),
            97 =>
                array(
                    'code' => '993-0347',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE ALCANTARILLADO Y RESIDUOS SOLIDOS DE PAJAN EPMAPARS-P',
                ),
            98 =>
                array(
                    'code' => '993-0350',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE  AGUA POTABLE  Y ALCANTARILLADO DE GUAYAQUIL EP - EMAPAG EP',
                ),
            99 =>
                array(
                    'code' => '993-0352',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE DESARROLLO URBANO Y VIVIENDA DEL CANTON QUEVEDO EP',
                ),
            100 =>
                array(
                    'code' => '993-0357',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA FARMACIAS MUNICIPALES SOLIDARIAS FARMASOL EP',
                ),
            101 =>
                array(
                    'code' => '993-0358',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FARMACIA MUNICIPAL SOLIDARIA SANTA ISABEL FARMASI EP',
                ),
            102 =>
                array(
                    'code' => '993-0360',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE RADIO Y TELEVISION E.P. ISABELA COMUNICACION',
                ),
            103 =>
                array(
                    'code' => '993-0362',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PÃšBLICA MUNICIPAL DE CAMAL DEL CANTÃ“N QUEVEDO -EMUPUCAQ',
                ),
            104 =>
                array(
                    'code' => '993-0370',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PuBLICA MUNICIPAL DE TELECOMUNICACIONES AGUA POTABLE ALCANTARILLADO Y SANEAMIENTO DE CUENCA',
                ),
            105 =>
                array(
                    'code' => '993-0371',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE COMUNICACION E INFORMACION DE LATACUNGA EPMUCILA E.P.',
                ),
            106 =>
                array(
                    'code' => '993-0373',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON NOBOL EMPRESA PUBLICA ECAPAN EP',
                ),
            107 =>
                array(
                    'code' => '993-0374',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE TURISMO COTACACHI EP',
                ),
            108 =>
                array(
                    'code' => '993-0376',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE  AGUA POTABLE Y ALCANTARILLADO DE COLIMES  EPAPA COLI',
                ),
            109 =>
                array(
                    'code' => '993-0377',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FARMACIA MUNICIPAL SANTIAGO DE GUALACEO FARMASAG EP',
                ),
            110 =>
                array(
                    'code' => '993-0378',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL TERMINAL TERRESTRE TRANSITO Y SEGUIRIDAD VIAL DEL CANTON BABAHOYO',
                ),
            111 =>
                array(
                    'code' => '993-0380',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON LAGO AGRIO',
                ),
            112 =>
                array(
                    'code' => '993-0381',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE TURISMO QUE REGULA LA ADMINISTRACION Y EL USO DE LOS CENTROS TURISTICOS DE LA PROVINCIA BOLIVAR ',
                ),
            113 =>
                array(
                    'code' => '993-0383',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA  DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON ROCAFUERTE EPAPAR ',
                ),
            114 =>
                array(
                    'code' => '993-0384',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE SANEAMIENTO AMBIENTAL DE BABAHOYO - EMSABA EP',
                ),
            115 =>
                array(
                    'code' => '993-0388',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y SANEAMIENTO AMBIENTAL DE BUENA FE EMAPSA BF',
                ),
            116 =>
                array(
                    'code' => '993-0389',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE CONSTRUCCIONES DEL GOBIERNO AUTONOMO DESCENTRALIZADO PROVINCIAL DEL GUAYAS - CONSTRUGUAYAS E.P.',
                ),
            117 =>
                array(
                    'code' => '993-0391',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE PASTAZA EMAPAST EP',
                ),
            118 =>
                array(
                    'code' => '993-0396',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA PARA EL FOMENTO AGROPECUARIO Y PRODUCTIVO DE ZAMORA CHINCHIPE AGROPZACHIN EP',
                ),
            119 =>
                array(
                    'code' => '993-0397',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE SERVICIO DE RASTRO Y PLAZAS DE GANADO DEL CANTON MACARA EPUSRAPLAGMAC',
                ),
            120 =>
                array(
                    'code' => '993-0398',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE VIVIENDA Y CONSTRUCCION ZAMORA EMVICONZ',
                ),
            121 =>
                array(
                    'code' => '993-0399',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA CUERPO DE BOMBEROS DE MILAGRO EP-CBM',
                ),
            122 =>
                array(
                    'code' => '993-0403',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE VIVIENDA DE LOJA VIVEM-EP',
                ),
            123 =>
                array(
                    'code' => '993-0404',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO PALORA',
                ),
            124 =>
                array(
                    'code' => '993-0405',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE URBANIZACION Y VIVIENDA DE CUENCA  EMUVI EP',
                ),
            125 =>
                array(
                    'code' => '993-0406',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL REGISTRO DE LA PROPIEDAD DE GUAYAQUIL',
                ),
            126 =>
                array(
                    'code' => '993-0407',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE ASEO SANTA ROSA EMAS EP',
                ),
            127 =>
                array(
                    'code' => '993-0408',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE PEDERNALES EPMAPA - PED',
                ),
            128 =>
                array(
                    'code' => '993-0410',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y SANEAMIENTO DE PORTOVIEJO EP',
                ),
            129 =>
                array(
                    'code' => '993-0411',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE VIALIDAD ZAMORA CHINCHIPE VIALZACHIN EP DEL GOBIERNO PROVINCIAL DE ZAMORA CHINCHI',
                ),
            130 =>
                array(
                    'code' => '993-0412',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE VIVIENDA SOCIAL HABITAT E INDUSTRIALIZACION DE RESIDUOS SOLIDOS MATERIALES ARIDOS PETREOS DEL GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DE SAN MIGUEL DE IBARRA',
                ),
            131 =>
                array(
                    'code' => '993-0413',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE HABITAT Y VIVIENDA LA CASITA DE MIS SUENOS DEL GAD MUNICIPAL DE EL GUAB',
                ),
            132 =>
                array(
                    'code' => '993-0414',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE TURISMO Y COMUNICACION SOCIAL',
                ),
            133 =>
                array(
                    'code' => '993-0415',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE TRANSITO Y MOVILIDAD DE DURAN',
                ),
            134 =>
                array(
                    'code' => '993-0416',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL MANCOMUNADA DE ASEO INTEGRAL BOSQUE SECO',
                ),
            135 =>
                array(
                    'code' => '993-0417',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL VIAL DE CONSTRUCCIONES DE URBANIZACION Y VIVIENDA DEL CANTON SAN VICENTE',
                ),
            136 =>
                array(
                    'code' => '993-0418',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'LA EMPRESA MUNICIPAL DE MATRICULACION VEHICULAR ESTACIONAMIENTO TARIFADO Y TRANSITO EMMETT EP',
                ),
            137 =>
                array(
                    'code' => '993-0463',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HIDROEQUINOCCIO E.P.',
                ),
            138 =>
                array(
                    'code' => '993-0466',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HIDROZAMORA EP',
                ),
            139 =>
                array(
                    'code' => '993-0467',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HIDROPLAYAS EP',
                ),
            140 =>
                array(
                    'code' => '993-0469',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'HIDROMIRA CARCHI EP',
                ),
            141 =>
                array(
                    'code' => '993-0479',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA METROPOLITANA DE RASTRO QUITO',
                ),
            142 =>
                array(
                    'code' => '993-0480',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE SERVICIO DE RASTRO CATAMAYO EP RASTRO-CATAMAYO',
                ),
            143 =>
                array(
                    'code' => '993-0481',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE RASTRO TULCAN',
                ),
            144 =>
                array(
                    'code' => '993-0483',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA METROPOLITANA DE GESTION INTEGRAL DE RESIDUOS SOLIDOS EMGIRS-EP',
                ),
            145 =>
                array(
                    'code' => '993-0484',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE ASEO DE CUENCA EMAC - EP',
                ),
            146 =>
                array(
                    'code' => '993-0485',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA METROPOLITANA DE SERVICIOS AEROPORTUARIOS Y GESTION DE ZONAS FRANCAS Y REGIMENES ESP',
                ),
            147 =>
                array(
                    'code' => '993-0488',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE LA CIUDAD DE CHUNCHI',
                ),
            148 =>
                array(
                    'code' => '993-0489',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE ALCANTARILLADO Y SANEAMIENTO DE CALVAS EP EMAPAC',
                ),
            149 =>
                array(
                    'code' => '993-0490',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON BOLIVAR EPMAPA-B',
                ),
            150 =>
                array(
                    'code' => '993-0492',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE RESIDUOS SOLIDOS RUMINAHUI-ASEO  EPM',
                ),
            151 =>
                array(
                    'code' => '993-0494',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE CONSTRUCCION MANABI CONSTRUYE',
                ),
            152 =>
                array(
                    'code' => '993-0495',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE ASEO DE MACHALA EMAM EP',
                ),
            153 =>
                array(
                    'code' => '993-0496',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL TAMBO EMAPAT EP',
                ),
            154 =>
                array(
                    'code' => '993-0497',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE ALCANTARILLADO Y SANEAMIENTO DE CUMANDA EPMAPSAC',
                ),
            155 =>
                array(
                    'code' => '993-0498',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA CANTONAL DE VIVIENDA VIVIR ZAPOTILLO HERMOSO',
                ),
            156 =>
                array(
                    'code' => '993-0501',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA EMPRESA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE RIOBAMBA EP-EMAPAR',
                ),
            157 =>
                array(
                    'code' => '993-0502',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA VIAL PROVINCIAL DE LOS RIOS - EMVIALRIOS',
                ),
            158 =>
                array(
                    'code' => '993-0503',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'E-P EMPRESA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE GUARANDA E-P EMAPA-G',
                ),
            159 =>
                array(
                    'code' => '993-0504',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE VIVIENDA EMPUVI "PASAJE"',
                ),
            160 =>
                array(
                    'code' => '993-0505',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE DESARROLLO ECONOMICO EDEC-EP',
                ),
            161 =>
                array(
                    'code' => '993-0506',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE SERVICIOS DE CEMENTERIOS  SALAS DE VELACIONES Y EXEQUIAS DEL CANTON CUE',
                ),
            162 =>
                array(
                    'code' => '993-0507',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE AGUA POTABLE Y ALCANTARILLADO DE PUJILI EPAPAP',
                ),
            163 =>
                array(
                    'code' => '993-0508',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE DESARROLLO PRODUCTIVO Y COMPETITIVIDAD EMPUDEPRO-TENA EP',
                ),
            164 =>
                array(
                    'code' => '993-0509',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'FARMACIA MUNICIPAL EMPRESA PUBLICA FARMUNIC EP',
                ),
            165 =>
                array(
                    'code' => '993-0512',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE DESARROLLO TURISTICO DE RECREACION SOSTENIBLE Y SUSTENTABLE E INF. DE LUGARES T',
                ),
            166 =>
                array(
                    'code' => '993-0513',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE CONSTRUCCION VIAL DEL CANTON SANTA ELENA EMUVIAL EP',
                ),
            167 =>
                array(
                    'code' => '993-0514',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA HIDROELECTRICA ZAMORA CHINCHIPE HIDROZACHIN EP',
                ),
            168 =>
                array(
                    'code' => '993-0515',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL PARA LA ADMINISTRACION DEL SISTEMA DE ESTACIONAMIENTO REGULADO DEL CANTON MANTA',
                ),
            169 =>
                array(
                    'code' => '993-0516',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE ADMINISTRACION VIAL DEL GOBIERNO PROVINCIAL AUTONOMO DE MANABI',
                ),
            170 =>
                array(
                    'code' => '993-0519',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE VIALIDAD DEL SUR  VIALSUR E.P.',
                ),
            171 =>
                array(
                    'code' => '993-0523',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE MERCADO Y CAMAL SANTA ROSA',
                ),
            172 =>
                array(
                    'code' => '993-0525',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE LA TRONCAL - EMAPAT EP',
                ),
            173 =>
                array(
                    'code' => '993-0526',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA VIAL DEL GOBIERNO PROVINCIAL AUTONOMO DE EL ORO - EMVIAL EP',
                ),
            174 =>
                array(
                    'code' => '993-0527',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE IBARRA EMAPA-I',
                ),
            175 =>
                array(
                    'code' => '993-0528',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE VIVIENDA PROVIVIR PUYANGO',
                ),
            176 =>
                array(
                    'code' => '993-0529',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE VIVIENDA SOCIAL DE MILAGRO',
                ),
            177 =>
                array(
                    'code' => '993-0531',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA METROPOLITANA DE TRANSPORTE DE PASAJEROS DE QUITO',
                ),
            178 =>
                array(
                    'code' => '993-0537',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DEL MINI TERMINAL TERRESTRE DE LA CIUDAD DE BAHIA DE CARAQUEZ EMTTBC EP',
                ),
            179 =>
                array(
                    'code' => '993-0538',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE RECOLECCION  TRANSPORTE  TRATAMIENTO DE DESECHOS SOLIDOS PELIGROSOS Y NO PELIGROSOS DE ASEO Y LIMPIEZA Y DE MANTENIMIENTO DE LUGARES PUBLICOS DEL CANTON SANTA ELENA EMASA-EP',
                ),
            180 =>
                array(
                    'code' => '993-0539',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE ASEO Y GESTION AMBIENTAL DEL CANTON LATACUNGA EPAGAL',
                ),
            181 =>
                array(
                    'code' => '993-0542',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE MOVILIDAD  TRANSITO Y TRANSPORTE DE CUENCA - EMOV EP',
                ),
            182 =>
                array(
                    'code' => '993-0543',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE SERVICIOS DE RASTRO Y PLAZAS DE GANADO EMURPLAG EP',
                ),
            183 =>
                array(
                    'code' => '993-0544',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE FAENAMIENTO Y PRODUCTOS CARNICOS DE IBARRA',
                ),
            184 =>
                array(
                    'code' => '993-0545',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE  ALCANTARILLADO Y SANEAMIENTO BASICO DE PEDRO MONCAYO',
                ),
            185 =>
                array(
                    'code' => '993-0546',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE AGUA POTABLE  ALCANTARILLADO Y SANEAMIENTO DE GUALACEO EP',
                ),
            186 =>
                array(
                    'code' => '993-0547',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON ZAMORA EP EMAPAZ EP',
                ),
            187 =>
                array(
                    'code' => '993-0548',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE ALCANTARILLADO FAENAMIENTO Y SERVICIOS DEL CANTON SUCUA EPMAPAF-SP',
                ),
            188 =>
                array(
                    'code' => '993-0549',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL MANCOMUNADA DE ASEO INTEGRAL DE PALLATANGA  CUMANDA Y GENERAL ANTONIO ELIZ',
                ),
            189 =>
                array(
                    'code' => '993-0551',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE VIVIENDA Y DESARROLLO SI VIVIENDA EP',
                ),
            190 =>
                array(
                    'code' => '993-0552',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON SAMBORONDON EPMAPA-S',
                ),
            191 =>
                array(
                    'code' => '993-0554',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA METROPOLITANA DE HABITAT Y VIVIENDA',
                ),
            192 =>
                array(
                    'code' => '993-0555',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA CANTONAL DE AGUA POTABLE Y ALCANTARILLADO DE GUAYAQUL -ECAPAG',
                ),
            193 =>
                array(
                    'code' => '993-0556',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA DE AGUA POTABLE Y ALCANTARILLADO DE ESMERALDAS SAN MATEO',
                ),
            194 =>
                array(
                    'code' => '993-0561',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL MANCOMUNADA RECOLECCION  PROCESAMIENTO Y DISPOSICION FINAL DE DESECHOS SOLIDOS',
                ),
            195 =>
                array(
                    'code' => '993-0563',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE TURISMO CIUDAD MITAD DEL MUNDO EP',
                ),
            196 =>
                array(
                    'code' => '993-0564',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE INFRAESTRUCTURA  DESARROLLO Y SERVICIOS DEL CANTON PUERTO QUITO',
                ),
            197 =>
                array(
                    'code' => '993-0566',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA METROPOLITANA DE AGUA POTABLE Y SANEAMIENTO',
                ),
            198 =>
                array(
                    'code' => '993-0567',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA METROPOLITANA DE MOVILIDAD Y OBRAS PUBLICAS',
                ),
            199 =>
                array(
                    'code' => '993-0568',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA METROPOLITANA DE GESTION DE DESTINO TURISTICO',
                ),
            200 =>
                array(
                    'code' => '993-0569',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE TULCAN',
                ),
            201 =>
                array(
                    'code' => '993-0570',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA METROPOLITANA DE ASEO',
                ),
            202 =>
                array(
                    'code' => '993-0571',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA CANTONAL DE AGUA POTABLE  ALCANTARILLADO  MANEJO PLUVIAL  DEPURACION RESIDUOS MANTA',
                ),
            203 =>
                array(
                    'code' => '993-0572',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE PEDRO VICENTE MALDONADO EPMAPA - PVM',
                ),
            204 =>
                array(
                    'code' => '993-0573',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE  ALCANTARILLADO Y SANEAMIENTO AMBIENTAL DEL CANTON  AZOGUE',
                ),
            205 =>
                array(
                    'code' => '993-0574',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE SANTO DOMINGO EP',
                ),
            206 =>
                array(
                    'code' => '993-0575',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON SANTA ROSA EMAPASR EP',
                ),
            207 =>
                array(
                    'code' => '993-0576',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL MERCADO DE PRODUCTORES AGRICOLAS SAN PEDRO DE RIOBAMBA',
                ),
            208 =>
                array(
                    'code' => '993-0577',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA - EMPRESA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE AMBATO',
                ),
            209 =>
                array(
                    'code' => '993-0578',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE DURAN-EMPRESA PUBLICA-EMAPAD EP',
                ),
            210 =>
                array(
                    'code' => '993-0584',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL MANCOMUNADA DE ASEO INTEGRAL DE LA CUENCA DEL JUBONES EMMAICJ-EP',
                ),
            211 =>
                array(
                    'code' => '993-0585',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL MANCOMUNADA DE ASEO INTEGRAL DE LOS CANTONES DE PATATE Y PELILEO EMMAIT-EP',
                ),
            212 =>
                array(
                    'code' => '993-0586',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMMAI-MANABI-CS-EP',
                ),
            213 =>
                array(
                    'code' => '993-0587',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE SERVICIOS MUNICIPALES DE ANTONIO ANTE SERMAA EP',
                ),
            214 =>
                array(
                    'code' => '993-0588',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA METROPOLITANA DE LOGISTICA PARA LA SEGURIDAD Y LA CONVIVENCIA CIUDADANA EP',
                ),
            215 =>
                array(
                    'code' => '993-0589',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL MANCOMUNADA DE ASEO INTEGRAL DE LOS CANTONES DE GUALACEO CHORDELEG SIGSIG GUACHAPALA Y EL PAN',
                ),
            216 =>
                array(
                    'code' => '993-0632',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON ESPEJO EPMAPA-E',
                ),
            217 =>
                array(
                    'code' => '993-0634',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL REGIONAL DE AGUA POTABLE DE ARENILLAS Y HUAQUILLAS  EMRAPAH.',
                ),
            218 =>
                array(
                    'code' => '993-0642',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE  TERMINAL TERRESTRE DE LA CIUDAD DE QUEVEDO',
                ),
            219 =>
                array(
                    'code' => '993-0650',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE  ALCANTARILLADO Y ASEO CAYAMBE  EMAPAAC-EP',
                ),
            220 =>
                array(
                    'code' => '993-0664',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE  AGUA POTABLE Y ALCANTARILLADO DE LA CIUDAD DE LIMONES  EMAPAL.',
                ),
            221 =>
                array(
                    'code' => '993-0671',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON PICHINCHA',
                ),
            222 =>
                array(
                    'code' => '993-0674',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE COMERCIALIZACION Y RASTRO SAN MATEO  EMCORSAM.',
                ),
            223 =>
                array(
                    'code' => '993-0675',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON  VENTANAS EP-MAPAVEN',
                ),
            224 =>
                array(
                    'code' => '993-0685',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE  AGUA POTABLE Y ALCANTARILLADO DEL CANTON  FLAVIO ALFARO  EMAPAFA',
                ),
            225 =>
                array(
                    'code' => '993-0698',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA EMPRESA MUNICIPAL MERCADO MAYORISTA AMBATO',
                ),
            226 =>
                array(
                    'code' => '993-0699',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL CUERPO DE BOMBEROS DE AMBATO - EMPRESA PUBLICA',
                ),
            227 =>
                array(
                    'code' => '993-0700',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL TERMINAL TERRESTRE DE MACHALA EP',
                ),
            228 =>
                array(
                    'code' => '993-0702',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUSEO ARQUEOLOGICO Y CENTRO CULTURAL DE ORELLANA MACCO-EP',
                ),
            229 =>
                array(
                    'code' => '993-0703',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE SERVICIOS AGROPECUARIOS DEL GOBIERNO AUTONOMO DESCENTRALIZADO DE LA PARROQUIA RURAL DE ENOKANQUI ENOKANQUI EP-SERVICIOS AGROPECUARIOS',
                ),
            230 =>
                array(
                    'code' => '993-0704',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE  AGUA POTABLE Y ALCANTARILLADO SANITARIO DE SIMON BOLIVAR EMAPA-EP',
                ),
            231 =>
                array(
                    'code' => '993-0705',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE  MOVILIDAD DE LA MANCOMUNIDAD DE COTOPAXI EPMC',
                ),
            232 =>
                array(
                    'code' => '993-0706',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA VIAL Y CONTRUCCIONES EP DEL GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON SIMON BOLIVAR',
                ),
            233 =>
                array(
                    'code' => '993-0707',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE GESTION INTEGRAL DE RESIDUOS SOLIDOS EMGIRS-EP-SIMON BOLIVAR',
                ),
            234 =>
                array(
                    'code' => '993-0708',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE  AGUA POTABLE Y ALCANTARILLADO DE MACHALA AGUAS MACHALA-EP',
                ),
            235 =>
                array(
                    'code' => '993-0709',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE URBANIZACION Y VIVIENDA DE INTERES SOCIAL DEL CANTON PASTAZA EMUVISP-EP',
                ),
            236 =>
                array(
                    'code' => '993-0710',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE MANTENIMIENTO INFRAESTRUCTURA VIALIDAD AMBIENTE Y MINERIA DE PAUTE - VIALMIN EP',
                ),
            237 =>
                array(
                    'code' => '993-0711',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE MOVILIDAD DEL NORTE MOVIDELNOR EP',
                ),
            238 =>
                array(
                    'code' => '993-0712',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE MOVILIDAD TRANSITO Y TRANSPORTE DE MILAGRO EMOVIM-EP',
                ),
            239 =>
                array(
                    'code' => '993-0713',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE CEMENTERIOS DEL CANTON QUEVEDO',
                ),
            240 =>
                array(
                    'code' => '993-0714',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE TRANSITO TRANSPORTE TERRESTRE FLUVIAL MARITIMO SEGURIDAD VIAL TERMINAL TERRESTRE Y MOVILIDAD DE SANTA ROSA - EMOVTT SR',
                ),
            241 =>
                array(
                    'code' => '993-0715',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE COMERCIALIZACION TURISTICA ORELLANA TURISMO EP SR',
                ),
            242 =>
                array(
                    'code' => '993-0716',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE SAN MIGUEL EPMAPA-SM',
                ),
            243 =>
                array(
                    'code' => '993-0717',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE HABITAT Y VIVIENDA DE RUMINAHUI EPM-HVR',
                ),
            244 =>
                array(
                    'code' => '993-0718',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA AUTORIDAD DE TRANSITO MANCOMUNADA CENTRO GUAYAS - EP',
                ),
            245 =>
                array(
                    'code' => '993-0719',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE ALCANTARILLADO MANEJO FLUVIAL Y DEPURACION DE RESIDUOS LIQUIDOS DE SANTA ISABEL EMAPA-SI',
                ),
            246 =>
                array(
                    'code' => '993-0721',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE FOMENTO A LAS ACTIVIDADES PRODUCTIVAS TURISTICAS AGROPECUARIAS HABITACIONALES Y AMBIENTALES DE LA PROVINCIA DE LOS RIOS -PRODURIOS EP',
                ),
            247 =>
                array(
                    'code' => '993-0722',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DEL CUERPO DE BOMBERO DEL GAD MUNICIPAL DE ZAMORA CBGADMZ-EP.',
                ),
            248 =>
                array(
                    'code' => '993-0723',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARIILLADO DE OTAVALO',
                ),
            249 =>
                array(
                    'code' => '993-0724',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'MANCOMUNIDAD DE TRANSITO SUCUMBIOS EP ',
                ),
            250 =>
                array(
                    'code' => '993-0726',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE PINAS',
                ),
            251 =>
                array(
                    'code' => '993-0727',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE  MOVILIDAD DEL GOBIERNO AUTONOMO DESCENTRALIZADO MUNICIPAL DEL CANTON GUALACEO',
                ),
            252 =>
                array(
                    'code' => '993-0728',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE CENTROS COMERCIALES Y CAMAL DE MACHALA EPMCCC-EP',
                ),
            253 =>
                array(
                    'code' => '993-0729',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE MOVILIDAD DE CAYAMBE - EP',
                ),
            254 =>
                array(
                    'code' => '993-0730',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE MOVILIDAD TRANSPORTE TERRESTRE TRANSITO Y SEGURIDAD VIAL EL TRIUNFO-EPMOVET',
                ),
            255 =>
                array(
                    'code' => '993-0731',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE SERVICIOS HIDROSANITARIOS DEL CANTON JARAMIJO HIDROJAR-EP',
                ),
            256 =>
                array(
                    'code' => '993-0732',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE HABITAT Y VIVIENDA DEL CANTON JARAMIJO MI HOGAR-EP',
                ),
            257 =>
                array(
                    'code' => '993-0733',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE ALCANTARILLADO PLUVIAL SANITARIO Y SANEAMIENTO DEL CANTON SAN FRANCISCO DE MILAGRO',
                ),
            258 =>
                array(
                    'code' => '993-0734',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE URBANIZACION Y VIVIENDA ATACAMES EPMUVA EP',
                ),
            259 =>
                array(
                    'code' => '993-0735',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE VIVIENDA DEL GOBIERNO AUTONOMO DESCENTRALIZADO DEL CANTON MACARA',
                ),
            260 =>
                array(
                    'code' => '993-0736',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE DESARROLLO URBANO DE PEDERNALES',
                ),
            261 =>
                array(
                    'code' => '993-0737',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE SANTA CRUZ EP',
                ),
            262 =>
                array(
                    'code' => '993-0738',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE FAENAMIENTO Y CARNICOS DE RUMINAHUI-EPM',
                ),
            263 =>
                array(
                    'code' => '993-0739',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EP-SERVICIOS AGRICOLAS SIETE DE JULIO',
                ),
            264 =>
                array(
                    'code' => '993-0740',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE ECHEANDIA',
                ),
            265 =>
                array(
                    'code' => '993-0741',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE TRANSPORTE TERRESTRE TRANSITO SEGURIDAD VIAL Y TERMINAL TERRESTRE DEL CANTON QUEVEDO',
                ),
            266 =>
                array(
                    'code' => '993-0742',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MANCOMUNADA DE LOS GADs MUNICIPALES SANTO DOMINGO LA CONCORDIA Y EL CARMEN EP TROPICO HUMEDO',
                ),
            267 =>
                array(
                    'code' => '993-0743',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL MERCADO MALL DEL CANTON NARANJAL EP-MMALL',
                ),
            268 =>
                array(
                    'code' => '993-0744',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL CACAO ORGANICO SHUAR TAISHA',
                ),
            269 =>
                array(
                    'code' => '993-0746',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE  AGUA POTABLE  Y ALCANTARILLADO DE VALENCIA  EMAPAV-EP',
                ),
            270 =>
                array(
                    'code' => '993-0747',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE HABITAT Y VIVIENDA DEL CANTON MONTECRISTI MONTEHOGAR-EP',
                ),
            271 =>
                array(
                    'code' => '993-0748',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE TURISMO LA CANDELARIA',
                ),
            272 =>
                array(
                    'code' => '993-0749',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE INFORMACION Y COMUNICACION DEL CANTON CELICA-EPMINCOCE-EP',
                ),
            273 =>
                array(
                    'code' => '993-0750',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE HABITAT Y VIVIENDA DEL CANTON PICHINCHA LUZ DEL DIA-EP',
                ),
            274 =>
                array(
                    'code' => '993-0751',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE COMUNICACION E INFORMACION DE CHAGUARPAMBA-EP',
                ),
            275 =>
                array(
                    'code' => '993-0752',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE MOVILIDAD TRANSITO TRANSPORTE Y SEGURIDAD VIAL DE SANTA ELENA EMUTRANSITO EP',
                ),
            276 =>
                array(
                    'code' => '993-0753',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE LA UNIDAD TECNICA Y DE CONTROL DE TRANSITO TRANSPORTE TERRESTRE Y SEGURIDAD VIAL DEL CANTON JUJAN ALFREDO BAQUERIZO MORENO JUJAN EPM ABMTRAN',
                ),
            277 =>
                array(
                    'code' => '993-0755',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE JAMA',
                ),
            278 =>
                array(
                    'code' => '993-0756',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL REGISTRO DE LA PROPIEDAD DE MANTA-EP',
                ),
            279 =>
                array(
                    'code' => '993-0768',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA PROVINCIAL SANTO DOMINGO CONSTRUYE EP',
                ),
            280 =>
                array(
                    'code' => '993-0769',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE  TRANSITO DE GUAYAQUIL - EP',
                ),
            281 =>
                array(
                    'code' => '993-0770',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE MOVILIDAD TRANSITO Y TRANSPORTE DEL CANTON ZARUMA EMOVTZA - EP',
                ),
            282 =>
                array(
                    'code' => '993-0772',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE CUERPO DE BOMBEROS DE RUMIÃ‘AHUI',
                ),
            283 =>
                array(
                    'code' => '993-0785',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL FARMACIA SOLIDARIA DE SIGSIG FARMASIG-EP',
                ),
            284 =>
                array(
                    'code' => '993-0786',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE INFORMACION Y COMUNICACION DEL CANTON SANTA ANA',
                ),
            285 =>
                array(
                    'code' => '993-0796',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON PEDRO CARBO EMAPAPC EP',
                ),
            286 =>
                array(
                    'code' => '993-0826',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE AGUA POTABLE Y ALCANTARILLADO SANITARIO DEL CANTON SAN FRANCISCO DE PUEBLOVIEJO',
                ),
            287 =>
                array(
                    'code' => '993-0827',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MANCOMUNADA PARA LA GESTION DESCENTRALIZADA Y DESCONCENTRADA DE LA COMPETENCIA DE TRANSITO TRANSPORTE TERRESTRE Y SEGURIDAD VIAL DE LOS GOBIERNOS AUTONOMOS DESCENTRALIZADOS MUNICIPALES',
                ),
            288 =>
                array(
                    'code' => '993-0835',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE AGUA POTABLE Y ALCANTARILLADO DE ANTONIO ANTE EPAA-AA',
                ),
            289 =>
                array(
                    'code' => '993-0836',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE DAULE EMAPA EP',
                ),
            290 =>
                array(
                    'code' => '993-0854',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL PARA LA GESTION INTEGRAL DE LOS DESECHOS SOLIDOS DEL CANTON AMBATO',
                ),
            291 =>
                array(
                    'code' => '993-0855',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE COMUNICACION E INFORMACION DE SARAGURO EMCISA EP',
                ),
            292 =>
                array(
                    'code' => '993-0870',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA DE COMUNICACION E INFORMACION MUNICIPAL DE CATAMAYO COMUNICATE EP',
                ),
            293 =>
                array(
                    'code' => '993-0894',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MANCOMUNADA COSTA LIMPIA EP',
                ),
            294 =>
                array(
                    'code' => '993-0895',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DEL CANTON CHIMBO',
                ),
            295 =>
                array(
                    'code' => '993-0909',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA METROPOLITANA METRO DE QUITO',
                ),
            296 =>
                array(
                    'code' => '993-0917',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE CENTRO COMERCIAL MERCADOS DEL CANTON HUAQUILLAS',
                ),
            297 =>
                array(
                    'code' => '993-0947',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL DE ASEO RECOLECCION Y DISPOSICION FINAL DE DESECHOS SOLIDOS (EPMARYDDS) DEL CANTON JAMA',
                ),
            298 =>
                array(
                    'code' => '993-0959',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA MUNICIPAL DE VIVIENDA EL PANGUI EMUVIP EP',
                ),
            299 =>
                array(
                    'code' => '993-0960',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA PUBLICA MUNICIPAL PARA LA GESTION DE LA INNOVACION Y LA COMPETITIVIDAD EP',
                ),
            300 =>
                array(
                    'code' => '216-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CORPORACION NACIONAL DE FINANZAS POPULARES Y SOLIDARIAS',
                ),
            301 =>
                array(
                    'code' => '579-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BANCO DEL INSTITUTO ECUATORIANO DE SEGURIDAD SOCIAL',
                ),
            302 =>
                array(
                    'code' => '691-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BANCO CENTRAL DEL ECUADOR',
                ),
            303 =>
                array(
                    'code' => '693-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BANCO ECUATORIANO DE LA VIVIENDA',
                ),
            304 =>
                array(
                    'code' => '694-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BANCO NACIONAL DE FOMENTO',
                ),
            305 =>
                array(
                    'code' => '695-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'CORPORACION FINANCIERA NACIONAL',
                ),
            306 =>
                array(
                    'code' => '696-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'INSTITUTO ECUATORIANO DE CREDITO EDUCATIVO Y BECAS -IECE - PLANTA CENTRAL',
                ),
            307 =>
                array(
                    'code' => '965-0001',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BANCO DE DESARROLLO DEL ECUADOR B.P.SUCURSAL ZONAL AUSTRO',
                ),
            308 =>
                array(
                    'code' => '965-0003',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BANCO DE DESARROLLO DEL ECUADOR B.P. SUCURSAL ZONAL SIERRA CENTRO - PASTAZA',
                ),
            309 =>
                array(
                    'code' => '965-0009',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BANCO DE DESARROLLO DEL ECUADOR B.P.SUCURSAL ZONAL LITORAL',
                ),
            310 =>
                array(
                    'code' => '965-0011',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BANCO DE DESARROLLO DEL ECUADOR B.P.SUCURSAL ZONAL SUR',
                ),
            311 =>
                array(
                    'code' => '965-0013',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BANCO DE DESARROLLO DEL ECUADOR B.P.SUCURSAL ZONAL MANABI',
                ),
            312 =>
                array(
                    'code' => '965-0017',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BANCO DE DESARROLLO DEL ECUADOR B.P.SUCURSAL ZONAL NORTE',
                ),
            313 =>
                array(
                    'code' => '965-9999',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'BANCO DE DESARROLLO DEL ECUADOR B.P.-PLANTA CENTRAL',
                ),
            314 =>
                array(
                    'code' => '117-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'OPERACIONES RIO NAPO COMPANIA DE ECONOMIA MIXTA',
                ),
            315 =>
                array(
                    'code' => '122-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMPANIA DE ECONOMIA MIXTA GPATOURS',
                ),
            316 =>
                array(
                    'code' => '124-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMPANIA DE ECONOMIA MIXTA GRAN NACIONAL MINERA MARISCAL SUCRE C.E.M.',
                ),
            317 =>
                array(
                    'code' => '244-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMPANIA DE CONSTRUCCIONES ECUATORIANA COREANA CONECUAKOR C E M',
                ),
            318 =>
                array(
                    'code' => '249-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMPANIA EASYNET S. A.',
                ),
            319 =>
                array(
                    'code' => '292-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMAC-BGP ENERGY COMPANIA DE ECONOMIA MIXTA CEM',
                ),
            320 =>
                array(
                    'code' => '340-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'COMPANIA DE ECONOMIA MIXTA AUSTROGAS',
                ),
            321 =>
                array(
                    'code' => '431-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'ELECTRO GENERADORA DEL AUSTRO ELECAUSTRO SA',
                ),
            322 =>
                array(
                    'code' => '438-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA ELECTRICA AMBATO REGIONAL CENTRO NORTE SA',
                ),
            323 =>
                array(
                    'code' => '439-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA ELECTRICA AZOGUES C.A.',
                ),
            324 =>
                array(
                    'code' => '441-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA ELECTRICA REGIONAL CENTRO SUR CA',
                ),
            325 =>
                array(
                    'code' => '442-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA ELECTRICA PROVINCIAL COTOPAXI SA ELEPCOSA',
                ),
            326 =>
                array(
                    'code' => '445-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA ELECTRICA PROVINCIAL GALAPAGOS ELECGALAPAGOS S.A.',
                ),
            327 =>
                array(
                    'code' => '450-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA ELECTRICA QUITO SA EEQ',
                ),
            328 =>
                array(
                    'code' => '452-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA ELECTRICA REGIONAL DEL SUR S A',
                ),
            329 =>
                array(
                    'code' => '453-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA ELECTRICA RIOBAMBA',
                ),
            330 =>
                array(
                    'code' => '457-0000',
                    'deleted_at' => null,
                    'enabled' => 1,
                    'name' => 'EMPRESA ELECTRICA REGIONAL NORTE S A',
                ),
        ));
    }
}
