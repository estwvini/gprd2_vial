<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuideSpendingClassifiersSeeder extends Seeder
{

    public function run()
    {
        DB::table('guide_spending_classifiers')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'parent_id' => null,
                    'code' => '01',
                    'full_code' => '01',
                    'description' => 'POLÍTICAS DE IGUALDAD',
                    'level' => 1,
                    'enabled' => 1,
                ),
            1 =>
                array(
                    'id' => 2,
                    'parent_id' => 1,
                    'code' => '01',
                    'full_code' => '01.01',
                    'description' => 'GÉNERO',
                    'level' => 2,
                    'enabled' => 1,
                ),
            2 =>
                array(
                    'id' => 3,
                    'parent_id' => 2,
                    'code' => '01',
                    'full_code' => '01.01.01',
                    'description' => 'Promoción de la autonomía y empoderamiento de la mujer en el marco de la economía social y solidaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            3 =>
                array(
                    'id' => 4,
                    'parent_id' => 3,
                    'code' => '01',
                    'full_code' => '01.01.01.01',
                    'description' => 'Garantizar el acceso a recursos financieros para generar condiciones y oportunidades equitativas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            4 =>
                array(
                    'id' => 5,
                    'parent_id' => 3,
                    'code' => '02',
                    'full_code' => '01.01.01.02',
                    'description' => 'Garantizar el acceso a recursos no financieros para generar condiciones y oportunidades equitativas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            5 =>
                array(
                    'id' => 6,
                    'parent_id' => 3,
                    'code' => '03',
                    'full_code' => '01.01.01.03',
                    'description' => 'Garantizar el derecho a la propiedad de la tierra, la vivienda y los recursos productivos para generar condiciones y oportunidades equitativas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            6 =>
                array(
                    'id' => 7,
                    'parent_id' => 3,
                    'code' => '04',
                    'full_code' => '01.01.01.04',
                    'description' => 'Promoción de mecanismos de compensación para acceder a recursos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            7 =>
                array(
                    'id' => 8,
                    'parent_id' => 3,
                    'code' => '05',
                    'full_code' => '01.01.01.05',
                    'description' => 'Promoción de pequeñas y medianas unidades de producción, unidades comunitarias y de la economía social y solidaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            8 =>
                array(
                    'id' => 9,
                    'parent_id' => 2,
                    'code' => '02',
                    'full_code' => '01.01.02',
                    'description' => 'Promoción, garantía y generación de igualdad de oportunidades y condiciones de trabajo',
                    'level' => 3,
                    'enabled' => 1,
                ),
            9 =>
                array(
                    'id' => 10,
                    'parent_id' => 9,
                    'code' => '01',
                    'full_code' => '01.01.02.01',
                    'description' => 'Promoción y garantía del ejercicio de los derechos laborales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            10 =>
                array(
                    'id' => 11,
                    'parent_id' => 9,
                    'code' => '02',
                    'full_code' => '01.01.02.02',
                    'description' => 'Promoción y garantía del ejercicio del derecho a la seguridad social',
                    'level' => 4,
                    'enabled' => 1,
                ),
            11 =>
                array(
                    'id' => 12,
                    'parent_id' => 9,
                    'code' => '03',
                    'full_code' => '01.01.02.03',
                    'description' => 'Promoción de condiciones y entornos de trabajo seguro, saludable y no discriminatorio',
                    'level' => 4,
                    'enabled' => 1,
                ),
            12 =>
                array(
                    'id' => 13,
                    'parent_id' => 9,
                    'code' => '04',
                    'full_code' => '01.01.02.04',
                    'description' => 'Promoción de incentivos a las instituciones públicas y privadas que apliquen medidas de igualdad de género y generación de empleo digno para mujeres',
                    'level' => 4,
                    'enabled' => 1,
                ),
            13 =>
                array(
                    'id' => 14,
                    'parent_id' => 2,
                    'code' => '03',
                    'full_code' => '01.01.03',
                    'description' => 'Promoción y desarrollo de sistemas de cuidado y corresponsabilidad',
                    'level' => 3,
                    'enabled' => 1,
                ),
            14 =>
                array(
                    'id' => 15,
                    'parent_id' => 14,
                    'code' => '01',
                    'full_code' => '01.01.03.01',
                    'description' => 'Desarrollo y promoción de centros de cuidado infantil y servicios de apoyo escolar',
                    'level' => 4,
                    'enabled' => 1,
                ),
            15 =>
                array(
                    'id' => 16,
                    'parent_id' => 14,
                    'code' => '02',
                    'full_code' => '01.01.03.02',
                    'description' => 'Desarrollo y promoción de servicios de cuidado de personas con discapacidad, adultas/os mayores, personas dependientes y personas afectadas por enfermedades (incluidas las catastróficas)',
                    'level' => 4,
                    'enabled' => 1,
                ),
            16 =>
                array(
                    'id' => 17,
                    'parent_id' => 14,
                    'code' => '03',
                    'full_code' => '01.01.03.03',
                    'description' => 'Mecanismos de compensación y apoyo a proveedoras y proveedores de cuidado',
                    'level' => 4,
                    'enabled' => 1,
                ),
            17 =>
                array(
                    'id' => 18,
                    'parent_id' => 14,
                    'code' => '04',
                    'full_code' => '01.01.03.04',
                    'description' => 'Generación de acciones que promuevan la corresponsabilidad en el trabajo reproductivo y en las relaciones familiares y personales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            18 =>
                array(
                    'id' => 19,
                    'parent_id' => 2,
                    'code' => '04',
                    'full_code' => '01.01.04',
                    'description' => 'Promoción y garantía del derecho a la participación social, política y ejercicio de ciudadanía',
                    'level' => 3,
                    'enabled' => 1,
                ),
            19 =>
                array(
                    'id' => 20,
                    'parent_id' => 19,
                    'code' => '01',
                    'full_code' => '01.01.04.01',
                    'description' => 'Promoción y garantía del derecho a la participación política y ejercicio de ciudadanía',
                    'level' => 4,
                    'enabled' => 1,
                ),
            20 =>
                array(
                    'id' => 21,
                    'parent_id' => 19,
                    'code' => '02',
                    'full_code' => '01.01.04.02',
                    'description' => 'Promoción y garantía del derecho a la participación social',
                    'level' => 4,
                    'enabled' => 1,
                ),
            21 =>
                array(
                    'id' => 22,
                    'parent_id' => 2,
                    'code' => '05',
                    'full_code' => '01.01.05',
                    'description' => 'Promoción y garantía de una vida libre de violencia',
                    'level' => 3,
                    'enabled' => 1,
                ),
            22 =>
                array(
                    'id' => 23,
                    'parent_id' => 22,
                    'code' => '01',
                    'full_code' => '01.01.05.01',
                    'description' => 'Cambio de patrones socio culturales para erradicar la violencia de género',
                    'level' => 4,
                    'enabled' => 1,
                ),
            23 =>
                array(
                    'id' => 24,
                    'parent_id' => 22,
                    'code' => '02',
                    'full_code' => '01.01.05.02',
                    'description' => 'Protección Integral a víctimas de violencia de género',
                    'level' => 4,
                    'enabled' => 1,
                ),
            24 =>
                array(
                    'id' => 25,
                    'parent_id' => 22,
                    'code' => '03',
                    'full_code' => '01.01.05.03',
                    'description' => 'Reducción de la impunidad de la violencia de género',
                    'level' => 4,
                    'enabled' => 1,
                ),
            25 =>
                array(
                    'id' => 26,
                    'parent_id' => 22,
                    'code' => '04',
                    'full_code' => '01.01.05.04',
                    'description' => 'Generación de información sobre violencia de género en sus distintas manifestaciones',
                    'level' => 4,
                    'enabled' => 1,
                ),
            26 =>
                array(
                    'id' => 27,
                    'parent_id' => 22,
                    'code' => '05',
                    'full_code' => '01.01.05.05',
                    'description' => 'Erradicación y sanción de la trata y tráfico de mujeres niños, niñas y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            27 =>
                array(
                    'id' => 28,
                    'parent_id' => 22,
                    'code' => '06',
                    'full_code' => '01.01.05.06',
                    'description' => 'Promoción de fronteras libres de violencia',
                    'level' => 4,
                    'enabled' => 1,
                ),
            28 =>
                array(
                    'id' => 29,
                    'parent_id' => 2,
                    'code' => '06',
                    'full_code' => '01.01.06',
                    'description' => 'Promoción, protección y  garantía del derecho a la salud',
                    'level' => 3,
                    'enabled' => 1,
                ),
            29 =>
                array(
                    'id' => 30,
                    'parent_id' => 29,
                    'code' => '01',
                    'full_code' => '01.01.06.01',
                    'description' => 'Garantizar la atención de la salud sexual de hombres y mujeres en condiciones de igualdad',
                    'level' => 4,
                    'enabled' => 1,
                ),
            30 =>
                array(
                    'id' => 31,
                    'parent_id' => 29,
                    'code' => '02',
                    'full_code' => '01.01.06.02',
                    'description' => 'Garantizar la atención de la salud reproductiva de hombres y mujeres en condiciones de igualdad',
                    'level' => 4,
                    'enabled' => 1,
                ),
            31 =>
                array(
                    'id' => 32,
                    'parent_id' => 29,
                    'code' => '03',
                    'full_code' => '01.01.06.03',
                    'description' => 'Garantizar la atención integral de las mujeres diversas en sus diferentes ciclos de vida',
                    'level' => 4,
                    'enabled' => 1,
                ),
            32 =>
                array(
                    'id' => 33,
                    'parent_id' => 2,
                    'code' => '07',
                    'full_code' => '01.01.07',
                    'description' => 'Protección y garantía del derecho a la educación',
                    'level' => 3,
                    'enabled' => 1,
                ),
            33 =>
                array(
                    'id' => 34,
                    'parent_id' => 33,
                    'code' => '01',
                    'full_code' => '01.01.07.01',
                    'description' => 'Erradicación del analfabetismo en mujeres',
                    'level' => 4,
                    'enabled' => 1,
                ),
            34 =>
                array(
                    'id' => 35,
                    'parent_id' => 33,
                    'code' => '02',
                    'full_code' => '01.01.07.02',
                    'description' => 'Eliminación de brechas de género en escolaridad inicial, básica, secundaria y superior',
                    'level' => 4,
                    'enabled' => 1,
                ),
            35 =>
                array(
                    'id' => 36,
                    'parent_id' => 33,
                    'code' => '03',
                    'full_code' => '01.01.07.03',
                    'description' => 'Inclusión de enfoques de derechos humanos y derechos de las mujeres en currículo, metodologías, textos y materiales educativos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            36 =>
                array(
                    'id' => 37,
                    'parent_id' => 33,
                    'code' => '04',
                    'full_code' => '01.01.07.04',
                    'description' => 'Apoyo a la formación y capacitación de mujeres en ciencia, tecnología y TICs',
                    'level' => 4,
                    'enabled' => 1,
                ),
            37 =>
                array(
                    'id' => 38,
                    'parent_id' => 33,
                    'code' => '05',
                    'full_code' => '01.01.07.05',
                    'description' => 'Apoyo a la formación y capacitación de mujeres, especialmente aquellas en grupos declarados de atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            38 =>
                array(
                    'id' => 39,
                    'parent_id' => 2,
                    'code' => '08',
                    'full_code' => '01.01.08',
                    'description' => 'Promoción del acceso a recursos para procurar acciones de desarrollo sustentable',
                    'level' => 3,
                    'enabled' => 1,
                ),
            39 =>
                array(
                    'id' => 40,
                    'parent_id' => 39,
                    'code' => '01',
                    'full_code' => '01.01.08.01',
                    'description' => 'Garantizar el acceso a la participación de las mujeres en procesos de gestión, decisión y a los beneficios de la explotación de recursos naturales y no renovables',
                    'level' => 4,
                    'enabled' => 1,
                ),
            40 =>
                array(
                    'id' => 41,
                    'parent_id' => 39,
                    'code' => '02',
                    'full_code' => '01.01.08.02',
                    'description' => 'Compensación y mitigación por actividades extractivas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            41 =>
                array(
                    'id' => 42,
                    'parent_id' => 39,
                    'code' => '03',
                    'full_code' => '01.01.08.03',
                    'description' => 'Atención prioritaria a mujeres en casos de desastres naturales y antrópicos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            42 =>
                array(
                    'id' => 43,
                    'parent_id' => 2,
                    'code' => '09',
                    'full_code' => '01.01.09',
                    'description' => 'Reconocimiento y promoción de los saberes y conocimientos ancestrales',
                    'level' => 3,
                    'enabled' => 1,
                ),
            43 =>
                array(
                    'id' => 44,
                    'parent_id' => 43,
                    'code' => '01',
                    'full_code' => '01.01.09.01',
                    'description' => 'Recuperación de los conocimientos, saberes y prácticas ancestrales de las mujeres en distintos campos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            44 =>
                array(
                    'id' => 45,
                    'parent_id' => 43,
                    'code' => '02',
                    'full_code' => '01.01.09.02',
                    'description' => 'Promoción y aprovechamiento de los conocimientos y prácticas ancestrales de las mujeres en distintos campos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            45 =>
                array(
                    'id' => 46,
                    'parent_id' => 2,
                    'code' => '10',
                    'full_code' => '01.01.10',
                    'description' => 'Promoción y garantía del derecho de las mujeres a la recreación y uso de espacios públicos en condiciones de igualdad',
                    'level' => 3,
                    'enabled' => 1,
                ),
            46 =>
                array(
                    'id' => 47,
                    'parent_id' => 46,
                    'code' => '01',
                    'full_code' => '01.01.10.01',
                    'description' => 'Promoción del derecho al descanso y la recreación de las mujeres',
                    'level' => 4,
                    'enabled' => 1,
                ),
            47 =>
                array(
                    'id' => 48,
                    'parent_id' => 46,
                    'code' => '02',
                    'full_code' => '01.01.10.02',
                    'description' => 'Promoción para la incorporación de mujeres en actividades deportivas, sociales, culturales y otras',
                    'level' => 4,
                    'enabled' => 1,
                ),
            48 =>
                array(
                    'id' => 49,
                    'parent_id' => 46,
                    'code' => '03',
                    'full_code' => '01.01.10.03',
                    'description' => 'Garantía del derecho al acceso y uso de espacios públicos en igualdad de condiciones',
                    'level' => 4,
                    'enabled' => 1,
                ),
            49 =>
                array(
                    'id' => 50,
                    'parent_id' => 2,
                    'code' => '11',
                    'full_code' => '01.01.11',
                    'description' => 'Promoción, garantía y desarrollo de institucionalidad y políticas públicas con equidad de género',
                    'level' => 3,
                    'enabled' => 1,
                ),
            50 =>
                array(
                    'id' => 51,
                    'parent_id' => 50,
                    'code' => '01',
                    'full_code' => '01.01.11.01',
                    'description' => 'Incorporación del enfoque de género en la gestión y normativa de las instituciones del sector público',
                    'level' => 4,
                    'enabled' => 1,
                ),
            51 =>
                array(
                    'id' => 52,
                    'parent_id' => 50,
                    'code' => '02',
                    'full_code' => '01.01.11.02',
                    'description' => 'Incorporación del enfoque de género en el diseño, formulación, implementación, seguimiento y evaluación de políticas públicas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            52 =>
                array(
                    'id' => 53,
                    'parent_id' => 50,
                    'code' => '03',
                    'full_code' => '01.01.11.03',
                    'description' => 'Elaboración y aplicación de metodologías y herramientas orientadas a incorporar la perspectiva de género en planes, programas, proyectos y en el presupuesto',
                    'level' => 4,
                    'enabled' => 1,
                ),
            53 =>
                array(
                    'id' => 54,
                    'parent_id' => 50,
                    'code' => '04',
                    'full_code' => '01.01.11.04',
                    'description' => 'Promoción de la rendición de cuentas en igualdad de género',
                    'level' => 4,
                    'enabled' => 1,
                ),
            54 =>
                array(
                    'id' => 55,
                    'parent_id' => 1,
                    'code' => '02',
                    'full_code' => '01.02',
                    'description' => 'DISCAPACIDADES',
                    'level' => 2,
                    'enabled' => 1,
                ),
            55 =>
                array(
                    'id' => 56,
                    'parent_id' => 55,
                    'code' => '01',
                    'full_code' => '01.02.01',
                    'description' => 'Promover el reconocimiento y garantia de los derechos de las mujeres y hombres con discapacidad, su debida valoración y el respeto a su dignidad.',
                    'level' => 3,
                    'enabled' => 1,
                ),
            56 =>
                array(
                    'id' => 57,
                    'parent_id' => 56,
                    'code' => '01',
                    'full_code' => '01.02.01.01',
                    'description' => 'Fomentar el uso de un lenguaje adecuado, correcto y respetuoso.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            57 =>
                array(
                    'id' => 58,
                    'parent_id' => 56,
                    'code' => '02',
                    'full_code' => '01.02.01.02',
                    'description' => 'Difundir ampliamente instrumentos que promueven los derechos de las mujeres y hombres con discapacidad.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            58 =>
                array(
                    'id' => 59,
                    'parent_id' => 56,
                    'code' => '03',
                    'full_code' => '01.02.01.03',
                    'description' => 'Diseñar un modelo de gestión institucional con un Enfoque Basado en Derechos Humanos (EBDH).',
                    'level' => 4,
                    'enabled' => 1,
                ),
            59 =>
                array(
                    'id' => 60,
                    'parent_id' => 56,
                    'code' => '04',
                    'full_code' => '01.02.01.04',
                    'description' => 'Construir y fortalecer una percepción positiva, digna y respetuosa, de las mujeres y hombres con discapacidad.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            60 =>
                array(
                    'id' => 61,
                    'parent_id' => 56,
                    'code' => '05',
                    'full_code' => '01.02.01.05',
                    'description' => 'Establecer procesos graduales y dinámicos para garantizar la sostenibilidad de la inclusión.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            61 =>
                array(
                    'id' => 62,
                    'parent_id' => 55,
                    'code' => '02',
                    'full_code' => '01.02.02',
                    'description' => 'Fomentar el ejercicio de los derechos sociales, civiles y políticos, y de las libertades fundamentales de las mujeres y hombres con discapacidad',
                    'level' => 3,
                    'enabled' => 1,
                ),
            62 =>
                array(
                    'id' => 63,
                    'parent_id' => 62,
                    'code' => '01',
                    'full_code' => '01.02.02.01',
                    'description' => 'Garantizar la participación efectiva de las mujeres y hombres con discapacidad, en procesos políticos, de acuerdo con sus requerimientos de apoyo.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            63 =>
                array(
                    'id' => 64,
                    'parent_id' => 62,
                    'code' => '02',
                    'full_code' => '01.02.02.02',
                    'description' => 'Promover la presencia, participación social y liderazgo de las mujeres y hombres con discapacidad.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            64 =>
                array(
                    'id' => 65,
                    'parent_id' => 62,
                    'code' => '03',
                    'full_code' => '01.02.02.03',
                    'description' => 'Impulsar el asociacionismo de mujeres y hombres con discapacidad, y sus familias.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            65 =>
                array(
                    'id' => 66,
                    'parent_id' => 62,
                    'code' => '04',
                    'full_code' => '01.02.02.04',
                    'description' => 'Respetar la privacidad de las mujeres y hombres con discapacidad y garantizar su derecho a formar una familia.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            66 =>
                array(
                    'id' => 67,
                    'parent_id' => 55,
                    'code' => '03',
                    'full_code' => '01.02.03',
                    'description' => 'Contribuir a la prevención de discapacidades, así como al diagnóstico precoz y atención temprana',
                    'level' => 3,
                    'enabled' => 1,
                ),
            67 =>
                array(
                    'id' => 68,
                    'parent_id' => 67,
                    'code' => '01',
                    'full_code' => '01.02.03.01',
                    'description' => 'Prevenir discapacidades producidas por enfermedades y otros factores de riesgo.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            68 =>
                array(
                    'id' => 69,
                    'parent_id' => 67,
                    'code' => '02',
                    'full_code' => '01.02.03.02',
                    'description' => 'Prevenir discapacidades congénitas.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            69 =>
                array(
                    'id' => 70,
                    'parent_id' => 67,
                    'code' => '03',
                    'full_code' => '01.02.03.03',
                    'description' => 'Prevenir discapacidades a causa de accidentes de tránsito.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            70 =>
                array(
                    'id' => 71,
                    'parent_id' => 67,
                    'code' => '04',
                    'full_code' => '01.02.03.04',
                    'description' => 'Prevenir riesgos y accidentes laborales que pudieran devenir en discapacidad.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            71 =>
                array(
                    'id' => 72,
                    'parent_id' => 67,
                    'code' => '05',
                    'full_code' => '01.02.03.05',
                    'description' => 'Disminuir todo tipo de violencia dado que es una de las causas de discapacidad.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            72 =>
                array(
                    'id' => 73,
                    'parent_id' => 55,
                    'code' => '04',
                    'full_code' => '01.02.04',
                    'description' => 'Garantizar a las mujeres y hombres con discapacidad ejercer su derecho a la salud',
                    'level' => 3,
                    'enabled' => 1,
                ),
            73 =>
                array(
                    'id' => 74,
                    'parent_id' => 73,
                    'code' => '01',
                    'full_code' => '01.02.04.01',
                    'description' => 'Implementar programas y acciones  para que las personas con discapacidad accedan a servicios de salud, en igualdad de condiciones que las demás personas.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            74 =>
                array(
                    'id' => 75,
                    'parent_id' => 73,
                    'code' => '02',
                    'full_code' => '01.02.04.02',
                    'description' => 'Integrar el enfoque de discapacidades en el Sistema Nacional de Salud.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            75 =>
                array(
                    'id' => 76,
                    'parent_id' => 73,
                    'code' => '03',
                    'full_code' => '01.02.04.03',
                    'description' => 'Ampliar la cobertura de atención de los servicios de salud mental.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            76 =>
                array(
                    'id' => 77,
                    'parent_id' => 73,
                    'code' => '04',
                    'full_code' => '01.02.04.04',
                    'description' => 'Impulsar investigaciones en pro de una atención integral de salud.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            77 =>
                array(
                    'id' => 78,
                    'parent_id' => 73,
                    'code' => '05',
                    'full_code' => '01.02.04.05',
                    'description' => 'Garantizar la seguridad y protección de las mujeres y hombres con discapacidad en situaciones de riesgo.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            78 =>
                array(
                    'id' => 79,
                    'parent_id' => 55,
                    'code' => '05',
                    'full_code' => '01.02.05',
                    'description' => 'Garantizar a las mujeres y hombres con discapacidad una educación inclusiva de calidad y con calidez,  así como oportunidades de aprendizaje a lo largo de la vida',
                    'level' => 3,
                    'enabled' => 1,
                ),
            79 =>
                array(
                    'id' => 80,
                    'parent_id' => 79,
                    'code' => '01',
                    'full_code' => '01.02.05.01',
                    'description' => 'Implementar medidas que aseguren a las mujeres y hombres con discapacidad el acceso a servicios educativos, en igualdad de condiciones que las demás personas.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            80 =>
                array(
                    'id' => 81,
                    'parent_id' => 79,
                    'code' => '02',
                    'full_code' => '01.02.05.02',
                    'description' => 'Asegurar una educación inclusiva, de calidad y con calidez para personas con discapacidad.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            81 =>
                array(
                    'id' => 82,
                    'parent_id' => 79,
                    'code' => '03',
                    'full_code' => '01.02.05.03',
                    'description' => 'Promover la participación del estudiantado con discapacidad en acciones y actividades tanto curriculares como extracurriculares.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            82 =>
                array(
                    'id' => 83,
                    'parent_id' => 79,
                    'code' => '04',
                    'full_code' => '01.02.05.04',
                    'description' => 'Viabilizar la continuidad de estudios y el aprendizaje a lo largo de la vida.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            83 =>
                array(
                    'id' => 84,
                    'parent_id' => 79,
                    'code' => '05',
                    'full_code' => '01.02.05.05',
                    'description' => 'Compensar las brechas de inequidad que en el campo educativo han afectado a las mujeres y hombres con discapacidad.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            84 =>
                array(
                    'id' => 85,
                    'parent_id' => 55,
                    'code' => '06',
                    'full_code' => '01.02.06',
                    'description' => 'Salvaguardar y promover el derecho al trabajo de las mujeres y hombres con discapacidad, sin discriminación y en igualdad de condiciones que las demás personas',
                    'level' => 3,
                    'enabled' => 1,
                ),
            85 =>
                array(
                    'id' => 86,
                    'parent_id' => 85,
                    'code' => '01',
                    'full_code' => '01.02.06.01',
                    'description' => 'Ampliar la probabilidad de inserción o reinserción laboral de mujeres y hombres con discapacidad con bajos niveles de educación formal.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            86 =>
                array(
                    'id' => 87,
                    'parent_id' => 85,
                    'code' => '02',
                    'full_code' => '01.02.06.02',
                    'description' => 'Incrementar oportunidades de empleo y mejorar los ingresos de las mujeres y hombres con discapacidad.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            87 =>
                array(
                    'id' => 88,
                    'parent_id' => 85,
                    'code' => '03',
                    'full_code' => '01.02.06.03',
                    'description' => 'Asegurar condiciones que garanticen el desempeño laboral de las mujeres y hombres con discapacidad mediante la equiparación de oportunidades.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            88 =>
                array(
                    'id' => 89,
                    'parent_id' => 85,
                    'code' => '04',
                    'full_code' => '01.02.06.04',
                    'description' => 'Incrementar posibilidades de autoempleo y microemprendimiento para mujeres y hombres con discapacidad y sus familias.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            89 =>
                array(
                    'id' => 90,
                    'parent_id' => 85,
                    'code' => '05',
                    'full_code' => '01.02.06.05',
                    'description' => 'Fortalecer la institucionalidad de los organismos públicos y privados, comprometidos con trabajo y empleo para mujeres y hombres con discapacidad.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            90 =>
                array(
                    'id' => 91,
                    'parent_id' => 55,
                    'code' => '07',
                    'full_code' => '01.02.07',
                    'description' => 'Asegurar el acceso de las mujeres y hombres  con discapacidad a los espacios físicos, a la comunicación y a la información',
                    'level' => 3,
                    'enabled' => 1,
                ),
            91 =>
                array(
                    'id' => 92,
                    'parent_id' => 91,
                    'code' => '01',
                    'full_code' => '01.02.07.01',
                    'description' => 'Garantizar a las personas con discapacidad condiciones de seguridad, autonomía y usabilidad mediante la aplicación de los Principios de Diseño Universal.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            92 =>
                array(
                    'id' => 93,
                    'parent_id' => 91,
                    'code' => '02',
                    'full_code' => '01.02.07.02',
                    'description' => 'Eliminar las barreras físicas que impiden el acceso y uso de espacios públicos.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            93 =>
                array(
                    'id' => 94,
                    'parent_id' => 91,
                    'code' => '03',
                    'full_code' => '01.02.07.03',
                    'description' => 'Asegurar que las personas con discapacidad accedan a la información y comunicación, en igualdad de condiciones que las demás.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            94 =>
                array(
                    'id' => 95,
                    'parent_id' => 91,
                    'code' => '04',
                    'full_code' => '01.02.07.04',
                    'description' => 'Garantizar la seguridad y autonomía de las mujeres y hombres con discapacidad, en igualdad de condiciones que las demás, en el uso de servicios de transporte.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            95 =>
                array(
                    'id' => 96,
                    'parent_id' => 91,
                    'code' => '05',
                    'full_code' => '01.02.07.05',
                    'description' => 'Impulsar el acceso a una vivienda digna y accesible para personas con discapacidad.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            96 =>
                array(
                    'id' => 97,
                    'parent_id' => 55,
                    'code' => '08',
                    'full_code' => '01.02.08',
                    'description' => 'Garantizar a las mujeres y hombres con discapacidad el acceso y de los múltiples beneficios  del turismo, de la cultura, del arte, del deporte y de la recreación',
                    'level' => 3,
                    'enabled' => 1,
                ),
            97 =>
                array(
                    'id' => 98,
                    'parent_id' => 97,
                    'code' => '01',
                    'full_code' => '01.02.08.01',
                    'description' => 'Promover la participación activa de las mujeres y hombres con discapacidad en actividades culturales, artísticas, deportivas, turísticas y recreativas.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            98 =>
                array(
                    'id' => 99,
                    'parent_id' => 55,
                    'code' => '09',
                    'full_code' => '01.02.09',
                    'description' => 'Garantizar a las mujeres y hombres con discapacidad el acceso a la protección y seguridad social',
                    'level' => 3,
                    'enabled' => 1,
                ),
            99 =>
                array(
                    'id' => 100,
                    'parent_id' => 99,
                    'code' => '01',
                    'full_code' => '01.02.09.01',
                    'description' => 'Salvaguardar la protección y seguridad social de las mujeres y hombres con discapacidad.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            100 =>
                array(
                    'id' => 101,
                    'parent_id' => 99,
                    'code' => '02',
                    'full_code' => '01.02.09.02',
                    'description' => 'Establecer mecanismos de compensación y apoyo a proveedoras y proveedores de cuidado, para mejorar las condiciones de vida de la persona con discapacidad y su familia, entendida ésta como sistema.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            101 =>
                array(
                    'id' => 102,
                    'parent_id' => 55,
                    'code' => '10',
                    'full_code' => '01.02.10',
                    'description' => 'Garantizar a las mujeres y hombres con discapacidad el acceso efectivo a la justicia, sin discriminación y en igualdad de condiciones que las demás personas',
                    'level' => 3,
                    'enabled' => 1,
                ),
            102 =>
                array(
                    'id' => 103,
                    'parent_id' => 102,
                    'code' => '01',
                    'full_code' => '01.02.10.01',
                    'description' => 'Garantizar el cumplimiento, exigibilidad y defensa de derechos de las mujeres y hombres con discapacidad.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            103 =>
                array(
                    'id' => 104,
                    'parent_id' => 102,
                    'code' => '02',
                    'full_code' => '01.02.10.02',
                    'description' => 'Asegurar que las mujeres y hombres con discapacidad tengan acceso a la justicia.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            104 =>
                array(
                    'id' => 105,
                    'parent_id' => 55,
                    'code' => '11',
                    'full_code' => '01.02.11',
                    'description' => 'Prevenir, sancionar y erradicar la violencia contra mujeres y hombres con discapacidad, sus familiares y cuidadores',
                    'level' => 3,
                    'enabled' => 1,
                ),
            105 =>
                array(
                    'id' => 106,
                    'parent_id' => 105,
                    'code' => '01',
                    'full_code' => '01.02.11.01',
                    'description' => 'Promover y garantizar una vida libre de violencia para las personas con discapacidad, sus familiares y cuidadores.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            106 =>
                array(
                    'id' => 107,
                    'parent_id' => 55,
                    'code' => '12',
                    'full_code' => '01.02.12',
                    'description' => 'Promover, garantizar y desarrollar la institucionalidad, normatividad y políticas públicas con equidad para mujeres y hombres con discapacidad',
                    'level' => 3,
                    'enabled' => 1,
                ),
            107 =>
                array(
                    'id' => 108,
                    'parent_id' => 107,
                    'code' => '01',
                    'full_code' => '01.02.12.01',
                    'description' => 'Incorporar el enfoque de discapacidades en la normativa, planificación y gestión y de las instituciones del sector público.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            108 =>
                array(
                    'id' => 109,
                    'parent_id' => 107,
                    'code' => '02',
                    'full_code' => '01.02.12.02',
                    'description' => 'Incorporar el enfoque de discapacidades en el diseño, formulación, implementación, seguimiento y evaluación de políticas públicas.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            109 =>
                array(
                    'id' => 110,
                    'parent_id' => 107,
                    'code' => '03',
                    'full_code' => '01.02.12.03',
                    'description' => 'Elaborar y aplicar metodologías y herramientas orientadas a incorporar la perspectiva de discapacidades en planes, programas, proyectos y presupuesto.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            110 =>
                array(
                    'id' => 111,
                    'parent_id' => 107,
                    'code' => '04',
                    'full_code' => '01.02.12.04',
                    'description' => 'Promover la rendición de cuentas sobre políticas de igualdad con enfoque de discapacidad.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            111 =>
                array(
                    'id' => 112,
                    'parent_id' => 1,
                    'code' => '03',
                    'full_code' => '01.03',
                    'description' => 'INTERCULTURALIDAD (Pueblos y Nacionalidades)',
                    'level' => 2,
                    'enabled' => 1,
                ),
            112 =>
                array(
                    'id' => 113,
                    'parent_id' => 112,
                    'code' => '01',
                    'full_code' => '01.03.01',
                    'description' => 'Garantizar y proteger la autodeterminación cultural, los saberes ancestrales, el patrimonio tangible e intangible y la memoria social de los pueblos y nacionalidades',
                    'level' => 3,
                    'enabled' => 1,
                ),
            113 =>
                array(
                    'id' => 114,
                    'parent_id' => 113,
                    'code' => '01',
                    'full_code' => '01.03.01.01',
                    'description' => 'Proteger, promover y garantizar la diversidad cultural y respetar sus espacios de reproducción e intercambio, en el marco del pluralismo',
                    'level' => 4,
                    'enabled' => 1,
                ),
            114 =>
                array(
                    'id' => 115,
                    'parent_id' => 113,
                    'code' => '02',
                    'full_code' => '01.03.01.02',
                    'description' => 'Mantener, proteger y desarrollar los conocimientos colectivos; sus ciencias, tecnologías y saberes ancestrales incluidos aquellos sobre biodiversidad, agua, sistemas comunitarios de manejo y protección de la naturaleza (flora, fauna y ecosistemas)',
                    'level' => 4,
                    'enabled' => 1,
                ),
            115 =>
                array(
                    'id' => 116,
                    'parent_id' => 113,
                    'code' => '03',
                    'full_code' => '01.03.01.03',
                    'description' => 'Conservar y desarrollar sus propias formas de convivencia, organización social, representación y ejercicio de autoridad en sus territorios',
                    'level' => 4,
                    'enabled' => 1,
                ),
            116 =>
                array(
                    'id' => 117,
                    'parent_id' => 113,
                    'code' => '04',
                    'full_code' => '01.03.01.04',
                    'description' => 'Proteger y salvaguardar el patrimonio tangible e intangible de los pueblos y nacionalidades según la Constitución',
                    'level' => 4,
                    'enabled' => 1,
                ),
            117 =>
                array(
                    'id' => 118,
                    'parent_id' => 113,
                    'code' => '05',
                    'full_code' => '01.03.01.05',
                    'description' => 'Recuperar, preservar y promover la memoria social de los pueblos y nacionalidades según la Constitución',
                    'level' => 4,
                    'enabled' => 1,
                ),
            118 =>
                array(
                    'id' => 119,
                    'parent_id' => 112,
                    'code' => '02',
                    'full_code' => '01.03.02',
                    'description' => 'Garantizar el ejercicio de los derechos territoriales en el marco de la Constitución y los Derechos Colectivos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            119 =>
                array(
                    'id' => 120,
                    'parent_id' => 119,
                    'code' => '01',
                    'full_code' => '01.03.02.01',
                    'description' => 'Garantizar el acceso, demarcación, titulación, conservación de tierras comunitarias y territorios ancestrales, incluidos los de los pueblos en aislamiento voluntario, en el marco de la Constitución y la Ley',
                    'level' => 4,
                    'enabled' => 1,
                ),
            120 =>
                array(
                    'id' => 121,
                    'parent_id' => 119,
                    'code' => '02',
                    'full_code' => '01.03.02.02',
                    'description' => 'Apoyar la conformación de circunscripciones territoriales interculturales para pueblos y nacionalidades, según la Constitución y la Ley',
                    'level' => 4,
                    'enabled' => 1,
                ),
            121 =>
                array(
                    'id' => 122,
                    'parent_id' => 119,
                    'code' => '03',
                    'full_code' => '01.03.02.03',
                    'description' => 'Garantizar la participación en el uso, usufructo, administración y conservación de los recursos naturales renovables que se hallen en tierras de pueblos y nacionalidades',
                    'level' => 4,
                    'enabled' => 1,
                ),
            122 =>
                array(
                    'id' => 123,
                    'parent_id' => 119,
                    'code' => '04',
                    'full_code' => '01.03.02.04',
                    'description' => 'Facilitar la consulta previa, libre e informada en torno a actividades sobre recursos no renovables que se encuentren en tierras de pueblos y nacionalidades, según la Constitución y la Ley',
                    'level' => 4,
                    'enabled' => 1,
                ),
            123 =>
                array(
                    'id' => 124,
                    'parent_id' => 119,
                    'code' => '05',
                    'full_code' => '01.03.02.05',
                    'description' => 'Prevenir, controlar, mitigar, sanear, remediar y compensar la contaminación ambiental u otros pasivos derivados de actividades de aprovechamiento y uso de recursos dentro de territorios ancestrales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            124 =>
                array(
                    'id' => 125,
                    'parent_id' => 112,
                    'code' => '03',
                    'full_code' => '01.03.03',
                    'description' => 'Promover y garantizar el derecho a la educación, al uso de las lenguas ancestrales y a sistemas educativos interculturales',
                    'level' => 3,
                    'enabled' => 1,
                ),
            125 =>
                array(
                    'id' => 126,
                    'parent_id' => 125,
                    'code' => '01',
                    'full_code' => '01.03.03.01',
                    'description' => 'Erradicar el analfabetismo en pueblos y nacionalidades.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            126 =>
                array(
                    'id' => 127,
                    'parent_id' => 125,
                    'code' => '02',
                    'full_code' => '01.03.03.02',
                    'description' => 'Garantizar a mujeres y hombres de los pueblos y nacionalidades, el acceso universal, permanencia y promoción, sin discriminación alguna, a todos los niveles del sistema educativo formal',
                    'level' => 4,
                    'enabled' => 1,
                ),
            127 =>
                array(
                    'id' => 128,
                    'parent_id' => 125,
                    'code' => '03',
                    'full_code' => '01.03.03.03',
                    'description' => 'Eliminar las brechas en escolaridad inicial, básica, secundaria, superior y de posgrado a pueblos y nacionalidades, tanto en espacios urbanos como rurales, por medio de concesión de becas y otros mecanismos de acción afirmativa',
                    'level' => 4,
                    'enabled' => 1,
                ),
            128 =>
                array(
                    'id' => 129,
                    'parent_id' => 125,
                    'code' => '04',
                    'full_code' => '01.03.03.04',
                    'description' => 'Promover y desarrollar mecanismos coordinados entre el Estado y los pueblos y nacionalidades para el uso, el rescate y la revitalización de los idiomas ancestrales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            129 =>
                array(
                    'id' => 130,
                    'parent_id' => 125,
                    'code' => '05',
                    'full_code' => '01.03.03.05',
                    'description' => 'Garantizar la educación de calidad en lengua materna en los sistemas de educación intercultural bilingüe, según la Constitución y la Ley',
                    'level' => 4,
                    'enabled' => 1,
                ),
            130 =>
                array(
                    'id' => 131,
                    'parent_id' => 125,
                    'code' => '06',
                    'full_code' => '01.03.03.06',
                    'description' => 'Fortalecer los conocimientos y aprendizajes tradicionales como parte integrante del Sistema Nacional de Ciencia, Tecnología, Innovaciones y Saberes Ancestrales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            131 =>
                array(
                    'id' => 132,
                    'parent_id' => 125,
                    'code' => '07',
                    'full_code' => '01.03.03.07',
                    'description' => 'Apoyar la formación y capacitación de los pueblos y nacionalidades en nuevas Tecnologías de Información y Comunicación (TIC)',
                    'level' => 4,
                    'enabled' => 1,
                ),
            132 =>
                array(
                    'id' => 133,
                    'parent_id' => 112,
                    'code' => '04',
                    'full_code' => '01.03.04',
                    'description' => 'Promover y garantizar el derecho a la salud y a sistemas de salud interculturales',
                    'level' => 3,
                    'enabled' => 1,
                ),
            133 =>
                array(
                    'id' => 134,
                    'parent_id' => 133,
                    'code' => '01',
                    'full_code' => '01.03.04.01',
                    'description' => 'Garantizar el acceso y cobertura de salud a pueblos y nacionalidades, dentro del Sistema Nacional de Salud y sus servicios, tomando en cuenta sus necesidades y contextos en todo el territorio del país',
                    'level' => 4,
                    'enabled' => 1,
                ),
            134 =>
                array(
                    'id' => 135,
                    'parent_id' => 133,
                    'code' => '02',
                    'full_code' => '01.03.04.02',
                    'description' => 'Fortalecer los sistemas de salud tradicional de los pueblos y nacionalidades, y favorecer la institucionalización e integración de sus prácticas con el sistema formal de salud pública',
                    'level' => 4,
                    'enabled' => 1,
                ),
            135 =>
                array(
                    'id' => 136,
                    'parent_id' => 133,
                    'code' => '03',
                    'full_code' => '01.03.04.03',
                    'description' => 'Apoyar la investigación de los conocimientos y prácticas de medicina y curación tradicionales, así como de las plantas medicinales, sus propiedades y usos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            136 =>
                array(
                    'id' => 137,
                    'parent_id' => 112,
                    'code' => '05',
                    'full_code' => '01.03.05',
                    'description' => 'Garantizar el ejercicio de los derechos de vivienda, laborales y de seguridad social de los pueblos y nacionalidades',
                    'level' => 3,
                    'enabled' => 1,
                ),
            137 =>
                array(
                    'id' => 138,
                    'parent_id' => 137,
                    'code' => '01',
                    'full_code' => '01.03.05.01',
                    'description' => 'Promover acciones afirmativas referidas a garantizar los derechos al hábitat y vivienda digna, incluidos servicios básicos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            138 =>
                array(
                    'id' => 139,
                    'parent_id' => 137,
                    'code' => '02',
                    'full_code' => '01.03.05.02',
                    'description' => 'Garantizar el ejercicio de los derechos laborales de los pueblos y nacionalidades (empleo y salario dignos) y fortalecer las ocupaciones y medios de vida tradicionales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            139 =>
                array(
                    'id' => 140,
                    'parent_id' => 137,
                    'code' => '03',
                    'full_code' => '01.03.05.03',
                    'description' => 'Promover y garantizar el acceso universal de los pueblos y nacionalidades a programas de seguridad social del Estado, adaptados a sus prácticas y contextos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            140 =>
                array(
                    'id' => 141,
                    'parent_id' => 112,
                    'code' => '06',
                    'full_code' => '01.03.06',
                    'description' => 'Garantizar el ejercicio del derecho propio o consetudinario a través de la coordinación y cooperación entre sistemas de justicia',
                    'level' => 3,
                    'enabled' => 1,
                ),
            141 =>
                array(
                    'id' => 142,
                    'parent_id' => 141,
                    'code' => '01',
                    'full_code' => '01.03.06.01',
                    'description' => 'Favorecer la investigación y conocimiento de las prácticas de justicia consuetudinaria de nacionalidades y pueblos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            142 =>
                array(
                    'id' => 143,
                    'parent_id' => 141,
                    'code' => '02',
                    'full_code' => '01.03.06.02',
                    'description' => 'Impulsar la articulación entre sistemas de justicia propia y sistema de justicia ordinaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            143 =>
                array(
                    'id' => 144,
                    'parent_id' => 141,
                    'code' => '03',
                    'full_code' => '01.03.06.03',
                    'description' => 'Garantizar el acceso a la administración de justicia a los pueblos y nacionalidades',
                    'level' => 4,
                    'enabled' => 1,
                ),
            144 =>
                array(
                    'id' => 145,
                    'parent_id' => 141,
                    'code' => '04',
                    'full_code' => '01.03.06.04',
                    'description' => 'Viabilizar programas de formación y promoción de operadores de justicia (fiscales, defensores públicos, jueces y funcionarios judiciales)',
                    'level' => 4,
                    'enabled' => 1,
                ),
            145 =>
                array(
                    'id' => 146,
                    'parent_id' => 112,
                    'code' => '07',
                    'full_code' => '01.03.07',
                    'description' => 'Promover y fortalecer los sistemas de economía popular y solidaria de los pueblos y nacionalidades',
                    'level' => 3,
                    'enabled' => 1,
                ),
            146 =>
                array(
                    'id' => 147,
                    'parent_id' => 146,
                    'code' => '01',
                    'full_code' => '01.03.07.01',
                    'description' => 'Fortalecer el desarrollo de organizaciones y redes de productores y de consumidores, así como las de comercialización y distribución de alimentos que promuevan la equidad entre pueblos y nacionalidades',
                    'level' => 4,
                    'enabled' => 1,
                ),
            147 =>
                array(
                    'id' => 148,
                    'parent_id' => 146,
                    'code' => '02',
                    'full_code' => '01.03.07.02',
                    'description' => 'Fortalecer la diversificación e innovación productiva de la economía popular y solidaria y la introducción de tecnologías ecológicas y orgánicas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            148 =>
                array(
                    'id' => 149,
                    'parent_id' => 146,
                    'code' => '03',
                    'full_code' => '01.03.07.03',
                    'description' => 'Establecer y fortalecer las redes de asistencia técnica, financiera  y de gestión para optimización de recursos productivos, generación de valor agregado y mejoramiento de la calidad en economía popular y solidaria de los pueblos y nacionalidades',
                    'level' => 4,
                    'enabled' => 1,
                ),
            149 =>
                array(
                    'id' => 150,
                    'parent_id' => 112,
                    'code' => '08',
                    'full_code' => '01.03.08',
                    'description' => 'Promover y fortalecer la Soberanía Alimentaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            150 =>
                array(
                    'id' => 151,
                    'parent_id' => 150,
                    'code' => '01',
                    'full_code' => '01.03.08.01',
                    'description' => 'Promover políticas redistributivas que permitan a los pueblos y nacionalidades el acceso a la tierra, al agua de riego y a su manejo para la producción de alimentos bajo los principios de equidad, eficiencia y sostenibilidad ambiental',
                    'level' => 4,
                    'enabled' => 1,
                ),
            151 =>
                array(
                    'id' => 152,
                    'parent_id' => 150,
                    'code' => '02',
                    'full_code' => '01.03.08.02',
                    'description' => 'Fortalecer la investigación científica, tecnológica y de extensión, sobre los sistemas alimentarios de la diversidad cultural y ecológica del país, para mejorar la calidad, productividad y sanidad alimentaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            152 =>
                array(
                    'id' => 153,
                    'parent_id' => 150,
                    'code' => '03',
                    'full_code' => '01.03.08.03',
                    'description' => 'Promover el uso, la conservación, mejoramiento e intercambio de semillas para garantizar la Soberanía Alimentaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            153 =>
                array(
                    'id' => 154,
                    'parent_id' => 150,
                    'code' => '04',
                    'full_code' => '01.03.08.04',
                    'description' => 'Impulsar la producción, transformación agroalimentaria y pesquera de las pequeñas y medianas unidades de producción',
                    'level' => 4,
                    'enabled' => 1,
                ),
            154 =>
                array(
                    'id' => 155,
                    'parent_id' => 150,
                    'code' => '05',
                    'full_code' => '01.03.08.05',
                    'description' => 'Fortalecer la difusión y transferencia de tecnología al sector agroalimentario, con un enfoque de demanda considerando la heterogeneidad de zonas agrobioclimáticas y patrones culturales de producción',
                    'level' => 4,
                    'enabled' => 1,
                ),
            155 =>
                array(
                    'id' => 156,
                    'parent_id' => 112,
                    'code' => '09',
                    'full_code' => '01.03.09',
                    'description' => 'Fortalecer y promover los liderazgos con equidad de género, la participación plena y el ejercicio de la democracia comunitaria de los pueblos y nacionalidades',
                    'level' => 3,
                    'enabled' => 1,
                ),
            156 =>
                array(
                    'id' => 157,
                    'parent_id' => 156,
                    'code' => '01',
                    'full_code' => '01.03.09.01',
                    'description' => 'Promover y consolidar liderazgos plurales, y con equidad de género, que redunden en la atención de sus necesidades y en su capacidad de exigibilidad y de incidencia en políticas públicas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            157 =>
                array(
                    'id' => 158,
                    'parent_id' => 156,
                    'code' => '02',
                    'full_code' => '01.03.09.02',
                    'description' => 'Fomentar y fortalecer procesos de deliberación, toma de decisiones, resolución de conflictos y representación ligados a la democracia comunitaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            158 =>
                array(
                    'id' => 159,
                    'parent_id' => 156,
                    'code' => '03',
                    'full_code' => '01.03.09.03',
                    'description' => 'Facilitar la participación mediante sus representantes con equidad de género, en los organismos oficiales para la definición de las políticas públicas así como de sus prioridades en los planes, programas, proyectos y acciones del Estado',
                    'level' => 4,
                    'enabled' => 1,
                ),
            159 =>
                array(
                    'id' => 160,
                    'parent_id' => 156,
                    'code' => '04',
                    'full_code' => '01.03.09.04',
                    'description' => 'Facilitar la consulta antes de la adopción de una medida legislativa que pueda afectar cualquiera de sus derechos colectivos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            160 =>
                array(
                    'id' => 161,
                    'parent_id' => 112,
                    'code' => '10',
                    'full_code' => '01.03.10',
                    'description' => 'Promover y reforzar la lucha contra el racismo, la discriminación y la intolerancia',
                    'level' => 3,
                    'enabled' => 1,
                ),
            161 =>
                array(
                    'id' => 162,
                    'parent_id' => 161,
                    'code' => '01',
                    'full_code' => '01.03.10.01',
                    'description' => 'Incluir en las mallas curriculares y en el material de estudio en todos los niveles de educación formal y no formal del país, contenidos de la diversidad cultural del Ecuador',
                    'level' => 4,
                    'enabled' => 1,
                ),
            162 =>
                array(
                    'id' => 163,
                    'parent_id' => 161,
                    'code' => '02',
                    'full_code' => '01.03.10.02',
                    'description' => 'Promover campañas masivas de información y sensibilización sobre la riqueza de la diversidad cultural, la equidad social, la Constitución y las leyes que la refieren',
                    'level' => 4,
                    'enabled' => 1,
                ),
            163 =>
                array(
                    'id' => 164,
                    'parent_id' => 161,
                    'code' => '03',
                    'full_code' => '01.03.10.03',
                    'description' => 'Fortalecer y generar normativa orientada hacia el control y sanción para la erradicación de prácticas de discriminación, racismo e intolerancia, en espacios públicos y privados, propiciando la adopción de códigos de ética que promuevan el respeto a la pluralidad',
                    'level' => 4,
                    'enabled' => 1,
                ),
            164 =>
                array(
                    'id' => 165,
                    'parent_id' => 161,
                    'code' => '04',
                    'full_code' => '01.03.10.04',
                    'description' => 'Promover y consolidar espacios y mecanismos de denuncia y sanción de actos de discriminación, racismo e intolerancia, asegurando la atención de casos asociados a la violación de derechos de personas pertenecientes a pueblos y nacionalidades',
                    'level' => 4,
                    'enabled' => 1,
                ),
            165 =>
                array(
                    'id' => 166,
                    'parent_id' => 161,
                    'code' => '05',
                    'full_code' => '01.03.10.05',
                    'description' => 'Velar por el cumplimiento y observancia de los convenios internacionales ligados a la lucha contra el racismo, la discriminación y la intolerancia',
                    'level' => 4,
                    'enabled' => 1,
                ),
            166 =>
                array(
                    'id' => 167,
                    'parent_id' => 161,
                    'code' => '06',
                    'full_code' => '01.03.10.06',
                    'description' => 'Fomentar y fortalecer espacios para el intercambio cultural de pueblos y nacionalidades',
                    'level' => 4,
                    'enabled' => 1,
                ),
            167 =>
                array(
                    'id' => 168,
                    'parent_id' => 112,
                    'code' => '11',
                    'full_code' => '01.03.11',
                    'description' => 'Garantizar el derecho a la comunicación e información de las nacionalidades y pueblos indígenas, afroecuatoriano y montubio',
                    'level' => 3,
                    'enabled' => 1,
                ),
            168 =>
                array(
                    'id' => 169,
                    'parent_id' => 168,
                    'code' => '01',
                    'full_code' => '01.03.11.01',
                    'description' => 'Fomentar el desarrollo de subsistemas de comunicación propios de los pueblos y nacionalidades',
                    'level' => 4,
                    'enabled' => 1,
                ),
            169 =>
                array(
                    'id' => 170,
                    'parent_id' => 168,
                    'code' => '02',
                    'full_code' => '01.03.11.02',
                    'description' => 'Promover el autoconocimiento de los pueblos y nacionalidades, con fines al pleno ejercicio de sus derechos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            170 =>
                array(
                    'id' => 171,
                    'parent_id' => 168,
                    'code' => '03',
                    'full_code' => '01.03.11.03',
                    'description' => 'Mantener y desarrollar los contactos, las relaciones y la cooperación con otros pueblos y nacionalidades, incluidos aquellos divididos por fronteras internacionales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            171 =>
                array(
                    'id' => 172,
                    'parent_id' => 112,
                    'code' => '12',
                    'full_code' => '01.03.12',
                    'description' => 'Promover y fortalecer la institucionalidad del Estado para la equidad con pueblos y nacionalidades',
                    'level' => 3,
                    'enabled' => 1,
                ),
            172 =>
                array(
                    'id' => 173,
                    'parent_id' => 172,
                    'code' => '01',
                    'full_code' => '01.03.12.01',
                    'description' => 'Incorporar el enfoque de la diversidad cultural en la gestión y normativa de las instituciones del sector público, incluidos protocolos para la atención en sus diferentes servicios',
                    'level' => 4,
                    'enabled' => 1,
                ),
            173 =>
                array(
                    'id' => 174,
                    'parent_id' => 172,
                    'code' => '02',
                    'full_code' => '01.03.12.02',
                    'description' => 'Incorporar la perspectiva de pueblos y nacionalidades en el diseño, formulación, implementación, seguimiento y evaluación de las políticas públicas, con metodologías, herramientas y presupuestos apropiados en las instituciones del Estado',
                    'level' => 4,
                    'enabled' => 1,
                ),
            174 =>
                array(
                    'id' => 175,
                    'parent_id' => 172,
                    'code' => '03',
                    'full_code' => '01.03.12.03',
                    'description' => 'Promover la capacitación y formación continua de los servidores y servidoras públicos en temas de garantía y promoción de los derechos de los pueblos y nacionalidades, y en la ejecución de las políticas públicas y en la práctica institucional y cotidiana',
                    'level' => 4,
                    'enabled' => 1,
                ),
            175 =>
                array(
                    'id' => 176,
                    'parent_id' => 172,
                    'code' => '04',
                    'full_code' => '01.03.12.04',
                    'description' => 'Promover mecanismos de rendición de cuentas y control social adaptadas a los pueblos y nacionalidades, sus idiomas y territorios',
                    'level' => 4,
                    'enabled' => 1,
                ),
            176 =>
                array(
                    'id' => 177,
                    'parent_id' => 172,
                    'code' => '05',
                    'full_code' => '01.03.12.05',
                    'description' => 'Impulsar la incorporación de enfoque de diversidad cultural en la elaboración, procesamiento y difusión de estadísticas a nivel nacional y local',
                    'level' => 4,
                    'enabled' => 1,
                ),
            177 =>
                array(
                    'id' => 178,
                    'parent_id' => 1,
                    'code' => '04',
                    'full_code' => '01.04',
                    'description' => 'MOVILIDAD HUMANA',
                    'level' => 2,
                    'enabled' => 1,
                ),
            178 =>
                array(
                    'id' => 179,
                    'parent_id' => 178,
                    'code' => '01',
                    'full_code' => '01.04.01',
                    'description' => 'Garantizar los derechos de las personas ecuatorianas en el exterior independientemente de su condición migratoria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            179 =>
                array(
                    'id' => 180,
                    'parent_id' => 179,
                    'code' => '01',
                    'full_code' => '01.04.01.01',
                    'description' => 'Registrar a los/as ecuatorianos/as en el exterior',
                    'level' => 4,
                    'enabled' => 1,
                ),
            180 =>
                array(
                    'id' => 181,
                    'parent_id' => 179,
                    'code' => '02',
                    'full_code' => '01.04.01.02',
                    'description' => 'Garantizar la generación eficiente de documentos de identificación de personas ecuatorianas en el exterior',
                    'level' => 4,
                    'enabled' => 1,
                ),
            181 =>
                array(
                    'id' => 182,
                    'parent_id' => 179,
                    'code' => '03',
                    'full_code' => '01.04.01.03',
                    'description' => 'Generar documentos legales de apoyo a ecuatorianos/as en el exterior',
                    'level' => 4,
                    'enabled' => 1,
                ),
            182 =>
                array(
                    'id' => 183,
                    'parent_id' => 179,
                    'code' => '04',
                    'full_code' => '01.04.01.04',
                    'description' => 'Precautelar los derechos de ecuatorianos/as privados/as de su libertad en el exterior',
                    'level' => 4,
                    'enabled' => 1,
                ),
            183 =>
                array(
                    'id' => 184,
                    'parent_id' => 179,
                    'code' => '05',
                    'full_code' => '01.04.01.05',
                    'description' => 'Apoyo a la repatriación de ecuatorianos/as en situación de vulnerabilidad y emergencia',
                    'level' => 4,
                    'enabled' => 1,
                ),
            184 =>
                array(
                    'id' => 185,
                    'parent_id' => 179,
                    'code' => '06',
                    'full_code' => '01.04.01.06',
                    'description' => 'Capacitar permanentemente a funcionarios/as del servicio exterior acerca de los derechos de las personas migrantes, de la normativa del Estado ecuatoriano, sus servicios y beneficios',
                    'level' => 4,
                    'enabled' => 1,
                ),
            185 =>
                array(
                    'id' => 186,
                    'parent_id' => 178,
                    'code' => '02',
                    'full_code' => '01.04.02',
                    'description' => 'Apoyar a la integración de ecuatorianos/as en sociedades de destino',
                    'level' => 3,
                    'enabled' => 1,
                ),
            186 =>
                array(
                    'id' => 187,
                    'parent_id' => 186,
                    'code' => '01',
                    'full_code' => '01.04.02.01',
                    'description' => 'Facilitar servicios de asesoría legal para personas migrantes ecuatorianas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            187 =>
                array(
                    'id' => 188,
                    'parent_id' => 186,
                    'code' => '02',
                    'full_code' => '01.04.02.02',
                    'description' => 'Facilitar servicios de atención psicológica para personas migrantes ecuatorianas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            188 =>
                array(
                    'id' => 189,
                    'parent_id' => 186,
                    'code' => '03',
                    'full_code' => '01.04.02.03',
                    'description' => 'Facilitar servicios de capacitación lingüística para personas migrantes ecuatorianas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            189 =>
                array(
                    'id' => 190,
                    'parent_id' => 186,
                    'code' => '04',
                    'full_code' => '01.04.02.04',
                    'description' => 'Facilitar/informar/coordinar servicios de nivelación escolar para personas migrantes ecuatorianas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            190 =>
                array(
                    'id' => 191,
                    'parent_id' => 186,
                    'code' => '05',
                    'full_code' => '01.04.02.05',
                    'description' => 'Realizar cursos de capacitación en deberes y derechos de ciudadanía en los países de destino',
                    'level' => 4,
                    'enabled' => 1,
                ),
            191 =>
                array(
                    'id' => 192,
                    'parent_id' => 186,
                    'code' => '06',
                    'full_code' => '01.04.02.06',
                    'description' => 'Generar bolsas laborales en coordinación con servicios sociales locales en los países de destino',
                    'level' => 4,
                    'enabled' => 1,
                ),
            192 =>
                array(
                    'id' => 193,
                    'parent_id' => 186,
                    'code' => '07',
                    'full_code' => '01.04.02.07',
                    'description' => 'Realizar cursos de capacitación para inserción laboral y sobre derechos laborales en los países de destino',
                    'level' => 4,
                    'enabled' => 1,
                ),
            193 =>
                array(
                    'id' => 194,
                    'parent_id' => 178,
                    'code' => '03',
                    'full_code' => '01.04.03',
                    'description' => 'Promover y reforzar la lucha contra la xenofobia, la discriminación y la intolerancia',
                    'level' => 3,
                    'enabled' => 1,
                ),
            194 =>
                array(
                    'id' => 195,
                    'parent_id' => 194,
                    'code' => '01',
                    'full_code' => '01.04.03.01',
                    'description' => 'Promover y consolidar espacios y mecanismos de denuncia de actos de xenofobia, discriminación e intolerancia, asegurando la atención de casos asociados a la violación de derechos de personas migrantes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            195 =>
                array(
                    'id' => 196,
                    'parent_id' => 194,
                    'code' => '02',
                    'full_code' => '01.04.03.02',
                    'description' => 'Fomentar y fortalecer espacios para el intercambio cultural en los países de destino',
                    'level' => 4,
                    'enabled' => 1,
                ),
            196 =>
                array(
                    'id' => 197,
                    'parent_id' => 194,
                    'code' => '03',
                    'full_code' => '01.04.03.03',
                    'description' => 'Promover actividades de sensibilización con población local en países de destino, para prevenir la xenofobia',
                    'level' => 4,
                    'enabled' => 1,
                ),
            197 =>
                array(
                    'id' => 198,
                    'parent_id' => 178,
                    'code' => '04',
                    'full_code' => '01.04.04',
                    'description' => 'Favorecer y fomentar la participación ciudadana de los migrantes en origen y destino',
                    'level' => 3,
                    'enabled' => 1,
                ),
            198 =>
                array(
                    'id' => 199,
                    'parent_id' => 198,
                    'code' => '01',
                    'full_code' => '01.04.04.01',
                    'description' => 'Apoyar a organizaciones y redes de migrantes ecuatorianos/as y de familiares en el Ecuador',
                    'level' => 4,
                    'enabled' => 1,
                ),
            199 =>
                array(
                    'id' => 200,
                    'parent_id' => 198,
                    'code' => '02',
                    'full_code' => '01.04.04.02',
                    'description' => 'Apoyar a las organizaciones y redes de migrantes ecuatorianos/as en el exterior',
                    'level' => 4,
                    'enabled' => 1,
                ),
            200 =>
                array(
                    'id' => 201,
                    'parent_id' => 198,
                    'code' => '03',
                    'full_code' => '01.04.04.03',
                    'description' => 'Promover y consolidar liderazgos plurales y con equidad de género, que velen por las necesidades específicas de las personas migrantes y sus organizaciones',
                    'level' => 4,
                    'enabled' => 1,
                ),
            201 =>
                array(
                    'id' => 202,
                    'parent_id' => 198,
                    'code' => '04',
                    'full_code' => '01.04.04.04',
                    'description' => 'Garantizar y promover los derechos de participación política (voto en el exterior) de los/as ecuatorianos/as en el exterior',
                    'level' => 4,
                    'enabled' => 1,
                ),
            202 =>
                array(
                    'id' => 203,
                    'parent_id' => 198,
                    'code' => '05',
                    'full_code' => '01.04.04.05',
                    'description' => 'Generar espacios de veeduría y control social en torno a la migración transnacional, sus derechos, riesgos, tratados, acuerdos y derivaciones',
                    'level' => 4,
                    'enabled' => 1,
                ),
            203 =>
                array(
                    'id' => 204,
                    'parent_id' => 178,
                    'code' => '05',
                    'full_code' => '01.04.05',
                    'description' => 'Prevenir y combatir de manera integral la trata y el tráfico de personas',
                    'level' => 3,
                    'enabled' => 1,
                ),
            204 =>
                array(
                    'id' => 205,
                    'parent_id' => 204,
                    'code' => '01',
                    'full_code' => '01.04.05.01',
                    'description' => 'Atender y proteger a personas víctimas de trata y tráfico de personas, favoreciendo su repatriación',
                    'level' => 4,
                    'enabled' => 1,
                ),
            205 =>
                array(
                    'id' => 206,
                    'parent_id' => 204,
                    'code' => '02',
                    'full_code' => '01.04.05.02',
                    'description' => 'Promover campañas masivas de información y sensibilización para una movilidad humana informada y segura, alertando los riesgos de la trata y el tráfico de personas y sus consecuencias',
                    'level' => 4,
                    'enabled' => 1,
                ),
            206 =>
                array(
                    'id' => 207,
                    'parent_id' => 204,
                    'code' => '03',
                    'full_code' => '01.04.05.03',
                    'description' => 'Promover y consolidar espacios y mecanismos de denuncia de actividades de trata y tráfico de personas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            207 =>
                array(
                    'id' => 208,
                    'parent_id' => 204,
                    'code' => '04',
                    'full_code' => '01.04.05.04',
                    'description' => 'Fortalecer y generar normativa orientada hacia la prevención, denuncia y sanción de la trata y tráfico de personas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            208 =>
                array(
                    'id' => 209,
                    'parent_id' => 178,
                    'code' => '06',
                    'full_code' => '01.04.06',
                    'description' => 'Apoyar el retorno voluntario de los/as migrantes ecuatorianos/as en el exterior',
                    'level' => 3,
                    'enabled' => 1,
                ),
            209 =>
                array(
                    'id' => 210,
                    'parent_id' => 209,
                    'code' => '01',
                    'full_code' => '01.04.06.01',
                    'description' => 'Facilitar información idónea de los derechos y beneficios que brinda el Estado ecuatoriano a sus ciudadanos/as en el exterior',
                    'level' => 4,
                    'enabled' => 1,
                ),
            210 =>
                array(
                    'id' => 211,
                    'parent_id' => 209,
                    'code' => '02',
                    'full_code' => '01.04.06.02',
                    'description' => 'Realizar acciones afirmativas orientadas a favorecer el retorno voluntario de migrantes ecuatorianos/as con insumos favorables a su reinserción en el Ecuador',
                    'level' => 4,
                    'enabled' => 1,
                ),
            211 =>
                array(
                    'id' => 212,
                    'parent_id' => 209,
                    'code' => '03',
                    'full_code' => '01.04.06.03',
                    'description' => 'Realizar acciones de control y monitoreo en los servicios aduaneros para el ingreso de objetos y materiales de ecuatorianos/as retornados/as.',
                    'level' => 4,
                    'enabled' => 1,
                ),
            212 =>
                array(
                    'id' => 213,
                    'parent_id' => 178,
                    'code' => '07',
                    'full_code' => '01.04.07',
                    'description' => 'Favorecer la reintegración social y económica de los/as migrantes retornados/as',
                    'level' => 3,
                    'enabled' => 1,
                ),
            213 =>
                array(
                    'id' => 214,
                    'parent_id' => 213,
                    'code' => '01',
                    'full_code' => '01.04.07.01',
                    'description' => 'Apoyar la inserción y reinserción laboral y profesional de los/as ecuatorianos/as retornados/as',
                    'level' => 4,
                    'enabled' => 1,
                ),
            214 =>
                array(
                    'id' => 215,
                    'parent_id' => 213,
                    'code' => '02',
                    'full_code' => '01.04.07.02',
                    'description' => 'Generar y fortalecer programas de crédito y apoyo financiero para proyectos e iniciativas productivas de migrantes ecuatorianos/as retornados/as y sus familias',
                    'level' => 4,
                    'enabled' => 1,
                ),
            215 =>
                array(
                    'id' => 216,
                    'parent_id' => 213,
                    'code' => '03',
                    'full_code' => '01.04.07.03',
                    'description' => 'Capacitar en derechos de ciudadanía en el Ecuador según la Constitución y las leyes actuales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            216 =>
                array(
                    'id' => 217,
                    'parent_id' => 213,
                    'code' => '04',
                    'full_code' => '01.04.07.04',
                    'description' => 'Favorecer y apoyar el acceso de los/as migrantes ecuatorianos/as retornados/as a los servicios sociales del Estado en sus distintas carteras',
                    'level' => 4,
                    'enabled' => 1,
                ),
            217 =>
                array(
                    'id' => 218,
                    'parent_id' => 213,
                    'code' => '05',
                    'full_code' => '01.04.07.05',
                    'description' => 'Favorecer la integración a actividades con fines productivos a migrantes retornados/as',
                    'level' => 4,
                    'enabled' => 1,
                ),
            218 =>
                array(
                    'id' => 219,
                    'parent_id' => 213,
                    'code' => '06',
                    'full_code' => '01.04.07.06',
                    'description' => 'Favorecer el acceso a la vivienda y sus servicios básicos a los/as migrantes retornados/as',
                    'level' => 4,
                    'enabled' => 1,
                ),
            219 =>
                array(
                    'id' => 220,
                    'parent_id' => 213,
                    'code' => '07',
                    'full_code' => '01.04.07.07',
                    'description' => 'Facilitar y apoyar la reinserción educativa de los/as hijos/as de ecuatorianos/as retornados/as',
                    'level' => 4,
                    'enabled' => 1,
                ),
            220 =>
                array(
                    'id' => 221,
                    'parent_id' => 178,
                    'code' => '08',
                    'full_code' => '01.04.08',
                    'description' => 'Garantizar los derechos de los/as familiares de migrantes ecuatorianos/as y de la familia transnacional, proviniendo toda forma de discriminación',
                    'level' => 3,
                    'enabled' => 1,
                ),
            221 =>
                array(
                    'id' => 222,
                    'parent_id' => 221,
                    'code' => '01',
                    'full_code' => '01.04.08.01',
                    'description' => 'Garantizar el acceso y permanencia de hijos/as de migrantes en el sistema de educación en el Ecuador',
                    'level' => 4,
                    'enabled' => 1,
                ),
            222 =>
                array(
                    'id' => 223,
                    'parent_id' => 221,
                    'code' => '02',
                    'full_code' => '01.04.08.02',
                    'description' => 'Promover la creación de productos financieros del Estado para la familia transnacional',
                    'level' => 4,
                    'enabled' => 1,
                ),
            223 =>
                array(
                    'id' => 224,
                    'parent_id' => 221,
                    'code' => '03',
                    'full_code' => '01.04.08.03',
                    'description' => 'Promover y fortalecer mecanismos de comunicación y promoción de vínculos familiares transnacionales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            224 =>
                array(
                    'id' => 225,
                    'parent_id' => 221,
                    'code' => '04',
                    'full_code' => '01.04.08.04',
                    'description' => 'Promover la atención psicológica a familiares de migrantes ecuatorianos/as',
                    'level' => 4,
                    'enabled' => 1,
                ),
            225 =>
                array(
                    'id' => 226,
                    'parent_id' => 221,
                    'code' => '05',
                    'full_code' => '01.04.08.05',
                    'description' => 'Crear y fortalecer servicios de asesoría legal para familiares de migrantes ecuatorianos/as',
                    'level' => 4,
                    'enabled' => 1,
                ),
            226 =>
                array(
                    'id' => 227,
                    'parent_id' => 178,
                    'code' => '09',
                    'full_code' => '01.04.09',
                    'description' => 'Fortalecer la política migratoria, sus agendas, convenios y acuerdos desde una perspectiva de derechos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            227 =>
                array(
                    'id' => 228,
                    'parent_id' => 227,
                    'code' => '01',
                    'full_code' => '01.04.09.01',
                    'description' => 'Velar por el cumplimiento de los convenios y acuerdos internacionales respecto de los derechos de las personas migrantes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            228 =>
                array(
                    'id' => 229,
                    'parent_id' => 227,
                    'code' => '02',
                    'full_code' => '01.04.09.02',
                    'description' => 'Generar convenios de seguridad social binacional con los países de destino de los/as migrantes ecuatorianos/as',
                    'level' => 4,
                    'enabled' => 1,
                ),
            229 =>
                array(
                    'id' => 230,
                    'parent_id' => 227,
                    'code' => '03',
                    'full_code' => '01.04.09.03',
                    'description' => 'Fortalecer y mejorar los acuerdos bilaterales y multilaterales de flujos migratorios',
                    'level' => 4,
                    'enabled' => 1,
                ),
            230 =>
                array(
                    'id' => 231,
                    'parent_id' => 227,
                    'code' => '04',
                    'full_code' => '01.04.09.04',
                    'description' => 'Velar por el cumplimiento y observancia de los convenios internacionales ligados a la lucha contra la xenofobia, la discriminación y la intolerancia',
                    'level' => 4,
                    'enabled' => 1,
                ),
            231 =>
                array(
                    'id' => 232,
                    'parent_id' => 227,
                    'code' => '05',
                    'full_code' => '01.04.09.05',
                    'description' => 'Apoyar la generación de agendas locales, bilaterales y multilaterales en materia migratoria incluida la cooperación internacional',
                    'level' => 4,
                    'enabled' => 1,
                ),
            232 =>
                array(
                    'id' => 233,
                    'parent_id' => 178,
                    'code' => '10',
                    'full_code' => '01.04.10',
                    'description' => 'Crear y fortalecer espacios de generación de información y estudio sobre la movilidad humana internacional',
                    'level' => 3,
                    'enabled' => 1,
                ),
            233 =>
                array(
                    'id' => 234,
                    'parent_id' => 233,
                    'code' => '01',
                    'full_code' => '01.04.10.01',
                    'description' => 'Generar estadísticas confiables y actualizadas de la migración ecuatoriana y global, y sus derivaciones',
                    'level' => 4,
                    'enabled' => 1,
                ),
            234 =>
                array(
                    'id' => 235,
                    'parent_id' => 233,
                    'code' => '02',
                    'full_code' => '01.04.10.02',
                    'description' => 'Promover becas para investigación en temática migratoria, fomentando intercambios de estudiantes y especialistas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            235 =>
                array(
                    'id' => 236,
                    'parent_id' => 233,
                    'code' => '03',
                    'full_code' => '01.04.10.03',
                    'description' => 'Crear espacios especializados de estudio, investigación y formación en torno a la movilidad humana internacional',
                    'level' => 4,
                    'enabled' => 1,
                ),
            236 =>
                array(
                    'id' => 237,
                    'parent_id' => 233,
                    'code' => '04',
                    'full_code' => '01.04.10.04',
                    'description' => 'Crear fondos concursables de investigación en temática de movilidad humana',
                    'level' => 4,
                    'enabled' => 1,
                ),
            237 =>
                array(
                    'id' => 238,
                    'parent_id' => 233,
                    'code' => '05',
                    'full_code' => '01.04.10.05',
                    'description' => 'Generar espacios de difusión de información y estadística de las migraciones y sus derivaciones',
                    'level' => 4,
                    'enabled' => 1,
                ),
            238 =>
                array(
                    'id' => 239,
                    'parent_id' => 178,
                    'code' => '11',
                    'full_code' => '01.04.11',
                    'description' => 'Promover y fortalecer la institucionalidad del Estado para transversalizar la atención a la movilidad humana',
                    'level' => 3,
                    'enabled' => 1,
                ),
            239 =>
                array(
                    'id' => 240,
                    'parent_id' => 239,
                    'code' => '01',
                    'full_code' => '01.04.11.01',
                    'description' => 'Incorporar el enfoque de la movilidad humana y sus derivaciones en la gestión y normativa de las instituciones del sector público, incluidos protocolos para la contratación de servidores/as públicos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            240 =>
                array(
                    'id' => 241,
                    'parent_id' => 239,
                    'code' => '02',
                    'full_code' => '01.04.11.02',
                    'description' => 'Facilitar y fortalecer el registro y los servicios para personas en movilidad humana',
                    'level' => 4,
                    'enabled' => 1,
                ),
            241 =>
                array(
                    'id' => 242,
                    'parent_id' => 239,
                    'code' => '03',
                    'full_code' => '01.04.11.03',
                    'description' => 'Realizar capacitación y formación continua de los servidores y servidoras públicos en temas de garantía y promoción de los derechos de las personas migrantes y sus familias',
                    'level' => 4,
                    'enabled' => 1,
                ),
            242 =>
                array(
                    'id' => 243,
                    'parent_id' => 1,
                    'code' => '05',
                    'full_code' => '01.05',
                    'description' => 'GENERACIONAL - INFANCIA, NIÑEZ Y ADOLESCENCIA',
                    'level' => 2,
                    'enabled' => 1,
                ),
            243 =>
                array(
                    'id' => 244,
                    'parent_id' => 243,
                    'code' => '01',
                    'full_code' => '01.05.01',
                    'description' => 'Asegurar una atención integral de salud oportuna y gratuita, con calidad, calidez y equidad para todos los niños, niñas y adolescentes',
                    'level' => 3,
                    'enabled' => 1,
                ),
            244 =>
                array(
                    'id' => 245,
                    'parent_id' => 244,
                    'code' => '01',
                    'full_code' => '01.05.01.01',
                    'description' => 'Mejorar el estado nutricional de niños y niñas menores de cinco años, escolares y adolescentes, embarazadas y mujeres en período de lactancia',
                    'level' => 4,
                    'enabled' => 1,
                ),
            245 =>
                array(
                    'id' => 246,
                    'parent_id' => 244,
                    'code' => '02',
                    'full_code' => '01.05.01.02',
                    'description' => 'Eliminar la desnutrición de los recién nacidos y de los niños y niñas hasta el primer año de vida',
                    'level' => 4,
                    'enabled' => 1,
                ),
            246 =>
                array(
                    'id' => 247,
                    'parent_id' => 244,
                    'code' => '03',
                    'full_code' => '01.05.01.03',
                    'description' => 'Combatir la deficiencia nutricional de niños y niñas, con énfasis hasta los 36 meses de edad, proporcionando micronutrientes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            247 =>
                array(
                    'id' => 248,
                    'parent_id' => 244,
                    'code' => '04',
                    'full_code' => '01.05.01.04',
                    'description' => 'Reducir la malnutrición de niños, niñas y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            248 =>
                array(
                    'id' => 249,
                    'parent_id' => 244,
                    'code' => '05',
                    'full_code' => '01.05.01.05',
                    'description' => 'Ampliar la inmunización de enfermedades epidemiológicas a niños y niñas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            249 =>
                array(
                    'id' => 250,
                    'parent_id' => 244,
                    'code' => '06',
                    'full_code' => '01.05.01.06',
                    'description' => 'Reducir la prevalencia de anemia en niños y niñas menores a 5 años de edad',
                    'level' => 4,
                    'enabled' => 1,
                ),
            250 =>
                array(
                    'id' => 251,
                    'parent_id' => 244,
                    'code' => '07',
                    'full_code' => '01.05.01.07',
                    'description' => 'Reducir el porcentaje de incidencia de discapacidad, con diagnósticos tempranos y atención especializada en la población infantil',
                    'level' => 4,
                    'enabled' => 1,
                ),
            251 =>
                array(
                    'id' => 252,
                    'parent_id' => 244,
                    'code' => '08',
                    'full_code' => '01.05.01.08',
                    'description' => 'Detectar acciones de refracción en la población escolar',
                    'level' => 4,
                    'enabled' => 1,
                ),
            252 =>
                array(
                    'id' => 253,
                    'parent_id' => 244,
                    'code' => '09',
                    'full_code' => '01.05.01.09',
                    'description' => 'Mejorar la calidad de la atención para mujeres embarazadas, recién nacidos, niñas, niños y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            253 =>
                array(
                    'id' => 254,
                    'parent_id' => 244,
                    'code' => '10',
                    'full_code' => '01.05.01.10',
                    'description' => 'Incorporar los perfiles epidemiológicos por ciclos de vida y los determinantes de las familias y comunidades en los modelos de atención y gestión',
                    'level' => 4,
                    'enabled' => 1,
                ),
            254 =>
                array(
                    'id' => 255,
                    'parent_id' => 244,
                    'code' => '11',
                    'full_code' => '01.05.01.11',
                    'description' => 'Mejorar los servicios integrales de salud sexual y reproductiva',
                    'level' => 4,
                    'enabled' => 1,
                ),
            255 =>
                array(
                    'id' => 256,
                    'parent_id' => 244,
                    'code' => '12',
                    'full_code' => '01.05.01.12',
                    'description' => 'Fomentar la educación y consejería sexual y reproductiva, basadas en enfoques científicos y enfoques de derechos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            256 =>
                array(
                    'id' => 257,
                    'parent_id' => 244,
                    'code' => '13',
                    'full_code' => '01.05.01.13',
                    'description' => 'Crear y sostener programas para el uso adecuado del tiempo libre de niños, niñas y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            257 =>
                array(
                    'id' => 258,
                    'parent_id' => 243,
                    'code' => '02',
                    'full_code' => '01.05.02',
                    'description' => 'Asegurar el desarrollo infantil y la educación integral, con calidad y calidez para todos los niños, niñas y adolescentes',
                    'level' => 3,
                    'enabled' => 1,
                ),
            258 =>
                array(
                    'id' => 259,
                    'parent_id' => 258,
                    'code' => '01',
                    'full_code' => '01.05.02.01',
                    'description' => 'Ampliar la cobertura de los programas de desarrollo infantil para niños y niñas menores a 3 años de edad en sus diversas modalidades, con enfoque de derechos, equidad de género e interculturalidad',
                    'level' => 4,
                    'enabled' => 1,
                ),
            259 =>
                array(
                    'id' => 260,
                    'parent_id' => 258,
                    'code' => '02',
                    'full_code' => '01.05.02.02',
                    'description' => 'Ampliar la cobertura de los programas de educación inicial para niños y niñas de 3 a 5 años de edad, con enfoque de derechos, equidad de género e interculturalidad',
                    'level' => 4,
                    'enabled' => 1,
                ),
            260 =>
                array(
                    'id' => 261,
                    'parent_id' => 258,
                    'code' => '03',
                    'full_code' => '01.05.02.03',
                    'description' => 'Fortalecer la calidad de los servicios educativos para niños, niñas y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            261 =>
                array(
                    'id' => 262,
                    'parent_id' => 258,
                    'code' => '04',
                    'full_code' => '01.05.02.04',
                    'description' => 'Dotar de infraestructura necesaria y segura a las unidades de atención de desarrollo infantil y establecimientos educativos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            262 =>
                array(
                    'id' => 263,
                    'parent_id' => 258,
                    'code' => '05',
                    'full_code' => '01.05.02.05',
                    'description' => 'Incorporar al sistema educativo a estudiantes de parroquias con altos índices de necesidades básicas insatisfechas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            263 =>
                array(
                    'id' => 264,
                    'parent_id' => 258,
                    'code' => '06',
                    'full_code' => '01.05.02.06',
                    'description' => 'Mejorar la cobertura y calidad de los servicios educativos para niños, niñas y adolescentes de los pueblos y nacionalidades, garantizando la permanencia y desarrollo de sus lenguas y culturas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            264 =>
                array(
                    'id' => 265,
                    'parent_id' => 258,
                    'code' => '07',
                    'full_code' => '01.05.02.07',
                    'description' => 'Reducir las barreras de ingreso y permanencia en el sistema educativo regular de niños, niñas y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            265 =>
                array(
                    'id' => 266,
                    'parent_id' => 258,
                    'code' => '08',
                    'full_code' => '01.05.02.08',
                    'description' => 'Reducir las barreras de acceso, reinserción y permanencia en el sistema educativo de niños, niñas y adolescentes que tengan algún grado de rezago escolar',
                    'level' => 4,
                    'enabled' => 1,
                ),
            266 =>
                array(
                    'id' => 267,
                    'parent_id' => 258,
                    'code' => '09',
                    'full_code' => '01.05.02.09',
                    'description' => 'Fortalecer y mejorar la atención en educación especial y la inclusión en el sistema regular de niñas, niños y adolescentes con necesidades educativas especiales asociadas o no a la discapacidad',
                    'level' => 4,
                    'enabled' => 1,
                ),
            267 =>
                array(
                    'id' => 268,
                    'parent_id' => 258,
                    'code' => '10',
                    'full_code' => '01.05.02.10',
                    'description' => 'Brindar a los niños, niñas y adolescentes una educación de calidad y calidez, construyendo ambientes que propendan a la innovación académica y psicopedagógica, fortaleciendo el trabajo de docentes y personal de las instituciones e incorporando los intereses de la sociedad civil y la comunidad',
                    'level' => 4,
                    'enabled' => 1,
                ),
            268 =>
                array(
                    'id' => 269,
                    'parent_id' => 258,
                    'code' => '11',
                    'full_code' => '01.05.02.11',
                    'description' => 'Fomentar el aprendizaje de las lenguas ancestrales oficiales del país',
                    'level' => 4,
                    'enabled' => 1,
                ),
            269 =>
                array(
                    'id' => 270,
                    'parent_id' => 258,
                    'code' => '12',
                    'full_code' => '01.05.02.12',
                    'description' => 'Mejorar la calidad de la enseñanza y aprendizaje del idioma inglés en el sistema educativo nacional',
                    'level' => 4,
                    'enabled' => 1,
                ),
            270 =>
                array(
                    'id' => 271,
                    'parent_id' => 258,
                    'code' => '13',
                    'full_code' => '01.05.02.13',
                    'description' => 'Incrementar el acceso y uso de las tecnologías de información y comunicación',
                    'level' => 4,
                    'enabled' => 1,
                ),
            271 =>
                array(
                    'id' => 272,
                    'parent_id' => 258,
                    'code' => '14',
                    'full_code' => '01.05.02.14',
                    'description' => 'Garantizar el derecho a la identidad y formas de expresión de niñas, niños y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            272 =>
                array(
                    'id' => 273,
                    'parent_id' => 258,
                    'code' => '15',
                    'full_code' => '01.05.02.15',
                    'description' => 'Fomentar mecanismos de identificación y registro de niñas, niños y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            273 =>
                array(
                    'id' => 274,
                    'parent_id' => 258,
                    'code' => '16',
                    'full_code' => '01.05.02.16',
                    'description' => 'Fortalecer los conocimientos en la comunidad educativa acerca de los enfoques del Buen Vivir y de derechos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            274 =>
                array(
                    'id' => 275,
                    'parent_id' => 258,
                    'code' => '17',
                    'full_code' => '01.05.02.17',
                    'description' => 'Incorporar los enfoques y fortalecer las capacidades para la gestión del riesgo de desastres',
                    'level' => 4,
                    'enabled' => 1,
                ),
            275 =>
                array(
                    'id' => 276,
                    'parent_id' => 258,
                    'code' => '18',
                    'full_code' => '01.05.02.18',
                    'description' => 'Vigilar que los niños y niñas que asisten al sistema educativo ecuatoriano sean respetados por los adultos, gocen de la confianza de los profesores, se tomen en cuenta sus opiniones y promueva su participación',
                    'level' => 4,
                    'enabled' => 1,
                ),
            276 =>
                array(
                    'id' => 277,
                    'parent_id' => 243,
                    'code' => '03',
                    'full_code' => '01.05.03',
                    'description' => 'Proteger integralmente a los niños, niñas y adolescentes que se encuentran en condición de vulnerabilidad y restituir sus derechos violentados',
                    'level' => 3,
                    'enabled' => 1,
                ),
            277 =>
                array(
                    'id' => 278,
                    'parent_id' => 277,
                    'code' => '01',
                    'full_code' => '01.05.03.01',
                    'description' => 'Articular y fortalecer los servicios integrales de atención a niñas, niños y adolescentes en situación de: maltrato, abuso y explotación sexual, explotación laboral y económica, tráfico y trata, privación de su medio familiar, mendicidad, movilidad humana, desaparición o discapacidad; adolescentes embarazadas, y enfermedades de transmisión sexual',
                    'level' => 4,
                    'enabled' => 1,
                ),
            278 =>
                array(
                    'id' => 279,
                    'parent_id' => 277,
                    'code' => '02',
                    'full_code' => '01.05.03.02',
                    'description' => 'Definir políticas y aplicar protocolos que mejoren los procesos de adopción de niños, niñas y adolescentes privados de su medio familiar',
                    'level' => 4,
                    'enabled' => 1,
                ),
            279 =>
                array(
                    'id' => 280,
                    'parent_id' => 277,
                    'code' => '03',
                    'full_code' => '01.05.03.03',
                    'description' => 'Erradicar toda forma de trabajo infantil, especialmente los trabajos prohibidos y peligrosos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            280 =>
                array(
                    'id' => 281,
                    'parent_id' => 277,
                    'code' => '04',
                    'full_code' => '01.05.03.04',
                    'description' => 'Erradicar progresivamente las situaciones de mendicidad',
                    'level' => 4,
                    'enabled' => 1,
                ),
            281 =>
                array(
                    'id' => 282,
                    'parent_id' => 277,
                    'code' => '05',
                    'full_code' => '01.05.03.05',
                    'description' => 'Implementar planes y programas sostenidos para combatir el consumo de alcohol, tabaco y drogas entre niños, niñas y adolescentes, y en su medio familiar',
                    'level' => 4,
                    'enabled' => 1,
                ),
            282 =>
                array(
                    'id' => 283,
                    'parent_id' => 277,
                    'code' => '06',
                    'full_code' => '01.05.03.06',
                    'description' => 'Implementar mecanismos de prevención, control y sanción de delitos informáticos contra niños, niñas y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            283 =>
                array(
                    'id' => 284,
                    'parent_id' => 277,
                    'code' => '07',
                    'full_code' => '01.05.03.07',
                    'description' => 'Generar políticas de prevención e información de salud sexual y reproductiva que involucren a niñas, niños y adolescentes, y a sus familias',
                    'level' => 4,
                    'enabled' => 1,
                ),
            284 =>
                array(
                    'id' => 285,
                    'parent_id' => 277,
                    'code' => '08',
                    'full_code' => '01.05.03.08',
                    'description' => 'Ampliar la cobertura y calidad de programas orientados a la prevención del embarazo adolescente y a la planificación familiar',
                    'level' => 4,
                    'enabled' => 1,
                ),
            285 =>
                array(
                    'id' => 286,
                    'parent_id' => 277,
                    'code' => '09',
                    'full_code' => '01.05.03.09',
                    'description' => 'Establecer y aplicar protocolos y estándares que garanticen la confidencialidad, la no revictimización, estigmatización y discriminación, conductas adultocéntricas a niños, niñas y adolescentes en los Centros de Apoyo Familiar',
                    'level' => 4,
                    'enabled' => 1,
                ),
            286 =>
                array(
                    'id' => 287,
                    'parent_id' => 243,
                    'code' => '04',
                    'full_code' => '01.05.04',
                    'description' => 'Garantizar la atención prioritaria a niños, niñas y adolescentes con énfasis en aquellos que se encuentren en situación de pobreza, crisis económica/social severa, doble vulnerabilidad, afectados por desastres, conflictos armados y otro tipo de emergencias',
                    'level' => 3,
                    'enabled' => 1,
                ),
            287 =>
                array(
                    'id' => 288,
                    'parent_id' => 287,
                    'code' => '01',
                    'full_code' => '01.05.04.01',
                    'description' => 'Ampliar el capital humano y evitar la persistencia de la pobreza mediante la entrega de compensaciones monetarias directas a las familias con niños, niñas y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            288 =>
                array(
                    'id' => 289,
                    'parent_id' => 287,
                    'code' => '02',
                    'full_code' => '01.05.04.02',
                    'description' => 'Brindar atención humanitaria y ayudas médicas con preferencia a niñas, niños y adolescentes, en eventos adversos, de manera individual o a colectivos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            289 =>
                array(
                    'id' => 290,
                    'parent_id' => 287,
                    'code' => '03',
                    'full_code' => '01.05.04.03',
                    'description' => 'Brindar atención a niños, niñas y adolescentes que padezcan enfermedades catastróficas y degenerativas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            290 =>
                array(
                    'id' => 291,
                    'parent_id' => 287,
                    'code' => '04',
                    'full_code' => '01.05.04.04',
                    'description' => 'Implementar planes de gestión de riesgo institucional, para su transversalización en la planificación y gestión de las instituciones públicas y privadas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            291 =>
                array(
                    'id' => 292,
                    'parent_id' => 287,
                    'code' => '05',
                    'full_code' => '01.05.04.05',
                    'description' => 'Implementar planes y programas para la prevención de accidentes por uso de juegos pirotécnicos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            292 =>
                array(
                    'id' => 293,
                    'parent_id' => 287,
                    'code' => '06',
                    'full_code' => '01.05.04.06',
                    'description' => 'Fortalecer las capacidades y la cultura de prevención y reducción de riesgos antrópicos y ante desastres en las comunidades educativas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            293 =>
                array(
                    'id' => 294,
                    'parent_id' => 243,
                    'code' => '05',
                    'full_code' => '01.05.05',
                    'description' => 'Incorporar a los niños, niñas y adolescentes como actores clave en el diseño e implementación de las políticas, programas y proyectos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            294 =>
                array(
                    'id' => 295,
                    'parent_id' => 294,
                    'code' => '01',
                    'full_code' => '01.05.05.01',
                    'description' => 'Fomentar una cultura de libre expresión, acceso a información y difusión del pensamiento de niñas, niños y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            295 =>
                array(
                    'id' => 296,
                    'parent_id' => 294,
                    'code' => '02',
                    'full_code' => '01.05.05.02',
                    'description' => 'Impulsar el derecho al voto facultativo entre los adolescentes de 16 a 18 años de edad',
                    'level' => 4,
                    'enabled' => 1,
                ),
            296 =>
                array(
                    'id' => 297,
                    'parent_id' => 294,
                    'code' => '03',
                    'full_code' => '01.05.05.03',
                    'description' => 'Generar mecanismos para impulsar la libertad de pensamiento, conciencia y religión de los niños, niñas y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            297 =>
                array(
                    'id' => 298,
                    'parent_id' => 294,
                    'code' => '04',
                    'full_code' => '01.05.05.04',
                    'description' => 'Impulsar y fortalecer la creación y funcionamiento de espacios de asociatividad de niños, niñas y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            298 =>
                array(
                    'id' => 299,
                    'parent_id' => 294,
                    'code' => '05',
                    'full_code' => '01.05.05.05',
                    'description' => 'Fomentar la participación de niñas, niños y adolescentes en la formulación de programas y proyectos de fortalecimiento de la corresponsabilidad y la exigibilidad de sus derechos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            299 =>
                array(
                    'id' => 300,
                    'parent_id' => 294,
                    'code' => '06',
                    'full_code' => '01.05.05.06',
                    'description' => 'Impulsar espacios seguros para la recreación y buen uso del tiempo libre de niños, niñas y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            300 =>
                array(
                    'id' => 301,
                    'parent_id' => 243,
                    'code' => '06',
                    'full_code' => '01.05.06',
                    'description' => 'Promover la corresponsabilidad del conjunto de la sociedad en el diseño, implementación y evaluación de las políticas públicas para la igualdad de niñas, niños y adolescentes',
                    'level' => 3,
                    'enabled' => 1,
                ),
            301 =>
                array(
                    'id' => 302,
                    'parent_id' => 301,
                    'code' => '01',
                    'full_code' => '01.05.06.01',
                    'description' => 'Promover y sostener espacios, mecanismos y formas de diálogo social sobre las políticas públicas de niñez y adolescencia en todos los niveles del Estado',
                    'level' => 4,
                    'enabled' => 1,
                ),
            302 =>
                array(
                    'id' => 303,
                    'parent_id' => 301,
                    'code' => '02',
                    'full_code' => '01.05.06.02',
                    'description' => 'Articular la acción colectiva de la sociedad civil organizada y del sector privado en torno a la garantía de derechos de las niñas, niños y adolescentes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            303 =>
                array(
                    'id' => 304,
                    'parent_id' => 243,
                    'code' => '07',
                    'full_code' => '01.05.07',
                    'description' => 'Generar investigación, análisis y difusión de la situación de la infancia, niñez y adolescencia',
                    'level' => 3,
                    'enabled' => 1,
                ),
            304 =>
                array(
                    'id' => 305,
                    'parent_id' => 304,
                    'code' => '01',
                    'full_code' => '01.05.07.01',
                    'description' => 'Impulsar la generación y difusión de investigaciones e información cuantitativa y cualitativa que expongan la situación de la infancia, niñez y adolescencia en el país',
                    'level' => 4,
                    'enabled' => 1,
                ),
            305 =>
                array(
                    'id' => 306,
                    'parent_id' => 243,
                    'code' => '08',
                    'full_code' => '01.05.08',
                    'description' => 'Promover, garantizar y desarrollar la institucionalidad y políticas públicas con equidad para niños, niñas y adolescentes',
                    'level' => 3,
                    'enabled' => 1,
                ),
            306 =>
                array(
                    'id' => 307,
                    'parent_id' => 306,
                    'code' => '01',
                    'full_code' => '01.05.08.01',
                    'description' => 'Actividades encaminadas a asegurar el enfoque en política, normativa, proyectos y presupuestos orientados a la inclusión plena',
                    'level' => 4,
                    'enabled' => 1,
                ),
            307 =>
                array(
                    'id' => 308,
                    'parent_id' => 243,
                    'code' => '09',
                    'full_code' => '01.05.09',
                    'description' => 'Promover e impulsar una justicia ágil y célere para niños, niñas y adolescentes en conflicto con la ley civil y penal',
                    'level' => 3,
                    'enabled' => 1,
                ),
            308 =>
                array(
                    'id' => 309,
                    'parent_id' => 308,
                    'code' => '01',
                    'full_code' => '01.05.09.01',
                    'description' => 'Generar programas de apoyo para derechohabientes de pensiones alimenticias',
                    'level' => 4,
                    'enabled' => 1,
                ),
            309 =>
                array(
                    'id' => 310,
                    'parent_id' => 308,
                    'code' => '02',
                    'full_code' => '01.05.09.02',
                    'description' => 'Generar programas para la implementación de medidas no privativas de libertad para adolescentes en conflicto con la Ley',
                    'level' => 4,
                    'enabled' => 1,
                ),
            310 =>
                array(
                    'id' => 311,
                    'parent_id' => 308,
                    'code' => '03',
                    'full_code' => '01.05.09.03',
                    'description' => 'Generar programas de atención integral en educación, salud y vínculos familiares para adolescentes privados de la libertad',
                    'level' => 4,
                    'enabled' => 1,
                ),
            311 =>
                array(
                    'id' => 312,
                    'parent_id' => 308,
                    'code' => '04',
                    'full_code' => '01.05.09.04',
                    'description' => 'Generar programas para hijos de personas privadas de la libertad y adolescentes en conflicto con la ley',
                    'level' => 4,
                    'enabled' => 1,
                ),
            312 =>
                array(
                    'id' => 313,
                    'parent_id' => 1,
                    'code' => '06',
                    'full_code' => '01.06',
                    'description' => 'GENERACIONAL JUVENTUD',
                    'level' => 2,
                    'enabled' => 1,
                ),
            313 =>
                array(
                    'id' => 314,
                    'parent_id' => 313,
                    'code' => '01',
                    'full_code' => '01.06.01',
                    'description' => 'Garantizar el acceso y fomentar la permanencia de las y los jóvenes en los diferentes niveles de educación hasta la culminación',
                    'level' => 3,
                    'enabled' => 1,
                ),
            314 =>
                array(
                    'id' => 315,
                    'parent_id' => 314,
                    'code' => '01',
                    'full_code' => '01.06.01.01',
                    'description' => 'Garantizar el acceso de las y los jóvenes al sistema educativo',
                    'level' => 4,
                    'enabled' => 1,
                ),
            315 =>
                array(
                    'id' => 316,
                    'parent_id' => 314,
                    'code' => '02',
                    'full_code' => '01.06.01.02',
                    'description' => 'Impulsar programas de becas completas o su equivalente en ayudas económicas, que garanticen la culminación de estudios primarios, secundarios y superiores',
                    'level' => 4,
                    'enabled' => 1,
                ),
            316 =>
                array(
                    'id' => 317,
                    'parent_id' => 314,
                    'code' => '03',
                    'full_code' => '01.06.01.03',
                    'description' => 'Fomentar la continuación de estudios de jóvenes bachilleres en el área técnica-tecnológica y/o superior',
                    'level' => 4,
                    'enabled' => 1,
                ),
            317 =>
                array(
                    'id' => 318,
                    'parent_id' => 314,
                    'code' => '04',
                    'full_code' => '01.06.01.04',
                    'description' => 'Ampliar y fomentar modalidades alternativas de educación de calidad, democrática e incluyente, respetando los diferentes ritmos de aprendizaje y la diversidad cultural',
                    'level' => 4,
                    'enabled' => 1,
                ),
            318 =>
                array(
                    'id' => 319,
                    'parent_id' => 314,
                    'code' => '05',
                    'full_code' => '01.06.01.05',
                    'description' => 'Promover procesos de promoción y control ciudadano e institucional para  garantizar la gratuidad y calidad de la educación pública y privada',
                    'level' => 4,
                    'enabled' => 1,
                ),
            319 =>
                array(
                    'id' => 320,
                    'parent_id' => 314,
                    'code' => '06',
                    'full_code' => '01.06.01.06',
                    'description' => 'Ampliar y diversificar la oferta de carreras',
                    'level' => 4,
                    'enabled' => 1,
                ),
            320 =>
                array(
                    'id' => 321,
                    'parent_id' => 314,
                    'code' => '07',
                    'full_code' => '01.06.01.07',
                    'description' => 'Incrementar el acceso y uso de las tecnologías de información y comunicación',
                    'level' => 4,
                    'enabled' => 1,
                ),
            321 =>
                array(
                    'id' => 322,
                    'parent_id' => 313,
                    'code' => '02',
                    'full_code' => '01.06.02',
                    'description' => 'Garantizar a las y los jóvenes el acceso al trabajo estable, justo y digno, así como a la capacitación, fomentando prioritariamente los emprendimientos de Economía Popular y Solidaria (EPS)',
                    'level' => 3,
                    'enabled' => 1,
                ),
            322 =>
                array(
                    'id' => 323,
                    'parent_id' => 322,
                    'code' => '01',
                    'full_code' => '01.06.02.01',
                    'description' => 'Garantizar las condiciones adecuadas para proteger a las y los jóvenes del trabajo precario y cualquier forma de explotación y discriminación laboral con énfasis en jóvenes con discapacidad',
                    'level' => 4,
                    'enabled' => 1,
                ),
            323 =>
                array(
                    'id' => 324,
                    'parent_id' => 322,
                    'code' => '02',
                    'full_code' => '01.06.02.02',
                    'description' => 'Implementar y desarrollar programas de capacitación, formación e inserción laboral; con énfasis en grupos de atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            324 =>
                array(
                    'id' => 325,
                    'parent_id' => 322,
                    'code' => '03',
                    'full_code' => '01.06.02.03',
                    'description' => 'Fomentar alianzas y estrategias público-privadas que promuevan la inserción laboral de los y las jóvenes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            325 =>
                array(
                    'id' => 326,
                    'parent_id' => 322,
                    'code' => '04',
                    'full_code' => '01.06.02.04',
                    'description' => 'Contar con jóvenes profesionales para un servicio de excelencia en todos los niveles del sector público',
                    'level' => 4,
                    'enabled' => 1,
                ),
            326 =>
                array(
                    'id' => 327,
                    'parent_id' => 322,
                    'code' => '05',
                    'full_code' => '01.06.02.05',
                    'description' => 'Impulsar y apoyar iniciativas de emprendimientos juveniles',
                    'level' => 4,
                    'enabled' => 1,
                ),
            327 =>
                array(
                    'id' => 328,
                    'parent_id' => 322,
                    'code' => '06',
                    'full_code' => '01.06.02.06',
                    'description' => 'Garantizar la transparencia en el proceso de selección y la estabilidad laboral de las y los jóvenes incorporados al servicio público',
                    'level' => 4,
                    'enabled' => 1,
                ),
            328 =>
                array(
                    'id' => 329,
                    'parent_id' => 313,
                    'code' => '03',
                    'full_code' => '01.06.03',
                    'description' => 'Impulsar la salud integral de las y los jóvenes, así como la atención oportuna en servicios de salud con calidad, calidez y sin discriminación',
                    'level' => 3,
                    'enabled' => 1,
                ),
            329 =>
                array(
                    'id' => 330,
                    'parent_id' => 329,
                    'code' => '01',
                    'full_code' => '01.06.03.01',
                    'description' => 'Fortalecer las acciones de promoción de la salud pública de la población juvenil y promover políticas, espacios y prácticas saludables',
                    'level' => 4,
                    'enabled' => 1,
                ),
            330 =>
                array(
                    'id' => 331,
                    'parent_id' => 329,
                    'code' => '02',
                    'full_code' => '01.06.03.02',
                    'description' => 'Fortalecer acciones y servicios de calidad que garanticen el derecho a una salud sexual y reproductiva no discriminatoria, libre de violencia y que respete la diversidad y las especificidades del territorio (urbano/rural)',
                    'level' => 4,
                    'enabled' => 1,
                ),
            331 =>
                array(
                    'id' => 332,
                    'parent_id' => 329,
                    'code' => '03',
                    'full_code' => '01.06.03.03',
                    'description' => 'Generar programas de información, prevención y rehabilitación de diferentes tipos de trastornos, que respeten los derechos de las jóvenes y los jóvenes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            332 =>
                array(
                    'id' => 333,
                    'parent_id' => 313,
                    'code' => '04',
                    'full_code' => '01.06.04',
                    'description' => 'Facilitar el acceso a la vivienda y hábitat dignos, seguros y saludables para las y los jóvenes',
                    'level' => 3,
                    'enabled' => 1,
                ),
            333 =>
                array(
                    'id' => 334,
                    'parent_id' => 333,
                    'code' => '01',
                    'full_code' => '01.06.04.01',
                    'description' => 'Desarrollar programas de vivienda de calidad para jóvenes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            334 =>
                array(
                    'id' => 335,
                    'parent_id' => 333,
                    'code' => '02',
                    'full_code' => '01.06.04.02',
                    'description' => 'Estructurar programas de crédito y facilitar el acceso a proyectos de vivienda para población joven con familia',
                    'level' => 4,
                    'enabled' => 1,
                ),
            335 =>
                array(
                    'id' => 336,
                    'parent_id' => 313,
                    'code' => '05',
                    'full_code' => '01.06.05',
                    'description' => 'Generar espacios públicos para la revitalización, promoción y difusión de las diversas expresiones culturales y de recreación, donde se valoren las distintas identidades juveniles',
                    'level' => 3,
                    'enabled' => 1,
                ),
            336 =>
                array(
                    'id' => 337,
                    'parent_id' => 336,
                    'code' => '01',
                    'full_code' => '01.06.05.01',
                    'description' => 'Promover iniciativas y expresiones culturales diversas, propuestas por las diferentes nacionalidades, pueblos, culturas, organizaciones, colectivos, grupos y asociaciones juveniles del área rural y urbana',
                    'level' => 4,
                    'enabled' => 1,
                ),
            337 =>
                array(
                    'id' => 338,
                    'parent_id' => 336,
                    'code' => '02',
                    'full_code' => '01.06.05.02',
                    'description' => 'Crear, incentivar y visibilizar espacios de encuentro, de comunicación y ocio para la consolidación, liberación, promoción y protección de las diferentes identidades juveniles, manifestaciones y prácticas culturales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            338 =>
                array(
                    'id' => 339,
                    'parent_id' => 313,
                    'code' => '06',
                    'full_code' => '01.06.06',
                    'description' => 'Facilitar el acceso de las y los jóvenes a la Información y a las Tecnologías de Información y Comunicación – TIC',
                    'level' => 3,
                    'enabled' => 1,
                ),
            339 =>
                array(
                    'id' => 340,
                    'parent_id' => 339,
                    'code' => '01',
                    'full_code' => '01.06.06.01',
                    'description' => 'Implementar y fortalecer espacios de acceso a las tecnologías de información y comunicación - TIC',
                    'level' => 4,
                    'enabled' => 1,
                ),
            340 =>
                array(
                    'id' => 341,
                    'parent_id' => 339,
                    'code' => '02',
                    'full_code' => '01.06.06.02',
                    'description' => 'Impulsar la generación y difusión de investigaciones e información cuantitativa y cualitativa que expongan la situación de la juventud en el país',
                    'level' => 4,
                    'enabled' => 1,
                ),
            341 =>
                array(
                    'id' => 342,
                    'parent_id' => 313,
                    'code' => '07',
                    'full_code' => '01.06.07',
                    'description' => 'Garantizar la inclusión social y los derechos de todos/as las y los jóvenes, y contribuir con la erradicación de la discriminación, xenofobia, violencia explotación sexual, mendicidad y trata',
                    'level' => 3,
                    'enabled' => 1,
                ),
            342 =>
                array(
                    'id' => 343,
                    'parent_id' => 342,
                    'code' => '01',
                    'full_code' => '01.06.07.01',
                    'description' => 'Implementar programas de capacitación y formación en derechos humanos para las y los jóvenes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            343 =>
                array(
                    'id' => 344,
                    'parent_id' => 342,
                    'code' => '02',
                    'full_code' => '01.06.07.02',
                    'description' => 'Garantizar la seguridad de las y los jóvenes en los espacios públicos y privados',
                    'level' => 4,
                    'enabled' => 1,
                ),
            344 =>
                array(
                    'id' => 345,
                    'parent_id' => 342,
                    'code' => '03',
                    'full_code' => '01.06.07.03',
                    'description' => 'Mejoramiento de la calidad y cobertura de la atención y prevención frente a la violencia de género e intrafamiliar',
                    'level' => 4,
                    'enabled' => 1,
                ),
            345 =>
                array(
                    'id' => 346,
                    'parent_id' => 342,
                    'code' => '04',
                    'full_code' => '01.06.07.04',
                    'description' => 'Implementar programas de prevención y capacitación sobre la trata de personas y mendicidad para las y los jóvenes',
                    'level' => 4,
                    'enabled' => 1,
                ),
            346 =>
                array(
                    'id' => 347,
                    'parent_id' => 313,
                    'code' => '08',
                    'full_code' => '01.06.08',
                    'description' => 'Impulsar y fortalecer el pleno ejercicio del derecho a la participación y la representación política y pública de las y los jóvenes',
                    'level' => 3,
                    'enabled' => 1,
                ),
            347 =>
                array(
                    'id' => 348,
                    'parent_id' => 347,
                    'code' => '01',
                    'full_code' => '01.06.08.01',
                    'description' => 'Incentivar y fortalecer la organización, asociatividad juvenil en zonas rurales, urbanas y de las nacionalidades y pueblos del Ecuador',
                    'level' => 4,
                    'enabled' => 1,
                ),
            348 =>
                array(
                    'id' => 349,
                    'parent_id' => 347,
                    'code' => '02',
                    'full_code' => '01.06.08.02',
                    'description' => 'Fomentar la cohesión e intercambio social generacional',
                    'level' => 4,
                    'enabled' => 1,
                ),
            349 =>
                array(
                    'id' => 350,
                    'parent_id' => 313,
                    'code' => '09',
                    'full_code' => '01.06.09',
                    'description' => 'Orientar la participación de las y los jóvenes en espacios de decisión como actores estratégicos de desarrollo del país',
                    'level' => 3,
                    'enabled' => 1,
                ),
            350 =>
                array(
                    'id' => 351,
                    'parent_id' => 350,
                    'code' => '01',
                    'full_code' => '01.06.09.01',
                    'description' => 'Propiciar la inclusión de las y los jóvenes como constructores de una sociedad con principios de igualdad, justicia, equidad, interculturalidad, paz y respeto a los derechos humanos y de la naturaleza',
                    'level' => 4,
                    'enabled' => 1,
                ),
            351 =>
                array(
                    'id' => 352,
                    'parent_id' => 350,
                    'code' => '02',
                    'full_code' => '01.06.09.02',
                    'description' => 'Generar y fortalecer la participación política, de los y las jóvenes en la toma de decisiones y formulación de políticas públicas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            352 =>
                array(
                    'id' => 353,
                    'parent_id' => 313,
                    'code' => '10',
                    'full_code' => '01.06.10',
                    'description' => 'Generar investigación, análisis y difusión de la situación de la juventud',
                    'level' => 3,
                    'enabled' => 1,
                ),
            353 =>
                array(
                    'id' => 354,
                    'parent_id' => 353,
                    'code' => '01',
                    'full_code' => '01.06.10.01',
                    'description' => 'Impulsar la generación y difusión de investigaciones e información cuantitativa y cualitativa que expongan la situación de la juventud en el país',
                    'level' => 4,
                    'enabled' => 1,
                ),
            354 =>
                array(
                    'id' => 355,
                    'parent_id' => 313,
                    'code' => '11',
                    'full_code' => '01.06.11',
                    'description' => 'Promover, garantizar y desarrollar la institucionalidad y políticas públicas con equidad para jóvenes',
                    'level' => 3,
                    'enabled' => 1,
                ),
            355 =>
                array(
                    'id' => 356,
                    'parent_id' => 355,
                    'code' => '01',
                    'full_code' => '01.06.11.01',
                    'description' => 'Actividades encaminadas a asegurar el enfoque en política, normativa, proyectos y presupuestos orientados a la inclusión plena',
                    'level' => 4,
                    'enabled' => 1,
                ),
            356 =>
                array(
                    'id' => 357,
                    'parent_id' => 1,
                    'code' => '07',
                    'full_code' => '01.07',
                    'description' => 'GENERACIONAL - ADULTOS MAYORES',
                    'level' => 2,
                    'enabled' => 1,
                ),
            357 =>
                array(
                    'id' => 358,
                    'parent_id' => 357,
                    'code' => '01',
                    'full_code' => '01.07.01',
                    'description' => 'Asegurar a las personas adultas mayores el acceso a servicios de salud integral, oportuna y de calidad',
                    'level' => 3,
                    'enabled' => 1,
                ),
            358 =>
                array(
                    'id' => 359,
                    'parent_id' => 358,
                    'code' => '01',
                    'full_code' => '01.07.01.01',
                    'description' => 'Articular y fortalecer la atención y prevención de personas adultas mayores que presentan: enfermedades crónicas, catastróficas y degenerativas, discapacidad malnutrición y deficiencias nutricionales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            359 =>
                array(
                    'id' => 360,
                    'parent_id' => 358,
                    'code' => '02',
                    'full_code' => '01.07.01.02',
                    'description' => 'Articular y fortalecer la atención de personas adultas mayores que requieren: poli medicación, inmunización, acceso a medicamentos, atención extramural, rehabilitación',
                    'level' => 4,
                    'enabled' => 1,
                ),
            360 =>
                array(
                    'id' => 361,
                    'parent_id' => 358,
                    'code' => '03',
                    'full_code' => '01.07.01.03',
                    'description' => 'Formación de recursos humanos especializados y capacitados en geriatría y gerontología',
                    'level' => 4,
                    'enabled' => 1,
                ),
            361 =>
                array(
                    'id' => 362,
                    'parent_id' => 357,
                    'code' => '02',
                    'full_code' => '01.07.02',
                    'description' => 'Promover una educación continua, reaprendizaje y aprendizajes permanentes de las personas adultas mayores',
                    'level' => 3,
                    'enabled' => 1,
                ),
            362 =>
                array(
                    'id' => 363,
                    'parent_id' => 362,
                    'code' => '01',
                    'full_code' => '01.07.02.01',
                    'description' => 'Fortalecer la alfabetización y capacitación funcional',
                    'level' => 4,
                    'enabled' => 1,
                ),
            363 =>
                array(
                    'id' => 364,
                    'parent_id' => 362,
                    'code' => '02',
                    'full_code' => '01.07.02.02',
                    'description' => 'Implementar y fortalecer espacios de acceso a las tecnologías de información y comunicación - TIC',
                    'level' => 4,
                    'enabled' => 1,
                ),
            364 =>
                array(
                    'id' => 365,
                    'parent_id' => 357,
                    'code' => '03',
                    'full_code' => '01.07.03',
                    'description' => 'Asegurar el acceso de las personas adultas mayores al medio físico, vivienda digna y segura, transporte y servicios básicos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            365 =>
                array(
                    'id' => 366,
                    'parent_id' => 365,
                    'code' => '01',
                    'full_code' => '01.07.03.01',
                    'description' => 'Estándares de construcción adecuación de viviendas dirigidas a personas adultas mayores que prevean sus limitaciones',
                    'level' => 4,
                    'enabled' => 1,
                ),
            366 =>
                array(
                    'id' => 367,
                    'parent_id' => 365,
                    'code' => '02',
                    'full_code' => '01.07.03.02',
                    'description' => 'Generar espacios accesibles seguros e incluyentes para las personas adultas mayores',
                    'level' => 4,
                    'enabled' => 1,
                ),
            367 =>
                array(
                    'id' => 368,
                    'parent_id' => 357,
                    'code' => '04',
                    'full_code' => '01.07.04',
                    'description' => 'Fomentar la inclusión económica a través del acceso a actividades que generen ingreso a las personas adultas mayores',
                    'level' => 3,
                    'enabled' => 1,
                ),
            368 =>
                array(
                    'id' => 369,
                    'parent_id' => 368,
                    'code' => '01',
                    'full_code' => '01.07.04.01',
                    'description' => 'Brindar oportunidades de trabajo con horarios flexibles en entidades públicas y privadas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            369 =>
                array(
                    'id' => 370,
                    'parent_id' => 368,
                    'code' => '02',
                    'full_code' => '01.07.04.02',
                    'description' => 'Apoyar las iniciativas de emprendimiento para las personas adultas mayores',
                    'level' => 4,
                    'enabled' => 1,
                ),
            370 =>
                array(
                    'id' => 371,
                    'parent_id' => 357,
                    'code' => '05',
                    'full_code' => '01.07.05',
                    'description' => 'Promover prácticas de cuidado a las personas adultas mayores bajo parámetros de calidad y calidez',
                    'level' => 3,
                    'enabled' => 1,
                ),
            371 =>
                array(
                    'id' => 372,
                    'parent_id' => 371,
                    'code' => '01',
                    'full_code' => '01.07.05.01',
                    'description' => 'Fortalecer los modelos de atención y gestión de los centros de cuidado a las personas adultas mayores (salud, rehabilitación, nutrición, ocupación del tiempo libre, educación y cuidado diario)',
                    'level' => 4,
                    'enabled' => 1,
                ),
            372 =>
                array(
                    'id' => 373,
                    'parent_id' => 371,
                    'code' => '02',
                    'full_code' => '01.07.05.02',
                    'description' => 'Fomentar y fortalecer el cuidado a las personas adultas mayores desde la corresponsabilidad familiar y comunitaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            373 =>
                array(
                    'id' => 374,
                    'parent_id' => 357,
                    'code' => '06',
                    'full_code' => '01.07.06',
                    'description' => 'Garantizar la universalización del derecho a la seguridad social de las personas adultas mayores',
                    'level' => 3,
                    'enabled' => 1,
                ),
            374 =>
                array(
                    'id' => 375,
                    'parent_id' => 374,
                    'code' => '01',
                    'full_code' => '01.07.06.01',
                    'description' => 'Asegurar mecanismos de sostenibilidad de las pensiones contributivas y no contributivas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            375 =>
                array(
                    'id' => 376,
                    'parent_id' => 357,
                    'code' => '07',
                    'full_code' => '01.07.07',
                    'description' => 'Prevenir la explotación, violencia, mendicidad, trata o abandono a personas adultas mayores y garantizar la protección y atención a quienes hayan sido víctimas de estas prácticas',
                    'level' => 3,
                    'enabled' => 1,
                ),
            376 =>
                array(
                    'id' => 377,
                    'parent_id' => 376,
                    'code' => '01',
                    'full_code' => '01.07.07.01',
                    'description' => 'Socializar los derechos de las personas adultas mayores',
                    'level' => 4,
                    'enabled' => 1,
                ),
            377 =>
                array(
                    'id' => 378,
                    'parent_id' => 376,
                    'code' => '02',
                    'full_code' => '01.07.07.02',
                    'description' => 'Priorizar la entrega del bono de vivienda para personas adultas mayores, especialmente en condiciones de pobreza y extrema pobreza',
                    'level' => 4,
                    'enabled' => 1,
                ),
            378 =>
                array(
                    'id' => 379,
                    'parent_id' => 376,
                    'code' => '03',
                    'full_code' => '01.07.07.03',
                    'description' => 'Establecer procesos para la atención adecuada a las personas adultas mayores víctimas de violencia y trata',
                    'level' => 4,
                    'enabled' => 1,
                ),
            379 =>
                array(
                    'id' => 380,
                    'parent_id' => 376,
                    'code' => '04',
                    'full_code' => '01.07.07.04',
                    'description' => 'Fortalecer los mecanismos de sanción a quienes incurran en prácticas de violencia y trata contra las personas adultas mayores',
                    'level' => 4,
                    'enabled' => 1,
                ),
            380 =>
                array(
                    'id' => 381,
                    'parent_id' => 376,
                    'code' => '05',
                    'full_code' => '01.07.07.05',
                    'description' => 'Fortalecer los mecanismos para referir a personas adultas mayores para centros de acogida',
                    'level' => 4,
                    'enabled' => 1,
                ),
            381 =>
                array(
                    'id' => 382,
                    'parent_id' => 357,
                    'code' => '08',
                    'full_code' => '01.07.08',
                    'description' => 'Promover la participación de las personas adultas mayores como actores del desarrollo',
                    'level' => 3,
                    'enabled' => 1,
                ),
            382 =>
                array(
                    'id' => 383,
                    'parent_id' => 382,
                    'code' => '01',
                    'full_code' => '01.07.08.01',
                    'description' => 'Generar y fortalecer espacios de participación y control social para las personas adultas mayores en los procesos de toma de decisión y planeación para el desarrollo',
                    'level' => 4,
                    'enabled' => 1,
                ),
            383 =>
                array(
                    'id' => 384,
                    'parent_id' => 382,
                    'code' => '02',
                    'full_code' => '01.07.08.02',
                    'description' => 'Fortalecer las organizaciones de personas adultas mayores',
                    'level' => 4,
                    'enabled' => 1,
                ),
            384 =>
                array(
                    'id' => 385,
                    'parent_id' => 357,
                    'code' => '09',
                    'full_code' => '01.07.09',
                    'description' => 'Generar investigación, análisis y difusión de la situación de personas adultas mayores',
                    'level' => 3,
                    'enabled' => 1,
                ),
            385 =>
                array(
                    'id' => 386,
                    'parent_id' => 385,
                    'code' => '01',
                    'full_code' => '01.07.09.01',
                    'description' => 'Impulsar la generación y difusión de investigaciones e información cuantitativa y cualitativa que expongan la situación del grupo generacional en el país',
                    'level' => 4,
                    'enabled' => 1,
                ),
            386 =>
                array(
                    'id' => 387,
                    'parent_id' => 357,
                    'code' => '10',
                    'full_code' => '01.07.10',
                    'description' => 'Promover, garantizar y desarrollar la institucionalidad y políticas públicas con equidad para adultos mayores',
                    'level' => 3,
                    'enabled' => 1,
                ),
            387 =>
                array(
                    'id' => 388,
                    'parent_id' => 387,
                    'code' => '01',
                    'full_code' => '01.07.10.01',
                    'description' => 'Actividades encaminadas a asegurar el enfoque en política, normativa, proyectos y presupuestos orientados a la inclusión plena',
                    'level' => 4,
                    'enabled' => 1,
                ),
            388 =>
                array(
                    'id' => 389,
                    'parent_id' => null,
                    'code' => '02',
                    'full_code' => '02',
                    'description' => 'POLÍTICAS DE AMBIENTE',
                    'level' => 1,
                    'enabled' => 1,
                ),
            389 =>
                array(
                    'id' => 390,
                    'parent_id' => 389,
                    'code' => '01',
                    'full_code' => '02.01',
                    'description' => 'PROTEGER EL AIRE, EL CLIMA Y LA CAPA DE OZONO, INCLUYENDO LA IMPLEMENTACIÓN DE MEDIDAS DE MITIGACIÓN Y ADAPTACIÓN AL CAMBIO CLIMÁTICO',
                    'level' => 2,
                    'enabled' => 1,
                ),
            390 =>
                array(
                    'id' => 391,
                    'parent_id' => 390,
                    'code' => '01',
                    'full_code' => '02.01.01',
                    'description' => 'Prevenir la contaminación atmosférica por modificación de procesos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            391 =>
                array(
                    'id' => 392,
                    'parent_id' => 391,
                    'code' => '01',
                    'full_code' => '02.01.01.01',
                    'description' => 'Prevenir la contaminación atmosférica por modificación de procesos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            392 =>
                array(
                    'id' => 393,
                    'parent_id' => 390,
                    'code' => '02',
                    'full_code' => '02.01.02',
                    'description' => 'Tratar la contaminación atmosférica por gases de escape y aire de ventilación',
                    'level' => 3,
                    'enabled' => 1,
                ),
            393 =>
                array(
                    'id' => 394,
                    'parent_id' => 393,
                    'code' => '01',
                    'full_code' => '02.01.02.01',
                    'description' => 'Tratar la contaminación atmosférica por gases de escape y aire de ventilación',
                    'level' => 4,
                    'enabled' => 1,
                ),
            394 =>
                array(
                    'id' => 395,
                    'parent_id' => 390,
                    'code' => '03',
                    'full_code' => '02.01.03',
                    'description' => 'Implementar medidas de mitigación y adaptación al cambio climático',
                    'level' => 3,
                    'enabled' => 1,
                ),
            395 =>
                array(
                    'id' => 396,
                    'parent_id' => 395,
                    'code' => '01',
                    'full_code' => '02.01.03.01',
                    'description' => 'Implementar medidas de mitigación y adaptación al cambio climático',
                    'level' => 4,
                    'enabled' => 1,
                ),
            396 =>
                array(
                    'id' => 397,
                    'parent_id' => 390,
                    'code' => '04',
                    'full_code' => '02.01.04',
                    'description' => 'Controlar, contabilizar, inventariar: gases de efecto invernadero, variables climáticas, contaminación del aire y capa de ozono, registrando sus variaciones,  entre otros',
                    'level' => 3,
                    'enabled' => 1,
                ),
            397 =>
                array(
                    'id' => 398,
                    'parent_id' => 397,
                    'code' => '01',
                    'full_code' => '02.01.04.01',
                    'description' => 'Controlar, contabilizar, inventariar: gases de efecto invernadero, variables climáticas, contaminación del aire y capa de ozono, registrando sus variaciones,  entre otros',
                    'level' => 4,
                    'enabled' => 1,
                ),
            398 =>
                array(
                    'id' => 399,
                    'parent_id' => 389,
                    'code' => '02',
                    'full_code' => '02.02',
                    'description' => 'PREVENIR, CONTROLAR Y MITIGAR LA CONTAMINACIÓN DE SUELOS, AGUAS SUBTERRÁNEAS Y SUPERFICIALES',
                    'level' => 2,
                    'enabled' => 1,
                ),
            399 =>
                array(
                    'id' => 400,
                    'parent_id' => 399,
                    'code' => '01',
                    'full_code' => '02.02.01',
                    'description' => 'Prevenir la contaminación de suelos, aguas subterráneas y superficiales',
                    'level' => 3,
                    'enabled' => 1,
                ),
            400 =>
                array(
                    'id' => 401,
                    'parent_id' => 400,
                    'code' => '01',
                    'full_code' => '02.02.01.01',
                    'description' => 'Prevenir la contaminación de suelos, aguas subterráneas y superficiales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            401 =>
                array(
                    'id' => 402,
                    'parent_id' => 399,
                    'code' => '02',
                    'full_code' => '02.02.02',
                    'description' => 'Mitigar la contaminación de los suelos, aguas subterráneas y superficiales implementando técnicas de limpieza y remediación de suelos  así como tratamiento de  aguas',
                    'level' => 3,
                    'enabled' => 1,
                ),
            402 =>
                array(
                    'id' => 403,
                    'parent_id' => 402,
                    'code' => '01',
                    'full_code' => '02.02.02.01',
                    'description' => 'Mitigar la contaminación de los suelos, aguas subterráneas y superficiales implementando técnicas de limpieza y remediación de suelos  así como tratamiento de  aguas',
                    'level' => 4,
                    'enabled' => 1,
                ),
            403 =>
                array(
                    'id' => 404,
                    'parent_id' => 399,
                    'code' => '03',
                    'full_code' => '02.02.03',
                    'description' => 'Proteger los suelos contra la erosión y otros tipos de degradación física',
                    'level' => 3,
                    'enabled' => 1,
                ),
            404 =>
                array(
                    'id' => 405,
                    'parent_id' => 404,
                    'code' => '01',
                    'full_code' => '02.02.03.01',
                    'description' => 'Proteger los suelos contra la erosión y otros tipos de degradación física',
                    'level' => 4,
                    'enabled' => 1,
                ),
            405 =>
                array(
                    'id' => 406,
                    'parent_id' => 399,
                    'code' => '04',
                    'full_code' => '02.02.04',
                    'description' => 'Prevenir la salinización del suelo y su contaminación',
                    'level' => 3,
                    'enabled' => 1,
                ),
            406 =>
                array(
                    'id' => 407,
                    'parent_id' => 406,
                    'code' => '01',
                    'full_code' => '02.02.04.01',
                    'description' => 'Prevenir la salinización del suelo y su contaminación',
                    'level' => 4,
                    'enabled' => 1,
                ),
            407 =>
                array(
                    'id' => 408,
                    'parent_id' => 399,
                    'code' => '05',
                    'full_code' => '02.02.05',
                    'description' => 'Controlar y medir la contaminación de los suelos, aguas subterráneas y aguas superficiales',
                    'level' => 3,
                    'enabled' => 1,
                ),
            408 =>
                array(
                    'id' => 409,
                    'parent_id' => 408,
                    'code' => '01',
                    'full_code' => '02.02.05.01',
                    'description' => 'Controlar y medir la contaminación de los suelos, aguas subterráneas y aguas superficiales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            409 =>
                array(
                    'id' => 410,
                    'parent_id' => 389,
                    'code' => '03',
                    'full_code' => '02.03',
                    'description' => 'GESTIONAR LAS AGUAS RESIDUALES PARA LA PREVENCIÓN, CONTROL Y MITIGACIÓN DE LA CONTAMINACIÓN AMBIENTAL',
                    'level' => 2,
                    'enabled' => 1,
                ),
            410 =>
                array(
                    'id' => 411,
                    'parent_id' => 410,
                    'code' => '01',
                    'full_code' => '02.03.01',
                    'description' => 'Prevenir la contaminación por aguas residuales a través de modificación de procesos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            411 =>
                array(
                    'id' => 412,
                    'parent_id' => 411,
                    'code' => '01',
                    'full_code' => '02.03.01.01',
                    'description' => 'Prevenir la contaminación por aguas residuales a través de modificación de procesos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            412 =>
                array(
                    'id' => 413,
                    'parent_id' => 410,
                    'code' => '02',
                    'full_code' => '02.03.02',
                    'description' => 'Prevenir contaminación por aguas residuales a través de la operación de redes de saneamiento',
                    'level' => 3,
                    'enabled' => 1,
                ),
            413 =>
                array(
                    'id' => 414,
                    'parent_id' => 413,
                    'code' => '01',
                    'full_code' => '02.03.02.01',
                    'description' => 'Prevenir contaminación por aguas residuales a través de la operación de redes de saneamiento',
                    'level' => 4,
                    'enabled' => 1,
                ),
            414 =>
                array(
                    'id' => 415,
                    'parent_id' => 410,
                    'code' => '03',
                    'full_code' => '02.03.03',
                    'description' => 'Mitigar la contaminación ambiental tratando las aguas residuales',
                    'level' => 3,
                    'enabled' => 1,
                ),
            415 =>
                array(
                    'id' => 416,
                    'parent_id' => 415,
                    'code' => '01',
                    'full_code' => '02.03.03.01',
                    'description' => 'Mitigar la contaminación ambiental tratando las aguas residuales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            416 =>
                array(
                    'id' => 417,
                    'parent_id' => 410,
                    'code' => '04',
                    'full_code' => '02.03.04',
                    'description' => 'Mitigar la contaminación ambiental tratando las aguas de refrigeración',
                    'level' => 3,
                    'enabled' => 1,
                ),
            417 =>
                array(
                    'id' => 418,
                    'parent_id' => 417,
                    'code' => '01',
                    'full_code' => '02.03.04.01',
                    'description' => 'Mitigar la contaminación ambiental tratando las aguas de refrigeración',
                    'level' => 4,
                    'enabled' => 1,
                ),
            418 =>
                array(
                    'id' => 419,
                    'parent_id' => 410,
                    'code' => '05',
                    'full_code' => '02.03.05',
                    'description' => 'Controlar y medir la contaminación por aguas residuales',
                    'level' => 3,
                    'enabled' => 1,
                ),
            419 =>
                array(
                    'id' => 420,
                    'parent_id' => 419,
                    'code' => '01',
                    'full_code' => '02.03.05.01',
                    'description' => 'Controlar y medir la contaminación por aguas residuales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            420 =>
                array(
                    'id' => 421,
                    'parent_id' => 389,
                    'code' => '04',
                    'full_code' => '02.04',
                    'description' => 'PREVENIR, CONTROLAR Y MITIGAR LA CONTAMINACIÓN POR SUSTANCIAS QUÍMICAS Y RESIDUOS/DESECHOS PELIGROSOS, NO PELIGROSOS Y ESPECIALES',
                    'level' => 2,
                    'enabled' => 1,
                ),
            421 =>
                array(
                    'id' => 422,
                    'parent_id' => 421,
                    'code' => '01',
                    'full_code' => '02.04.01',
                    'description' => 'Prevenir la generación de residuos/desechos  peligrosos, no peligrosos  y especiales por modificación de procesos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            422 =>
                array(
                    'id' => 423,
                    'parent_id' => 422,
                    'code' => '01',
                    'full_code' => '02.04.01.01',
                    'description' => 'Prevenir la generación de residuos/desechos  peligrosos, no peligrosos  y especiales por modificación de procesos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            423 =>
                array(
                    'id' => 424,
                    'parent_id' => 421,
                    'code' => '02',
                    'full_code' => '02.04.02',
                    'description' => 'Prevenir la contaminación ambiental recolectando y transportando residuos/desechos peligrosos , no peligrosos y especiales',
                    'level' => 3,
                    'enabled' => 1,
                ),
            424 =>
                array(
                    'id' => 425,
                    'parent_id' => 424,
                    'code' => '01',
                    'full_code' => '02.04.02.01',
                    'description' => 'Prevenir la contaminación ambiental recolectando y transportando residuos/desechos peligrosos , no peligrosos y especiales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            425 =>
                array(
                    'id' => 426,
                    'parent_id' => 421,
                    'code' => '03',
                    'full_code' => '02.04.03',
                    'description' => 'Mitigar la contaminación ambiental a través de tratamiento, eliminación o disposición final de los residuos/desechos peligrosos y especiales',
                    'level' => 3,
                    'enabled' => 1,
                ),
            426 =>
                array(
                    'id' => 427,
                    'parent_id' => 426,
                    'code' => '01',
                    'full_code' => '02.04.03.01',
                    'description' => 'Mitigar la contaminación ambiental a través de tratamiento, eliminación o disposición final de los residuos/desechos peligrosos y especiales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            427 =>
                array(
                    'id' => 428,
                    'parent_id' => 421,
                    'code' => '04',
                    'full_code' => '02.04.04',
                    'description' => 'Mitigar la contaminación ambiental a través de tratamiento, eliminación o disposición final  de los residuos/desechos  no peligrosos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            428 =>
                array(
                    'id' => 429,
                    'parent_id' => 428,
                    'code' => '01',
                    'full_code' => '02.04.04.01',
                    'description' => 'Mitigar la contaminación ambiental a través de tratamiento, eliminación o disposición final  de los residuos/desechos  no peligrosos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            429 =>
                array(
                    'id' => 430,
                    'parent_id' => 421,
                    'code' => '05',
                    'full_code' => '02.04.05',
                    'description' => 'Controlar y medir la contaminación por residuos/desechos peligrosos , no peligrosos y especiales',
                    'level' => 3,
                    'enabled' => 1,
                ),
            430 =>
                array(
                    'id' => 431,
                    'parent_id' => 430,
                    'code' => '01',
                    'full_code' => '02.04.05.01',
                    'description' => 'Controlar y medir la contaminación por residuos/desechos peligrosos , no peligrosos y especiales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            431 =>
                array(
                    'id' => 432,
                    'parent_id' => 421,
                    'code' => '06',
                    'full_code' => '02.04.06',
                    'description' => 'Promover y Controlar la Gestión Integral de Sustancias Químicas para prevenir y mitigar la contaminación',
                    'level' => 3,
                    'enabled' => 1,
                ),
            432 =>
                array(
                    'id' => 433,
                    'parent_id' => 432,
                    'code' => '01',
                    'full_code' => '02.04.06.01',
                    'description' => 'Promover y Controlar la Gestión Integral de Sustancias Químicas para prevenir y mitigar la contaminación',
                    'level' => 4,
                    'enabled' => 1,
                ),
            433 =>
                array(
                    'id' => 434,
                    'parent_id' => 389,
                    'code' => '05',
                    'full_code' => '02.05',
                    'description' => 'PREVENIR, CONTROLAR Y MITIGAR LA CONTAMINACIÓN POR RUIDO Y VIBRACIONES',
                    'level' => 2,
                    'enabled' => 1,
                ),
            434 =>
                array(
                    'id' => 435,
                    'parent_id' => 434,
                    'code' => '01',
                    'full_code' => '02.05.01',
                    'description' => 'Prevenir la contaminación por ruido y vibraciones modificando su origen',
                    'level' => 3,
                    'enabled' => 1,
                ),
            435 =>
                array(
                    'id' => 436,
                    'parent_id' => 435,
                    'code' => '01',
                    'full_code' => '02.05.01.01',
                    'description' => 'Prevenir la contaminación por ruido y vibraciones modificando su origen',
                    'level' => 4,
                    'enabled' => 1,
                ),
            436 =>
                array(
                    'id' => 437,
                    'parent_id' => 434,
                    'code' => '02',
                    'full_code' => '02.05.02',
                    'description' => 'Prevenir la contaminación por ruido y vibraciones construyendo dispositivos antiruidos y antivibraciones',
                    'level' => 3,
                    'enabled' => 1,
                ),
            437 =>
                array(
                    'id' => 438,
                    'parent_id' => 437,
                    'code' => '01',
                    'full_code' => '02.05.02.01',
                    'description' => 'Prevenir la contaminación por ruido y vibraciones construyendo dispositivos antiruidos y antivibraciones',
                    'level' => 4,
                    'enabled' => 1,
                ),
            438 =>
                array(
                    'id' => 439,
                    'parent_id' => 434,
                    'code' => '03',
                    'full_code' => '02.05.03',
                    'description' => 'Controlar y medir la contaminación ambiental por ruido y vibraciones',
                    'level' => 3,
                    'enabled' => 1,
                ),
            439 =>
                array(
                    'id' => 440,
                    'parent_id' => 439,
                    'code' => '01',
                    'full_code' => '02.05.03.01',
                    'description' => 'Controlar y medir la contaminación ambiental por ruido y vibraciones',
                    'level' => 4,
                    'enabled' => 1,
                ),
            440 =>
                array(
                    'id' => 441,
                    'parent_id' => 389,
                    'code' => '06',
                    'full_code' => '02.06',
                    'description' => 'PREVENIR, CONTROLAR Y MITIGAR LA CONTAMINACIÓN AMBIENTAL POR RADIACIONES',
                    'level' => 2,
                    'enabled' => 1,
                ),
            441 =>
                array(
                    'id' => 442,
                    'parent_id' => 441,
                    'code' => '01',
                    'full_code' => '02.06.01',
                    'description' => 'Prevenir la contaminación ambiental por radiaciones protegiendo los entornos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            442 =>
                array(
                    'id' => 443,
                    'parent_id' => 442,
                    'code' => '01',
                    'full_code' => '02.06.01.01',
                    'description' => 'Prevenir la contaminación ambiental por radiaciones protegiendo los entornos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            443 =>
                array(
                    'id' => 444,
                    'parent_id' => 441,
                    'code' => '02',
                    'full_code' => '02.06.02',
                    'description' => 'Mitigar la contaminación ambiental por radiaciones transportando y tratando los residuos con alto índice de radioactividad',
                    'level' => 3,
                    'enabled' => 1,
                ),
            444 =>
                array(
                    'id' => 445,
                    'parent_id' => 444,
                    'code' => '01',
                    'full_code' => '02.06.02.01',
                    'description' => 'Mitigar la contaminación ambiental por radiaciones transportando y tratando los residuos con alto índice de radioactividad',
                    'level' => 4,
                    'enabled' => 1,
                ),
            445 =>
                array(
                    'id' => 446,
                    'parent_id' => 441,
                    'code' => '03',
                    'full_code' => '02.06.03',
                    'description' => 'Controlar y medir la contaminación ambiental por radiaciones',
                    'level' => 3,
                    'enabled' => 1,
                ),
            446 =>
                array(
                    'id' => 447,
                    'parent_id' => 446,
                    'code' => '01',
                    'full_code' => '02.06.03.01',
                    'description' => 'Controlar y medir la contaminación ambiental por radiaciones',
                    'level' => 4,
                    'enabled' => 1,
                ),
            447 =>
                array(
                    'id' => 448,
                    'parent_id' => 389,
                    'code' => '07',
                    'full_code' => '02.07',
                    'description' => 'VALORAR, CONSERVAR Y MANEJAR SUSTENTABLEMENTE EL PATRIMONIO NATURAL Y SU BIODIVERSIDAD TERRESTRE, ACUÁTICA, CONTINENTAL, MARINA Y COSTERA, CON EL ACCESO JUSTO Y EQUITATIVO A SUS BENEFICIOS',
                    'level' => 2,
                    'enabled' => 1,
                ),
            448 =>
                array(
                    'id' => 449,
                    'parent_id' => 448,
                    'code' => '01',
                    'full_code' => '02.07.01',
                    'description' => 'Proteger la biodiversidad en sus distintos niveles de organización (genes, especies, poblaciones y ecosistemas- bosques)',
                    'level' => 3,
                    'enabled' => 1,
                ),
            449 =>
                array(
                    'id' => 450,
                    'parent_id' => 449,
                    'code' => '01',
                    'full_code' => '02.07.01.01',
                    'description' => 'Proteger la biodiversidad en sus distintos niveles de organización (genes, especies, poblaciones y ecosistemas- bosques)',
                    'level' => 4,
                    'enabled' => 1,
                ),
            450 =>
                array(
                    'id' => 451,
                    'parent_id' => 448,
                    'code' => '02',
                    'full_code' => '02.07.02',
                    'description' => 'Promover el uso sostenible de la biodiversidad y el patrimonio genético',
                    'level' => 3,
                    'enabled' => 1,
                ),
            451 =>
                array(
                    'id' => 452,
                    'parent_id' => 451,
                    'code' => '01',
                    'full_code' => '02.07.02.01',
                    'description' => 'Promover el uso sostenible de la biodiversidad y el patrimonio genético',
                    'level' => 4,
                    'enabled' => 1,
                ),
            452 =>
                array(
                    'id' => 453,
                    'parent_id' => 448,
                    'code' => '03',
                    'full_code' => '02.07.03',
                    'description' => 'Garantizar la restauración ecológica de la biodiversidad que hayan sido afectados negativamente por efectos naturales o humanos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            453 =>
                array(
                    'id' => 454,
                    'parent_id' => 453,
                    'code' => '01',
                    'full_code' => '02.07.03.01',
                    'description' => 'Garantizar la restauración ecológica de la biodiversidad que hayan sido afectados negativamente por efectos naturales o humanos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            454 =>
                array(
                    'id' => 455,
                    'parent_id' => 448,
                    'code' => '04',
                    'full_code' => '02.07.04',
                    'description' => 'Valorar la biodiversidad, los bienes y los servicios ecosistémicos asociados',
                    'level' => 3,
                    'enabled' => 1,
                ),
            455 =>
                array(
                    'id' => 456,
                    'parent_id' => 455,
                    'code' => '01',
                    'full_code' => '02.07.04.01',
                    'description' => 'Valorar la biodiversidad, los bienes y los servicios ecosistémicos asociados',
                    'level' => 4,
                    'enabled' => 1,
                ),
            456 =>
                array(
                    'id' => 457,
                    'parent_id' => 448,
                    'code' => '05',
                    'full_code' => '02.07.05',
                    'description' => 'Promover turismo sustentable',
                    'level' => 3,
                    'enabled' => 1,
                ),
            457 =>
                array(
                    'id' => 458,
                    'parent_id' => 457,
                    'code' => '01',
                    'full_code' => '02.07.05.01',
                    'description' => 'Promover turismo sustentable',
                    'level' => 4,
                    'enabled' => 1,
                ),
            458 =>
                array(
                    'id' => 459,
                    'parent_id' => 448,
                    'code' => '06',
                    'full_code' => '02.07.06',
                    'description' => 'Controlar y medir la conservación y manejo de la biodiversidad, sus especies y hábitats, así como paisajes naturales y seminaturales',
                    'level' => 3,
                    'enabled' => 1,
                ),
            459 =>
                array(
                    'id' => 460,
                    'parent_id' => 459,
                    'code' => '01',
                    'full_code' => '02.07.06.01',
                    'description' => 'Controlar y medir la conservación y manejo de la biodiversidad, sus especies y hábitats, así como paisajes naturales y seminaturales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            460 =>
                array(
                    'id' => 461,
                    'parent_id' => 389,
                    'code' => '08',
                    'full_code' => '02.08',
                    'description' => 'GESTIONAR DE MANERA SUSTENTABLE Y PARTICIPATIVA EL RECURSO AGUA',
                    'level' => 2,
                    'enabled' => 1,
                ),
            461 =>
                array(
                    'id' => 462,
                    'parent_id' => 461,
                    'code' => '01',
                    'full_code' => '02.08.01',
                    'description' => 'Gestionar de manera sustentable y participativa el recurso hídrico para uso doméstico , asegurando la participación de grupos de atención prioritaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            462 =>
                array(
                    'id' => 463,
                    'parent_id' => 462,
                    'code' => '01',
                    'full_code' => '02.08.01.01',
                    'description' => 'Gestionar de manera sustentable y participativa el recurso hídrico para uso doméstico , asegurando la participación de grupos de atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            463 =>
                array(
                    'id' => 464,
                    'parent_id' => 461,
                    'code' => '02',
                    'full_code' => '02.08.02',
                    'description' => 'Gestionar de manera sustentable y participativa el recurso hídrico para uso industrial asegurando la participación de grupos de atención prioritaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            464 =>
                array(
                    'id' => 465,
                    'parent_id' => 464,
                    'code' => '01',
                    'full_code' => '02.08.02.01',
                    'description' => 'Gestionar de manera sustentable y participativa el recurso hídrico para uso industrial asegurando la participación de grupos de atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            465 =>
                array(
                    'id' => 466,
                    'parent_id' => 461,
                    'code' => '03',
                    'full_code' => '02.08.03',
                    'description' => 'Gestionar de manera sustentable y participativa del recurso hídrico para agricultura, ganadería, acuacultura asegurando la participación de grupos de atención prioritaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            466 =>
                array(
                    'id' => 467,
                    'parent_id' => 466,
                    'code' => '01',
                    'full_code' => '02.08.03.01',
                    'description' => 'Gestionar de manera sustentable y participativa del recurso hídrico para agricultura, ganadería, acuacultura asegurando la participación de grupos de atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            467 =>
                array(
                    'id' => 468,
                    'parent_id' => 461,
                    'code' => '04',
                    'full_code' => '02.08.04',
                    'description' => 'Gestionar de manera sustentable y participativa las cuencas y caudales ecológicos asegurando la participación de grupos de atención prioritaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            468 =>
                array(
                    'id' => 469,
                    'parent_id' => 468,
                    'code' => '01',
                    'full_code' => '02.08.04.01',
                    'description' => 'Gestionar de manera sustentable y participativa las cuencas y caudales ecológicos asegurando la participación de grupos de atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            469 =>
                array(
                    'id' => 470,
                    'parent_id' => 461,
                    'code' => '05',
                    'full_code' => '02.08.05',
                    'description' => 'Controlar y medir el recurso hídrico  asegurando la participación de grupos de atención prioritaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            470 =>
                array(
                    'id' => 471,
                    'parent_id' => 470,
                    'code' => '01',
                    'full_code' => '02.08.05.01',
                    'description' => 'Controlar y medir el recurso hídrico  asegurando la participación de grupos de atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            471 =>
                array(
                    'id' => 472,
                    'parent_id' => 389,
                    'code' => '09',
                    'full_code' => '02.09',
                    'description' => 'PROMOVER LA EFICIENCIA EN LA GESTIÓN DE LOS RECURSOS MINERALES E HIDROCARBURÍFEROS',
                    'level' => 2,
                    'enabled' => 1,
                ),
            472 =>
                array(
                    'id' => 473,
                    'parent_id' => 472,
                    'code' => '01',
                    'full_code' => '02.09.01',
                    'description' => 'Promover la eficiencia en la gestión de los recursos minerales',
                    'level' => 3,
                    'enabled' => 1,
                ),
            473 =>
                array(
                    'id' => 474,
                    'parent_id' => 473,
                    'code' => '01',
                    'full_code' => '02.09.01.01',
                    'description' => 'Promover la eficiencia en la gestión de los recursos minerales',
                    'level' => 4,
                    'enabled' => 1,
                ),
            474 =>
                array(
                    'id' => 475,
                    'parent_id' => 472,
                    'code' => '02',
                    'full_code' => '02.09.02',
                    'description' => 'Promover la eficiencia en la gestión de los recursos hidrocarburíferos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            475 =>
                array(
                    'id' => 476,
                    'parent_id' => 475,
                    'code' => '01',
                    'full_code' => '02.09.02.01',
                    'description' => 'Promover la eficiencia en la gestión de los recursos hidrocarburíferos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            476 =>
                array(
                    'id' => 477,
                    'parent_id' => 472,
                    'code' => '03',
                    'full_code' => '02.09.03',
                    'description' => 'Gestionar los recursos provenientes de regalías asegurando la participación de grupos atención prioritaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            477 =>
                array(
                    'id' => 478,
                    'parent_id' => 477,
                    'code' => '01',
                    'full_code' => '02.09.03.01',
                    'description' => 'Gestionar los recursos provenientes de regalías asegurando la participación de grupos atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            478 =>
                array(
                    'id' => 479,
                    'parent_id' => 472,
                    'code' => '04',
                    'full_code' => '02.09.04',
                    'description' => 'Controlar y medir los recursos minerales e hidrocarburíferos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            479 =>
                array(
                    'id' => 480,
                    'parent_id' => 479,
                    'code' => '01',
                    'full_code' => '02.09.04.01',
                    'description' => 'Controlar y medir los recursos minerales e hidrocarburíferos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            480 =>
                array(
                    'id' => 481,
                    'parent_id' => 389,
                    'code' => '10',
                    'full_code' => '02.10',
                    'description' => 'PROMOVER LA EFICIENCIA EN LA GESTIÓN DE RECURSOS ENERGÉTICOS RENOVABLES',
                    'level' => 2,
                    'enabled' => 1,
                ),
            481 =>
                array(
                    'id' => 482,
                    'parent_id' => 481,
                    'code' => '01',
                    'full_code' => '02.10.01',
                    'description' => 'Promover la eficiencia en la gestión del recurso para energía solar',
                    'level' => 3,
                    'enabled' => 1,
                ),
            482 =>
                array(
                    'id' => 483,
                    'parent_id' => 482,
                    'code' => '01',
                    'full_code' => '02.10.01.01',
                    'description' => 'Promover la eficiencia en la gestión del recurso para energía solar',
                    'level' => 4,
                    'enabled' => 1,
                ),
            483 =>
                array(
                    'id' => 484,
                    'parent_id' => 481,
                    'code' => '02',
                    'full_code' => '02.10.02',
                    'description' => 'Promover la eficiencia en la gestión del recurso para energía eólica',
                    'level' => 3,
                    'enabled' => 1,
                ),
            484 =>
                array(
                    'id' => 485,
                    'parent_id' => 484,
                    'code' => '01',
                    'full_code' => '02.10.02.01',
                    'description' => 'Promover la eficiencia en la gestión del recurso para energía eólica',
                    'level' => 4,
                    'enabled' => 1,
                ),
            485 =>
                array(
                    'id' => 486,
                    'parent_id' => 481,
                    'code' => '03',
                    'full_code' => '02.10.03',
                    'description' => 'Promover la eficiencia en la gestión del  recurso para energía hídrica',
                    'level' => 3,
                    'enabled' => 1,
                ),
            486 =>
                array(
                    'id' => 487,
                    'parent_id' => 486,
                    'code' => '01',
                    'full_code' => '02.10.03.01',
                    'description' => 'Promover la eficiencia en la gestión del  recurso para energía hídrica',
                    'level' => 4,
                    'enabled' => 1,
                ),
            487 =>
                array(
                    'id' => 488,
                    'parent_id' => 481,
                    'code' => '04',
                    'full_code' => '02.10.04',
                    'description' => 'Promover la eficiencia en la gestión de otros recursos energéticos renovables (exceptuando recursos energía solar, eólica e hídrica)',
                    'level' => 3,
                    'enabled' => 1,
                ),
            488 =>
                array(
                    'id' => 489,
                    'parent_id' => 488,
                    'code' => '01',
                    'full_code' => '02.10.04.01',
                    'description' => 'Promover la eficiencia en la gestión de otros recursos energéticos renovables (exceptuando recursos energía solar, eólica e hídrica)',
                    'level' => 4,
                    'enabled' => 1,
                ),
            489 =>
                array(
                    'id' => 490,
                    'parent_id' => 481,
                    'code' => '05',
                    'full_code' => '02.10.05',
                    'description' => 'Controlar y medir los recursos energéticos renovables',
                    'level' => 3,
                    'enabled' => 1,
                ),
            490 =>
                array(
                    'id' => 491,
                    'parent_id' => 490,
                    'code' => '01',
                    'full_code' => '02.10.05.01',
                    'description' => 'Controlar y medir los recursos energéticos renovables',
                    'level' => 4,
                    'enabled' => 1,
                ),
            491 =>
                array(
                    'id' => 492,
                    'parent_id' => 389,
                    'code' => '11',
                    'full_code' => '02.11',
                    'description' => 'GESTIÓN SOSTENIBLE DE RECURSOS FORESTALES MADERABLES Y NO MADERABLES',
                    'level' => 2,
                    'enabled' => 1,
                ),
            492 =>
                array(
                    'id' => 493,
                    'parent_id' => 492,
                    'code' => '01',
                    'full_code' => '02.11.01',
                    'description' => 'Gestionar sostenible y participativamente los recursos forestales maderables aseguirando la participación de los grupos de atención prioritaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            493 =>
                array(
                    'id' => 494,
                    'parent_id' => 493,
                    'code' => '01',
                    'full_code' => '02.11.01.01',
                    'description' => 'Gestionar sostenible y participativamente los recursos forestales maderables aseguirando la participación de los grupos de atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            494 =>
                array(
                    'id' => 495,
                    'parent_id' => 492,
                    'code' => '02',
                    'full_code' => '02.11.02',
                    'description' => 'Gestionar sostenible y participativamente los recursos forestales no maderables aseguirando la participación de los grupos de atención prioritaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            495 =>
                array(
                    'id' => 496,
                    'parent_id' => 495,
                    'code' => '01',
                    'full_code' => '02.11.02.01',
                    'description' => 'Gestionar sostenible y participativamente los recursos forestales no maderables aseguirando la participación de los grupos de atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            496 =>
                array(
                    'id' => 497,
                    'parent_id' => 492,
                    'code' => '03',
                    'full_code' => '02.11.03',
                    'description' => 'Controlar y medir los recursos forestales maderables y no maderables aseguirando la participación de grupos de atención prioritaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            497 =>
                array(
                    'id' => 498,
                    'parent_id' => 497,
                    'code' => '01',
                    'full_code' => '02.11.03.01',
                    'description' => 'Controlar y medir los recursos forestales maderables y no maderables aseguirando la participación de grupos de atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            498 =>
                array(
                    'id' => 499,
                    'parent_id' => 389,
                    'code' => '12',
                    'full_code' => '02.12',
                    'description' => 'CONSERVAR Y MANEJAR SUSTENTABLEMENTE LOS RECURSOS ACUÁTICOS DE PESCA Y ACUACULTURA',
                    'level' => 2,
                    'enabled' => 1,
                ),
            499 =>
                array(
                    'id' => 500,
                    'parent_id' => 499,
                    'code' => '01',
                    'full_code' => '02.12.01',
                    'description' => 'Conservar y manejar sustentable y participativamente los recursos de pesca aseguirando la participación delos gruos de atención prioritaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
        ));
        DB::table('guide_spending_classifiers')->insert(array(
            0 =>
                array(
                    'id' => 501,
                    'parent_id' => 500,
                    'code' => '01',
                    'full_code' => '02.12.01.01',
                    'description' => 'Conservar y manejar sustentable y participativamente los recursos de pesca aseguirando la participación delos gruos de atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            1 =>
                array(
                    'id' => 502,
                    'parent_id' => 499,
                    'code' => '02',
                    'full_code' => '02.12.02',
                    'description' => 'Conservar y manejar sustentable y participativamente los recursos de acuacultura aseguirando la participación de los grupos de atención prioritaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            2 =>
                array(
                    'id' => 503,
                    'parent_id' => 502,
                    'code' => '01',
                    'full_code' => '02.12.02.01',
                    'description' => 'Conservar y manejar sustentable y participativamente los recursos de acuacultura aseguirando la participación de los grupos de atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            3 =>
                array(
                    'id' => 504,
                    'parent_id' => 499,
                    'code' => '03',
                    'full_code' => '02.12.03',
                    'description' => 'Controlar y medir los recursos acuáticos de pesca y acuacultura aseguirando la participación de grupos de atención prioritaria',
                    'level' => 3,
                    'enabled' => 1,
                ),
            4 =>
                array(
                    'id' => 505,
                    'parent_id' => 504,
                    'code' => '01',
                    'full_code' => '02.12.03.01',
                    'description' => 'Controlar y medir los recursos acuáticos de pesca y acuacultura aseguirando la participación de grupos de atención prioritaria',
                    'level' => 4,
                    'enabled' => 1,
                ),
            5 =>
                array(
                    'id' => 506,
                    'parent_id' => 389,
                    'code' => '13',
                    'full_code' => '02.13',
                    'description' => 'PROMOVER LA INVESTIGACIÓN Y DESARROLLO PARA PROTECCIÓN AMBIENTAL',
                    'level' => 2,
                    'enabled' => 1,
                ),
            6 =>
                array(
                    'id' => 507,
                    'parent_id' => 506,
                    'code' => '01',
                    'full_code' => '02.13.01',
                    'description' => 'Promover investigación básica  de protección ambiental',
                    'level' => 3,
                    'enabled' => 1,
                ),
            7 =>
                array(
                    'id' => 508,
                    'parent_id' => 507,
                    'code' => '01',
                    'full_code' => '02.13.01.01',
                    'description' => 'Promover investigación básica  de protección ambiental',
                    'level' => 4,
                    'enabled' => 1,
                ),
            8 =>
                array(
                    'id' => 509,
                    'parent_id' => 506,
                    'code' => '02',
                    'full_code' => '02.13.02',
                    'description' => 'Promover investigación aplicada de protección ambiental',
                    'level' => 3,
                    'enabled' => 1,
                ),
            9 =>
                array(
                    'id' => 510,
                    'parent_id' => 509,
                    'code' => '01',
                    'full_code' => '02.13.02.01',
                    'description' => 'Promover investigación aplicada de protección ambiental',
                    'level' => 4,
                    'enabled' => 1,
                ),
            10 =>
                array(
                    'id' => 511,
                    'parent_id' => 506,
                    'code' => '03',
                    'full_code' => '02.13.03',
                    'description' => 'Promover desarrollo tecnológico de protección ambiental',
                    'level' => 3,
                    'enabled' => 1,
                ),
            11 =>
                array(
                    'id' => 512,
                    'parent_id' => 511,
                    'code' => '01',
                    'full_code' => '02.13.03.01',
                    'description' => 'Promover desarrollo tecnológico de protección ambiental',
                    'level' => 4,
                    'enabled' => 1,
                ),
            12 =>
                array(
                    'id' => 513,
                    'parent_id' => 389,
                    'code' => '14',
                    'full_code' => '02.14',
                    'description' => 'PROMOVER LA INVESTIGACIÓN Y DESARROLLO PARA GESTIÓN DE RECURSOS (HÍDRICOS, MINERALES E HIDROCARBURÍFEROS, ENERGÉTICOS RENOVABLES, FORESTALES, DE PESCA Y ACUACULTURA)',
                    'level' => 2,
                    'enabled' => 1,
                ),
            13 =>
                array(
                    'id' => 514,
                    'parent_id' => 513,
                    'code' => '01',
                    'full_code' => '02.14.01',
                    'description' => 'Promover investigación básica  de gestión de recursos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            14 =>
                array(
                    'id' => 515,
                    'parent_id' => 514,
                    'code' => '01',
                    'full_code' => '02.14.01.01',
                    'description' => 'Promover investigación básica  de gestión de recursos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            15 =>
                array(
                    'id' => 516,
                    'parent_id' => 513,
                    'code' => '02',
                    'full_code' => '02.14.02',
                    'description' => 'Promover investigación aplicada de gestión de recursos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            16 =>
                array(
                    'id' => 517,
                    'parent_id' => 516,
                    'code' => '01',
                    'full_code' => '02.14.02.01',
                    'description' => 'Promover investigación aplicada de gestión de recursos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            17 =>
                array(
                    'id' => 518,
                    'parent_id' => 513,
                    'code' => '03',
                    'full_code' => '02.14.03',
                    'description' => 'Promover desarrollo tecnológico de gestión de recursos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            18 =>
                array(
                    'id' => 519,
                    'parent_id' => 518,
                    'code' => '01',
                    'full_code' => '02.14.03.01',
                    'description' => 'Promover desarrollo tecnológico de gestión de recursos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            19 =>
                array(
                    'id' => 520,
                    'parent_id' => 389,
                    'code' => '15',
                    'full_code' => '02.15',
                    'description' => 'PROMOVER Y FORTALECER LA INSTITUCIONALIDAD DEL ESTADO Y POLÍTICAS PÚBLICAS PARA AMBIENTE',
                    'level' => 2,
                    'enabled' => 1,
                ),
            20 =>
                array(
                    'id' => 521,
                    'parent_id' => 520,
                    'code' => '01',
                    'full_code' => '02.15.01',
                    'description' => 'Promover y fortalecer la educación, capacitación y formación en ambiente',
                    'level' => 3,
                    'enabled' => 1,
                ),
            21 =>
                array(
                    'id' => 522,
                    'parent_id' => 521,
                    'code' => '01',
                    'full_code' => '02.15.01.01',
                    'description' => 'Promover y fortalecer la educación, capacitación y formación en ambiente',
                    'level' => 4,
                    'enabled' => 1,
                ),
            22 =>
                array(
                    'id' => 523,
                    'parent_id' => 520,
                    'code' => '02',
                    'full_code' => '02.15.02',
                    'description' => 'Realizar difusión de información sobre protección en medio ambiente y gestión de recursos',
                    'level' => 3,
                    'enabled' => 1,
                ),
            23 =>
                array(
                    'id' => 524,
                    'parent_id' => 523,
                    'code' => '01',
                    'full_code' => '02.15.02.01',
                    'description' => 'Realizar difusión de información sobre protección en medio ambiente y gestión de recursos',
                    'level' => 4,
                    'enabled' => 1,
                ),
            24 =>
                array(
                    'id' => 525,
                    'parent_id' => 520,
                    'code' => '03',
                    'full_code' => '02.15.03',
                    'description' => 'Asegurar los derechos de la naturaleza y la participación social en la gestión ambiental',
                    'level' => 3,
                    'enabled' => 1,
                ),
            25 =>
                array(
                    'id' => 526,
                    'parent_id' => 525,
                    'code' => '01',
                    'full_code' => '02.15.03.01',
                    'description' => 'Asegurar los derechos de la naturaleza y la participación social en la gestión ambiental',
                    'level' => 4,
                    'enabled' => 1,
                ),
            26 =>
                array(
                    'id' => 527,
                    'parent_id' => 520,
                    'code' => '04',
                    'full_code' => '02.15.04',
                    'description' => 'Promover e implementar la salud ocupacional y seguridad laboral',
                    'level' => 3,
                    'enabled' => 1,
                ),
            27 =>
                array(
                    'id' => 528,
                    'parent_id' => 527,
                    'code' => '01',
                    'full_code' => '02.15.04.01',
                    'description' => 'Promover e implementar la salud ocupacional y seguridad laboral',
                    'level' => 4,
                    'enabled' => 1,
                ),
            28 =>
                array(
                    'id' => 529,
                    'parent_id' => 520,
                    'code' => '05',
                    'full_code' => '02.15.05',
                    'description' => 'Promover la producción y consumo sustentable',
                    'level' => 3,
                    'enabled' => 1,
                ),
            29 =>
                array(
                    'id' => 530,
                    'parent_id' => 529,
                    'code' => '01',
                    'full_code' => '02.15.05.01',
                    'description' => 'Promover la producción y consumo sustentable',
                    'level' => 4,
                    'enabled' => 1,
                ),
            30 =>
                array(
                    'id' => 531,
                    'parent_id' => 520,
                    'code' => '06',
                    'full_code' => '02.15.06',
                    'description' => 'Generar  política pública, normativa y regulación, buenas prácticas ambientales e institucionalización en el ámbito ambiental',
                    'level' => 3,
                    'enabled' => 1,
                ),
            31 =>
                array(
                    'id' => 532,
                    'parent_id' => 531,
                    'code' => '01',
                    'full_code' => '02.15.06.01',
                    'description' => 'Generar  política pública, normativa y regulación, buenas prácticas ambientales e institucionalización en el ámbito ambiental',
                    'level' => 4,
                    'enabled' => 1,
                ),
            32 =>
                array(
                    'id' => 533,
                    'parent_id' => null,
                    'code' => '99',
                    'full_code' => '99',
                    'description' => 'Ninguno',
                    'level' => 1,
                    'enabled' => 1,
                ),
            33 =>
                array(
                    'id' => 534,
                    'parent_id' => 533,
                    'code' => '99',
                    'full_code' => '99.99',
                    'description' => 'Ninguno',
                    'level' => 2,
                    'enabled' => 1,
                ),
            34 =>
                array(
                    'id' => 535,
                    'parent_id' => 534,
                    'code' => '99',
                    'full_code' => '99.99.99',
                    'description' => 'Ninguno',
                    'level' => 3,
                    'enabled' => 1,
                ),
            35 =>
                array(
                    'id' => 536,
                    'parent_id' => 535,
                    'code' => '99',
                    'full_code' => '99.99.99.99',
                    'description' => 'Ninguno',
                    'level' => 4,
                    'enabled' => 1,
                ),
        ));

        DB::statement("select setval('guide_spending_classifiers_id_seq', (select max(id) from guide_spending_classifiers)+1)");
    }
}
