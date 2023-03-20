<?php
declare(strict_types=1);

use App\Models\Business\Catalogs\GeographicLocation;
use App\Models\System\User;
use App\Processes\Business\Catalogs\GeographicLocationProcess;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can view geographic locations index page', function () {
    $models = GeographicLocation::factory(5)->make(['type', GeographicLocation::TYPE_CANTON]);
    $this->mock(GeographicLocationProcess::class, function (MockInterface $mock) use ($models) {
        $mock->shouldReceive('byTypes')
            ->andReturn($models)
            ->once();

        $mock->shouldReceive('currentProvince')
            ->andReturn('')
            ->once();
    });

    $response = $this->get(route('index.geographic_locations.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can view geographic locations create page', function () {
    $models = GeographicLocation::factory(5)->make(['type', GeographicLocation::TYPE_CANTON]);
    $this->mock(GeographicLocationProcess::class, function (MockInterface $mock) use ($models) {
        $mock->shouldReceive('create')
            ->andReturn([
                'entity' => null,
                'parentLocations' => [],
                'types' => GeographicLocation::types(),
                'provinces' => [],
                'cantons' => $models,
                'parishes' => [],
                'province' => ''
            ])
            ->once();

    });

    $response = $this->get(route('create.geographic_locations.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can store geographic locations', function () {
    $models = GeographicLocation::factory(5)->make(['type', GeographicLocation::TYPE_CANTON]);
    $this->mock(GeographicLocationProcess::class, function (MockInterface $mock) use ($models) {
        $mock->shouldReceive('store')
            ->andReturn($this->any())
            ->once();
        $mock->shouldReceive('byTypes')
            ->andReturn($models)
            ->once();

        $mock->shouldReceive('currentProvince')
            ->andReturn('')
            ->once();
    });
    $response = $this->post(route('store.create.geographic_locations.module_configuration_catalogs'), []);

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can show geographic locations view page', function () {
    $model = GeographicLocation::factory()->make();
    $this->mock(GeographicLocationProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('show')
            ->andReturn([
                'entity' => $model
            ])
            ->once();
    });
    $response = $this->get(route('show.geographic_locations.module_configuration_catalogs', 1));
    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('modal_st'));
});

it('can show geographic locations edit page', function () {
    $model = GeographicLocation::factory()->make();
    $this->mock(GeographicLocationProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('edit')
            ->andReturn([
                'entity' => $model,
                'parentLocations' => [],
                'province' => ''
            ])
            ->once();
    });
    $response = $this->get(route('edit.geographic_locations.module_configuration_catalogs', 1));
    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can update geographic locations', function () {
    $models = GeographicLocation::factory(5)->make(['type', GeographicLocation::TYPE_CANTON]);
    $this->mock(GeographicLocationProcess::class, function (MockInterface $mock) use ($models) {
        $mock->shouldReceive('update')
            ->andReturn($this->any())
            ->once();
        $mock->shouldReceive('byTypes')
            ->andReturn($models)
            ->once();

        $mock->shouldReceive('currentProvince')
            ->andReturn('')
            ->once();
    });
    $response = $this->put(route('update.edit.geographic_locations.module_configuration_catalogs', 1), []);
    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can delete geographic locations', function () {
    $models = GeographicLocation::factory(5)->make(['type', GeographicLocation::TYPE_CANTON]);
    $this->mock(GeographicLocationProcess::class, function (MockInterface $mock) use ($models) {
        $mock->shouldReceive('destroy')
            ->andReturn(false)
            ->once();
        $mock->shouldReceive('byTypes')
            ->andReturn($models)
            ->once();

        $mock->shouldReceive('currentProvince')
            ->andReturn('')
            ->once();
    });
    $response = $this->delete(route('destroy.geographic_locations.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can change geographic locations status', function () {
    $model = GeographicLocation::factory()->make();
    $this->mock(GeographicLocationProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('status')
            ->andReturn($model)
            ->once();
    });
    $response = $this->put(route('status.geographic_locations.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('message.type'));
});


