<?php
declare(strict_types=1);

use App\Models\Business\Catalogs\MeasureUnit;
use App\Models\System\User;
use App\Processes\Business\Catalogs\MeasureUnitProcess;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can view measure units index page', function () {
    $response = $this->get(route('index.measure_units.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can view measure units create page', function () {
    $response = $this->get(route('create.measure_units.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can store measure units', function () {

    $this->mock(MeasureUnitProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('store')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->post(route('store.create.measure_units.module_configuration_catalogs'), []);

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can show edit measure units page', function () {
    $model = MeasureUnit::factory()->make();
    $this->mock(MeasureUnitProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('edit')
            ->andReturn([
                'entity' => $model
            ])
            ->once();
    });
    $response = $this->get(route('edit.measure_units.module_configuration_catalogs', 1));
    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can update measure units', function () {

    $this->mock(MeasureUnitProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('update')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->put(route('update.edit.measure_units.module_configuration_catalogs', 1), []);

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can delete measure units', function () {

    $this->mock(MeasureUnitProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('destroy')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->delete(route('destroy.measure_units.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can change measure units status', function () {
    $model = MeasureUnit::factory()->make();

    $this->mock(MeasureUnitProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('status')
            ->andReturn($model)
            ->once();
    });
    $response = $this->put(route('status.index.measure_units.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('message.type'));
});
