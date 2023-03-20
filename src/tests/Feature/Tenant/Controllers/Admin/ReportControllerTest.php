<?php
declare(strict_types=1);

use App\Models\System\User;
use App\Processes\Admin\ReportProcess;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can view users report admin page', function () {
    $response = $this->get(route('index.users.config_reports'));
    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can view projects report admin page', function () {
    $response = $this->get(route('index.projects.config_reports'));
    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can view audit report admin page', function () {

    $this->mock(ReportProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('auditIndex')
            ->andReturn([
                'users' => [],
                'departments' => [],
            ])
            ->once();
    });
    $response = $this->get(route('index.audit.config_reports'));
    $response->assertStatus(200);
    $response->assertJson(fn(AssertableJson $json) => $json->has('view'));
});
