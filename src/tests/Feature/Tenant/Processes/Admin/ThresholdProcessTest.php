<?php

declare(strict_types=1);

use App\Models\Admin\Threshold;
use App\Models\System\User;
use App\Processes\Admin\ThresholdProcess;
use App\Repositories\Repository\Admin\ThresholdRepository;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can show edit threshold page', function () {
    $models = Threshold::factory(3)->make();

    $this->mock(ThresholdRepository::class, function (MockInterface $mock) use ($models) {
        $mock->shouldReceive('findAll')
            ->andReturn($models)
            ->once();
    });

    $response = $this->app->make(ThresholdProcess::class)->edit();
    $this::assertArrayHasKey('view', $response);
});

it('can update thresholds', function () {
    $models = Threshold::factory(3)->make();

    $this->mock(ThresholdRepository::class, function (MockInterface $mock) use ($models) {
        $mock->shouldReceive('updateAll')
            ->andReturn($models->all())
            ->once();
    });

    $response = $this->app->make(ThresholdProcess::class)->update([]);
    $this::assertArrayHasKey('view', $response);
    $this::assertEquals('success', $response['message']['type']);
});
