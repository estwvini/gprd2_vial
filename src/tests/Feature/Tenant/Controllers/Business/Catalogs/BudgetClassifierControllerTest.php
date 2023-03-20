<?php
declare(strict_types=1);

use App\Models\Business\Catalogs\BudgetClassifier;
use App\Models\System\User;
use App\Processes\Business\Catalogs\BudgetClassifierProcess;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can view budget classifier index page', function () {
    $response = $this->get(route('index.budget_classifiers.module_configuration_catalogs'));

    $response->assertSuccessful();
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can view budget classifier create page', function () {
    $this->mock(BudgetClassifierProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('create')
            ->andReturn(['entity' => new BudgetClassifier()])
            ->once();
    });
    $response = $this->get(route('create.budget_classifiers.module_configuration_catalogs'));

    $response->assertSuccessful();
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can store budget classifier', function () {
    $model = BudgetClassifier::factory()->make();
    $this->mock(BudgetClassifierProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('store')
            ->andReturn($model)
            ->once();
    });
    $response = $this->post(route('store.create.budget_classifiers.module_configuration_catalogs'), []);

    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can show budget classifier page', function () {
    $model = BudgetClassifier::factory()->make();
    $this->mock(BudgetClassifierProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('show')
            ->andReturn([
                'entity' => $model
            ])
            ->once();
    });
    $response = $this->get(route('show.budget_classifiers.module_configuration_catalogs', 1));
    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('modal_st'));
});

it('can show edit budget classifier page', function () {
    $model = BudgetClassifier::factory()->make();

    $this->mock(BudgetClassifierProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('edit')
            ->andReturn([
                'entity' => $model,
                'updateCode' => false
            ])
            ->once();
    });
    $response = $this->get(route('edit.budget_classifiers.module_configuration_catalogs', 1));
    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can update budget classifier', function () {
    $model = BudgetClassifier::factory()->make();
    $this->mock(BudgetClassifierProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('update')
            ->andReturn($model)
            ->once();
    });
    $response = $this->put(route('update.edit.budget_classifiers.module_configuration_catalogs', 1), []);

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can delete budget classifier', function () {

    $this->mock(BudgetClassifierProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('destroy')
            ->andReturn(1)
            ->once();
    });
    $response = $this->delete(route('destroy.budget_classifiers.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});


it('can change budget classifier status', function () {

    $this->mock(BudgetClassifierProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('status')
            ->andReturn(true)
            ->once();
    });
    $response = $this->put(route('status.budget_classifiers.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('message.type'));
});
