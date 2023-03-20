<?php

declare(strict_types=1);

use App\Exceptions\RoleHasUsersException;
use App\Exceptions\UnexpectedException;
use App\Models\System\Role;
use App\Models\System\User;
use App\Processes\Admin\RoleProcess;
use App\Repositories\Repository\Configuration\RoleRepository;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can list roles data table', function () {
    $response = $this->app->make(RoleProcess::class)->data();

    $this::assertEquals(200, $response->status());
});

it('can store role', function () {
    $role = Role::factory()->create();
    $this->mock(RoleRepository::class, function (MockInterface $mock) use ($role) {
        $mock->shouldReceive('createFromArray')
            ->andReturn($role)
            ->once();
    });

    $response = $this->app->make(RoleProcess::class)->store([]);

    $this::assertArrayHasKey('view', $response);
    $this::assertEquals('success', $response['message']['type']);
});

it('can show role page', function () {
    $model = Role::query()->first();

    $this->mock(RoleRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();
    });

    $response = $this->app->make(RoleProcess::class)->show($model->id);

    $this::assertArrayHasKey('modal', $response);
});

it('can show edit role page', function () {
    $model = Role::query()->first();

    $this->mock(RoleRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();
    });

    $response = $this->app->make(RoleProcess::class)->edit($model->id);

    $this->assertArrayHasKey('view', $response);
});

it('can update role', function () {
    $model = Role::query()->first();

    $this->mock(RoleRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();

        $mock->shouldReceive('updateFromArray')
            ->andReturn($model)
            ->once();
    });

    $response = $this->app->make(RoleProcess::class)->update([], $model->id);

    $this::assertArrayHasKey('view', $response);
    $this::assertEquals('success', $response['message']['type']);
});

it('can delete role', function () {
    $model = Role::factory()->create();

    $this->mock(RoleRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();

        $mock->shouldReceive('delete')
            ->andReturn(true)
            ->once();
    });

    $response = $this->app->make(RoleProcess::class)->destroy($model->id);

    $this::assertArrayHasKey('view', $response);
    $this::assertEquals('success', $response['message']['type']);
});

it('can not delete role with users', function () {
    $model = Role::query()->first();
    $user = User::factory()->create();
    $user->roles()->save($model);

    $this->mock(RoleRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();
    });

    $this->expectException(RoleHasUsersException::class);

    $this->app->make(RoleProcess::class)->destroy($model->id);
});

it('can not delete role', function () {
    $model = Role::factory()->create();

    $this->mock(RoleRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();

        $mock->shouldReceive('delete')
            ->andReturn(false)
            ->once();
    });

    $this->expectException(UnexpectedException::class);

    $this->app->make(RoleProcess::class)->destroy($model->id);
});

it('can change role status', function () {
    $model = Role::factory()->create();

    $this->mock(RoleRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();

        $mock->shouldReceive('changeStatus')
            ->andReturn(true)
            ->once();
    });

    $response = $this->app->make(RoleProcess::class)->status($model->id);

    $this->assertEquals('success', $response['message']['type']);
});

it('can not change role status', function () {
    $model = Role::factory()->create();

    $this->mock(RoleRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();

        $mock->shouldReceive('changeStatus')
            ->andReturn(false)
            ->once();
    });

    $this->expectException(UnexpectedException::class);

    $this->app->make(RoleProcess::class)->status($model->id);
});

it('can change role editable field', function () {
    $model = Role::factory()->create();

    $this->mock(RoleRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();

        $mock->shouldReceive('changeEditable')
            ->andReturn(true)
            ->once();
    });

    $response = $this->app->make(RoleProcess::class)->editable($model->id);

    $this->assertEquals('success', $response['message']['type']);
});

it('can not change role editable field', function () {
    $model = Role::factory()->create();

    $this->mock(RoleRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();

        $mock->shouldReceive('changeEditable')
            ->andReturn(false)
            ->once();
    });

    $this->expectException(UnexpectedException::class);

    $this->app->make(RoleProcess::class)->editable($model->id);
});

it('can show role permissions page', function () {
    $model = Role::query()->first();

    $this->mock(RoleRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();
    });

    $response = $this->app->make(RoleProcess::class)->permissions($model->id);

    $this::assertArrayHasKey('view', $response);
});
