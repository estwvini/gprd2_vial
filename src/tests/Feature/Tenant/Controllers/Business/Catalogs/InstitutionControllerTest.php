<?php
declare(strict_types=1);

use App\Models\Business\Catalogs\Institution;
use App\Models\System\User;
use App\Processes\Business\Catalogs\InstitutionProcess;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can view institution index page', function () {
    $response = $this->get(route('index.institution.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can view institution create page', function () {
    $response = $this->get(route('create.institution.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can store institution', function () {

    $this->mock(InstitutionProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('store')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->post(route('store.create.institution.module_configuration_catalogs'), []);

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can show edit institution page', function () {
    $model = Institution::factory()->make();
    $this->mock(InstitutionProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('edit')
            ->andReturn([
                'entity' => $model
            ])
            ->once();
    });
    $response = $this->get(route('edit.institution.module_configuration_catalogs', 1));
    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can update institution', function () {

    $this->mock(InstitutionProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('update')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->put(route('update.edit.institution.module_configuration_catalogs', 1), []);

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can delete institution', function () {

    $this->mock(InstitutionProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('destroy')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->delete(route('destroy.institution.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can change institution status', function () {
    $model = Institution::factory()->make();

    $this->mock(InstitutionProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('status')
            ->andReturn($model)
            ->once();
    });
    $response = $this->put(route('status.index.institution.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('message.type'));
});
