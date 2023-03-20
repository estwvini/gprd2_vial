<?php

namespace Database\Seeders\Tenant;

use App\Models\Business\Plan;
use App\Models\Business\PlanElement;
use App\Models\Business\PlanIndicator;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    public function run()
    {

        $ods = Plan::query()->create(
            [
                'name' => 'ODS',
                'vision' => 'La Agenda 2030 para el Desarrollo Sostenible, aprobada en septiembre de 2015 por la Asamblea General de las Naciones Unidas, establece una visión transformadora hacia la sostenibilidad económica, social y ambiental de los 193 Estados Miembros que la suscribieron y será la guía de referencia para el trabajo de la institución en pos de esta visión durante los próximos 15 años.',
                'mission' => null,
                'scope' => Plan::SCOPE_SUPRANATIONAL,
                'type' => Plan::TYPE_ODS,
                'start_year' => 2015,
                'end_year' => 2030,
                'status' => Plan::STATUS_DRAFT,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        );
        $pnd = Plan::query()->create([
            'name' => 'Plan de Creación de Oportunidades',
            'vision' => 'Un país próspero, con una democracia liberal plena, regida por el Estado de derecho y donde funcionan eficientemente las instituciones. Solo respetando la individualidad personal lograremos promover una economía de libre mercado y abierta al mundo, fiscalmente responsable y generadora de empleo. Queremos empoderar a los ciudadanos para que elijan con libertad los medios que les permitan alcanzar su felicidad, sin olvidar ser solidarios con los más vulnerables, a través de un Estado pequeño, pero sólido y eficiente.',
            'mission' => null,
            'scope' => Plan::SCOPE_NATIONAL,
            'type' => Plan::TYPE_PND,
            'start_year' => 2021,
            'end_year' => 2025,
            'status' => Plan::STATUS_DRAFT,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);

        PlanElement::query()->insert(
            [
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Poner fin a la pobreza en todas sus formas en todo el mundo',
                    'code' => '01',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Poner fin al hambre, lograr la seguridad alimentaria y la mejora de la nutrición y promover la agricultura sostenible.',
                    'code' => '02',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Garantizar una vida sana y promover el bienestar de todos a todas las edades',
                    'code' => '03',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Garantizar una educación inclusiva y equitativa de calidad y promover oportunidades de aprendizaje permanente para todos',
                    'code' => '04',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Lograr la igualdad de género y empoderar a todas las mujeres y las niñas.',
                    'code' => '05',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Garantizar la disponibilidad y la gestión sostenible del agua y el saneamiento para todos.',
                    'code' => '06',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Garantizar el acceso a una energía asequible, fiable, sostenible y moderna para todos.',
                    'code' => '07',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Promover el crecimiento económico sostenido, inclusivo y sostenible, el empleo pleno y productivo y el trabajo decente para todos.',
                    'code' => '08',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Construir infraestructuras resilientes, promover la industrialización inclusiva y sostenible y fomentar la innovación.',
                    'code' => '09',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Reducir la desigualdad en los países y entre ellos',
                    'code' => '10',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Lograr que las ciudades y los asentamientos humanos sean inclusivos, seguros, resilientes y sostenibles.',
                    'code' => '11',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Garantizar modalidades de consumo y producción sostenibles',
                    'code' => '12',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Adoptar medidas urgentes para combatir el cambio climático y sus efectos.',
                    'code' => '13',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Conservar y utilizar sosteniblemente los océanos, los mares y los recursos marinos para el desarrollo sostenible',
                    'code' => '14',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Proteger, restablecer y promover el uso sostenible de los ecosistemas terrestres, gestionar sosteniblemente los bosques, luchar contra la desertificación, detener e invertir la degradación de las tierras y detener la pérdida de biodiversidad.',
                    'code' => '15',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Promover sociedades pacíficas e inclusivas para el desarrollo sostenible, facilitar el acceso a la justicia para todos y construir a todos los niveles instituciones eficaces e inclusivas que rindan cuentas.',
                    'code' => '16',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'plan_id' => $ods->id,
                    'parent_id' => null,
                    'description' => 'Fortalecer los medios de implementación y revitalizar la Alianza Mundial para el Desarrollo Sostenible',
                    'code' => '17',
                    'type' => 'OBJECTIVE',
                    'product' => null,
                    'production_goal' => null,
                    'dimension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ]
            ]);

        $p01 = PlanElement::query()->create([
            'plan_id' => $pnd->id,
            'parent_id' => null,
            'description' => 'Derechos para todos durante toda la vida,',
            'code' => '01',
            'type' => 'THRUST',
            'product' => null,
            'production_goal' => null,
            'dimension' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);
        $p02 = PlanElement::query()->create([
            'plan_id' => $pnd->id,
            'parent_id' => null,
            'description' => 'Economía al servicio de la sociedad',
            'code' => '02',
            'type' => 'THRUST',
            'product' => null,
            'production_goal' => null,
            'dimension' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);
        $p03 = PlanElement::query()->create([
            'plan_id' => $pnd->id,
            'parent_id' => null,
            'description' => 'Más sociedad, mejor Estado',
            'code' => '03',
            'type' => 'THRUST',
            'product' => null,
            'production_goal' => null,
            'dimension' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);

        PlanElement::query()->insert([
            [
                'plan_id' => $pnd->id,
                'parent_id' => $p01->id,
                'description' => 'Garantizar una vida digna con iguales oportunidades para todas las personas',
                'code' => '01',
                'type' => 'OBJECTIVE',
                'product' => null,
                'production_goal' => null,
                'dimension' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'plan_id' => $pnd->id,
                'parent_id' => $p01->id,
                'description' => 'Afirmar la interculturalidad y plurinacionalidad, revalorizando las identidades.',
                'code' => '02',
                'type' => 'OBJECTIVE',
                'product' => null,
                'production_goal' => null,
                'dimension' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'plan_id' => $pnd->id,
                'parent_id' => $p01->id,
                'description' => 'Garantizar los derechos de la naturaleza para las actuales y futuras generaciones.',
                'code' => '03',
                'type' => 'OBJECTIVE',
                'product' => null,
                'production_goal' => null,
                'dimension' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        ]);
        PlanElement::query()->insert([
            [
                'plan_id' => $pnd->id,
                'parent_id' => $p02->id,
                'description' => 'Consolidar la sostenibilidad del sistema económico, social y solidario y afianzar la dolarización',
                'code' => '04',
                'type' => 'OBJECTIVE',
                'product' => null,
                'production_goal' => null,
                'dimension' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'plan_id' => $pnd->id,
                'parent_id' => $p02->id,
                'description' => 'Impulsar la productividad y competitividad para el crecimiento económico sostenible, de manera redistributiva y solidaria.',
                'code' => '05',
                'type' => 'OBJECTIVE',
                'product' => null,
                'production_goal' => null,
                'dimension' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'plan_id' => $pnd->id,
                'parent_id' => $p02->id,
                'description' => 'Desarrollar las capacidades productivas y del entorno, para lograr la soberanía alimentaria y el Buen Vivir Rural',
                'code' => '06',
                'type' => 'OBJECTIVE',
                'product' => null,
                'production_goal' => null,
                'dimension' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
        PlanElement::query()->insert([
            [
                'plan_id' => $pnd->id,
                'parent_id' => $p03->id,
                'description' => 'Incentivar una sociedad participativa, con un Estado cercano al servicio de la ciudadanía',
                'code' => '07',
                'type' => 'OBJECTIVE',
                'product' => null,
                'production_goal' => null,
                'dimension' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'plan_id' => $pnd->id,
                'parent_id' => $p03->id,
                'description' => 'Promover la transparencia y la corresponsabilidad para una nueva ética social.',
                'code' => '08',
                'type' => 'OBJECTIVE',
                'product' => null,
                'production_goal' => null,
                'dimension' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'plan_id' => $pnd->id,
                'parent_id' => $p03->id,
                'description' => 'Garantizar la soberanía y la paz, y posicionar estratégicamente al país en la región y el mundo',
                'code' => '09',
                'type' => 'OBJECTIVE',
                'product' => null,
                'production_goal' => null,
                'dimension' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        ]);

        $planElement = new PlanElement;
        $indicator = new PlanIndicator;

        // Ejes
        $economic = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => null,
            'description' => 'Económico',
            'code' => '01',
            'type' => PlanElement::TYPE_THRUST
        ]);
        $social = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => null,
            'description' => 'Social',
            'code' => '02',
            'type' => PlanElement::TYPE_THRUST
        ]);
        $security = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => null,
            'description' => 'Seguridad Integral',
            'code' => '03',
            'type' => PlanElement::TYPE_THRUST
        ]);
        $ecological = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => null,
            'description' => 'Transición Ecológica',
            'code' => '04',
            'type' => PlanElement::TYPE_THRUST
        ]);
        $institutional = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => null,
            'description' => 'Institucional',
            'code' => '05',
            'type' => PlanElement::TYPE_THRUST
        ]);

        // Objectives
        $obj1 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $economic->id,
            'description' => 'Incrementar y fomentar, de manera inclusiva, las oportunidades de empleo y las condiciones laborales',
            'code' => '01',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj2 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $economic->id,
            'description' => 'Impulsar un sistema económico con reglas claras que fomente el comercio exterior, turismo, atracción de inversiones y modernización del sistema financiero nacional',
            'code' => '02',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj3 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $economic->id,
            'description' => 'Fomentar la productividad y competitividad en los sectores agrícola, industrial, acuícola y pesquero, bajo el enfoque de la economía circular',
            'code' => '03',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj4 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $economic->id,
            'description' => 'Garantizar la gestión de las finanzas públicas de manera sostenible y transparente',
            'code' => '04',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj5 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $social->id,
            'description' => 'Proteger a las familias, garantizar sus derechos y servicios, erradicar la pobreza y promover la inclusión social',
            'code' => '05',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj6 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $social->id,
            'description' => 'Garantizar el  derecho a la salud integral, gratuita y de calidad',
            'code' => '06',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj7 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $social->id,
            'description' => 'Potenciar las capacidades de la ciudadanía y promover una educación innovadora, inclusiva y de calidad en todos los niveles',
            'code' => '07',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj8 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $social->id,
            'description' => 'Generar nuevas oportunidades y bienestar para las zonas rurales, con énfasis en pueblos y nacionalidades',
            'code' => '08',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj9 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $security->id,
            'description' => 'Garantizar la seguridad ciudadana, orden público y gestión de riesgos',
            'code' => '09',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj10 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $security->id,
            'description' => 'Garantizar la soberanía nacional, integridad territorial y seguridad del Estado',
            'code' => '10',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj11 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $ecological->id,
            'description' => 'Conservar, restaurar, proteger y hacer un uso sostenible de los recursos naturales',
            'code' => '11',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj12 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $ecological->id,
            'description' => 'Fomentar modelos de desarrollo sostenibles aplicando medidas de adaptación y mitigación al Cambio Climático',
            'code' => '12',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj13 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $ecological->id,
            'description' => 'Promover la gestión integral de los recursos hídricos',
            'code' => '13',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj14 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $institutional->id,
            'description' => 'Fortalecer las capacidades del Estado con énfasis en la administración de justicia y eficiencia en los procesos de regulación y control, con independencia y autonomía',
            'code' => '14',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj15 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $institutional->id,
            'description' => 'Fomentar la ética pública, la transparencia y la lucha contra la corrupción',
            'code' => '15',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);
        $obj16 = $planElement::create([
            'plan_id' => $pnd->id,
            'parent_id' => $institutional->id,
            'description' => 'Promover la integración regional, la inserción estratégica del país en el mundo y garantizar los derechos de las personas en situación de movilidad humana',
            'code' => '16',
            'type' => PlanElement::TYPE_OBJECTIVE
        ]);

        // Indicators
        // obj1
        $ind111 = $indicator::create([
            'name' => '1.1.1. Incrementar la tasa de empleo adecuado del 30,41% al 50,00%.',
            'description' => '',
            'goal_description' => '1.1.1. Incrementar la tasa de empleo adecuado del 30,41% al 50,00%. ',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj1->id,
        ]);
        $ind112 = $indicator::create([
            'name' => '1.1.2. Reducir la tasa de desempleo juvenil (entre 18 y 29 años) de 10,08% a 8,17%.',
            'description' => '',
            'goal_description' => '1.1.2. Reducir la tasa de desempleo juvenil (entre 18 y 29 años) de 10,08% a 8,17%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj1->id,
        ]);
        $ind113 = $indicator::create([
            'name' => '1.1.3. Incrementar el porcentaje de personas empleadas mensualmente en actividades artísticas y culturales del 5,19% al 6,00%.',
            'description' => '',
            'goal_description' => '1.1.3. Incrementar el porcentaje de personas empleadas mensualmente en actividades artísticas y culturales del 5,19% al 6,00%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj1->id,
        ]);
        $ind114 = $indicator::create([
            'name' => '1.1.4. Aumentar el número de personas con discapacidad y/o sustitutos insertados en el sistema laboral de 70.273 a 74.547.',
            'description' => '',
            'goal_description' => '1.1.4. Aumentar el número de personas con discapacidad y/o sustitutos insertados en el sistema laboral de 70.273 a 74.547.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj1->id,
        ]);
        $ind115 = $indicator::create([
            'name' => '1.1.5. Incrementar para el 2025 la tasa acumulada de acceso al menos a la clase media en 30,39%',
            'description' => '',
            'goal_description' => '1.1.5. Incrementar para el 2025 la tasa acumulada de acceso al menos a la clase media en 30,39%',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj1->id,
        ]);

        // obj2
        $ind211 = $indicator::create([
            'name' => '2.1.1. Incrementar las exportaciones alta, media, baja intensidad tecnológica per cápita de 42,38 al 51,31.',
            'description' => '',
            'goal_description' => '2.1.1. Incrementar las exportaciones alta, media, baja intensidad tecnológica per cápita de 42,38 al 51,31.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind212 = $indicator::create([
            'name' => '2.1.2. Incrementar la participación de las exportaciones no tradicionales en las exportaciones no petroleras totales del 41,16% al 48,36%.',
            'description' => '',
            'goal_description' => '2.1.2. Incrementar la participación de las exportaciones no tradicionales en las exportaciones no petroleras totales del 41,16% al 48,36%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind221 = $indicator::create([
            'name' => '2.2.1. Incrementar la recaudación tributaria anual del sector minero de USD 40.283.952 a USD 248.040.057.',
            'description' => '',
            'goal_description' => '2.2.1. Incrementar la recaudación tributaria anual del sector minero de USD 40.283.952 a USD 248.040.057.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind222 = $indicator::create([
            'name' => '2.2.2. Incrementar las exportaciones mineras anuales de USD 921.935.961 a USD 4.040.016.198.',
            'description' => '',
            'goal_description' => '2.2.2. Incrementar las exportaciones mineras anuales de USD 921.935.961 a USD 4.040.016.198.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind223 = $indicator::create([
            'name' => '2.2.3. Incrementar el mantenimiento de la red vial estatal con modelos de gestión sostenible del 17,07% al 40%.',
            'description' => '',
            'goal_description' => '2.2.3. Incrementar el mantenimiento de la red vial estatal con modelos de gestión sostenible del 17,07% al 40%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind224 = $indicator::create([
            'name' => '2.2.4. Incrementar la Inversión Extranjera Directa de USD 1.189,83 millones a USD 2.410,17 millones.',
            'description' => '',
            'goal_description' => '2.2.4. Incrementar la Inversión Extranjera Directa de USD 1.189,83 millones a USD 2.410,17 millones.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind225 = $indicator::create([
            'name' => '2.2.5. Aumentar las solicitudes de patentes nacionales presentadas de 64 a 93.',
            'description' => '',
            'goal_description' => '2.2.5. Aumentar las solicitudes de patentes nacionales presentadas de 64 a 93.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind226 = $indicator::create([
            'name' => '2.2.6 Incrementar la Inversión Privada Nacional y Extranjera de USD 1.676,90 millones a USD 7.104,68 millones.',
            'description' => '',
            'goal_description' => '2.2.6 Incrementar la Inversión Privada Nacional y Extranjera de USD 1.676,90 millones a USD 7.104,68 millones. (USD 23,5 miles de millones acumulados)',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind227 = $indicator::create([
            'name' => '2.2.7 Incrementar el volumen de producción de hidrocarburos de 516.083 BEP a 1 millón del BEP hasta el año 2025.',
            'description' => '',
            'goal_description' => '2.2.7 Incrementar el volumen de producción de hidrocarburos de 516.083 BEP a 1 millón del BEP hasta el año 2025.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind231 = $indicator::create([
            'name' => '2.3.1. Aumentar el ingreso de divisas por concepto de turismo receptor de USD 704,67 millones a USD 2.434,60 millones.',
            'description' => '',
            'goal_description' => '2.3.1. Aumentar el ingreso de divisas por concepto de turismo receptor de USD 704,67 millones a USD 2.434,60 millones.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind232 = $indicator::create([
            'name' => '2.3.2. Incrementar las llegadas de extranjeros no residentes al país de 468.894 en 2020 a 2.000.000 en 2025.',
            'description' => '',
            'goal_description' => '2.3.2. Incrementar las llegadas de extranjeros no residentes al país de 468.894 en 2020 a 2.000.000 en 2025.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind233 = $indicator::create([
            'name' => '2.3.3. Aumentar el empleo en las principales actividades turísticas de 460.498 a 495.820.',
            'description' => '',
            'goal_description' => '2.3.3. Aumentar el empleo en las principales actividades turísticas de 460.498 a 495.820.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind241 = $indicator::create([
            'name' => '2.4.1. Incrementar del 1,49% al 1,80% la contribución de las actividades culturales en el Producto Interno Bruto.',
            'description' => '',
            'goal_description' => '2.4.1. Incrementar del 1,49% al 1,80% la contribución de las actividades culturales en el Producto Interno Bruto.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind242 = $indicator::create([
            'name' => '2.4.2. Incrementar el número de nuevas obras artísticas culturales certificadas al año, en derechos de autor y derechos conexos de 2.429 a 3.912.',
            'description' => '',
            'goal_description' => '2.4.2. Incrementar el número de nuevas obras artísticas culturales certificadas al año, en derechos de autor y derechos conexos de 2.429 a 3.912.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);
        $ind243 = $indicator::create([
            'name' => '2.4.3. Incrementar el porcentaje de contribución de importaciones en bienes de uso artístico y cultural en las importaciones totales del país',
            'description' => '',
            'goal_description' => '2.4.3. Incrementar el porcentaje de contribución de importaciones en bienes de uso artístico y cultural en las importaciones totales del país de 9,33% a 10,69%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj2->id,
        ]);

        // obj3
        $ind311 = $indicator::create([
            'name' => '3.1.1. Incrementar el Valor Agregado Bruto (VAB) manufacturero sobre VAB primario de 1,13 al 1,24.',
            'description' => '',
            'goal_description' => '3.1.1. Incrementar el Valor Agregado Bruto (VAB) manufacturero sobre VAB primario de 1,13 al 1,24.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj3->id,
        ]);
        $ind312 = $indicator::create([
            'name' => '3.1.2. Aumentar el rendimiento de la productividad agrícola nacional de 117,78 a 136,85 tonelada/Hectárea (t/Ha).',
            'description' => '',
            'goal_description' => '3.1.2. Aumentar el rendimiento de la productividad agrícola nacional de 117,78 a 136,85 tonelada/Hectárea (t/Ha).',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj3->id,
        ]);
        $ind313 = $indicator::create([
            'name' => '3.1.3. Incrementar las exportaciones agropecuarias y agroindustriales del 13,35% al 17,67%.',
            'description' => '',
            'goal_description' => '3.1.3. Incrementar las exportaciones agropecuarias y agroindustriales del 13,35% al 17,67%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj3->id,
        ]);
        $ind314 = $indicator::create([
            'name' => '3.1.4. Aumentar la tasa de cobertura con riego tecnificado parcelario para pequeños y medianos productores del 15,86% al 38,88%.',
            'description' => '',
            'goal_description' => '3.1.4. Aumentar la tasa de cobertura con riego tecnificado parcelario para pequeños y medianos productores del 15,86% al 38,88%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj3->id,
        ]);
        $ind315 = $indicator::create([
            'name' => '3.1.5. Incrementar el Valor Agregado Bruto (VAB) acuícola y pesquero de camarón sobre VAB primario del 11,97% al 13,28%.',
            'description' => '',
            'goal_description' => '3.1.5. Incrementar el Valor Agregado Bruto (VAB) acuícola y pesquero de camarón sobre VAB primario del 11,97% al 13,28%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj3->id,
        ]);

        $ind316 = $indicator::create([
            'name' => '3.1.6. Reducir el Valor Agregado Bruto (VAB) Pesca (excepto de camarón) sobre VAB primario del 7,00% al 6,73%.',
            'description' => '',
            'goal_description' => '3.1.6. Reducir el Valor Agregado Bruto (VAB) Pesca (excepto de camarón) sobre VAB primario del 7,00% al 6,73%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj3->id,
        ]);
        $ind317 = $indicator::create([
            'name' => '3.1.7. Incrementar el valor agregado por manufactura per cápita de 879 a 1.065',
            'description' => '',
            'goal_description' => '3.1.7. Incrementar el valor agregado por manufactura per cápita de 879 a 1.065',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj3->id,
        ]);
        $ind321 = $indicator::create([
            'name' => '3.2.1. Incrementar de 85,97 % al 86,85 % la participación de los alimentos producidos en el país en el consumo de los hogares ecuatorianos',
            'description' => '',
            'goal_description' => '3.2.1. Incrementar de 85,97 % al 86,85 % la participación de los alimentos producidos en el país en el consumo de los hogares ecuatorianos',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj3->id,
        ]);
        $ind331 = $indicator::create([
            'name' => '3.3.1. Incrementar el porcentaje de productores asociados, registrados como Agricultura Familiar Campesina.',
            'description' => '',
            'goal_description' => '3.3.1. Incrementar del 4 % al 25 % el porcentaje de productores asociados, registrados como Agricultura Familiar Campesina que se vinculan a sistemas de comercialización',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj3->id,
        ]);
        $ind332 = $indicator::create([
            'name' => '3.3.2. Incrementar en 2.750 mujeres rurales que se desempeñan como promotoras de sistemas de producción sostenibles',
            'description' => '',
            'goal_description' => '3.3.2. Incrementar en 2.750 mujeres rurales que se desempeñan como promotoras de sistemas de producción sostenibles',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj3->id,
        ]);

        // obj4
        $ind411 = $indicator::create([
            'name' => '4.1.1. Reducir de 78,22% a 76,02% los gastos primarios del Gobierno respecto al Presupuesto General del Estado',
            'description' => '',
            'goal_description' => '4.1.1. Reducir de 78,22% a 76,02% los gastos primarios del Gobierno respecto al Presupuesto General del Estado',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj4->id,
        ]);
        $ind421 = $indicator::create([
            'name' => '4.2.1. Incrementar de 32,91% a 35% la proporción del Presupuesto General del Estado financiados por impuestos internos',
            'description' => '',
            'goal_description' => '4.2.1. Incrementar de 32,91% a 35% la proporción del Presupuesto General del Estado financiados por impuestos internos',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj4->id,
        ]);
        $ind422 = $indicator::create([
            'name' => '4.2.2. Incrementar de 30,64% a 32,61% los ingresos de autogestión respecto a los ingresos totales de los GAD',
            'description' => '',
            'goal_description' => '4.2.2. Incrementar de 30,64% a 32,61% los ingresos de autogestión respecto a los ingresos totales de los GAD',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj4->id,
        ]);
        $ind431 = $indicator::create([
            'name' => '4.3.1. Aumentar las empresas públicas en operación con EBITDA positivo.',
            'description' => '',
            'goal_description' => '4.3.1. Aumentar de 66,67% a 91,67% las empresas públicas en operación con EBITDA (por sus siglas en inglés: Earnings Before Interests, Tax, Depreciation and Amortization) positivo.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj4->id,
        ]);
        $ind441 = $indicator::create([
            'name' => '4.4.1. Reducir de 60,7% a 57% la deuda pública y otras obligaciones de pago con relación al Producto Interno Bruto',
            'description' => '',
            'goal_description' => '4.4.1. Reducir de 60,7% a 57% la deuda pública y otras obligaciones de pago con relación al Producto Interno Bruto',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj4->id,
        ]);
        $ind451 = $indicator::create([
            'name' => '4.5.1. Alcanzar un superávit global de SPNF a 2025 de 0,35% del PIB.',
            'description' => '',
            'goal_description' => '4.5.1. Alcanzar un superávit global de SPNF a 2025 de 0,35% del PIB.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj4->id,
        ]);
        $ind452 = $indicator::create([
            'name' => '4.5.2 Alcanzar un crecimiento anual del Producto Interno Bruto del 5% en el 2025',
            'description' => '',
            'goal_description' => '4.5.2 Alcanzar un crecimiento anual del Producto Interno Bruto del 5% en el 2025',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj4->id,
        ]);
        $ind461 = $indicator::create([
            'name' => '4.6.1. Incrementar el porcentaje promedio de cobertura de pasivos del primer sistema de balance del Banco Central del Ecuador.',
            'description' => '',
            'goal_description' => '4.6.1. Incrementar el porcentaje promedio de cobertura de pasivos del primer sistema de balance del Banco Central del Ecuador respecto a las Reservas Internacionales del 88% al 97%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj4->id,
        ]);

        // obj5
        $ind511 = $indicator::create([
            'name' => '5.1.1. Reducir la tasa de pobreza extrema por ingresos de 15,44% al 10,76%.',
            'description' => '',
            'goal_description' => '5.1.1. Reducir la tasa de pobreza extrema por ingresos de 15,44% al 10,76%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj5->id,
        ]);
        $ind512 = $indicator::create([
            'name' => '5.1.2. Disminuir la tasa de trabajo infantil (de 5 a 14 años) de 6,10% a 4,42%.',
            'description' => '',
            'goal_description' => '5.1.2. Disminuir la tasa de trabajo infantil (de 5 a 14 años) de 6,10% a 4,42%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj5->id,
        ]);
        $ind521 = $indicator::create([
            'name' => '5.2.1. Disminuir la tasa de femicidios por cada 100.000 mujeres de 0,87 a 0,80.',
            'description' => '',
            'goal_description' => '5.2.1. Disminuir la tasa de femicidios por cada 100.000 mujeres de 0,87 a 0,80.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj5->id,
        ]);
        $ind522 = $indicator::create([
            'name' => '5.2.2. Reducir la brecha de empleo adecuado entre hombres y mujeres del 33,50% al 28,45%.',
            'description' => '',
            'goal_description' => '5.2.2. Reducir la brecha de empleo adecuado entre hombres y mujeres del 33,50% al 28,45%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj5->id,
        ]);
        $ind523 = $indicator::create([
            'name' => '5.2.3. Reducir la brecha salarial entre hombres y mujeres del 15,34% al 11,27%.',
            'description' => '',
            'goal_description' => '5.2.3. Reducir la brecha salarial entre hombres y mujeres del 15,34% al 11,27%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj5->id,
        ]);
        $ind531 = $indicator::create([
            'name' => '5.3.1. Incrementar el porcentaje de personas cubiertas por alguno de los regímenes de seguridad social pública contributiva del 37,56% al 41,73%.',
            'description' => '',
            'goal_description' => '5.3.1. Incrementar el porcentaje de personas cubiertas por alguno de los regímenes de seguridad social pública contributiva del 37,56% al 41,73%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj5->id,
        ]);
        $ind541 = $indicator::create([
            'name' => '5.4.1. Reducir el déficit habitacional de vivienda del 58,00% al 48,44%.',
            'description' => '',
            'goal_description' => '5.4.1. Reducir el déficit habitacional de vivienda del 58,00% al 48,44%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj5->id,
        ]);
        $ind551 = $indicator::create([
            'name' => '5.5.1. Incrementar la cobertura poblacional con tecnología 4G o superior del 60,74% al 92,00%.',
            'description' => '',
            'goal_description' => '5.5.1. Incrementar la cobertura poblacional con tecnología 4G o superior del 60,74% al 92,00%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj5->id,
        ]);
        $ind552 = $indicator::create([
            'name' => '5.5.2. Incrementar la penetración de Internet móvil y fijo del 68,08% al 78,00%.',
            'description' => '',
            'goal_description' => '5.5.2. Incrementar la penetración de Internet móvil y fijo del 68,08% al 78,00%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj5->id,
        ]);

        //obj6
        $ind611 = $indicator::create([
            'name' => '6.1.1. Incrementar el porcentaje de nacidos vivos con asistencia de personal de la salud del 96,4% al 98,5%.',
            'description' => '',
            'goal_description' => '6.1.1. Incrementar el porcentaje de nacidos vivos con asistencia de personal de la salud del 96,4% al 98,5%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind612 = $indicator::create([
            'name' => '6.1.2. Reducir la tasa de mortalidad neonatal de 4,6 al 4,0 por cada 1.000 nacidos vivos.',
            'description' => '',
            'goal_description' => '6.1.2. Reducir la tasa de mortalidad neonatal de 4,6 al 4,0 por cada 1.000 nacidos vivos.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind613 = $indicator::create([
            'name' => '6.1.3. Reducir la tasa de mortalidad por suicidio de 6,1 al 5,1 por cada 100.000 habitantes.',
            'description' => '',
            'goal_description' => '6.1.3. Reducir la tasa de mortalidad por suicidio de 6,1 al 5,1 por cada 100.000 habitantes.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind614 = $indicator::create([
            'name' => '6.1.4. Reducir la tasa de mortalidad atribuida al cáncer en la población de 21 a 75 años de 30,0 al 28,6 por cada 100.000 habitantes.',
            'description' => '',
            'goal_description' => '6.1.4. Reducir la tasa de mortalidad atribuida al cáncer en la población de 21 a 75 años de 30,0 al 28,6 por cada 100.000 habitantes.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind615 = $indicator::create([
            'name' => '6.1.5. Incrementar las personas que conocen su estado serológico y se encuentran en tratamiento para VIH del 89% al 92%.',
            'description' => '',
            'goal_description' => '6.1.5. Incrementar las personas que conocen su estado serológico y se encuentran en tratamiento para VIH del 89% al 92%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind616 = $indicator::create([
            'name' => '6.1.6 Reducir el gasto de bolsillo como porcentaje del gasto total en salud de 31,37% a 26,87%.',
            'description' => '',
            'goal_description' => '6.1.6 Reducir el gasto de bolsillo como porcentaje del gasto total en salud de 31,37% a 26,87%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind621 = $indicator::create([
            'name' => '6.2.1. Incrementar la vacunación de neumococo en la población menor de 1 año de 76,09% a 88,05%.',
            'description' => '',
            'goal_description' => '6.2.1. Incrementar la vacunación de neumococo en la población menor de 1 año de 76,09% a 88,05%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind622 = $indicator::create([
            'name' => '6.2.2. Incrementar la vacunación de rotavirus en la población menor de 1 año de 75,19% a 81,24%.',
            'description' => '',
            'goal_description' => '6.2.2. Incrementar la vacunación de rotavirus en la población menor de 1 año de 75,19% a 81,24%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind623 = $indicator::create([
            'name' => '6.2.3. Incrementar la vacunación de sarampión, rubeola y parodititis (SRP) en la población de 12 a 23 meses de 70,35% a 82,21%.',
            'description' => '',
            'goal_description' => '6.2.3. Incrementar la vacunación de sarampión, rubeola y parodititis (SRP) en la población de 12 a 23 meses de 70,35% a 82,21%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind631 = $indicator::create([
            'name' => '6.3.1. Reducir la razón de muerte materna de 57,6 a 38,41 fallecimientos por cada 100.000 nacidos vivos.',
            'description' => '',
            'goal_description' => '6.3.1. Reducir la razón de muerte materna de 57,6 a 38,41 fallecimientos por cada 100.000 nacidos vivos.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind632 = $indicator::create([
            'name' => '6.3.2. Disminuir la tasa de nacimientos por embarazo adolescente (15 a 19 años de edad) del 54,6 al 39,4 por cada 1.000 nacidos vivos.',
            'description' => '',
            'goal_description' => '6.3.2. Disminuir la tasa de nacimientos por embarazo adolescente (15 a 19 años de edad) del 54,6 al 39,4 por cada 1.000 nacidos vivos.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind641 = $indicator::create([
            'name' => '6.4.1. Reducir 6 puntos porcentuales la Desnutrición Crónica Infantil en menores de 2 años.',
            'description' => '',
            'goal_description' => '6.4.1. Reducir 6 puntos porcentuales la Desnutrición Crónica Infantil en menores de 2 años.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind651 = $indicator::create([
            'name' => '6.5.1. Incrementar la proporción de médicos familiares que trabajan haciendo atención primaria de 1,14 a 1,71 por cada 10.000 habitantes.',
            'description' => '',
            'goal_description' => '6.5.1. Incrementar la proporción de médicos familiares que trabajan haciendo atención primaria de 1,14 a 1,71 por cada 10.000 habitantes.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind652 = $indicator::create([
            'name' => '6.5.2. Incrementar la proporción de enfermeras que trabajan en los servicios de salud de 0,65 a 0,76 por cada médico.',
            'description' => '',
            'goal_description' => '6.5.2. Incrementar la proporción de enfermeras que trabajan en los servicios de salud de 0,65 a 0,76 por cada médico.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind661 = $indicator::create([
            'name' => '6.6.1. Reducir el porcentaje de adolescentes entre 13 y 15 años que consumen tabaco del 0,52 al 0,34.',
            'description' => '',
            'goal_description' => '6.6.1. Reducir el porcentaje de adolescentes entre 13 y 15 años que consumen tabaco del 0,52 al 0,34.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind671 = $indicator::create([
            'name' => '6.7.1. Reducir la prevalencia de actividad física insuficiente en la población de niñas, niños y jóvenes (5-17 años) del 88,21% al 83,21%.',
            'description' => '',
            'goal_description' => '6.7.1. Reducir la prevalencia de actividad física insuficiente en la población de niñas, niños y jóvenes (5-17 años) del 88,21% al 83,21%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind672 = $indicator::create([
            'name' => '6.7.2. Reducir la prevalencia de actividad física insuficiente en la población adulta (18-69 años) del 17,80% al 13,00%.',
            'description' => '',
            'goal_description' => '6.7.2. Reducir la prevalencia de actividad física insuficiente en la población adulta (18-69 años) del 17,80% al 13,00%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind673 = $indicator::create([
            'name' => '6.7.3. Reducir el tiempo de comportamiento sedentario en un día normal de 120 minutos a 114 minutos en la población de niñas, niños y jóvenes',
            'description' => '',
            'goal_description' => '6.7.3. Reducir el tiempo de comportamiento sedentario en un día normal de 120 minutos a 114 minutos en la población de niñas, niños y jóvenes (5-17 años).',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);
        $ind674 = $indicator::create([
            'name' => '6.7.4. Reducir el tiempo de comportamiento sedentario en un día normal de 150 minutos a 143 minutos en la población adulta (18-69 años).',
            'description' => '',
            'goal_description' => '6.7.4. Reducir el tiempo de comportamiento sedentario en un día normal de 150 minutos a 143 minutos en la población adulta (18-69 años).',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj6->id,
        ]);

        //obj7
        $ind711 = $indicator::create([
            'name' => '7.1.1. Incrementar el porcentaje de personas entre 18 y 29 años con bachillerato completo de 69,75% a 77,89%.',
            'description' => '',
            'goal_description' => '7.1.1. Incrementar el porcentaje de personas entre 18 y 29 años con bachillerato completo de 69,75% a 77,89%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj7->id,
        ]);
        $ind712 = $indicator::create([
            'name' => '7.1.2. Incrementar la tasa bruta de matrícula de bachillerato de 87,38% a 89,09%.',
            'description' => '',
            'goal_description' => '7.1.2. Incrementar la tasa bruta de matrícula de bachillerato de 87,38% a 89,09%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj7->id,
        ]);
        $ind713 = $indicator::create([
            'name' => '7.1.3. Incrementar la tasa bruta de matrícula de Educación General Básica de 93,00% a 97,53%.',
            'description' => '',
            'goal_description' => '7.1.3. Incrementar la tasa bruta de matrícula de Educación General Básica de 93,00% a 97,53%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj7->id,
        ]);
        $ind721 = $indicator::create([
            'name' => '7.2.1. Incrementar el porcentaje de instituciones educativas fiscales con cobertura de internet con fines pedagógicos de 41,93% a 65,92%.',
            'description' => '',
            'goal_description' => '7.2.1. Incrementar el porcentaje de instituciones educativas fiscales con cobertura de internet con fines pedagógicos de 41,93% a 65,92%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj7->id,
        ]);
        $ind731 = $indicator::create([
            'name' => '7.3.1. Incrementar el porcentaje de respuesta a la atención de víctimas de violencia para que cuenten con un plan de acompañamiento',
            'description' => '',
            'goal_description' => '7.3.1. Incrementar el porcentaje de respuesta a la atención de víctimas de violencia para que cuenten con un plan de acompañamiento pasando de 67,60% a 95,00%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj7->id,
        ]);
        $ind741 = $indicator::create([
            'name' => '7.4.1. Incrementar los artículos publicados por las universidades y escuelas politécnicas en revistas indexadas de 6.624 a 12.423.',
            'description' => '',
            'goal_description' => '7.4.1. Incrementar los artículos publicados por las universidades y escuelas politécnicas en revistas indexadas de 6.624 a 12.423.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj7->id,
        ]);
        $ind742 = $indicator::create([
            'name' => '7.4.2. Incrementar la tasa bruta de matrícula en educación superior terciaria del 37,34% al 50,27%.',
            'description' => '',
            'goal_description' => '7.4.2. Incrementar la tasa bruta de matrícula en educación superior terciaria del 37,34% al 50,27%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj7->id,
        ]);
        $ind743 = $indicator::create([
            'name' => '7.4.3. Disminuir la tasa de deserción en el primer año en la educación superior del 21,84% al 19,89%.',
            'description' => '',
            'goal_description' => '7.4.3. Disminuir la tasa de deserción en el primer año en la educación superior del 21,84% al 19,89%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj7->id,
        ]);
        $ind744 = $indicator::create([
            'name' => '7.4.4. Incrementar el número de investigadores por cada 1.000 habitantes de la Población Económicamente Activa de 0,55 a 0,75.',
            'description' => '',
            'goal_description' => '7.4.4. Incrementar el número de investigadores por cada 1.000 habitantes de la Población Económicamente Activa de 0,55 a 0,75.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj7->id,
        ]);
        $ind745 = $indicator::create([
            'name' => '7.4.5. Incrementar el número de personas tituladas de educación superior técnica y tecnológica de 23.274 a 28.756.',
            'description' => '',
            'goal_description' => '7.4.5. Incrementar el número de personas tituladas de educación superior técnica y tecnológica de 23.274 a 28.756.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj7->id,
        ]);
        $ind746 = $indicator::create([
            'name' => '7.4.6. Incrementar el número estudiantes matriculados en educación superior en las modalidades a distancia y en línea de 78.076 a 125.417.',
            'description' => '',
            'goal_description' => '7.4.6. Incrementar el número estudiantes matriculados en educación superior en las modalidades a distancia y en línea de 78.076 a 125.417.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj7->id,
        ]);
        $ind751 = $indicator::create([
            'name' => '7.5.1. Incrementar el porcentaje de atletas con discapacidad de alto rendimiento del 10,66% al 11,31%.',
            'description' => '',
            'goal_description' => '7.5.1. Incrementar el porcentaje de atletas con discapacidad de alto rendimiento del 10,66% al 11,31%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj7->id,
        ]);

        //obj8
        $ind812 = $indicator::create([
            'name' => '8.1.2. Reducir de 70% a 55% la pobreza multidimensional rural, con énfasis en pueblos y nacionalidades y poblaciones vulnerables.',
            'description' => '',
            'goal_description' => '8.1.2. Reducir de 70% a 55% la pobreza multidimensional rural, con énfasis en pueblos y nacionalidades y poblaciones vulnerables.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj8->id,
        ]);
        $ind821 = $indicator::create([
            'name' => '8.2.1. Incrementar la tasa bruta de matrícula de Educación General Básica en el área rural de 63,47% a 64,47%.',
            'description' => '',
            'goal_description' => '8.2.1. Incrementar la tasa bruta de matrícula de Educación General Básica en el área rural de 63,47% a 64,47%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj8->id,
        ]);
        $ind822 = $indicator::create([
            'name' => '8.2.2. Incrementar la tasa bruta de matrícula de bachillerato en el área rural de 48,65% al 54,91%.',
            'description' => '',
            'goal_description' => '8.2.2. Incrementar la tasa bruta de matrícula de bachillerato en el área rural de 48,65% al 54,91%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj8->id,
        ]);
        $ind823 = $indicator::create([
            'name' => '8.2.3. Implementar el Modelo de Sistema de Educación Intercultural Bilingüe (MOSEIB)',
            'description' => '',
            'goal_description' => '8.2.3. Implementar el Modelo de Sistema de Educación Intercultural Bilingüe (MOSEIB), en el 5,41% de instituciones del Sistema de Educación Intercultural Bilingüe.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj8->id,
        ]);
        $ind831 = $indicator::create([
            'name' => '8.3.1. Incrementar los sitios patrimoniales de gestión cultural comunitaria habilitados y puestos en valor para efectuar procesos de turismo',
            'description' => '',
            'goal_description' => '8.3.1. Incrementar los sitios patrimoniales de gestión cultural comunitaria habilitados y puestos en valor para efectuar procesos de turismo rural sostenible, de 0 a 20.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj8->id,
        ]);

        //obj9
        $ind911 = $indicator::create([
            'name' => '9.1.1. Disminuir la tasa de homicidios intencionales de 106 a 100 por cada 1.000.000 habitantes.',
            'description' => '',
            'goal_description' => '9.1.1. Disminuir la tasa de homicidios intencionales de 106 a 100 por cada 1.000.000 habitantes.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj9->id,
        ]);
        $ind912 = $indicator::create([
            'name' => '9.1.2. Incrementar el porcentaje de efectividad de las investigaciones, con investigación previa',
            'description' => '',
            'goal_description' => '9.1.2. Incrementar el porcentaje de efectividad de las investigaciones, con investigación previa, que permita la desarticulación de grupos delictivos organizados (GDO) del 55.75% al 73,45%',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj9->id,
        ]);
        $ind913 = $indicator::create([
            'name' => '9.1.3. Incrementar la satisfacción del usuario externo de la Policía Nacional del 77,00% al 84,61%.',
            'description' => '',
            'goal_description' => '9.1.3. Incrementar la satisfacción del usuario externo de la Policía Nacional del 77,00% al 84,61%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj9->id,
        ]);
        $ind921 = $indicator::create([
            'name' => '9.2.1 Disminuir la tasa de mortalidad por accidentes de tránsito, in situ, de 12,62 a 11,96, por cada 100.000 habitantes.',
            'description' => '',
            'goal_description' => '9.2.1 Disminuir la tasa de mortalidad por accidentes de tránsito, in situ, de 12,62 a 11,96, por cada 100.000 habitantes.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj9->id,
        ]);
        $ind922 = $indicator::create([
            'name' => '9.2.2 Reducir la tasa de accidentes en la operación de transporte aéreo comercial de 1,91 a 1,26',
            'description' => '',
            'goal_description' => '9.2.2 Reducir la tasa de accidentes en la operación de transporte aéreo comercial de 1,91 a 1,26',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj9->id,
        ]);
        $ind931 = $indicator::create([
            'name' => '9.3.1 Reducir la tasa de muertes por desastres de 0,11 a 0,06 por cada 100.000 habitantes.',
            'description' => '',
            'goal_description' => '9.3.1 Reducir la tasa de muertes por desastres de 0,11 a 0,06 por cada 100.000 habitantes.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj9->id,
        ]);
        $ind932 = $indicator::create([
            'name' => '9.3.2. Incrementar el nivel de eficiencia en la gestión de identificación del riesgo ejecutada por el SNDGR del 76,36% al 84,00%.',
            'description' => '',
            'goal_description' => '9.3.2. Incrementar el nivel de eficiencia en la gestión de identificación del riesgo ejecutada por el Sistema Nacional Descentralizado de Gestión de Riesgos (SNDGR) del 76,36% al 84,00%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj9->id,
        ]);
        $ind93 = $indicator::create([
            'name' => '9.3.3 Incrementar el nivel de eficiencia en la gestión de manejo de desastre del riesgo ejecutada por el SNDGR del 73,25% al 80,58%.',
            'description' => '',
            'goal_description' => '9.3.3 Incrementar el nivel de eficiencia en la gestión de manejo de desastre del riesgo ejecutada por el Sistema Nacional Descentralizado de Gestión de Riesgos (SNDGR) del 73,25% al 80,58%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj9->id,
        ]);
        $ind941 = $indicator::create([
            'name' => '9.4.1 Reducir el número de muertes por violencia intracarcelaria en los Centros de Privación de Libertad de 130 a 88.',
            'description' => '',
            'goal_description' => '9.4.1 Reducir el número de muertes por violencia intracarcelaria en los Centros de Privación de Libertad de 130 a 88.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj9->id,
        ]);
        $ind942 = $indicator::create([
            'name' => '9.4.2 Reducir el porcentaje de hacinamiento en los Centros de Privación de Libertad del 29,83% al 20,42%.',
            'description' => '',
            'goal_description' => '9.4.2 Reducir el porcentaje de hacinamiento en los Centros de Privación de Libertad del 29,83% al 20,42%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj9->id,
        ]);
        $ind943 = $indicator::create([
            'name' => '9.4.3 Disminuir  la Tasa de Personas Privadas de Libertad (PPL) custodiadas por cada SCSVP',
            'description' => '',
            'goal_description' => '9.4.3 Disminuir  la Tasa de Personas Privadas de Libertad (PPL) custodiadas por cada Servidor del Cuerpo de Seguridad y Vigilancia Penitenciaria (SCSVP) en los Centros de Privación de Libertad (CPL) de 26 PPL a 10 PPL custodiadas por cada SCSVP',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj9->id,
        ]);
        $ind944 = $indicator::create([
            'name' => '9.4.4 Reducir el número de situaciones de crisis en los Centros de Privación de Libertad de 118 a 79.',
            'description' => '',
            'goal_description' => '9.4.4 Reducir el número de situaciones de crisis en los Centros de Privación de Libertad de 118 a 79.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj9->id,
        ]);

        //obj10
        $ind1011 = $indicator::create([
            'name' => '10.1.1 Incrementar el índice de ciberseguridad global de 26,3 a 51,3.',
            'description' => '',
            'goal_description' => '10.1.1 Incrementar el índice de ciberseguridad global de 26,3 a 51,3.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj10->id,
        ]);

        //obj11
        $ind1111 = $indicator::create([
            'name' => '11.1.1. Mantener la proporción de territorio nacional bajo conservación o manejo ambiental en 16,45%.',
            'description' => '',
            'goal_description' => '11.1.1. Mantener la proporción de territorio nacional bajo conservación o manejo ambiental en 16,45%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj11->id,
        ]);
        $ind1121 = $indicator::create([
            'name' => '11.2.1. Incrementar de 1.496 a 2.067 fuentes de contaminación hidrocarburíferas remediadas y avaladas.',
            'description' => '',
            'goal_description' => '11.2.1. Incrementar de 1.496 a 2.067 fuentes de contaminación hidrocarburíferas remediadas y avaladas.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj11->id,
        ]);
        $ind1131 = $indicator::create([
            'name' => '11.3.1. Reducir las emisiones de Gases de Efecto Invernadero por deforestación en el sector de USCUSS',
            'description' => '',
            'goal_description' => '11.3.1. Reducir las emisiones de Gases de Efecto Invernadero por deforestación en el sector de Uso del Suelo, Cambio de Uso del Suelo y Silvicultura (USCUSS) de 53.782,59 a 52.706,94 Gg CO2eq.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj11->id,
        ]);

        //obj12
        $ind1211 = $indicator::create([
            'name' => '12.1.1. Incrementar los instrumentos integrados para aumentar la capacidad adaptación al cambio climático.',
            'description' => '',
            'goal_description' => '12.1.1. Incrementar de 71 a 96 los instrumentos integrados para aumentar la capacidad adaptación al cambio climático, promover la resiliencia al clima y mitigar el cambio climático sin comprometer la producción de alimentos.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj12->id,
        ]);
        $ind1212 = $indicator::create([
            'name' => '12.1.2. Reducir del 91,02 a 82,81 la vulnerabilidad al cambio climático, en función de la capacidad de adaptación.',
            'description' => '',
            'goal_description' => '12.1.2. Reducir del 91,02 a 82,81 la vulnerabilidad al cambio climático, en función de la capacidad de adaptación.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj12->id,
        ]);
        $ind1221 = $indicator::create([
            'name' => '12.2.1. Incrementar la recuperación de los residuos y/o desechos en la aplicación de las políticas de responsabilidad extendida al productor.',
            'description' => '',
            'goal_description' => '12.2.1. Incrementar de 0% a 20% la recuperación de los residuos y/o desechos en el marco de la aplicación de las políticas de responsabilidad extendida al productor.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj12->id,
        ]);
        $ind1222 = $indicator::create([
            'name' => '12.2.2. Evitar que la brecha entre huella ecológica y biocapacidad per cápita no sea inferior a 0,30 hectáreas globales.',
            'description' => '',
            'goal_description' => '12.2.2. Evitar que la brecha entre huella ecológica y biocapacidad per cápita no sea inferior a 0,30 hectáreas globales.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj12->id,
        ]);
        $ind1231 = $indicator::create([
            'name' => '12.3.1. Reducir de 79.833 a 62.917 kBEP la energía utilizada en los sectores de consumo.',
            'description' => '',
            'goal_description' => '12.3.1. Reducir de 79.833 a 62.917 kBEP la energía utilizada en los sectores de consumo.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj12->id,
        ]);
        $ind1232 = $indicator::create([
            'name' => '12.3.2. Reducir a 10,50% las pérdidas de energía eléctrica a nivel nacional.',
            'description' => '',
            'goal_description' => '12.3.2. Reducir a 10,50% las pérdidas de energía eléctrica a nivel nacional.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj12->id,
        ]);
        $ind1233 = $indicator::create([
            'name' => '12.3.3. Incrementar el ahorro de combustibles en Barriles Equivalentes de Petróleo, optimizando la generación eléctrica y la eficiencia energética',
            'description' => '',
            'goal_description' => '12.3.3. Incrementar de 21.6 a 50.5 millones el ahorro de combustibles en Barriles Equivalentes de Petróleo, optimizando el proceso de generación eléctrica y la eficiencia energética en el sector de hidrocarburos.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj12->id,
        ]);
        $ind1234 = $indicator::create([
            'name' => '12.3.4. Incrementar la capacidad en potencia instalada en subestaciones de distribución.',
            'description' => '',
            'goal_description' => '12.3.4. Incrementar de 6.424 a 6.954 megavoltiamperio (MVA) la capacidad en potencia instalada en subestaciones de distribución, para atender el crecimiento de la demanda de los sectores residencial, comercial e industrial.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj12->id,
        ]);
        $ind1235 = $indicator::create([
            'name' => '12.3.5. Incrementar la capacidad instalada de generación eléctrica de 821,44 a 1.518,44 megavatios (MW).',
            'description' => '',
            'goal_description' => '12.3.5. Incrementar la capacidad instalada de generación eléctrica de 821,44 a 1.518,44 megavatios (MW).',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj12->id,
        ]);

        // obj13
        $ind1311 = $indicator::create([
            'name' => '13.1.1. Incrementar el territorio nacional bajo protección hídrica de 18.152,13 a 284.000 hectáreas.',
            'description' => '',
            'goal_description' => '13.1.1. Incrementar el territorio nacional bajo protección hídrica de 18.152,13 a 284.000 hectáreas.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj13->id,
        ]);
        $ind1321 = $indicator::create([
            'name' => '13.2.1. Incrementar las autorizaciones para uso y aprovechamiento del recurso hídrico, de 500 a 12.000.',
            'description' => '',
            'goal_description' => '13.2.1. Incrementar las autorizaciones para uso y aprovechamiento del recurso hídrico, de 500 a 12.000.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj13->id,
        ]);
        $ind1322 = $indicator::create([
            'name' => '13.2.2. Incrementar la superficie potencial de riego y drenaje de 1.458,46 a 11.461 hectáreas.',
            'description' => '',
            'goal_description' => '13.2.2. Incrementar la superficie potencial de riego y drenaje de 1.458,46 a 11.461 hectáreas.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj13->id,
        ]);
        $ind1323 = $indicator::create([
            'name' => '13.2.3. Incrementar la superficie del territorio nacional con planes de gestión integral de recursos hídricos de 208.959,12 a 452.000 hectáreas.',
            'description' => '',
            'goal_description' => '13.2.3. Incrementar la superficie del territorio nacional con planes de gestión integral de recursos hídricos de 208.959,12 a 452.000 hectáreas.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj13->id,
        ]);
        $ind1331 = $indicator::create([
            'name' => '13.3.1. Se beneficia a 3.5 millones de habitantes con acceso a agua apta para el consumo humano y saneamiento.',
            'description' => '',
            'goal_description' => '13.3.1. Se beneficia a 3.5 millones de habitantes a través de proyectos cofinanciados por el Estado para acceso a agua apta para el consumo humano y saneamiento.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj13->id,
        ]);

        // obj14
        $ind1411 = $indicator::create([
            'name' => '14.1.1 Aumentar la tasa de resolución de 0,84 a 1,06.',
            'description' => '',
            'goal_description' => '14.1.1 Aumentar la tasa de resolución de 0,84 a 1,06.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj14->id,
        ]);
        $ind1412 = $indicator::create([
            'name' => '14.1.2 Reducir la tasa de congestión de 2,15 a 1,61.',
            'description' => '',
            'goal_description' => '14.1.2 Reducir la tasa de congestión de 2,15 a 1,61.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj14->id,
        ]);
        $ind1413 = $indicator::create([
            'name' => '14.1.3 Reducir la tasa de pendencia de 1,15 a 0,61.',
            'description' => '',
            'goal_description' => '14.1.3 Reducir la tasa de pendencia de 1,15 a 0,61.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj14->id,
        ]);
        $ind1414 = $indicator::create([
            'name' => '14.1.4 Incrementar de 3,87 a 5 defensores públicos por cada 100.000 habitantes.',
            'description' => '',
            'goal_description' => '14.1.4 Incrementar de 3,87 a 5 defensores públicos por cada 100.000 habitantes.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj14->id,
        ]);
        $ind1421 = $indicator::create([
            'name' => '14.2.1. Los GAD municipales incrementan su capacidad operativa de 18,03 a 22,03 puntos en promedio.',
            'description' => '',
            'goal_description' => '14.2.1. Los GAD municipales incrementan su capacidad operativa de 18,03 a 22,03 puntos en promedio.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj14->id,
        ]);
        $ind1422 = $indicator::create([
            'name' => '14.2.2. Los GAD provinciales incrementan su capacidad operativa de 18,89 a 22,87 puntos en promedio.',
            'description' => '',
            'goal_description' => '14.2.2. Los GAD provinciales incrementan su capacidad operativa de 18,89 a 22,87 puntos en promedio.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj14->id,
        ]);
        $ind1431 = $indicator::create([
            'name' => '14.3.1 Incrementar el Índice de Implementación de la Mejora Regulatoria en el Estado.',
            'description' => '',
            'goal_description' => '14.3.1 Incrementar de 16,84 a 38,84 el Índice de Implementación de la Mejora Regulatoria en el Estado para optimizar la calidad de vida de los ciudadanos, el clima de negocios y la competitividad.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj14->id,
        ]);
        $ind1432 = $indicator::create([
            'name' => '14.3.2 Aumentar el índice de percepción de calidad de los servicios públicos de 6,08 a 8,00.',
            'description' => '',
            'goal_description' => '14.3.2 Aumentar el índice de percepción de calidad de los servicios públicos de 6,08 a 8,00.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj14->id,
        ]);

        // obj15
        $ind1511 = $indicator::create([
            'name' => '15.1.1 Incrementar de 25% a 30% el nivel de confianza institucional en el gobierno.',
            'description' => '',
            'goal_description' => '15.1.1 Incrementar de 25% a 30% el nivel de confianza institucional en el gobierno.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj15->id,
        ]);
        $ind1512 = $indicator::create([
            'name' => '15.1.2. Mejorar el posicionamiento en el ranking de percepción de corrupción mundial del puesto 93 al 50',
            'description' => '',
            'goal_description' => '15.1.2. Mejorar el posicionamiento en el ranking de percepción de corrupción mundial del puesto 93 al 50',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj15->id,
        ]);
        $ind1521 = $indicator::create([
            'name' => '15.2.1 Al 2024 incrementar de 0,7 a 0.76 el índice de gobierno electrónico.',
            'description' => '',
            'goal_description' => '15.2.1 Al 2024 incrementar de 0,7 a 0.76 el índice de gobierno electrónico.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj15->id,
        ]);
        $ind1522 = $indicator::create([
            'name' => '15.2.2 Incrementar de 20,45% a 52,27% la participación de entidades públicas en el proceso de Gobierno Abierto Ecuador.',
            'description' => '',
            'goal_description' => '15.2.2 Incrementar de 20,45% a 52,27% la participación de entidades públicas en el proceso de Gobierno Abierto Ecuador.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj15->id,
        ]);

        // obj16
        $ind1611 = $indicator::create([
            'name' => '16.1.1 Incrementar la ejecución anual de fondos de cooperación internacional no reembolsable de USD 139,84 millones a USD 160,81 millones.',
            'description' => '',
            'goal_description' => '16.1.1 Incrementar la ejecución anual de fondos de cooperación internacional no reembolsable de USD 139,84 millones a USD 160,81 millones.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj16->id,
        ]);
        $ind1612 = $indicator::create([
            'name' => '16.1.2 Incrementar el porcentaje de avance en la inserción estratégica del país en la Antártida del 47% al 55%.',
            'description' => '',
            'goal_description' => '16.1.2 Incrementar el porcentaje de avance en la inserción estratégica del país en la Antártida del 47% al 55%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj16->id,
        ]);
        $ind1613 = $indicator::create([
            'name' => '16.1.3 Incrementar el cumplimiento de compromisos binacionales de 68,7% al 74%.',
            'description' => '',
            'goal_description' => '16.1.3 Incrementar el cumplimiento de compromisos binacionales de 68,7% al 74%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj16->id,
        ]);
        $ind1621 = $indicator::create([
            'name' => '16.2.1 Incrementar el porcentaje de avance en la definición del límite exterior de la plataforma continental más allá de las 200 millas náuticas.',
            'description' => '',
            'goal_description' => '16.2.1 Incrementar el porcentaje de avance en la definición del límite exterior de la plataforma continental más allá de las 200 millas náuticas del 8,33% al 100%.',
            'status' => PlanIndicator::STATUS_FIXED,
            'indicatorable_type' => PlanElement::class,
            'indicatorable_id' => $obj16->id,
        ]);
    }
}
