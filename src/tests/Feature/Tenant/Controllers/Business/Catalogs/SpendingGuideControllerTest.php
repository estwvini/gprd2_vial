<?php
declare(strict_types=1);

use App\Models\Business\Catalogs\SpendingGuide;
use App\Models\System\User;
use App\Processes\Business\Catalogs\SpendingGuideProcess;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can view spending guide index page', function () {
    $models = SpendingGuide::factory(5)->make();
    $this->mock(SpendingGuideProcess::class, function (MockInterface $mock) use ($models) {
        $mock->shouldReceive('byLevels')
            ->andReturn($models)
            ->once();
    });
    $response = $this->get(route('index.spending_guide.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can view spending guide create page', function () {
    $models = SpendingGuide::factory(5)->make();
    $this->mock(SpendingGuideProcess::class, function (MockInterface $mock) use ($models) {
        $mock->shouldReceive('create')
            ->andReturn([
                'entity' => null,
                'types' => SpendingGuide::levels(),
                'orientations' => $models,
                'addressings' => [],
                'categories' => [],
                'subcategories' => []
            ])
            ->once();
    });
    $response = $this->get(route('create.spending_guide.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can store spending guide', function () {
    $model = SpendingGuide::factory()->make();
    $models = SpendingGuide::factory(5)->make();

    $this->mock(SpendingGuideProcess::class, function (MockInterface $mock) use ($model, $models) {
        $mock->shouldReceive('store')
            ->andReturn($model)
            ->once();
        $mock->shouldReceive('byLevels')
            ->andReturn($models)
            ->once();
    });
    $response = $this->post(route('store.create.spending_guide.module_configuration_catalogs'), []);
    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can show spending guide edit page', function () {
    $model = SpendingGuide::factory()->make();
    $this->mock(SpendingGuideProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('edit')
            ->andReturn([
                'entity' => $model,
                'updateCode' => false,
            ])
            ->once();
    });
    $response = $this->get(route('edit.spending_guide.module_configuration_catalogs', 1));
    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can update spending guide', function () {
    $model = SpendingGuide::factory()->make();
    $models = SpendingGuide::factory(5)->make();

    $this->mock(SpendingGuideProcess::class, function (MockInterface $mock) use ($model, $models) {
        $mock->shouldReceive('update')
            ->andReturn($model)
            ->once();

        $mock->shouldReceive('byLevels')
            ->andReturn($models)
            ->once();
    });
    $response = $this->put(route('update.edit.spending_guide.module_configuration_catalogs', 1), []);
    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can delete spending guide', function () {
    $models = SpendingGuide::factory(5)->make();

    $this->mock(SpendingGuideProcess::class, function (MockInterface $mock) use ($models) {
        $mock->shouldReceive('destroy')
            ->andReturn(1)
            ->once();
        $mock->shouldReceive('byLevels')
            ->andReturn($models)
            ->once();
    });
    $response = $this->delete(route('destroy.spending_guide.module_configuration_catalogs', 1));
    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can change spending guide status', function () {
    $model = SpendingGuide::factory()->make();

    $this->mock(SpendingGuideProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('status')
            ->andReturn($model)
            ->once();
    });
    $response = $this->put(route('status.spending_guide.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('message.type'));
});
