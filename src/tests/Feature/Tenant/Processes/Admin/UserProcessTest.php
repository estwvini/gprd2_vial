<?php

declare(strict_types=1);

use App\Exceptions\UserIsManagerException;
use App\Models\System\User;
use App\Processes\Admin\UserProcess;
use App\Repositories\Repository\Admin\UserRepository;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can list users data table', function () {
    $response = $this->app->make(UserProcess::class)->data();

    $this::assertEquals(200, $response->status());
});

it('can show user create page', function () {

    $response = $this->app->make(UserProcess::class)->create();

    $this::assertArrayHasKey('view', $response);
});

it('can store user', function () {
    $user = User::factory()->make();
    $this->mock(UserRepository::class, function (MockInterface $mock) use ($user) {
        $mock->shouldReceive('createFromArray')
            ->andReturn($user)
            ->once();
    });

    $response = $this->app->make(UserProcess::class)->store([]);

    $this::assertArrayHasKey('view', $response);
    $this::assertEquals('success', $response['message']['type']);
});


it('can show user page', function () {
    $model = User::query()->first();

    $this->mock(UserRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();
    });

    $response = $this->app->make(UserProcess::class)->show($model->id);

    $this::assertArrayHasKey('modal', $response);
});

it('can show edit user page', function () {
    $model = User::query()->first();

    $this->mock(UserRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();
    });

    $response = $this->app->make(UserProcess::class)->edit($model->id);

    $this->assertArrayHasKey('view', $response);
});

it('can update user', function () {
    $model = User::query()->first();

    $this->mock(UserRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();

        $mock->shouldReceive('updateFromArray')
            ->andReturn($model)
            ->once();
    });

    $response = $this->app->make(UserProcess::class)->update([], $model->id);

    $this::assertArrayHasKey('view', $response);
    $this::assertEquals('success', $response['message']['type']);
});

it('can delete user', function () {
    $model = User::factory()->create();

    $this->mock(UserRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();

        $mock->shouldReceive('isManager')
            ->andReturn(false)
            ->once();

        $mock->shouldReceive('delete')
            ->andReturn(true)
            ->once();
    });

    $response = $this->app->make(UserProcess::class)->destroy($model->id);

    $this::assertArrayHasKey('view', $response);
    $this::assertEquals('success', $response['message']['type']);
});

it('can not delete user that is department manager', function () {
    $user = User::factory()->create();

    $this->mock(UserRepository::class, function (MockInterface $mock) use ($user) {
        $mock->shouldReceive('find')
            ->andReturn($user)
            ->once();

        $mock->shouldReceive('isManager')
            ->andReturn(true)
            ->once();
    });

    $this->expectException(UserIsManagerException::class);
    $this->app->make(UserProcess::class)->destroy($user->id);
});

it('can change user status', function () {
    $model = User::factory()->create();

    $this->mock(UserRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();

        $mock->shouldReceive('changeStatus')
            ->andReturn(true)
            ->once();
    });

    $response = $this->app->make(UserProcess::class)->status($model->id);

    $this->assertEquals('success', $response['message']['type']);
});

