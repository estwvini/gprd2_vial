<?php
declare(strict_types=1);

use App\Models\System\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can view roles page', function () {
    $response = $this->get(route('index.roles'));
    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can view create roles page', function () {
    $response = $this->get(route('create.roles'));
    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});
