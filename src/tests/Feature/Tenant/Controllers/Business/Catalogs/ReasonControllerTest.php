<?php
declare(strict_types=1);

use App\Models\Business\Catalogs\Reason;
use App\Models\System\User;
use App\Processes\Business\Catalogs\ReasonProcess;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can view reason index page', function () {
    $response = $this->get(route('index.reasons.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can view reason create page', function () {
    $response = $this->get(route('create.reasons.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can store reason', function () {

    $this->mock(ReasonProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('store')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->post(route('store.create.reasons.module_configuration_catalogs'), []);

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can show edit reason page', function () {
    $model = Reason::factory()->make();
    $this->mock(ReasonProcess::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('edit')
            ->andReturn([
                'entity' => $model
            ])
            ->once();
    });
    $response = $this->get(route('edit.reasons.module_configuration_catalogs', 1));
    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can update reason', function () {

    $this->mock(ReasonProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('update')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->put(route('update.edit.reasons.module_configuration_catalogs', 1), []);

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can delete reason', function () {

    $this->mock(ReasonProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('destroy')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->delete(route('destroy.reasons.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

