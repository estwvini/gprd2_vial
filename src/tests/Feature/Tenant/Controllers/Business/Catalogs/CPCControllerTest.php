<?php
declare(strict_types=1);

use App\Models\Business\Catalogs\CPC;
use App\Models\System\User;
use App\Processes\Business\Catalogs\CPCProcess;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can view cpc index page', function () {
    $response = $this->get(route('index.cpc.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can view cpc create page', function () {
    $response = $this->get(route('create.cpc.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can store cpc', function () {

    $this->mock(CPCProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('store')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->post(route('store.create.cpc.module_configuration_catalogs'), []);

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can show edit cpc page', function () {
    $model = CPC::factory()->make();
    $this->mock(CPCProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('edit')
            ->andReturn([
                'entity' => $model
            ])
            ->once();
    });
    $response = $this->get(route('edit.cpc.module_configuration_catalogs', 1));
    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can update cpc', function () {

    $this->mock(CPCProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('update')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->put(route('update.edit.cpc.module_configuration_catalogs', 1), []);

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can delete cpc', function () {

    $this->mock(CPCProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('destroy')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->delete(route('destroy.cpc.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can change cpc status', function () {

    $this->mock(CPCProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('status')
            ->andReturn(true)
            ->once();
    });
    $response = $this->put(route('status.cpc.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('message.type'));
});
