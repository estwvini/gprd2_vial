<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('app_clients', function (Blueprint $table) {
            $table->increments('id');

            $table->string('email', 75);
            $table->string('password', 255);
            $table->string('full_name', 75);
            $table->integer('age')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('ethnicity',50)->nullable();
            $table->string('gender',50)->nullable();
            $table->string('canton',50)->nullable();
            $table->rememberToken();
            $table->boolean('changed_password')->default(false);
            $table->boolean('enabled')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('app_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->text('comment');
            $table->integer('rating')->default(0);
            $table->boolean('approved')->default(0);

            $table->morphs('reviewable');
            $table->nullableMorphs('author');
            $table->unsignedInteger('location_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('app_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);

            $table->unsignedInteger('responsible_id')->nullable();
            $table->foreign('responsible_id')->references('id')->on('users')->onDelete('NO ACTION');

            $table->timestamps();
        });

        Schema::create('app_faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->string('image', 255)->nullable();
            $table->text('description')->nullable();
            $table->boolean('publish')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('app_visits', function (Blueprint $table) {
            $table->increments('id');
            $table->date('visit_at');

            $table->integer('client_id')->unsigned()->nullable()->index();
            $table->foreign('client_id')->references('id')->on('app_clients')->onDelete('NO ACTION');

            $table->timestamps();
        });

        Schema::create('budget_item_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('budget_item_id');
            $table->integer('location_id')->index();
            $table->unsignedInteger('user_id');
            $table->double('amount', 15, 2);
            $table->text('description')->nullable();

            $table->timestamps();

            $table->foreign('budget_item_id')->references('id')->on('budget_items')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('location_id')->references('id')->on('geographic_location_classifiers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('app_dbh_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 50);
            $table->string('name', 300);
            $table->integer('year');
            $table->unsignedInteger('project_related_id')->nullable();
            $table->integer('executing_unit_id')->index();

            $table->timestamps();

            $table->foreign('project_related_id')->references('id')->on('app_dbh_projects')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('executing_unit_id')->references('id')->on('departments')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });

        Schema::create('app_dbh_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id');
            $table->string('name', 300);

            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('app_dbh_projects')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('app_dbh_activity_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('activity_id');
            $table->integer('location_id')->index();
            $table->double('amount', 15, 2)->nullable();
            $table->integer('beneficiaries')->nullable();

            $table->timestamps();

            $table->foreign('activity_id')->references('id')->on('app_dbh_activities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('location_id')->references('id')->on('geographic_location_classifiers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('password_reset_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('token');
            $table->string('code');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_clients');
        Schema::dropIfExists('app_reviews');
        Schema::dropIfExists('app_subjects');
        Schema::dropIfExists('app_faqs');
        Schema::dropIfExists('app_visits');
        Schema::dropIfExists('budget_item_locations');
        Schema::dropIfExists('app_dbh_projects');
        Schema::dropIfExists('app_dbh_activities');
        Schema::dropIfExists('app_dbh_activity_locations');
        Schema::dropIfExists('password_reset_clients');
    }
};
