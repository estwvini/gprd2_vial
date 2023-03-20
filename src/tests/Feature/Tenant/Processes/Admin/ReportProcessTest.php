<?php

declare(strict_types=1);

use App\Models\Business\Project;
use App\Models\Ledger;
use App\Models\System\Setting;
use App\Models\System\User;
use App\Processes\Admin\ReportProcess;
use App\Repositories\Repository\Admin\AuditRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can list users data table', function () {
    $users = User::query();

    $this->mock(UserRepository::class, function (MockInterface $mock) use ($users) {
        $mock->shouldReceive('getAllWith')
            ->andReturn($users)
            ->once();
    });
    $response = $this->app->make(ReportProcess::class)->usersData();

    $this::assertEquals(200, $response->status());
});

it('can list project data table', function () {
    $projects = Project::query();

    $this->mock(ProjectRepository::class, function (MockInterface $mock) use ($projects) {
        $mock->shouldReceive('getAllWith')
            ->andReturn($projects)
            ->once();
    });
    $response = $this->app->make(ReportProcess::class)->projectData();

    $this::assertEquals(200, $response->status());
});

it('can list audit data table', function () {
    $model_query = Ledger::query();

    $this->mock(AuditRepository::class, function (MockInterface $mock) use ($model_query) {
        $mock->shouldReceive('getAllWith')
            ->andReturn($model_query)
            ->once();
    });
    $response = $this->app->make(ReportProcess::class)->auditData([]);

    $this::assertEquals(200, $response->status());
});

it('can export audit data', function () {
    $setting = Setting::factory()->make(['value' => ['province' => 'Pichincha']]);

    $this->mock(SettingRepository::class, function (MockInterface $mock) use ($setting) {
        $mock->shouldReceive('findByKey')
            ->andReturn($setting)
            ->once();
    });
    $response = $this->app->make(ReportProcess::class)->auditDataExport([]);

    $this::assertArrayHasKey('rows', $response);
    $this::assertArrayHasKey('date', $response);
    $this::assertArrayHasKey('gad', $response);
    $this::assertArrayHasKey('department', $response);
    $this::assertArrayHasKey('user', $response);
});

