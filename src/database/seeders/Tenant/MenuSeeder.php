<?php

namespace Database\Seeders\Tenant;

use App\Models\System\Menu;
use App\Models\System\Module;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the Menu seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Menu;
        $model::truncate();

        // Configuration Module
        $model->create([
            'label' => 'Nivel Organizacional',
            'slug' => 'index.departments',
            'icon' => 'sitemap',
            'weight' => 100,
            'enabled' => 1,
            'module_id' => 3
        ]);

        $model->create([
            'label' => 'Roles',
            'slug' => 'index.roles',
            'icon' => 'tasks',
            'weight' => 200,
            'enabled' => 1,
            'module_id' => 3
        ]);

        $model->create([
            'label' => 'Usuarios',
            'slug' => 'index.users',
            'icon' => 'users',
            'weight' => 300,
            'enabled' => 1,
            'module_id' => 3
        ]);

        // Catalogs
        $catalogs = $model->create([
            'label' => 'Catálogos',
            'module_id' => 3,
            'slug' => null,
            'icon' => 'list-ul',
            'weight' => 500,
            'enabled' => 1
        ]);

        $model->create([
            'label' => 'Localizaciones Geográficas',
            'slug' => 'index.geographic_locations.module_configuration_catalogs',
            'icon' => 'map',
            'weight' => 501,
            'enabled' => 1,
            'parent_id' => $catalogs->id
        ]);

        $model->create([
            'label' => 'Fuentes de Financiamiento',
            'slug' => 'index.financing_sources.module_configuration_catalogs',
            'icon' => 'money',
            'weight' => 502,
            'enabled' => 1,
            'parent_id' => $catalogs->id
        ]);

        $model->create([
            'label' => 'Compras Públicas',
            'slug' => 'index.cpc.module_configuration_catalogs',
            'icon' => 'shopping-cart',
            'weight' => 504,
            'enabled' => 1,
            'parent_id' => $catalogs->id
        ]);

        $model->create([
            'label' => 'Orientación del Gasto',
            'slug' => 'index.spending_guide.module_configuration_catalogs',
            'icon' => 'compass',
            'weight' => 505,
            'enabled' => 1,
            'parent_id' => $catalogs->id
        ]);

        $model->create([
            'label' => 'Clasificador Presupuestario',
            'slug' => 'index.budget_classifiers.module_configuration_catalogs',
            'icon' => 'inbox',
            'weight' => 506,
            'enabled' => 1,
            'parent_id' => $catalogs->id
        ]);

        $model->create([
            'label' => 'Unidades de Medida',
            'slug' => 'index.measure_units.module_configuration_catalogs',
            'icon' => 'balance-scale',
            'weight' => 507,
            'enabled' => 1,
            'parent_id' => $catalogs->id
        ]);

        $model->create([
            'label' => 'Instituciones',
            'slug' => 'index.institution.module_configuration_catalogs',
            'icon' => 'university',
            'weight' => 508,
            'enabled' => 1,
            'parent_id' => $catalogs->id
        ]);

        $model->create([
            'label' => 'Tipos de Actividades',
            'slug' => 'index.activity_type.module_configuration_catalogs',
            'icon' => 'tasks',
            'weight' => 509,
            'enabled' => 1,
            'parent_id' => $catalogs->id
        ]);

        $model->create([
            'label' => 'Motivos',
            'slug' => 'index.reasons.module_configuration_catalogs',
            'icon' => 'pencil',
            'weight' => 510,
            'enabled' => 1,
            'parent_id' => $catalogs->id
        ]);

        $model->create([
            'label' => 'Umbrales',
            'module_id' => 3,
            'slug' => 'edit.create.threshold',
            'icon' => 'circle',
            'weight' => 800,
            'enabled' => 1
        ]);

        $model->create([
            'label' => 'Metodologías de Priorización',
            'module_id' => 3,
            'slug' => 'index.prioritization_templates',
            'icon' => 'recycle',
            'weight' => 1000,
            'enabled' => 1
        ]);

        $report = $model->create([
            'label' => 'Reportes',
            'module_id' => 3,
            'slug' => null,
            'icon' => 'pie-chart',
            'weight' => 1100,
            'enabled' => 1
        ]);

        $model->create([
            'label' => 'Perfil de usuarios',
            'slug' => 'index.users.config_reports',
            'icon' => 'users',
            'weight' => 1101,
            'enabled' => 1,
            'parent_id' => $report->id
        ]);

        $model->create([
            'label' => 'Reporte de proyectos',
            'slug' => 'index.projects.config_reports',
            'icon' => 'product-hunt',
            'weight' => 1102,
            'enabled' => 1,
            'parent_id' => $report->id
        ]);

        $model->create([
            'label' => 'Actividad de usuarios',
            'slug' => 'index.audit.config_reports',
            'icon' => 'tasks',
            'weight' => 1103,
            'enabled' => 1,
            'parent_id' => $report->id
        ]);


        // Planning Module
        $model->create([
            'label' => 'RES',
            'module_id' => 1,
            'slug' => 'index.staff',
            'icon' => 'spinner',
            'weight' => 600,
            'enabled' => 1
        ]);

        $planning = $model->create([
            'label' => 'Planificación',
            'module_id' => 1,
            'slug' => null,
            'icon' => 'tasks',
            'weight' => 700,
            'enabled' => 1
        ]);

        $model->create([
            'label' => 'Gestión de Planes',
            'slug' => 'index.plans.plans_management',
            'icon' => 'sitemap',
            'weight' => 701,
            'enabled' => 1,
            'parent_id' => $planning->id
        ]);

        $model->create([
            'label' => 'Objetivos Operativos',
            'slug' => 'index.operational_goals.plans_management',
            'icon' => 'dot-circle-o',
            'weight' => 702,
            'enabled' => 1,
            'parent_id' => $planning->id
        ]);

        $model->create([
            'label' => 'Planificación Proyectos',
            'slug' => 'index.projects.plans_management',
            'icon' => 'product-hunt',
            'weight' => 703,
            'enabled' => 1,
            'parent_id' => $planning->id
        ]);

        $model->create([
            'label' => 'Revisión Presupuestaria',
            'slug' => 'index.budget_review.plans_management',
            'icon' => 'dollar',
            'weight' => 704,
            'enabled' => 1,
            'parent_id' => $planning->id
        ]);

        $model->create([
            'label' => 'Revisión de Proyectos',
            'slug' => 'index.projects_review.plans_management',
            'icon' => 'check',
            'weight' => 704,
            'enabled' => 1,
            'parent_id' => $planning->id
        ]);

        $model->create([
            'label' => 'Priorización de Proyectos',
            'slug' => 'index.prioritization.plans_management',
            'icon' => 'folder-open',
            'weight' => 705,
            'enabled' => 1,
            'parent_id' => $planning->id
        ]);

        $budget = $model->create([
            'label' => 'Presupuesto',
            'slug' => null,
            'icon' => 'money',
            'weight' => 706,
            'enabled' => 1,
            'parent_id' => $planning->id
        ]);

        $model->create([
            'label' => 'Ingresos',
            'slug' => 'index.income.budget.plans_management',
            'icon' => 'dollar',
            'weight' => 7061,
            'enabled' => 1,
            'parent_id' => $budget->id
        ]);

        $model->create([
            'label' => 'Gasto Corriente',
            'slug' => 'index.current_expenditure_elements.budget.plans_management',
            'icon' => 'cart-arrow-down',
            'weight' => 7062,
            'enabled' => 1,
            'parent_id' => $budget->id
        ]);

        $model->create([
            'label' => 'Ajuste',
            'slug' => 'index.budget_adjustment.budget.plans_management',
            'icon' => 'balance-scale',
            'weight' => 7063,
            'enabled' => 1,
            'parent_id' => $budget->id
        ]);

        $model->create([
            'label' => 'Planificación Presupuestaria',
            'slug' => 'index.poa.reports',
            'icon' => 'pie-chart',
            'weight' => 7064,
            'enabled' => 1,
            'parent_id' => $budget->id
        ]);

        $model->create([
            'label' => 'PAC',
            'slug' => 'index.pac.reports',
            'icon' => 'pie-chart',
            'weight' => 7065,
            'enabled' => 1,
            'parent_id' => $budget->id
        ]);

        $model->create([
            'label' => 'Banco de Proyectos',
            'slug' => 'index.projects_repository.plans_management',
            'icon' => 'folder-open',
            'weight' => 707,
            'enabled' => 1,
            'parent_id' => $planning->id
        ]);


        // Execution
        $execution = $model->create([
            'label' => 'Ejecución',
            'module_id' => Module::MODULE_GXR,
            'slug' => null,
            'icon' => 'play-circle',
            'weight' => 1200,
            'enabled' => 1
        ]);

        $indicators_tracking = $model->create([
            'label' => 'Avance de Indicadores',
            'slug' => null,
            'icon' => 'fa fa-thermometer-three-quarters',
            'weight' => 1201,
            'enabled' => 1,
            'parent_id' => $execution->id
        ]);

        $model->create([
            'label' => 'PDOT',
            'slug' => 'pdot.indicator_progress.execution',
            'icon' => 'fa fa-thermometer-three-quarters',
            'weight' => 12011,
            'enabled' => 1,
            'parent_id' => $indicators_tracking->id
        ]);

        $model->create([
            'label' => 'PEI / Plan de Gobierno',
            'slug' => 'pei.indicator_progress.execution',
            'icon' => 'fa fa-thermometer-three-quarters',
            'weight' => 12012,
            'enabled' => 1,
            'parent_id' => $indicators_tracking->id
        ]);

        $model->create([
            'label' => 'Planes Sectoriales',
            'slug' => 'sectoral.indicator_progress.execution',
            'icon' => 'fa fa-thermometer-three-quarters',
            'weight' => 12013,
            'enabled' => 1,
            'parent_id' => $indicators_tracking->id
        ]);

        $model->create([
            'label' => 'Objetivos Operativos',
            'slug' => 'operational_goals.indicator_progress.execution',
            'icon' => 'fa fa-thermometer-three-quarters',
            'weight' => 12014,
            'enabled' => 1,
            'parent_id' => $indicators_tracking->id
        ]);

        $model->create([
            'label' => 'Proyectos',
            'slug' => 'projects.indicator_progress.execution',
            'icon' => 'fa fa-thermometer-three-quarters',
            'weight' => 12015,
            'enabled' => 1,
            'parent_id' => $indicators_tracking->id
        ]);

        $model->create([
            'label' => 'Componentes',
            'slug' => 'components.indicator_progress.execution',
            'icon' => 'fa fa-thermometer-three-quarters',
            'weight' => 12016,
            'enabled' => 1,
            'parent_id' => $indicators_tracking->id
        ]);

        $model->create([
            'label' => 'Avance de Proyectos',
            'slug' => 'index.project_tracking.execution',
            'icon' => 'map-signs',
            'weight' => 1202,
            'enabled' => 1,
            'parent_id' => $execution->id
        ]);

        // Reforms
        $reform = $model->create([
            'label' => 'Reformas y Reprogramaciones',
            'module_id' => Module::MODULE_GXR,
            'slug' => null,
            'icon' => 'wrench',
            'weight' => 1203,
            'enabled' => 1,
            'parent_id' => $execution->id
        ]);

        $model->create([
            'label' => 'Reformas',
            'slug' => 'index.reforms.reforms_reprogramming.execution',
            'icon' => 'wrench',
            'weight' => 12031,
            'enabled' => 1,
            'parent_id' => $reform->id
        ]);

        $model->create([
            'label' => 'Proyectos por Reformar',
            'slug' => 'index.budgetary.reforms.reforms_reprogramming.execution',
            'icon' => 'money',
            'weight' => 12032,
            'enabled' => 1,
            'parent_id' => $reform->id
        ]);

        $model->create([
            'label' => 'Reprogramación',
            'slug' => 'index.reprogramming.reforms_reprogramming.execution',
            'icon' => 'calendar',
            'weight' => 12033,
            'enabled' => 1,
            'parent_id' => $reform->id
        ]);

        // Structure
        $structure = $model->create([
            'label' => 'Gestión Estructura Programática',
            'module_id' => Module::MODULE_GXR,
            'slug' => null,
            'icon' => 'sitemap',
            'weight' => 1204,
            'enabled' => 1,
            'parent_id' => $execution->id
        ]);

        $model->create([
            'label' => 'Ingresos',
            'slug' => 'index.income.programmatic_structure.execution',
            'icon' => 'dollar',
            'weight' => 12041,
            'enabled' => 1,
            'parent_id' => $structure->id
        ]);

        $model->create([
            'label' => 'Gastos',
            'slug' => 'index.current_expenditure_elements.programmatic_structure.execution',
            'icon' => 'dollar',
            'weight' => 12042,
            'enabled' => 1,
            'parent_id' => $structure->id
        ]);

        $model->create([
            'label' => 'Proyectos',
            'slug' => 'index.project.programmatic_structure.execution',
            'icon' => 'product-hunt',
            'weight' => 12043,
            'enabled' => 1,
            'parent_id' => $structure->id
        ]);

        $model->create([
            'label' => 'Actividades Administrativas',
            'slug' => 'index.admin_activities.execution',
            'icon' => 'tasks',
            'weight' => 1205,
            'enabled' => 1,
            'parent_id' => $execution->id
        ]);

        $certification = $model->create([
            'label' => 'Certificaciones',
            'module_id' => Module::MODULE_GXR,
            'slug' => null,
            'icon' => 'certificate',
            'weight' => 1206,
            'enabled' => 1,
            'parent_id' => $execution->id
        ]);

        $model->create([
            'label' => 'POA',
            'slug' => 'index.certifications.execution',
            'icon' => 'certificate',
            'weight' => 1207,
            'enabled' => 1,
            'parent_id' => $certification->id
        ]);

        $model->create([
            'label' => 'Presupuestaria',
            'slug' => 'approved.certifications.execution',
            'icon' => 'certificate',
            'weight' => 1208,
            'enabled' => 1,
            'parent_id' => $certification->id
        ]);

        // Tracking
        $tracking = $model->create([
            'label' => 'Seguimiento',
            'module_id' => Module::MODULE_GXR,
            'slug' => null,
            'icon' => 'map-marker',
            'weight' => 1300,
            'enabled' => 1
        ]);

        $model->create([
            'label' => 'Resultados PDOT',
            'module_id' => Module::MODULE_GXR,
            'slug' => 'index.project_result_pdot.tracking',
            'icon' => 'fa fa-window-restore',
            'weight' => 1302,
            'enabled' => 1,
            'parent_id' => $tracking->id
        ]);

        $model->create([
            'label' => 'Resultados PEI',
            'module_id' => Module::MODULE_GXR,
            'slug' => 'index.project_result_pei.tracking',
            'icon' => 'fa fa-window-restore',
            'weight' => 1303,
            'enabled' => 1,
            'parent_id' => $tracking->id
        ]);

        $model->create([
            'label' => 'Planes Sectoriales',
            'module_id' => Module::MODULE_GXR,
            'slug' => 'index.sectoral.tracking',
            'icon' => 'university',
            'weight' => 1304,
            'enabled' => 1,
            'parent_id' => $tracking->id
        ]);

        $model->create([
            'label' => 'Objetivos Operativos',
            'module_id' => Module::MODULE_GXR,
            'slug' => 'index.operational_goals.tracking',
            'icon' => 'tasks',
            'weight' => 1305,
            'enabled' => 1,
            'parent_id' => $tracking->id
        ]);

        $model->create([
            'label' => 'Indicadores Proyectos',
            'module_id' => Module::MODULE_GXR,
            'slug' => 'index.project_indicators.tracking',
            'icon' => 'compass',
            'weight' => 1306,
            'enabled' => 1,
            'parent_id' => $tracking->id
        ]);

        $model->create([
            'label' => 'Componentes Proyectos',
            'module_id' => Module::MODULE_GXR,
            'slug' => 'index.project_components.tracking',
            'icon' => 'cubes',
            'weight' => 1307,
            'enabled' => 1,
            'parent_id' => $tracking->id
        ]);

        // Planning Reports
        $model->create([
            'label' => 'Reportes',
            'module_id' => 1,
            'slug' => 'index.reports',
            'icon' => 'pie-chart',
            'weight' => 3000,
            'enabled' => 1
        ]);

        $model->create([
            'label' => 'Repositorio Documentos',
            'module_id' => 1,
            'slug' => 'index.files',
            'icon' => 'files-o',
            'weight' => 5000,
            'enabled' => 1
        ]);


        //Vial module
        $management_roads = $model->create([
            'label' => 'Gestión Vial',
            'module_id' => Module::MODULE_ROADS,
            'slug' => null,
            'icon' => 'truck',
            'weight' => 1000,
            'enabled' => 1
        ]);

        $model->create([
            'label' => 'Inventario vial',
            'slug' => 'index.inventory_roads',
            'icon' => 'automobile',
            'weight' => 1001,
            'enabled' => 1,
            'parent_id' => $management_roads->id
        ]);

        $model->create([
            'label' => 'Archivo HDM4',
            'module_id' => Module::MODULE_ROADS,
            'slug' => 'index.hdm4_roads',
            'icon' => 'download',
            'weight' => 1003,
            'enabled' => 1,
            'parent_id' => $management_roads->id
        ]);

        $model->create([
            'label' => 'Shapes por Provincia',
            'module_id' => Module::MODULE_ROADS,
            'slug' => 'index.main_shape',
            'icon' => 'map-marker',
            'weight' => 1004,
            'enabled' => 1,
            'parent_id' => $management_roads->id
        ]);

        $model->create([
            'label' => 'Catálogos',
            'slug' => 'index.inventory_roads_catalogs',
            'icon' => 'list-ul',
            'weight' => 1005,
            'enabled' => 1,
            'parent_id' => $management_roads->id
        ]);

        $road_catalog = $model->create([
            'label' => 'Catálogos',
            'slug' => null,
            'icon' => 'list-ul',
            'weight' => 1002,
            'enabled' => 1,
            'parent_id' => $management_roads->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Alcantarilla',
            'slug' => 'index.sewer_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1100,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Capa de Rodadura de Puente',
            'slug' => 'index.bridge_rolling_layer.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1101,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Interconexión',
            'slug' => 'index.interconnection_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1102,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Carriles',
            'slug' => 'index.lanes.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1103,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Uso Vía',
            'slug' => 'index.track_usage.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1104,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Cuneta',
            'slug' => 'index.ditch_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1105,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Condiciones Climáticas',
            'slug' => 'index.weather_conditions.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1106,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Lado',
            'slug' => 'index.side.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1107,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Terreno',
            'slug' => 'index.terrain_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1108,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Protecciones Laterales',
            'slug' => 'index.side_protections.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1109,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Estado',
            'slug' => 'index.status.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1110,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Material de Alcantarilla',
            'slug' => 'index.sewer_material.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1111,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Superficie de Rodadura',
            'slug' => 'index.rolling_surface_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1112,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Material',
            'slug' => 'index.material_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1113,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Piso Climático',
            'slug' => 'index.climatic_floor.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1114,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Superficie de Rodadura',
            'slug' => 'index.rolling_surface.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1115,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Punto Crítico',
            'slug' => 'index.critical_point_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1116,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Drenaje',
            'slug' => 'index.drainage_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1117,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Sector Productivo',
            'slug' => 'index.productive_sector.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1118,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Fuente',
            'slug' => 'index.source.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1119,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Minas',
            'slug' => 'index.mines_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1120,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Estado de Drenaje',
            'slug' => 'index.drainage_status.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1121,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Señal Horizontal',
            'slug' => 'index.horizontal_signal_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1122,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Señal Vertical',
            'slug' => 'index.vertical_signal_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1123,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo Firme',
            'slug' => 'index.firm_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1124,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Población',
            'slug' => 'index.population_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1125,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Talud',
            'slug' => 'index.slope_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1126,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Servicio Asociado',
            'slug' => 'index.associated_service_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1127,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Necesidad de Conservación',
            'slug' => 'index.type_conservation_need.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1128,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Tipo de Día',
            'slug' => 'index.day_type.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1129,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Material de Minas',
            'slug' => 'index.mines_material.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1130,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);

        $model->create([
            'label' => 'Catálogo Servicios de Apoyo',
            'slug' => 'index.support_services.inventory_roads_catalogs',
            'icon' => 'road',
            'weight' => 1131,
            'enabled' => 1,
            'parent_id' => $road_catalog->id
        ]);				

        $model->create([
            'label' => 'Reportes Gestión Vial',
            'module_id' => Module::MODULE_ROADS,
            'slug' => 'index.inventory_roads_report',
            'icon' => 'pie-chart',
            'weight' => 3000,
            'enabled' => 1
        ]);

        // App module
        $model->create([
            'label' => 'Comentarios',
            'module_id' => Module::MODULE_APP,
            'slug' => 'index.reviews',
            'icon' => 'comments-o',
            'weight' => 1,
            'enabled' => 1
        ]);

        $model->create([
            'label' => 'Aprobar respuestas',
            'module_id' => Module::MODULE_APP,
            'slug' => 'approvals.reviews',
            'icon' => 'check-circle',
            'weight' => 5,
            'enabled' => 1
        ]);

        $model->create([
            'label' => 'Faqs',
            'module_id' => Module::MODULE_APP,
            'slug' => 'index.faqs',
            'icon' => 'question-circle',
            'weight' => 10,
            'enabled' => 1
        ]);

        $model->create([
            'label' => 'Áreas Temáticas',
            'module_id' => Module::MODULE_APP,
            'slug' => 'index.subjects',
            'icon' => 'cubes',
            'weight' => 20,
            'enabled' => 1
        ]);

    }
}
