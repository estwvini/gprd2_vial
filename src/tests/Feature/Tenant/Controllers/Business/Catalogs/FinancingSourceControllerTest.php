<?php
declare(strict_types=1);

use App\Models\Business\Catalogs\FinancingSource;
use App\Models\System\User;
use App\Processes\Business\Catalogs\FinancingSourceProcess;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can view financing source index page', function () {
    $response = $this->get(route('index.financing_sources.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can view financing source create page', function () {
    $response = $this->get(route('create.financing_sources.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can store financing source', function () {

    $this->mock(FinancingSourceProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('store')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->post(route('store.create.financing_sources.module_configuration_catalogs'), []);

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can show financing source edit page', function () {
    $model = FinancingSource::factory()->make();
    $this->mock(FinancingSourceProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('edit')
            ->andReturn([
                'entity' => $model,
                'type' => $model->type,
                'typeLang' => ''
            ])
            ->once();
    });
    $response = $this->get(route('edit.financing_sources.module_configuration_catalogs', 1));
    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can update financing source', function () {

    $this->mock(FinancingSourceProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('update')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->put(route('update.edit.financing_sources.module_configuration_catalogs', 1), []);
    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can delete financing source', function () {

    $this->mock(FinancingSourceProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('destroy')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->delete(route('destroy.financing_sources.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can change financing source status', function () {

    $this->mock(FinancingSourceProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('status')
            ->andReturn(true)
            ->once();
    });
    $response = $this->put(route('status.financing_sources.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('message.type'));
});
