<?php
declare(strict_types=1);

use App\Models\System\User;
use App\Processes\Business\Catalogs\ActivityTypeProcess;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can view activity index page', function () {
    $response = $this->get(route('index.activity_type.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can view activity create page', function () {
    $response = $this->get(route('create.activity_type.module_configuration_catalogs'));

    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can store activity', function () {

    $this->mock(ActivityTypeProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('store')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->post(route('store.create.activity_type.module_configuration_catalogs'), []);

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can update activity', function () {

    $this->mock(ActivityTypeProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('update')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->put(route('update.edit.activity_type.module_configuration_catalogs', 1), []);

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});

it('can delete activity', function () {

    $this->mock(ActivityTypeProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('destroy')
            ->andReturn($this->any())
            ->once();
    });
    $response = $this->delete(route('destroy.activity_type.module_configuration_catalogs', 1));

    $response->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json->has('view')->has('message.type'));
});
