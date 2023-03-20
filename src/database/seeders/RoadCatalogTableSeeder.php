<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoadCatalogTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('road_catalogo')->delete();
        
        \DB::table('road_catalogo')->insert(array (
            0 => 
            array (
                'id' => 1,
                'codigo' => '0',
                'descrip' => 'estado',
                'padre_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'codigo' => '0',
                'descrip' => 'fuente',
                'padre_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'codigo' => '0',
                'descrip' => 'humedad',
                'padre_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'codigo' => '0',
                'descrip' => 'capa_rodadura_puente',
                'padre_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'codigo' => '0',
                'descrip' => 'carriles',
                'padre_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'codigo' => '0',
                'descrip' => 'condiciones_climaticas',
                'padre_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'codigo' => '0',
                'descrip' => 'est_drenaje',
                'padre_id' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'codigo' => '0',
                'descrip' => 'lado',
                'padre_id' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'codigo' => '0',
                'descrip' => 'material_alcantarilla',
                'padre_id' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'codigo' => '0',
                'descrip' => 'material_minas',
                'padre_id' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'codigo' => '0',
                'descrip' => 'piso_climatico',
                'padre_id' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'codigo' => '0',
                'descrip' => 'protecciones_laterales',
                'padre_id' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'codigo' => '0',
                'descrip' => 'sector_productivo',
                'padre_id' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'codigo' => '0',
                'descrip' => 'superficie_rodadura',
                'padre_id' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'codigo' => '0',
                'descrip' => 'tipo_alcantarilla',
                'padre_id' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'codigo' => '0',
                'descrip' => 'tipo_cuneta',
                'padre_id' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'codigo' => '0',
                'descrip' => 'tipo_dia',
                'padre_id' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'codigo' => '0',
                'descrip' => 'tipo_drenaje',
                'padre_id' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'codigo' => '0',
                'descrip' => 'tipo_firme',
                'padre_id' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'codigo' => '0',
                'descrip' => 'tipo_interconexion',
                'padre_id' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'codigo' => '0',
                'descrip' => 'tipo_material',
                'padre_id' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'codigo' => '0',
                'descrip' => 'tipo_minas',
                'padre_id' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'codigo' => '0',
                'descrip' => 'tipo_necesidad_conservacion',
                'padre_id' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'codigo' => '0',
                'descrip' => 'tipo_poblacion',
                'padre_id' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'codigo' => '0',
                'descrip' => 'tipo_punto_critico',
                'padre_id' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'codigo' => '0',
                'descrip' => 'tipo_senal_horizontal',
                'padre_id' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'codigo' => '0',
                'descrip' => 'tipo_senal_vertical',
                'padre_id' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'codigo' => '0',
                'descrip' => 'tipo_servicio_asociado',
                'padre_id' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'codigo' => '0',
                'descrip' => 'tipo_superficie_rodadura',
                'padre_id' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'codigo' => '0',
                'descrip' => 'tipo_talud',
                'padre_id' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'codigo' => '0',
                'descrip' => 'tipo_terreno',
                'padre_id' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'codigo' => '0',
                'descrip' => 'tipo_vehiculo',
                'padre_id' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'codigo' => '0',
                'descrip' => 'uso_via',
                'padre_id' => NULL,
            ),
            33 => 
            array (
                'id' => 176,
                'codigo' => '1',
                'descrip' => 'BUENO',
                'padre_id' => 1,
            ),
            34 => 
            array (
                'id' => 177,
                'codigo' => '2',
                'descrip' => 'MALO',
                'padre_id' => 1,
            ),
            35 => 
            array (
                'id' => 178,
                'codigo' => '3',
                'descrip' => 'REGULAR',
                'padre_id' => 1,
            ),
            36 => 
            array (
                'id' => 179,
                'codigo' => '4',
                'descrip' => 'SIN DETERMINAR',
                'padre_id' => 1,
            ),
            37 => 
            array (
                'id' => 180,
                'codigo' => '1',
                'descrip' => 'CANTERA',
                'padre_id' => 2,
            ),
            38 => 
            array (
                'id' => 181,
                'codigo' => '2',
                'descrip' => 'RIO',
                'padre_id' => 2,
            ),
            39 => 
            array (
                'id' => 182,
                'codigo' => '1',
                'descrip' => 'ARIDO',
                'padre_id' => 3,
            ),
            40 => 
            array (
                'id' => 183,
                'codigo' => '2',
                'descrip' => 'SEMIARIDO',
                'padre_id' => 3,
            ),
            41 => 
            array (
                'id' => 184,
                'codigo' => '3',
                'descrip' => 'SUB HUMEDO',
                'padre_id' => 3,
            ),
            42 => 
            array (
                'id' => 185,
                'codigo' => '4',
                'descrip' => 'HUMEDO',
                'padre_id' => 3,
            ),
            43 => 
            array (
                'id' => 186,
                'codigo' => '5',
                'descrip' => 'SUPER HUMEDO',
                'padre_id' => 3,
            ),
            44 => 
            array (
                'id' => 187,
                'codigo' => '2',
                'descrip' => 'ASFALTO',
                'padre_id' => 4,
            ),
            45 => 
            array (
                'id' => 188,
                'codigo' => '1',
                'descrip' => 'HORMIGON',
                'padre_id' => 4,
            ),
            46 => 
            array (
                'id' => 189,
                'codigo' => '3',
                'descrip' => 'LASTRE',
                'padre_id' => 4,
            ),
            47 => 
            array (
                'id' => 190,
                'codigo' => '4',
                'descrip' => 'MADERA',
                'padre_id' => 4,
            ),
            48 => 
            array (
                'id' => 191,
                'codigo' => '5',
                'descrip' => 'METAL',
                'padre_id' => 4,
            ),
            49 => 
            array (
                'id' => 192,
                'codigo' => '6',
                'descrip' => 'SIN DETERMINAR',
                'padre_id' => 4,
            ),
            50 => 
            array (
                'id' => 193,
                'codigo' => '5',
                'descrip' => 'CUATRO CARRILES BIDIRECCIONALES',
                'padre_id' => 5,
            ),
            51 => 
            array (
                'id' => 194,
                'codigo' => '4',
                'descrip' => 'DOS CARRILES BIDIRECCIONALES',
                'padre_id' => 5,
            ),
            52 => 
            array (
                'id' => 195,
                'codigo' => '3',
                'descrip' => 'DOS CARRILES UNIDIRECCIONALES',
                'padre_id' => 5,
            ),
            53 => 
            array (
                'id' => 196,
                'codigo' => '2',
                'descrip' => 'UN CARRIL BIDIRECCIONAL',
                'padre_id' => 5,
            ),
            54 => 
            array (
                'id' => 197,
                'codigo' => '1',
                'descrip' => 'UN CARRIL UNIDIRECCIONAL',
                'padre_id' => 5,
            ),
            55 => 
            array (
                'id' => 198,
                'codigo' => '6',
                'descrip' => 'SIN DETERMINAR',
                'padre_id' => 5,
            ),
            56 => 
            array (
                'id' => 199,
                'codigo' => '1',
                'descrip' => 'LLUVIOSO',
                'padre_id' => 6,
            ),
            57 => 
            array (
                'id' => 200,
                'codigo' => '4',
                'descrip' => 'LLUVIOSO - NUBLADO',
                'padre_id' => 6,
            ),
            58 => 
            array (
                'id' => 201,
                'codigo' => '2',
                'descrip' => 'SECO',
                'padre_id' => 6,
            ),
            59 => 
            array (
                'id' => 202,
                'codigo' => '3',
                'descrip' => 'SECO - NUBLADO',
                'padre_id' => 6,
            ),
            60 => 
            array (
                'id' => 203,
                'codigo' => '1',
                'descrip' => 'BUENO',
                'padre_id' => 7,
            ),
            61 => 
            array (
                'id' => 204,
                'codigo' => '4',
                'descrip' => 'EXCELENTE',
                'padre_id' => 7,
            ),
            62 => 
            array (
                'id' => 205,
                'codigo' => '2',
                'descrip' => 'MALO',
                'padre_id' => 7,
            ),
            63 => 
            array (
                'id' => 206,
                'codigo' => '5',
                'descrip' => 'MUY MALO',
                'padre_id' => 7,
            ),
            64 => 
            array (
                'id' => 207,
                'codigo' => '3',
                'descrip' => 'REGULAR',
                'padre_id' => 7,
            ),
            65 => 
            array (
                'id' => 208,
                'codigo' => '1',
                'descrip' => 'AMBOS',
                'padre_id' => 8,
            ),
            66 => 
            array (
                'id' => 209,
                'codigo' => '2',
                'descrip' => 'CENTRO',
                'padre_id' => 8,
            ),
            67 => 
            array (
                'id' => 210,
                'codigo' => '3',
                'descrip' => 'DERECHA',
                'padre_id' => 8,
            ),
            68 => 
            array (
                'id' => 211,
                'codigo' => '4',
                'descrip' => 'IZQUIERDA',
                'padre_id' => 8,
            ),
            69 => 
            array (
                'id' => 212,
                'codigo' => '1',
                'descrip' => 'HORMIGON',
                'padre_id' => 9,
            ),
            70 => 
            array (
                'id' => 213,
                'codigo' => '2',
                'descrip' => 'METALICA',
                'padre_id' => 9,
            ),
            71 => 
            array (
                'id' => 214,
                'codigo' => '3',
                'descrip' => 'PVC',
                'padre_id' => 9,
            ),
            72 => 
            array (
                'id' => 215,
                'codigo' => '4',
                'descrip' => 'SIN DETERMINAR',
                'padre_id' => 9,
            ),
            73 => 
            array (
                'id' => 216,
                'codigo' => '5',
                'descrip' => 'LADRILLO',
                'padre_id' => 9,
            ),
            74 => 
            array (
                'id' => 217,
                'codigo' => '6',
                'descrip' => 'MIXTO',
                'padre_id' => 9,
            ),
            75 => 
            array (
                'id' => 218,
                'codigo' => '1',
                'descrip' => 'ARENA',
                'padre_id' => 10,
            ),
            76 => 
            array (
                'id' => 219,
                'codigo' => '2',
                'descrip' => 'MATERIAL GRANULAR',
                'padre_id' => 10,
            ),
            77 => 
            array (
                'id' => 220,
                'codigo' => '3',
                'descrip' => 'RIPIO',
                'padre_id' => 10,
            ),
            78 => 
            array (
                'id' => 221,
                'codigo' => '4',
                'descrip' => 'BASE',
                'padre_id' => 10,
            ),
            79 => 
            array (
                'id' => 222,
                'codigo' => '5',
                'descrip' => 'CALIZA',
                'padre_id' => 10,
            ),
            80 => 
            array (
                'id' => 223,
                'codigo' => '6',
                'descrip' => 'LASTRE',
                'padre_id' => 10,
            ),
            81 => 
            array (
                'id' => 224,
                'codigo' => '7',
                'descrip' => 'ZEOLITA',
                'padre_id' => 10,
            ),
            82 => 
            array (
                'id' => 225,
                'codigo' => '8',
                'descrip' => 'ARCILLA',
                'padre_id' => 10,
            ),
            83 => 
            array (
                'id' => 226,
                'codigo' => '2',
                'descrip' => 'SUB TROPICAL CALIDO',
                'padre_id' => 11,
            ),
            84 => 
            array (
                'id' => 227,
                'codigo' => '3',
                'descrip' => 'SUB TROPICAL FRIO',
                'padre_id' => 11,
            ),
            85 => 
            array (
                'id' => 228,
                'codigo' => '4',
                'descrip' => 'TEMPLADO FRIO',
                'padre_id' => 11,
            ),
            86 => 
            array (
                'id' => 229,
                'codigo' => '5',
                'descrip' => 'TEMPLADO HELADO',
                'padre_id' => 11,
            ),
            87 => 
            array (
                'id' => 230,
                'codigo' => '1',
                'descrip' => 'TROPICAL',
                'padre_id' => 11,
            ),
            88 => 
            array (
                'id' => 231,
                'codigo' => '1',
                'descrip' => 'HORMIGON',
                'padre_id' => 12,
            ),
            89 => 
            array (
                'id' => 232,
                'codigo' => '6',
                'descrip' => 'MADERA',
                'padre_id' => 12,
            ),
            90 => 
            array (
                'id' => 233,
                'codigo' => '2',
                'descrip' => 'METALICA',
                'padre_id' => 12,
            ),
            91 => 
            array (
                'id' => 234,
                'codigo' => '3',
                'descrip' => 'MIXTA',
                'padre_id' => 12,
            ),
            92 => 
            array (
                'id' => 235,
                'codigo' => '4',
                'descrip' => 'NINGUNA',
                'padre_id' => 12,
            ),
            93 => 
            array (
                'id' => 236,
                'codigo' => '5',
                'descrip' => 'OTRO',
                'padre_id' => 12,
            ),
            94 => 
            array (
                'id' => 237,
                'codigo' => '1',
                'descrip' => 'AGRICULTURA',
                'padre_id' => 13,
            ),
            95 => 
            array (
                'id' => 238,
                'codigo' => '2',
                'descrip' => 'AGRO-GANADERIA',
                'padre_id' => 13,
            ),
            96 => 
            array (
                'id' => 239,
                'codigo' => '3',
                'descrip' => 'AGROPECUARIA',
                'padre_id' => 13,
            ),
            97 => 
            array (
                'id' => 240,
                'codigo' => '4',
                'descrip' => 'GANADERIA',
                'padre_id' => 13,
            ),
            98 => 
            array (
                'id' => 241,
                'codigo' => '8',
                'descrip' => 'MINERIA',
                'padre_id' => 13,
            ),
            99 => 
            array (
                'id' => 242,
                'codigo' => '9',
                'descrip' => 'NINGUNA',
                'padre_id' => 13,
            ),
            100 => 
            array (
                'id' => 243,
                'codigo' => '5',
                'descrip' => 'PESCA',
                'padre_id' => 13,
            ),
            101 => 
            array (
                'id' => 244,
                'codigo' => '7',
                'descrip' => 'SERVICIOS',
                'padre_id' => 13,
            ),
            102 => 
            array (
                'id' => 245,
                'codigo' => '8',
                'descrip' => 'SIN DETERMINAR',
                'padre_id' => 13,
            ),
            103 => 
            array (
                'id' => 246,
                'codigo' => '6',
                'descrip' => 'TURISMO',
                'padre_id' => 13,
            ),
            104 => 
            array (
                'id' => 247,
                'codigo' => '1',
            'descrip' => 'AMGB (MEZCLA BITUMINOSA CON BASE GRANULAR)',
                'padre_id' => 14,
            ),
            105 => 
            array (
                'id' => 248,
                'codigo' => '2',
            'descrip' => 'AMSB (MEZCLA BITUMINOSA CON BASE ESTABILIZADA)',
                'padre_id' => 14,
            ),
            106 => 
            array (
                'id' => 249,
                'codigo' => '9',
            'descrip' => 'CRCP (PAVIMENTO HORMIGON CONTINUAMENTE REFORZADO)',
                'padre_id' => 14,
            ),
            107 => 
            array (
                'id' => 250,
                'codigo' => '7',
                'descrip' => 'JPCP (PAVIMENTO HORMIGON CON JUNTAS PLANAS SIN PASADORES DE TRA',
                    'padre_id' => 14,
                ),
                108 => 
                array (
                    'id' => 251,
                    'codigo' => '6',
                    'descrip' => 'JPCPc (PAVIMENTO HORMIGON CON JUNTAS PLANAS CON PASADORES DE TR',
                        'padre_id' => 14,
                    ),
                    109 => 
                    array (
                        'id' => 252,
                        'codigo' => '8',
                    'descrip' => 'JRCP (PAVIMENTO HORMIGON CON JUNTAS REFORZADAS)',
                        'padre_id' => 14,
                    ),
                    110 => 
                    array (
                        'id' => 253,
                        'codigo' => '10',
                        'descrip' => 'LASTRE',
                        'padre_id' => 14,
                    ),
                    111 => 
                    array (
                        'id' => 254,
                        'codigo' => '5',
                    'descrip' => 'STAP (TRATAMIENTO SUPERFICAL CON BASE DE PAVIMENTO ASFALTICO)',
                        'padre_id' => 14,
                    ),
                    112 => 
                    array (
                        'id' => 255,
                        'codigo' => '3',
                    'descrip' => 'STGB (TRATAMIENTO SUPERFICIAL CON BASE GRANULAR)',
                        'padre_id' => 14,
                    ),
                    113 => 
                    array (
                        'id' => 256,
                        'codigo' => '4',
                    'descrip' => 'STSB (TRATAMIENTO SUPERFICIAL CON BASE ESTABILIDAZA)',
                        'padre_id' => 14,
                    ),
                    114 => 
                    array (
                        'id' => 257,
                        'codigo' => '11',
                        'descrip' => 'TIERRA',
                        'padre_id' => 14,
                    ),
                    115 => 
                    array (
                        'id' => 258,
                        'codigo' => '1',
                        'descrip' => 'CAJON',
                        'padre_id' => 15,
                    ),
                    116 => 
                    array (
                        'id' => 259,
                        'codigo' => '2',
                        'descrip' => 'CIRCULAR',
                        'padre_id' => 15,
                    ),
                    117 => 
                    array (
                        'id' => 260,
                        'codigo' => '3',
                        'descrip' => 'SIN DETERMINAR',
                        'padre_id' => 15,
                    ),
                    118 => 
                    array (
                        'id' => 261,
                        'codigo' => '4',
                        'descrip' => 'SPAN',
                        'padre_id' => 15,
                    ),
                    119 => 
                    array (
                        'id' => 262,
                        'codigo' => '5',
                        'descrip' => 'BADEN',
                        'padre_id' => 15,
                    ),
                    120 => 
                    array (
                        'id' => 263,
                        'codigo' => '1',
                        'descrip' => 'CUNETA CANAL',
                        'padre_id' => 16,
                    ),
                    121 => 
                    array (
                        'id' => 264,
                        'codigo' => '2',
                        'descrip' => 'CUNETA EN L',
                        'padre_id' => 16,
                    ),
                    122 => 
                    array (
                        'id' => 265,
                        'codigo' => '3',
                        'descrip' => 'CUNETA EN V',
                        'padre_id' => 16,
                    ),
                    123 => 
                    array (
                        'id' => 266,
                        'codigo' => '4',
                        'descrip' => 'CUNETAS TRAPECIALES',
                        'padre_id' => 16,
                    ),
                    124 => 
                    array (
                        'id' => 267,
                        'codigo' => '5',
                        'descrip' => 'NO EXISTE',
                        'padre_id' => 16,
                    ),
                    125 => 
                    array (
                        'id' => 268,
                        'codigo' => '6',
                        'descrip' => 'SUELO LATERAL',
                        'padre_id' => 16,
                    ),
                    126 => 
                    array (
                        'id' => 269,
                        'codigo' => '2',
                        'descrip' => 'FERIA',
                        'padre_id' => 17,
                    ),
                    127 => 
                    array (
                        'id' => 270,
                        'codigo' => '3',
                        'descrip' => 'FIN DE SEMANA',
                        'padre_id' => 17,
                    ),
                    128 => 
                    array (
                        'id' => 271,
                        'codigo' => '1',
                        'descrip' => 'ORDINARIO',
                        'padre_id' => 17,
                    ),
                    129 => 
                    array (
                        'id' => 272,
                        'codigo' => '2',
                        'descrip' => 'ALINEADO A LAS CAPA',
                        'padre_id' => 18,
                    ),
                    130 => 
                    array (
                        'id' => 273,
                        'codigo' => '3',
                        'descrip' => 'EN FORMA DE V REVESTIDO',
                        'padre_id' => 18,
                    ),
                    131 => 
                    array (
                        'id' => 274,
                        'codigo' => '4',
                        'descrip' => 'EN FORMA DE V SIN REVESTIR',
                        'padre_id' => 18,
                    ),
                    132 => 
                    array (
                        'id' => 275,
                        'codigo' => '7',
                        'descrip' => 'SIN DRENAJE PERO NECESARIO',
                        'padre_id' => 18,
                    ),
                    133 => 
                    array (
                        'id' => 276,
                        'codigo' => '8',
                        'descrip' => 'SIN DRENAJE PERO NO NECESARIO',
                        'padre_id' => 18,
                    ),
                    134 => 
                    array (
                        'id' => 277,
                        'codigo' => '6',
                        'descrip' => 'SUPERFCIAL SIN REVESTIR',
                        'padre_id' => 18,
                    ),
                    135 => 
                    array (
                        'id' => 278,
                        'codigo' => '5',
                        'descrip' => 'SUPERFICIAL REVESTIDO',
                        'padre_id' => 18,
                    ),
                    136 => 
                    array (
                        'id' => 279,
                        'codigo' => '1',
                        'descrip' => 'TOTALMENTE ALINEADO Y VINCULADO',
                        'padre_id' => 18,
                    ),
                    137 => 
                    array (
                        'id' => 280,
                        'codigo' => '11',
                        'descrip' => 'ASENTAMIENTO HUMANO A ASENTAMIENTO HUMANO',
                        'padre_id' => 20,
                    ),
                    138 => 
                    array (
                        'id' => 281,
                        'codigo' => '5',
                        'descrip' => 'CABECERA PARROQUIAL RURAL A ASENTAMIENTO HUMANO',
                        'padre_id' => 20,
                    ),
                    139 => 
                    array (
                        'id' => 282,
                        'codigo' => '3',
                        'descrip' => 'CANTON A CANTON',
                        'padre_id' => 20,
                    ),
                    140 => 
                    array (
                        'id' => 283,
                        'codigo' => '7',
                        'descrip' => 'ESTATAL CON ASENTAMIENTO HUMANO',
                        'padre_id' => 20,
                    ),
                    141 => 
                    array (
                        'id' => 284,
                        'codigo' => '6',
                        'descrip' => 'ESTATAL CON CABECERA CANTONAL',
                        'padre_id' => 20,
                    ),
                    142 => 
                    array (
                        'id' => 285,
                        'codigo' => '8',
                        'descrip' => 'ESTATAL CON CABECERA PARROQUIAL',
                        'padre_id' => 20,
                    ),
                    143 => 
                    array (
                        'id' => 286,
                        'codigo' => '10',
                        'descrip' => 'ESTATAL CON CABECERA PROVINCIAL',
                        'padre_id' => 20,
                    ),
                    144 => 
                    array (
                        'id' => 287,
                        'codigo' => '2',
                        'descrip' => 'ESTATALES',
                        'padre_id' => 20,
                    ),
                    145 => 
                    array (
                        'id' => 288,
                        'codigo' => '9',
                        'descrip' => 'OTROS',
                        'padre_id' => 20,
                    ),
                    146 => 
                    array (
                        'id' => 289,
                        'codigo' => '4',
                        'descrip' => 'PARROQUIA RURAL A PARROQUIA RURAL',
                        'padre_id' => 20,
                    ),
                    147 => 
                    array (
                        'id' => 290,
                        'codigo' => '1',
                        'descrip' => 'PROVINCIA A PROVINCIA',
                        'padre_id' => 20,
                    ),
                    148 => 
                    array (
                        'id' => 291,
                        'codigo' => '1',
                        'descrip' => 'FLEXIBLE',
                        'padre_id' => 21,
                    ),
                    149 => 
                    array (
                        'id' => 292,
                        'codigo' => '2',
                        'descrip' => 'RIGIDO',
                        'padre_id' => 21,
                    ),
                    150 => 
                    array (
                        'id' => 293,
                        'codigo' => '3',
                        'descrip' => 'SIN PAVIMENTAR',
                        'padre_id' => 21,
                    ),
                    151 => 
                    array (
                        'id' => 294,
                        'codigo' => '1',
                        'descrip' => 'CONCESIONADA',
                        'padre_id' => 22,
                    ),
                    152 => 
                    array (
                        'id' => 295,
                        'codigo' => '2',
                        'descrip' => 'NO CONCESIONADA',
                        'padre_id' => 22,
                    ),
                    153 => 
                    array (
                        'id' => 296,
                        'codigo' => '1',
                        'descrip' => 'CONSTRUCCION NUEVA',
                        'padre_id' => 23,
                    ),
                    154 => 
                    array (
                        'id' => 297,
                        'codigo' => '2',
                        'descrip' => 'MANTENIMIENTO CORRECTIVO',
                        'padre_id' => 23,
                    ),
                    155 => 
                    array (
                        'id' => 298,
                        'codigo' => '3',
                        'descrip' => 'MANTENIMIENTO PERIODICO',
                        'padre_id' => 23,
                    ),
                    156 => 
                    array (
                        'id' => 299,
                        'codigo' => '4',
                        'descrip' => 'MANTENIMIENTO RUTINARIO',
                        'padre_id' => 23,
                    ),
                    157 => 
                    array (
                        'id' => 300,
                        'codigo' => '8',
                        'descrip' => 'MEJORAMIENTO',
                        'padre_id' => 23,
                    ),
                    158 => 
                    array (
                        'id' => 301,
                        'codigo' => '5',
                        'descrip' => 'OTRA',
                        'padre_id' => 23,
                    ),
                    159 => 
                    array (
                        'id' => 302,
                        'codigo' => '6',
                        'descrip' => 'RECONSTRUCCION',
                        'padre_id' => 23,
                    ),
                    160 => 
                    array (
                        'id' => 303,
                        'codigo' => '7',
                        'descrip' => 'REHABILITACION',
                        'padre_id' => 23,
                    ),
                    161 => 
                    array (
                        'id' => 304,
                        'codigo' => '1',
                        'descrip' => 'CONCENTRADA',
                        'padre_id' => 24,
                    ),
                    162 => 
                    array (
                        'id' => 305,
                        'codigo' => '2',
                        'descrip' => 'DISPERSA',
                        'padre_id' => 24,
                    ),
                    163 => 
                    array (
                        'id' => 306,
                        'codigo' => '3',
                        'descrip' => 'SIN DETERMINAR',
                        'padre_id' => 24,
                    ),
                    164 => 
                    array (
                        'id' => 307,
                        'codigo' => '1',
                        'descrip' => 'DISEÑO GEOMETRICO',
                        'padre_id' => 25,
                    ),
                    165 => 
                    array (
                        'id' => 308,
                        'codigo' => '2',
                        'descrip' => 'GEOLOGICOS',
                        'padre_id' => 25,
                    ),
                    166 => 
                    array (
                        'id' => 309,
                        'codigo' => '3',
                        'descrip' => 'HIDROGEOLOGICOS',
                        'padre_id' => 25,
                    ),
                    167 => 
                    array (
                        'id' => 310,
                        'codigo' => '6',
                        'descrip' => 'HIDROLOGICOS',
                        'padre_id' => 25,
                    ),
                    168 => 
                    array (
                        'id' => 311,
                        'codigo' => '4',
                        'descrip' => 'MANTENIMIENTO',
                        'padre_id' => 25,
                    ),
                    169 => 
                    array (
                        'id' => 312,
                        'codigo' => '5',
                        'descrip' => 'OTROS',
                        'padre_id' => 25,
                    ),
                    170 => 
                    array (
                        'id' => 313,
                        'codigo' => '1',
                        'descrip' => 'CONTINUA CON TACHAS',
                        'padre_id' => 26,
                    ),
                    171 => 
                    array (
                        'id' => 314,
                        'codigo' => '2',
                        'descrip' => 'CONTINUA SIN TACHAS',
                        'padre_id' => 26,
                    ),
                    172 => 
                    array (
                        'id' => 315,
                        'codigo' => '3',
                        'descrip' => 'SEGMENTADA CON TACHAS',
                        'padre_id' => 26,
                    ),
                    173 => 
                    array (
                        'id' => 316,
                        'codigo' => '4',
                        'descrip' => 'SEGMENTADA SIN TACHAS',
                        'padre_id' => 26,
                    ),
                    174 => 
                    array (
                        'id' => 317,
                        'codigo' => '1',
                        'descrip' => 'INFORMATIVA',
                        'padre_id' => 27,
                    ),
                    175 => 
                    array (
                        'id' => 318,
                        'codigo' => '2',
                        'descrip' => 'PREVENTIVA',
                        'padre_id' => 27,
                    ),
                    176 => 
                    array (
                        'id' => 319,
                        'codigo' => '3',
                        'descrip' => 'REGULATORIA',
                        'padre_id' => 27,
                    ),
                    177 => 
                    array (
                        'id' => 320,
                        'codigo' => '4',
                        'descrip' => 'SIN DETERMINAR',
                        'padre_id' => 27,
                    ),
                    178 => 
                    array (
                        'id' => 321,
                        'codigo' => '2',
                        'descrip' => 'ALIMENTACION',
                        'padre_id' => 28,
                    ),
                    179 => 
                    array (
                        'id' => 322,
                        'codigo' => '3',
                        'descrip' => 'AMBULANCIA',
                        'padre_id' => 28,
                    ),
                    180 => 
                    array (
                        'id' => 323,
                        'codigo' => '9',
                        'descrip' => 'BODEGAS',
                        'padre_id' => 28,
                    ),
                    181 => 
                    array (
                        'id' => 324,
                        'codigo' => '1',
                        'descrip' => 'CENTROS DE ACOPIO',
                        'padre_id' => 28,
                    ),
                    182 => 
                    array (
                        'id' => 325,
                        'codigo' => '10',
                        'descrip' => 'ESTACION DE COMBUSTIBLE',
                        'padre_id' => 28,
                    ),
                    183 => 
                    array (
                        'id' => 326,
                        'codigo' => '4',
                        'descrip' => 'HOSPEDAJE',
                        'padre_id' => 28,
                    ),
                    184 => 
                    array (
                        'id' => 327,
                        'codigo' => '11',
                        'descrip' => 'POLICIA',
                        'padre_id' => 28,
                    ),
                    185 => 
                    array (
                        'id' => 328,
                        'codigo' => '8',
                        'descrip' => 'SERVICIOS BANCARIOS',
                        'padre_id' => 28,
                    ),
                    186 => 
                    array (
                        'id' => 329,
                        'codigo' => '5',
                        'descrip' => 'SERVICIOS DE EDUCACION',
                        'padre_id' => 28,
                    ),
                    187 => 
                    array (
                        'id' => 330,
                        'codigo' => '6',
                        'descrip' => 'SERVICIOS DE SALUD',
                        'padre_id' => 28,
                    ),
                    188 => 
                    array (
                        'id' => 331,
                        'codigo' => '7',
                        'descrip' => 'SERVICIOS PUBLICOS',
                        'padre_id' => 28,
                    ),
                    189 => 
                    array (
                        'id' => 332,
                        'codigo' => '13',
                        'descrip' => 'VIVEROS',
                        'padre_id' => 28,
                    ),
                    190 => 
                    array (
                        'id' => 333,
                        'codigo' => '12',
                        'descrip' => 'VULCANIZADORA',
                        'padre_id' => 28,
                    ),
                    191 => 
                    array (
                        'id' => 334,
                        'codigo' => '1',
                        'descrip' => 'ADOQUIN',
                        'padre_id' => 29,
                    ),
                    192 => 
                    array (
                        'id' => 335,
                        'codigo' => '2',
                        'descrip' => 'D-T BITUMINOSO',
                        'padre_id' => 29,
                    ),
                    193 => 
                    array (
                        'id' => 336,
                        'codigo' => '3',
                        'descrip' => 'EMPEDRADO',
                        'padre_id' => 29,
                    ),
                    194 => 
                    array (
                        'id' => 337,
                        'codigo' => '4',
                        'descrip' => 'LASTRE',
                        'padre_id' => 29,
                    ),
                    195 => 
                    array (
                        'id' => 338,
                        'codigo' => '5',
                        'descrip' => 'MIXTO',
                        'padre_id' => 29,
                    ),
                    196 => 
                    array (
                        'id' => 339,
                        'codigo' => '6',
                        'descrip' => 'PAVIMENTO FLEXIBLE',
                        'padre_id' => 29,
                    ),
                    197 => 
                    array (
                        'id' => 340,
                        'codigo' => '7',
                        'descrip' => 'PAVIMENTO RIGIDO',
                        'padre_id' => 29,
                    ),
                    198 => 
                    array (
                        'id' => 341,
                        'codigo' => '8',
                        'descrip' => 'SUELO NATURAL',
                        'padre_id' => 29,
                    ),
                    199 => 
                    array (
                        'id' => 342,
                        'codigo' => '9',
                        'descrip' => 'TIERRA',
                        'padre_id' => 29,
                    ),
                    200 => 
                    array (
                        'id' => 343,
                        'codigo' => '1',
                        'descrip' => 'INTERVENIDO',
                        'padre_id' => 30,
                    ),
                    201 => 
                    array (
                        'id' => 344,
                        'codigo' => '2',
                        'descrip' => 'NATURAL',
                        'padre_id' => 30,
                    ),
                    202 => 
                    array (
                        'id' => 345,
                        'codigo' => '1',
                        'descrip' => 'LLANO',
                        'padre_id' => 31,
                    ),
                    203 => 
                    array (
                        'id' => 346,
                        'codigo' => '2',
                        'descrip' => 'MONTAÑOSO',
                        'padre_id' => 31,
                    ),
                    204 => 
                    array (
                        'id' => 347,
                        'codigo' => '3',
                        'descrip' => 'ONDULADO',
                        'padre_id' => 31,
                    ),
                    205 => 
                    array (
                        'id' => 348,
                        'codigo' => '4',
                        'descrip' => 'OTROS',
                        'padre_id' => 31,
                    ),
                    206 => 
                    array (
                        'id' => 349,
                        'codigo' => '5',
                        'descrip' => 'SIN DETERMINAR',
                        'padre_id' => 31,
                    ),
                    207 => 
                    array (
                        'id' => 350,
                        'codigo' => '3',
                        'descrip' => '2 EJES',
                        'padre_id' => 32,
                    ),
                    208 => 
                    array (
                        'id' => 351,
                        'codigo' => '4',
                        'descrip' => '3 EJES',
                        'padre_id' => 32,
                    ),
                    209 => 
                    array (
                        'id' => 352,
                        'codigo' => '5',
                        'descrip' => '4 EJES',
                        'padre_id' => 32,
                    ),
                    210 => 
                    array (
                        'id' => 353,
                        'codigo' => '6',
                        'descrip' => '5 EJES',
                        'padre_id' => 32,
                    ),
                    211 => 
                    array (
                        'id' => 354,
                        'codigo' => '2',
                        'descrip' => 'BUSES',
                        'padre_id' => 32,
                    ),
                    212 => 
                    array (
                        'id' => 355,
                        'codigo' => '1',
                        'descrip' => 'LIVIANOS',
                        'padre_id' => 32,
                    ),
                    213 => 
                    array (
                        'id' => 356,
                        'codigo' => '1',
                        'descrip' => 'AGRICOLA',
                        'padre_id' => 33,
                    ),
                    214 => 
                    array (
                        'id' => 357,
                        'codigo' => '2',
                        'descrip' => 'BOSQUE',
                        'padre_id' => 33,
                    ),
                    215 => 
                    array (
                        'id' => 358,
                        'codigo' => '8',
                        'descrip' => 'CUERPO DE AGUA',
                        'padre_id' => 33,
                    ),
                    216 => 
                    array (
                        'id' => 359,
                        'codigo' => '3',
                        'descrip' => 'INFRAESTRUCTURA',
                        'padre_id' => 33,
                    ),
                    217 => 
                    array (
                        'id' => 360,
                        'codigo' => '4',
                        'descrip' => 'MALEZA',
                        'padre_id' => 33,
                    ),
                    218 => 
                    array (
                        'id' => 361,
                        'codigo' => '5',
                        'descrip' => 'OTRO',
                        'padre_id' => 33,
                    ),
                    219 => 
                    array (
                        'id' => 362,
                        'codigo' => '6',
                        'descrip' => 'PASTOS',
                        'padre_id' => 33,
                    ),
                    220 => 
                    array (
                        'id' => 363,
                        'codigo' => '7',
                        'descrip' => 'SIN DETERMINAR',
                        'padre_id' => 33,
                    ),
                    221 => 
                    array (
                        'id' => 364,
                        'codigo' => '9',
                        'descrip' => 'INFRAESTRUCTURA FISICA',
                        'padre_id' => 33,
                    ),
                    222 => 
                    array (
                        'id' => 365,
                        'codigo' => '7',
                        'descrip' => 'OTRO',
                        'padre_id' => 9,
                    ),
                    223 => 
                    array (
                        'id' => 366,
                        'codigo' => '7',
                        'descrip' => 'OTRO',
                        'padre_id' => 9,
                    ),
                    224 => 
                    array (
                        'id' => 367,
                        'codigo' => '6',
                        'descrip' => 'OTRO',
                        'padre_id' => 15,
                    ),
                    225 => 
                    array (
                        'id' => 368,
                        'codigo' => '7',
                        'descrip' => 'RECTANGULAR',
                        'padre_id' => 15,
                    ),
                ));
        
        
    }
}