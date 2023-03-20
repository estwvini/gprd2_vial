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

it('can view departments page', function () {
    $response = $this->get(route('index.departments'));
    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});
