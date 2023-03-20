<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_project_fiscal_years', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 3);
            $table->string('name', 400);
            $table->unsignedInteger('project_fiscal_year_id')->index();
            $table->unsignedInteger('area_id')->nullable()->index('activity_project_fiscal_years_area_id_fk');
            $table->unsignedInteger('component_id')->index('activity_project_fiscal_years_component_id_fk');
            $table->boolean('has_budget')->default(false);
            $table->date('date_init')->nullable();
            $table->date('date_end')->nullable();
            $table->integer('duration')->nullable();
            $table->enum('relevance', ['0', '1', '2', '3'])->nullable();
            $table->double('weight', 18, 16)->nullable();
            $table->double('weight_percentage', 6, 3)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('activity_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('admin_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->text('description')->nullable();
            $table->enum('status', ['DRAFT', 'IN_PROGRESS', 'COMPLETED', 'CANCELED'])->default('DRAFT');
            $table->string('qualification')->nullable();
            $table->enum('priority', ['1', '2', '3', '4'])->default('2');
            $table->date('date_init')->nullable();
            $table->date('date_end')->nullable();
            $table->json('check_list')->nullable();
            $table->double('planned_hours', 8, 2)->default(0);
            $table->double('time_spent', 8, 2)->default(0);
            $table->integer('responsible_unit_id')->index();
            $table->unsignedInteger('created_by_id')->index();
            $table->unsignedInteger('assigned_user_id')->nullable()->index();
            $table->unsignedInteger('fiscal_year_id')->index();
            $table->unsignedInteger('activity_type_id')->nullable()->index();
            $table->unsignedInteger('reason_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('area', 50);
            $table->string('code', 2)->unique();
        });

        Schema::create('budget_adjustment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('prioritization_id')->index();
            $table->enum('status', ['DRAFT', 'APPROVED'])->default('DRAFT');
            $table->timestamps();
        });

        Schema::create('budget_classifier_spendings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('parent_id')->nullable()->index('fk_budge_clasifier_budge_clasifier1_idx');
            $table->string('code', 45);
            $table->string('full_code', 45)->nullable();
            $table->text('title');
            $table->text('description');
            $table->integer('level')->default(1);
            $table->boolean('enabled')->default(true);
        });

        Schema::create('budget_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 250);
            $table->double('amount', 15, 2)->nullable();
            $table->double('last_total_reform', 15, 2)->nullable();
            $table->boolean('is_participatory_budget')->default(false);
            $table->boolean('is_public_purchase')->default(false);
            $table->unsignedInteger('activity_project_fiscal_year_id')->nullable()->index();
            $table->integer('budget_classifier_id')->nullable()->index();
            $table->integer('geographic_location_id')->nullable()->index();
            $table->integer('financing_source_id')->nullable()->index();
            $table->unsignedInteger('guide_spending_id')->nullable()->index('budget_items_guide_spending_id_foreign');
            $table->unsignedInteger('institution_id')->nullable()->index();
            $table->integer('loan_id')->nullable()->index();
            $table->unsignedInteger('operational_activity_id')->nullable()->index();
            $table->unsignedInteger('fiscal_year_id')->nullable()->index();
            $table->timestamps();
            $table->unsignedInteger('competence_id')->nullable()->index();
            $table->string('description', 500)->nullable();
            $table->text('name')->nullable();
            $table->string('status')->nullable();
        });

        Schema::create('budget_items_operations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_code')->comment('REF: codemp');
            $table->integer('year')->comment('REF: anio');
            $table->string('voucher_type')->comment('REF: sig_tip');
            $table->integer('number')->comment('REF: acu_tip: Secuencia por tipo de comprobante y ejercicio fiscal');
            $table->text('description')->nullable()->comment('REF: des_cab: Descripción de la operación');
            $table->double('total_debit', 15, 2)->default(0)->comment('REF: tot_deb');
            $table->double('total_credit', 15, 2)->default(0)->comment('REF: tot_cre');
            $table->date('date_assignment')->comment('REF: fec_asi: Fecha de creación');
            $table->date('date_approval')->comment('REF: fec_apr: Fecha de aprobación');
            $table->date('date_created')->comment('REF: fec_cre: Fecha del sistema');
            $table->string('created_by')->comment('REF: cre_por');
            $table->integer('status')->comment('REF: estado: 3 - Aprobado');
            $table->integer('period')->default(1)->comment('REF: periodo: 1');
            $table->timestamps();
        });

        Schema::create('budget_items_operations_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_code')->comment('REF: codemp');
            $table->integer('year')->comment('REF: anio');
            $table->string('voucher_type')->comment('REF: sig_tip');
            $table->integer('number')->comment('REF: acu_tip: Secuencia por tipo de comprobante y ejercicio fiscal');
            $table->integer('sequential')->comment('REF: sec_det: Secuencial del detalle');
            $table->string('code', 250)->comment('REF: cuenta: código de clasificador presupuestario');
            $table->double('income_amount', 15, 2)->default(0)->comment('REF: val_deb');
            $table->double('expense_amount', 15, 2)->default(0)->comment('REF: val_cre');
            $table->enum('type', ['1', '2'])->comment('REF: nro_che and asociac: detail type (1: expense, 2: income)');
            $table->integer('status')->comment('REF: estado: 3 - Aprobado');
            $table->integer('period')->default(1)->comment('REF: periodo: 1');
            $table->string('created_by')->comment('REF: cre_por');
            $table->timestamps();
        });

        Schema::create('budget_plannings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('month')->nullable();
            $table->double('assigned', 10, 2)->default(0);
            $table->unsignedInteger('budget_item_id')->nullable()->index();
            $table->unsignedInteger('public_purchase_id')->nullable()->index();
            $table->timestamps();
        });

        Schema::create('certifiables', function (Blueprint $table) {
            $table->unsignedInteger('certification_id')->index();
            $table->string('certifiable_type');
            $table->unsignedBigInteger('certifiable_id');
            $table->double('amount', 15, 2)->default(0);
            $table->timestamps();

            $table->index(['certifiable_type', 'certifiable_id']);
        });

        Schema::create('certifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->string('name', 60);
            $table->text('topic');
            $table->string('status', 100);
            $table->date('approved_at')->nullable();
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('activity_id')->index();
            $table->unsignedInteger('fiscal_year_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comment');
            $table->unsignedInteger('user_id')->index();
            $table->string('commentable_type');
            $table->unsignedBigInteger('commentable_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['commentable_type', 'commentable_id']);
        });

        Schema::create('competences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 45);
            $table->string('name', 150);
        });

        Schema::create('components', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->index('components_project_id_fk');
            $table->string('name', 500)->nullable();
            $table->text('assumptions')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cpc_classifiers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('code', 45);
            $table->text('description');
            $table->boolean('enabled')->default(true);
        });

        Schema::create('current_expenditure_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable()->index();
            $table->unsignedInteger('fiscal_year_id')->index();
            $table->unsignedInteger('area_id')->nullable()->index();
            $table->string('code', 45);
            $table->string('name', 512);
            $table->enum('type', ['PROGRAM', 'SUBPROGRAM']);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('department_has_users', function (Blueprint $table) {
            $table->integer('department_id')->index('fk_departments_has_users_departments1_idx');
            $table->unsignedInteger('user_id')->index('fk_departments_has_users_users1_idx');
            $table->boolean('is_manager')->default(false);

            $table->primary(['department_id', 'user_id', 'is_manager']);
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 200)->nullable();
            $table->string('description')->nullable();
            $table->boolean('enabled')->nullable()->default(true);
            $table->integer('parent_id')->nullable()->index('fk_department_department1_idx');
            $table->string('phone_number', 45)->nullable();
            $table->string('code', 3)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('fk_files_users_idx');
            $table->string('name', 128);
            $table->text('description')->nullable();
            $table->string('version', 16)->nullable();
            $table->string('path', 128);
            $table->boolean('is_road')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->string('fileable_type')->nullable();
            $table->unsignedBigInteger('fileable_id')->nullable();

            $table->index(['fileable_type', 'fileable_id']);
        });

        Schema::create('financing_source_classifiers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('code', 45);
            $table->string('description');
            $table->boolean('enabled')->default(true);
        });

        Schema::create('fiscal_years', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year');
            $table->boolean('enabled')->default(true);
        });

        Schema::create('geographic_location_classifiers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('parent_id')->nullable()->index('fk_geographic_location_classifier_geographic_location_class_idx');
            $table->string('code', 45);
            $table->string('description')->nullable();
            $table->enum('type', ['CANTON', 'PARISH']);
            $table->boolean('enabled')->default(true);
            $table->boolean('app')->nullable();
        });

        Schema::create('guide_spending_classifiers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable()->index('fk_guide_spending_classifiers_guide_spending_classifiers1_idx');
            $table->string('code', 45);
            $table->string('full_code', 45)->nullable();
            $table->string('description', 512);
            $table->integer('level')->default(1);
            $table->boolean('enabled')->default(true);
        });

        Schema::create('hiring_modalities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('enabled');
            $table->timestamps();
        });

        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 250);
            $table->unsignedInteger('fiscal_year_id')->index('fk_incomes_fiscal_year');
            $table->integer('budget_classifier_id')->index('fk_incomes_budget_classifier');
            $table->integer('financing_source_id')->index('fk_incomes_financing_source');
            $table->unsignedInteger('institution_id')->nullable()->index('fk_incomes_institution');
            $table->integer('loan_id')->nullable()->index('fk_incomes_budget_classifier2');
            $table->text('justification')->nullable();
            $table->text('legal_base')->nullable();
            $table->double('value', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->string('distributor_code', 2)->nullable();
            $table->string('distributor_name', 200)->nullable();
        });

        Schema::create('institutions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 8);
            $table->string('name', 256);
            $table->boolean('enabled')->default(true);
            $table->softDeletes();
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('justifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('fk_justifications_users');
            $table->text('description');
            $table->string('action', 16);
            $table->string('path', 128);
            $table->string('document_reference', 64);
            $table->timestamps();
            $table->softDeletes();
            $table->string('justifiable_type');
            $table->unsignedBigInteger('justifiable_id');

            $table->index(['justifiable_type', 'justifiable_id']);
        });

        Schema::create('ledgers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_type')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('recordable_type');
            $table->unsignedBigInteger('recordable_id');
            $table->unsignedTinyInteger('context');
            $table->string('event');
            $table->text('properties');
            $table->text('modified');
            $table->text('pivot');
            $table->text('extra');
            $table->text('url')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->string('signature');
            $table->timestamps();

            $table->index(['recordable_type', 'recordable_id']);
            $table->index(['user_id', 'user_type']);
        });

        Schema::create('links', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedInteger('parent_indicator')->index();
            $table->unsignedInteger('child_indicator')->index();
        });

        Schema::create('measure_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('abbreviation');
            $table->boolean('is_cpc')->default(false);
            $table->boolean('enabled')->default(true);
            $table->softDeletes();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('module_id')->nullable()->index('fk_menus_modules_idx');
            $table->unsignedInteger('parent_id')->nullable()->index();
            $table->string('label', 50);
            $table->string('slug', 100)->nullable();
            $table->string('icon', 50)->nullable();
            $table->string('role', 100)->nullable();
            $table->integer('weight')->default(0);
            $table->boolean('enabled')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('enabled')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        
        Schema::create('operational_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('current_expenditure_element_id')->nullable()->index();
            $table->string('code', 45)->nullable();
            $table->string('name', 512)->nullable();
            $table->integer('responsible_unit_id')->nullable()->index();
            $table->integer('executing_unit_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('operational_goals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_element_id')->nullable()->index('operational_goals_plan_elements_fk');
            $table->unsignedInteger('fiscal_year_id')->nullable()->index('operational_goals_fiscal_years_fk');
            $table->string('code', 45);
            $table->string('name', 512);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('permission_id')->index();
            $table->unsignedInteger('role_id')->index();
            $table->timestamps();
        });

        Schema::create('permission_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('permission_id')->index();
            $table->unsignedInteger('user_id')->index();
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('module_id')->nullable()->index('fk_permissions_modules_idx');
            $table->unsignedInteger('inherit_id')->nullable()->index();
            $table->string('name')->index();
            $table->string('label')->nullable();
            $table->json('slug');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('plan_elements', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('plan_id')->index('fk_plan_element_plan1_idx');
            $table->integer('parent_id')->nullable()->index('fk_plan_elements_plan_elements1_idx');
            $table->text('description')->comment('Los plan elements pueden ser Ejes, Objetivos, Políticas o Metas. La forma en que van a ser articulados va a ser por medio de la tabla Links.');
            $table->string('code', 45);
            $table->enum('type', ['THRUST', 'OBJECTIVE', 'STRATEGY', 'POLICY', 'PROGRAM', 'SUBPROGRAM', 'RISK']);
            $table->text('product')->nullable();
            $table->text('production_goal')->nullable();
            $table->enum('dimension', ['VALUE_PUBLIC', 'PROCESS', 'BUDGET', 'HUMAN_TALENT'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('plan_indicator_goals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('plan_indicator_id')->index('plan_indicator_goals_plan_indicator_id_foreign');
            $table->double('goal_value', 15, 2)->nullable();
            $table->double('min', 15, 2)->nullable();
            $table->double('max', 15, 2)->nullable();
            $table->double('actual_value', 15, 2)->nullable();
            $table->integer('period');
            $table->unsignedInteger('actual_value_user_id')->index('plan_indicator_goals_actual_value_user_id_foreign');
            $table->integer('year')->nullable();
            $table->timestamps();
        });

        Schema::create('plan_indicators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->integer('measuring_unit')->nullable();
            $table->string('technical_file', 100)->nullable();
            $table->text('calculation_formula')->nullable();
            $table->double('base_line', 15, 2)->nullable();
            $table->integer('base_line_year')->nullable();
            $table->double('goal', 15, 2)->nullable();
            $table->text('goal_description');
            $table->text('source')->nullable();
            $table->enum('type', ['ascending', 'descending', 'tolerance'])->nullable();
            $table->enum('goal_type', ['discreet', 'accumulated'])->nullable();
            $table->integer('measurement_frequency_per_year')->nullable();
            $table->enum('status', ['draft', 'approved', 'rejected', 'fixed']);
            $table->text('rejected_comments')->nullable();
            $table->unsignedInteger('creator_user_id')->nullable()->index('plan_indicators_creator_user_id_foreign');
            $table->unsignedInteger('approval_user_id')->nullable()->index('plan_indicators_approval_user_id_foreign');
            $table->unsignedInteger('measure_unit_id')->nullable()->index();
            $table->string('indicatorable_type');
            $table->unsignedBigInteger('indicatorable_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['indicatorable_type', 'indicatorable_id']);
        });

        Schema::create('plans', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 150);
            $table->text('vision');
            $table->text('mission')->nullable();
            $table->enum('scope', ['SUPRANATIONAL', 'NATIONAL', 'TERRITORIAL', 'INSTITUTIONAL']);
            $table->enum('type', ['ODS', 'PND', 'PDOT', 'SECTORAL', 'PEI', 'OTHER']);
            $table->integer('start_year');
            $table->integer('end_year');
            $table->enum('status', ['DRAFT', 'VERIFIED', 'APPROVED', 'ARCHIVED'])->default('DRAFT');
            $table->boolean('incoming_plan')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('prioritization_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable()->index();
            $table->unsignedInteger('fiscal_year_id')->nullable()->index();
            $table->text('description')->nullable();
            $table->json('configuration');
            $table->enum('status', ['DEFAULT', 'ENABLED', 'BLOCKED'])->default('ENABLED');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('prioritizations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_fiscal_year_id')->index();
            $table->json('configuration');
            $table->double('value', 6, 2);
            $table->timestamps();
        });

        Schema::create('procedures', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('regime_type', ['COMÚN', 'ESPECIAL', 'PROCEDIMIENTOS ESPECIALES']);
            $table->string('hiring_type')->nullable();
            $table->string('name', 200);
            $table->boolean('normalized')->nullable();
            $table->double('min', 15, 2)->nullable();
            $table->double('max', 15, 2)->nullable();
        });

        Schema::create('proformas', function (Blueprint $table) {
            $table->string('company_code', 4);
            $table->integer('year');
            $table->string('code', 250);
            $table->enum('type', ['1', '2']);
            $table->string('description', 512);
            $table->enum('last_level', ['S', 'N'])->default('N');
            $table->integer('level');
            $table->string('parent_code', 64);
            $table->string('created_by', 256);
            $table->timestamps();
        });

        Schema::create('project_fiscal_years', function (Blueprint $table) {
            $table->increments('id');
            $table->double('referential_budget', 15, 2);
            $table->unsignedInteger('project_id')->index();
            $table->unsignedInteger('fiscal_year_id')->index();
            $table->enum('status', ['DRAFT', 'TO_REVIEW', 'REJECTED', 'REVIEWED', 'IN_PROGRESS'])->default('DRAFT');
            $table->double('total_reform', 15, 2)->default(0);
            $table->date('reform_date')->nullable();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200)->nullable();
            $table->string('cup', 45)->nullable();
            $table->string('full_cup', 45)->nullable();
            $table->text('description')->nullable();
            $table->string('zone', 100)->nullable();
            $table->text('qualitative_benefit')->nullable();
            $table->text('purpose')->nullable();
            $table->text('assumptions')->nullable();
            $table->date('date_init')->nullable();
            $table->date('date_end')->nullable();
            $table->double('referential_budget', 15, 2)->nullable();
            $table->double('month_duration', 8, 2)->nullable();
            $table->string('execution_term', 45)->nullable();
            $table->unsignedInteger('operational_goal_id')->nullable()->index('projects_operational_goals_fk');
            $table->integer('responsible_unit_id')->nullable()->index();
            $table->integer('executing_unit_id')->nullable()->index();
            $table->integer('plan_element_id')->nullable()->index('projects_plan_element_id_fk');
            $table->boolean('is_road')->default(false);
            $table->text('requirements')->nullable();
            $table->text('product_description_service')->nullable();
            $table->text('approval_criteria')->nullable();
            $table->text('general_risks')->nullable();
            $table->integer('phase')->default(1);
            $table->double('tir', 15, 2)->nullable();
            $table->double('van', 15, 2)->nullable();
            $table->text('benefit_cost')->nullable();
            $table->enum('status', ['DRAFT', 'IN_PROGRESS', 'CANCELLED', 'CLOSED', 'COMPLETED', 'SUSPENDED'])->default('DRAFT');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('project_related_id')->nullable()->index();
        });

        Schema::create('public_purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cpc_id')->nullable()->index();
            $table->unsignedInteger('budget_item_id')->nullable()->index();
            $table->unsignedInteger('procedure_id')->nullable()->index();
            $table->boolean('is_international_fund')->default(false);
            $table->enum('regime_type', ['COMÚN', 'ESPECIAL', 'PROCEDIMIENTOS ESPECIALES']);
            $table->enum('budget_type', ['CORRIENTE', 'INVERSIÓN']);
            $table->enum('hiring_type', ['BIEN', 'OBRA', 'SERVICIO', 'CONSULTORÍA']);
            $table->unsignedInteger('measure_unit_id')->nullable()->index();
            $table->double('quantity', 15, 2)->nullable();
            $table->double('amount', 15, 2)->nullable();
            $table->double('amount_no_vat', 15, 2)->nullable();
            $table->string('c1', 1)->nullable();
            $table->string('c2', 1)->nullable();
            $table->string('c3', 1)->nullable();
            $table->timestamps();
            $table->string('description', 200)->nullable();
        });

        Schema::create('reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('type', ['CANCEL']);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('rejects', function (Blueprint $table) {
            $table->increments('id');
            $table->text('observations');
            $table->unsignedInteger('user_id')->index('fk_rejects_users');
            $table->unsignedBigInteger('rejectable_id');
            $table->string('rejectable_type');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['rejectable_type', 'rejectable_id'], 'rejects_rejectable_id_rejectable_type_index');
        });

        Schema::create('reprogramming', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->string('description', 200);
            $table->enum('status', ['DRAFT', 'APPROVED'])->default('DRAFT');
            $table->unsignedInteger('project_fiscal_year_id')->index();
            $table->date('approved_date')->nullable();
            $table->timestamps();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('enabled')->default(true);
            $table->boolean('editable')->default(true);
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 50);
            $table->json('value');
            $table->text('description')->nullable();
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });

        Schema::create('staff_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('meeting_id')->nullable()->index();
            $table->unsignedInteger('parent_id')->nullable()->index();
            $table->string('name', 500);
            $table->string('status', 20)->default('PENDIENTE');
            $table->string('type', 20);
            $table->boolean('is_extra')->default(false);
            $table->timestamps();
            $table->date('date_end')->nullable();
            $table->string('scope')->nullable();
            $table->boolean('requires_media_coverage')->default(false);
            $table->boolean('is_public_purchase')->default(false);
        });

        Schema::create('staff_activity_institutions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('activity_id')->index();
            $table->unsignedInteger('institution_id')->index();
        });

        Schema::create('staff_meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('week');
            $table->integer('department_id')->index();
            $table->string('status', 20)->default('PENDIENTE');
            $table->date('start');
            $table->date('end');
            $table->double('physical_progress', 8, 2)->nullable();
            $table->double('budget_progress', 8, 2)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('staff_related_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('activity_id')->index();
            $table->string('relatable_type');
            $table->unsignedBigInteger('relatable_id');

            $table->index(['relatable_type', 'relatable_id']);
        });

        Schema::create('taggables', function (Blueprint $table) {
            $table->unsignedInteger('tag_id')->index();
            $table->string('taggable_type');
            $table->unsignedBigInteger('taggable_id');

            $table->unique(['tag_id', 'taggable_id', 'taggable_type']);
            $table->index(['taggable_type', 'taggable_id']);
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->string('type', 50)->nullable();
            $table->string('color', 10)->nullable();
            $table->timestamps();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('activity_project_fiscal_year_id')->index('task_activity_fiscal_years_activity_project_fiscal_year_fk');
            $table->unsignedInteger('approval_user_id')->nullable()->index('fk_tasks_users');
            $table->string('name', 250);
            $table->enum('type', ['TASK', 'MILESTONE']);
            $table->date('date_init')->nullable();
            $table->date('date_end')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('duration')->nullable();
            $table->double('weight_percentage', 5, 2)->nullable();
            $table->integer('beneficiaries')->nullable();
            $table->enum('status', ['PENDING', 'TO_REVIEW', 'REJECTED', 'COMPLETED_ONTIME', 'COMPLETED_OUTOFTIME'])->default('PENDING');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('thresholds', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['ascending', 'descending', 'tolerance']);
            $table->enum('color', ['danger', 'warning', 'success']);
            $table->double('min', 10, 4)->nullable();
            $table->double('max', 10, 4)->nullable();
            $table->timestamps();
        });

        Schema::create('user_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->text('description')->nullable();
            $table->timestamp('date_at')->useCurrent();
            $table->boolean('is_completed')->default(false);
            $table->boolean('is_important')->default(false);
            $table->integer('rating')->default(0);
            $table->unsignedInteger('user_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->string('type', 50)->nullable();
            $table->float('work_time', 10, 0)->nullable()->default(0);
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 20);
            $table->string('email', 75)->nullable();
            $table->string('username', 45);
            $table->string('password');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('photo')->nullable();
            $table->boolean('enabled')->default(true);
            $table->string('institution', 50)->nullable();
            $table->enum('identification_type', ['ced', 'other']);
            $table->boolean('changed_password')->default(false);
            $table->rememberToken();
            $table->unsignedInteger('hiring_modality_id')->nullable()->index('users_hiring_modalities_fk');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users_manages_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->index('fk_users_manages_activities_users');
            $table->unsignedInteger('activity_project_fiscal_year_id')->nullable()->index('users_manages_fk_activities_activity_project_fiscal_year');
            $table->boolean('active')->nullable();
            $table->date('date_init')->nullable();
            $table->date('date_end')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users_manages_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->index();
            $table->unsignedInteger('project_id')->nullable()->index();
            $table->boolean('active')->nullable()->default(true);
            $table->date('date_init')->nullable();
            $table->date('date_end')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users_manages_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->index('users_manages_tasks_user_fk');
            $table->unsignedInteger('task_id')->nullable()->index('users_manages_tasks_task_activity_fiscal_year_fk');
            $table->boolean('active')->nullable();
            $table->date('date_init')->nullable();
            $table->date('date_end')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('activity_project_fiscal_years', function (Blueprint $table) {
            $table->foreign(['area_id'], 'activity_project_fiscal_years_area_id_fk')->references(['id'])->on('areas');
            $table->foreign(['component_id'], 'activity_project_fiscal_years_component_id_fk')->references(['id'])->on('components');
            $table->foreign(['project_fiscal_year_id'])->references(['id'])->on('project_fiscal_years')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('admin_activities', function (Blueprint $table) {
            $table->foreign(['activity_type_id'])->references(['id'])->on('activity_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['assigned_user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['created_by_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['fiscal_year_id'])->references(['id'])->on('fiscal_years')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['reason_id'])->references(['id'])->on('reasons')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['responsible_unit_id'])->references(['id'])->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('budget_adjustment', function (Blueprint $table) {
            $table->foreign(['prioritization_id'], 'fk_prioritizations')->references(['id'])->on('prioritizations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('budget_classifier_spendings', function (Blueprint $table) {
            $table->foreign(['parent_id'], 'fk_budge_clasifier_budge_clasifier1')->references(['id'])->on('budget_classifier_spendings')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('budget_items', function (Blueprint $table) {
            $table->foreign(['activity_project_fiscal_year_id'])->references(['id'])->on('activity_project_fiscal_years')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['budget_classifier_id'])->references(['id'])->on('budget_classifier_spendings')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['competence_id'], 'budget_items_competence_id_fk')->references(['id'])->on('competences')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['financing_source_id'])->references(['id'])->on('financing_source_classifiers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['fiscal_year_id'])->references(['id'])->on('fiscal_years')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['geographic_location_id'])->references(['id'])->on('geographic_location_classifiers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['guide_spending_id'])->references(['id'])->on('guide_spending_classifiers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['institution_id'])->references(['id'])->on('institutions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['loan_id'])->references(['id'])->on('budget_classifier_spendings')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['operational_activity_id'])->references(['id'])->on('operational_activities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('budget_plannings', function (Blueprint $table) {
            $table->foreign(['budget_item_id'])->references(['id'])->on('budget_items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['public_purchase_id'])->references(['id'])->on('public_purchases')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('certifiables', function (Blueprint $table) {
            $table->foreign(['certification_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('certifications', function (Blueprint $table) {
            $table->foreign(['activity_id'])->references(['id'])->on('activity_project_fiscal_years')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['fiscal_year_id'])->references(['id'])->on('fiscal_years')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('components', function (Blueprint $table) {
            $table->foreign(['project_id'], 'components_project_id_fk')->references(['id'])->on('projects');
        });

        Schema::table('current_expenditure_elements', function (Blueprint $table) {
            $table->foreign(['area_id'], 'fk_current_expenditure_elements_areas')->references(['id'])->on('areas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['parent_id'], 'fk_current_expenditure_elements_current_expenditure_elements1')->references(['id'])->on('current_expenditure_elements')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['fiscal_year_id'], 'fk_current_expenditure_elements_fiscal_years1')->references(['id'])->on('fiscal_years')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('department_has_users', function (Blueprint $table) {
            $table->foreign(['department_id'], 'fk_departments_has_users_departments1')->references(['id'])->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_id'], 'fk_departments_has_users_users1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->foreign(['parent_id'], 'fk_department_department1')->references(['id'])->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('files', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_files_users')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('geographic_location_classifiers', function (Blueprint $table) {
            $table->foreign(['parent_id'], 'fk_geographic_location_classifier_geographic_location_classif1')->references(['id'])->on('geographic_location_classifiers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('guide_spending_classifiers', function (Blueprint $table) {
            $table->foreign(['parent_id'], 'fk_guide_spending_classifiers_guide_spending_classifiers1')->references(['id'])->on('guide_spending_classifiers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->foreign(['budget_classifier_id'], 'fk_incomes_budget_classifier')->references(['id'])->on('budget_classifier_spendings')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['loan_id'], 'fk_incomes_budget_classifier2')->references(['id'])->on('budget_classifier_spendings')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['financing_source_id'], 'fk_incomes_financing_source')->references(['id'])->on('financing_source_classifiers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['fiscal_year_id'], 'fk_incomes_fiscal_year')->references(['id'])->on('fiscal_years')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['institution_id'], 'fk_incomes_institution')->references(['id'])->on('institutions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('justifications', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_justifications_users')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('links', function (Blueprint $table) {
            $table->foreign(['parent_indicator'], 'links_indicators1_fk')->references(['id'])->on('plan_indicators')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['child_indicator'], 'links_indicators2_fk')->references(['id'])->on('plan_indicators')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->foreign(['module_id'], 'fk_menus_modules')->references(['id'])->on('modules')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('operational_activities', function (Blueprint $table) {
            $table->foreign(['current_expenditure_element_id'], 'fk_operational_activities_current_expenditure_elements1')->references(['id'])->on('current_expenditure_elements')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['responsible_unit_id'], 'fk_operational_activities_departments1')->references(['id'])->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['executing_unit_id'], 'fk_operational_activities_departments2')->references(['id'])->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('operational_goals', function (Blueprint $table) {
            $table->foreign(['fiscal_year_id'], 'operational_goals_fiscal_years_fk')->references(['id'])->on('fiscal_years');
            $table->foreign(['plan_element_id'], 'operational_goals_plan_elements_fk')->references(['id'])->on('plan_elements');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->foreign(['module_id'], 'fk_permissions_modules')->references(['id'])->on('modules')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('plan_elements', function (Blueprint $table) {
            $table->foreign(['parent_id'], 'fk_plan_elements_plan_elements1')->references(['id'])->on('plan_elements')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['plan_id'], 'fk_plan_element_plan1')->references(['id'])->on('plans')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('plan_indicator_goals', function (Blueprint $table) {
            $table->foreign(['actual_value_user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['plan_indicator_id'])->references(['id'])->on('plan_indicators')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('plan_indicators', function (Blueprint $table) {
            $table->foreign(['approval_user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['creator_user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['measure_unit_id'])->references(['id'])->on('measure_units')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('prioritization_templates', function (Blueprint $table) {
            $table->foreign(['fiscal_year_id'], 'fk_prioritization_templates_fiscal_years')->references(['id'])->on('fiscal_years')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['parent_id'], 'fk_prioritization_templates_prioritization_templates')->references(['id'])->on('prioritization_templates')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('prioritizations', function (Blueprint $table) {
            $table->foreign(['project_fiscal_year_id'], 'fk_prioritizations_project_fiscal_years')->references(['id'])->on('project_fiscal_years')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('project_fiscal_years', function (Blueprint $table) {
            $table->foreign(['fiscal_year_id'])->references(['id'])->on('fiscal_years')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['project_id'])->references(['id'])->on('projects')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreign(['executing_unit_id'])->references(['id'])->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['operational_goal_id'], 'projects_operational_goals_fk')->references(['id'])->on('operational_goals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['plan_element_id'], 'projects_plan_element_id_fk')->references(['id'])->on('plan_elements')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['project_related_id'])->references(['id'])->on('projects')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['responsible_unit_id'])->references(['id'])->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('public_purchases', function (Blueprint $table) {
            $table->foreign(['budget_item_id'])->references(['id'])->on('budget_items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['cpc_id'])->references(['id'])->on('cpc_classifiers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['measure_unit_id'])->references(['id'])->on('measure_units')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['procedure_id'])->references(['id'])->on('procedures')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('rejects', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_rejects_users')->references(['id'])->on('users');
        });

        Schema::table('staff_activities', function (Blueprint $table) {
            $table->foreign(['meeting_id'])->references(['id'])->on('staff_meetings')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['parent_id'])->references(['id'])->on('staff_activities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('staff_activity_institutions', function (Blueprint $table) {
            $table->foreign(['activity_id'])->references(['id'])->on('staff_activities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['institution_id'])->references(['id'])->on('institutions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('staff_meetings', function (Blueprint $table) {
            $table->foreign(['department_id'])->references(['id'])->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('staff_related_activities', function (Blueprint $table) {
            $table->foreign(['activity_id'])->references(['id'])->on('staff_activities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign(['approval_user_id'], 'fk_tasks_users')->references(['id'])->on('users');
            $table->foreign(['activity_project_fiscal_year_id'], 'task_activity_fiscal_years_activity_project_fiscal_year_fk')->references(['id'])->on('activity_project_fiscal_years')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('user_tasks', function (Blueprint $table) {
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('users_manages_activities', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_users_manages_activities_users')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['activity_project_fiscal_year_id'], 'users_manages_fk_activities_activity_project_fiscal_year')->references(['id'])->on('activity_project_fiscal_years')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('users_manages_projects', function (Blueprint $table) {
            $table->foreign(['project_id'])->references(['id'])->on('projects')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('users_manages_tasks', function (Blueprint $table) {
            $table->foreign(['task_id'], 'users_manages_tasks_task_activity_fiscal_year_fk')->references(['id'])->on('tasks')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_id'], 'users_manages_tasks_user_fk')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_manages_tasks', function (Blueprint $table) {
            $table->dropForeign('users_manages_tasks_task_activity_fiscal_year_fk');
            $table->dropForeign('users_manages_tasks_user_fk');
        });

        Schema::table('users_manages_projects', function (Blueprint $table) {
            $table->dropForeign('users_manages_projects_project_id_foreign');
            $table->dropForeign('users_manages_projects_user_id_foreign');
        });

        Schema::table('users_manages_activities', function (Blueprint $table) {
            $table->dropForeign('fk_users_manages_activities_users');
            $table->dropForeign('users_manages_fk_activities_activity_project_fiscal_year');
        });

        Schema::table('user_tasks', function (Blueprint $table) {
            $table->dropForeign('user_tasks_user_id_foreign');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('fk_tasks_users');
            $table->dropForeign('task_activity_fiscal_years_activity_project_fiscal_year_fk');
        });

        Schema::table('staff_related_activities', function (Blueprint $table) {
            $table->dropForeign('staff_related_activities_activity_id_foreign');
        });

        Schema::table('staff_meetings', function (Blueprint $table) {
            $table->dropForeign('staff_meetings_department_id_foreign');
        });

        Schema::table('staff_activity_institutions', function (Blueprint $table) {
            $table->dropForeign('staff_activity_institutions_activity_id_foreign');
            $table->dropForeign('staff_activity_institutions_institution_id_foreign');
        });

        Schema::table('staff_activities', function (Blueprint $table) {
            $table->dropForeign('staff_activities_meeting_id_foreign');
            $table->dropForeign('staff_activities_parent_id_foreign');
        });

        Schema::table('rejects', function (Blueprint $table) {
            $table->dropForeign('fk_rejects_users');
        });

        Schema::table('public_purchases', function (Blueprint $table) {
            $table->dropForeign('public_purchases_budget_item_id_foreign');
            $table->dropForeign('public_purchases_cpc_id_foreign');
            $table->dropForeign('public_purchases_measure_unit_id_foreign');
            $table->dropForeign('public_purchases_procedure_id_foreign');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_executing_unit_id_foreign');
            $table->dropForeign('projects_operational_goals_fk');
            $table->dropForeign('projects_plan_element_id_fk');
            $table->dropForeign('projects_project_related_id_foreign');
            $table->dropForeign('projects_responsible_unit_id_foreign');
        });

        Schema::table('project_fiscal_years', function (Blueprint $table) {
            $table->dropForeign('project_fiscal_years_fiscal_year_id_foreign');
            $table->dropForeign('project_fiscal_years_project_id_foreign');
        });

        Schema::table('prioritizations', function (Blueprint $table) {
            $table->dropForeign('fk_prioritizations_project_fiscal_years');
        });

        Schema::table('prioritization_templates', function (Blueprint $table) {
            $table->dropForeign('fk_prioritization_templates_fiscal_years');
            $table->dropForeign('fk_prioritization_templates_prioritization_templates');
        });

        Schema::table('plan_indicators', function (Blueprint $table) {
            $table->dropForeign('plan_indicators_approval_user_id_foreign');
            $table->dropForeign('plan_indicators_creator_user_id_foreign');
            $table->dropForeign('plan_indicators_measure_unit_id_foreign');
        });

        Schema::table('plan_indicator_goals', function (Blueprint $table) {
            $table->dropForeign('plan_indicator_goals_actual_value_user_id_foreign');
            $table->dropForeign('plan_indicator_goals_plan_indicator_id_foreign');
        });

        Schema::table('plan_elements', function (Blueprint $table) {
            $table->dropForeign('fk_plan_elements_plan_elements1');
            $table->dropForeign('fk_plan_element_plan1');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign('fk_permissions_modules');
        });

        Schema::table('operational_goals', function (Blueprint $table) {
            $table->dropForeign('operational_goals_fiscal_years_fk');
            $table->dropForeign('operational_goals_plan_elements_fk');
        });

        Schema::table('operational_activities', function (Blueprint $table) {
            $table->dropForeign('fk_operational_activities_current_expenditure_elements1');
            $table->dropForeign('fk_operational_activities_departments1');
            $table->dropForeign('fk_operational_activities_departments2');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign('fk_menus_modules');
        });

        Schema::table('links', function (Blueprint $table) {
            $table->dropForeign('links_indicators1_fk');
            $table->dropForeign('links_indicators2_fk');
        });

        Schema::table('justifications', function (Blueprint $table) {
            $table->dropForeign('fk_justifications_users');
        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->dropForeign('fk_incomes_budget_classifier');
            $table->dropForeign('fk_incomes_budget_classifier2');
            $table->dropForeign('fk_incomes_financing_source');
            $table->dropForeign('fk_incomes_fiscal_year');
            $table->dropForeign('fk_incomes_institution');
        });

        Schema::table('guide_spending_classifiers', function (Blueprint $table) {
            $table->dropForeign('fk_guide_spending_classifiers_guide_spending_classifiers1');
        });

        Schema::table('geographic_location_classifiers', function (Blueprint $table) {
            $table->dropForeign('fk_geographic_location_classifier_geographic_location_classif1');
        });

        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign('fk_files_users');
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign('fk_department_department1');
        });

        Schema::table('department_has_users', function (Blueprint $table) {
            $table->dropForeign('fk_departments_has_users_departments1');
            $table->dropForeign('fk_departments_has_users_users1');
        });

        Schema::table('current_expenditure_elements', function (Blueprint $table) {
            $table->dropForeign('fk_current_expenditure_elements_areas');
            $table->dropForeign('fk_current_expenditure_elements_current_expenditure_elements1');
            $table->dropForeign('fk_current_expenditure_elements_fiscal_years1');
        });

        Schema::table('components', function (Blueprint $table) {
            $table->dropForeign('components_project_id_fk');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_user_id_foreign');
        });

        Schema::table('certifications', function (Blueprint $table) {
            $table->dropForeign('certifications_activity_id_foreign');
            $table->dropForeign('certifications_fiscal_year_id_foreign');
            $table->dropForeign('certifications_user_id_foreign');
        });

        Schema::table('certifiables', function (Blueprint $table) {
            $table->dropForeign('certifiables_certification_id_foreign');
        });

        Schema::table('budget_plannings', function (Blueprint $table) {
            $table->dropForeign('budget_plannings_budget_item_id_foreign');
            $table->dropForeign('budget_plannings_public_purchase_id_foreign');
        });

        Schema::table('budget_items', function (Blueprint $table) {
            $table->dropForeign('budget_items_activity_project_fiscal_year_id_foreign');
            $table->dropForeign('budget_items_budget_classifier_id_foreign');
            $table->dropForeign('budget_items_competence_id_fk');
            $table->dropForeign('budget_items_financing_source_id_foreign');
            $table->dropForeign('budget_items_fiscal_year_id_foreign');
            $table->dropForeign('budget_items_geographic_location_id_foreign');
            $table->dropForeign('budget_items_guide_spending_id_foreign');
            $table->dropForeign('budget_items_institution_id_foreign');
            $table->dropForeign('budget_items_loan_id_foreign');
            $table->dropForeign('budget_items_operational_activity_id_foreign');
        });

        Schema::table('budget_classifier_spendings', function (Blueprint $table) {
            $table->dropForeign('fk_budge_clasifier_budge_clasifier1');
        });

        Schema::table('budget_adjustment', function (Blueprint $table) {
            $table->dropForeign('fk_prioritizations');
        });

        Schema::table('admin_activities', function (Blueprint $table) {
            $table->dropForeign('admin_activities_activity_type_id_foreign');
            $table->dropForeign('admin_activities_assigned_user_id_foreign');
            $table->dropForeign('admin_activities_created_by_id_foreign');
            $table->dropForeign('admin_activities_fiscal_year_id_foreign');
            $table->dropForeign('admin_activities_reason_id_foreign');
            $table->dropForeign('admin_activities_responsible_unit_id_foreign');
        });

        Schema::table('activity_project_fiscal_years', function (Blueprint $table) {
            $table->dropForeign('activity_project_fiscal_years_area_id_fk');
            $table->dropForeign('activity_project_fiscal_years_component_id_fk');
            $table->dropForeign('activity_project_fiscal_years_project_fiscal_year_id_foreign');
        });

        Schema::dropIfExists('users_manages_tasks');

        Schema::dropIfExists('users_manages_projects');

        Schema::dropIfExists('users_manages_activities');

        Schema::dropIfExists('users');

        Schema::dropIfExists('user_tasks');

        Schema::dropIfExists('thresholds');

        Schema::dropIfExists('tasks');

        Schema::dropIfExists('tags');

        Schema::dropIfExists('taggables');

        Schema::dropIfExists('staff_related_activities');

        Schema::dropIfExists('staff_meetings');

        Schema::dropIfExists('staff_activity_institutions');

        Schema::dropIfExists('staff_activities');

        Schema::dropIfExists('settings');

        Schema::dropIfExists('roles');

        Schema::dropIfExists('role_user');

        Schema::dropIfExists('reprogramming');

        Schema::dropIfExists('rejects');

        Schema::dropIfExists('reasons');

        Schema::dropIfExists('public_purchases');

        Schema::dropIfExists('projects');

        Schema::dropIfExists('project_fiscal_years');

        Schema::dropIfExists('proformas');

        Schema::dropIfExists('procedures');

        Schema::dropIfExists('prioritizations');

        Schema::dropIfExists('prioritization_templates');

        Schema::dropIfExists('plans');

        Schema::dropIfExists('plan_indicators');

        Schema::dropIfExists('plan_indicator_goals');

        Schema::dropIfExists('plan_elements');

        Schema::dropIfExists('permissions');

        Schema::dropIfExists('permission_user');

        Schema::dropIfExists('permission_role');

        Schema::dropIfExists('password_resets');

        Schema::dropIfExists('operational_goals');

        Schema::dropIfExists('operational_activities');

        Schema::dropIfExists('oauth_refresh_tokens');

        Schema::dropIfExists('oauth_personal_access_clients');

        Schema::dropIfExists('oauth_clients');

        Schema::dropIfExists('oauth_auth_codes');

        Schema::dropIfExists('oauth_access_tokens');

        Schema::dropIfExists('modules');

        Schema::dropIfExists('menus');

        Schema::dropIfExists('measure_units');

        Schema::dropIfExists('links');

        Schema::dropIfExists('ledgers');

        Schema::dropIfExists('justifications');

        Schema::dropIfExists('jobs');

        Schema::dropIfExists('institutions');

        Schema::dropIfExists('incomes');

        Schema::dropIfExists('hiring_modalities');

        Schema::dropIfExists('guide_spending_classifiers');

        Schema::dropIfExists('geographic_location_classifiers');

        Schema::dropIfExists('fiscal_years');

        Schema::dropIfExists('financing_source_classifiers');

        Schema::dropIfExists('files');

        Schema::dropIfExists('failed_jobs');

        Schema::dropIfExists('departments');

        Schema::dropIfExists('department_has_users');

        Schema::dropIfExists('current_expenditure_elements');

        Schema::dropIfExists('cpc_classifiers');

        Schema::dropIfExists('components');

        Schema::dropIfExists('competences');

        Schema::dropIfExists('comments');

        Schema::dropIfExists('certifications');

        Schema::dropIfExists('certifiables');

        Schema::dropIfExists('budget_plannings');

        Schema::dropIfExists('budget_items_operations_details');

        Schema::dropIfExists('budget_items_operations');

        Schema::dropIfExists('budget_items');

        Schema::dropIfExists('budget_classifier_spendings');

        Schema::dropIfExists('budget_adjustment');

        Schema::dropIfExists('areas');

        Schema::dropIfExists('admin_activities');

        Schema::dropIfExists('activity_types');

        Schema::dropIfExists('activity_project_fiscal_years');
    }
}
