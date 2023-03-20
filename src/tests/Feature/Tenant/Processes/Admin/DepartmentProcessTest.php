<?php
declare(strict_types=1);

use App\Exceptions\DepartmentHasChildrenException;
use App\Exceptions\DepartmentHasOperationalActivitiesException;
use App\Exceptions\DepartmentHasParentDisabledException;
use App\Exceptions\DepartmentHasProjectsException;
use App\Exceptions\DepartmentHasUsersException;
use App\Models\Admin\Department;
use App\Models\Business\Planning\OperationalActivity;
use App\Models\Business\Project;
use App\Models\System\User;
use App\Processes\Admin\DepartmentProcess;
use App\Repositories\Repository\Admin\DepartmentRepository;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can list departments data table', function () {
    $models = Department::factory(5)->make();
    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($models) {
        $mock->shouldReceive('findAll')->andReturn($models)->once();
    });

    $response = $this->app->make(DepartmentProcess::class)->data();
    $this::assertEquals(200, $response->status());
});

it('can show create departments page', function () {
    $models = Department::factory(5)->make();
    $max_code = Department::query()->max('code');
    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($models, $max_code) {
        $mock->shouldReceive('maxValueCode')
            ->andReturn($max_code)
            ->once();

        $mock->shouldReceive('findMaxDepthEnabled')
            ->andReturn($models)
            ->once();
    });

    $response = $this->app->make(DepartmentProcess::class)->create();

    $this::assertEquals(200, $response->status());
});

it('can store department', function () {
    $this->mock(DepartmentRepository::class, function (MockInterface $mock) {
        $mock->shouldReceive('createFromArray')
            ->andReturn(new Department())
            ->once();
    });

    $response = $this->app->make(DepartmentProcess::class)->store([]);
    $data_content = json_decode($response->content(), true, 512, JSON_THROW_ON_ERROR);

    $this::assertEquals(200, $response->status());
    $this::assertArrayHasKey('view', $data_content);
    $this::assertEquals('success', $data_content['message']['type']);
});

it('can show department page', function () {
    $model = Department::factory()->make();

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();
    });

    $response = $this->app->make(DepartmentProcess::class)->show($model->id);
    $this::assertArrayHasKey('modal_st', $response);
});

it('can show edit department page', function () {
    $models = Department::factory(5)->make();

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($models) {
        $mock->shouldReceive('find')
            ->andReturn($models->first())
            ->once();

        $mock->shouldReceive('findMaxDepthEnabled')
            ->andReturn($models)
            ->once();
    });

    $response = $this->app->make(DepartmentProcess::class)->edit($models->first()->id);
    $this::assertArrayHasKey('view', $response);
});

it('can update department', function () {
    $model = Department::factory()->make();

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();

        $mock->shouldReceive('updateFromArray')
            ->andReturn($model)
            ->once();
    });

    $response = $this->app->make(DepartmentProcess::class)->update([], $model->id);
    $this::assertArrayHasKey('view', $response);
    $this::assertEquals('success', $response['message']['type']);
});

it('can delete department', function () {
    $model = Department::factory()->make();

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();

        $mock->shouldReceive('delete')
            ->andReturn(true)
            ->once();
    });

    $response = $this->app->make(DepartmentProcess::class)->destroy($model->id);
    $this::assertArrayHasKey('view', $response);
    $this::assertEquals('success', $response['message']['type']);
});

it('can not delete department with children', function () {
    $model = Department::factory()->create();
    $model_parent = Department::factory()->create(['parent_id' => $model->id]);

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();
    });

    $this->expectException(DepartmentHasChildrenException::class);
    $this->app->make(DepartmentProcess::class)->destroy($model->id);
});

it('can not delete a department with users', function () {
    $department = Department::factory()->create();
    $user = User::factory()->create();
    $department->users()->save($user);

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($department) {
        $mock->shouldReceive('find')
            ->andReturn($department)
            ->once();
    });

    $this->expectException(DepartmentHasUsersException::class);
    $this->app->make(DepartmentProcess::class)->destroy($department->id);
});

it('can not delete a department with responsible projects', function () {
    $department = Department::factory()->create();
    Project::factory()->create(['responsible_unit_id' => $department->id]);

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($department) {
        $mock->shouldReceive('find')
            ->andReturn($department)
            ->once();
    });

    $this->expectException(DepartmentHasProjectsException::class);
    $this->app->make(DepartmentProcess::class)->destroy($department->id);
});

it('can not delete a department with executing projects', function () {
    $department = Department::factory()->create();
    Project::factory()->create(['executing_unit_id' => $department->id]);

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($department) {
        $mock->shouldReceive('find')
            ->andReturn($department)
            ->once();
    });

    $this->expectException(DepartmentHasProjectsException::class);
    $this->app->make(DepartmentProcess::class)->destroy($department->id);
});

it('can not delete a department with responsible operational activities', function () {
    $department = Department::factory()->create();
    OperationalActivity::factory()->create(['responsible_unit_id' => $department->id]);

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($department) {
        $mock->shouldReceive('find')
            ->andReturn($department)
            ->once();
    });

    $this->expectException(DepartmentHasOperationalActivitiesException::class);
    $this->app->make(DepartmentProcess::class)->destroy($department->id);
});

it('can not delete a department with executing operational activities', function () {
    $department = Department::factory()->create();
    OperationalActivity::factory()->create(['executing_unit_id' => $department->id]);

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($department) {
        $mock->shouldReceive('find')
            ->andReturn($department)
            ->once();
    });

    $this->expectException(DepartmentHasOperationalActivitiesException::class);
    $this->app->make(DepartmentProcess::class)->destroy($department->id);
});

it('can change a department status', function () {
    $department = Department::factory()->create();

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($department) {
        $mock->shouldReceive('find')
            ->andReturn($department)
            ->once();

        $mock->shouldReceive('changeStatus')
            ->andReturn(true)
            ->once();
    });

    $response = $this->app->make(DepartmentProcess::class)->status($department->id);
    $this::assertEquals('success', $response['message']['type']);
});

it('can not change a department status with children', function () {
    $model = Department::factory()->create();
    Department::factory()->create(['parent_id' => $model->id]);

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($model) {
        $mock->shouldReceive('find')
            ->andReturn($model)
            ->once();
    });

    $this->expectException(DepartmentHasChildrenException::class);
    $this->app->make(DepartmentProcess::class)->status($model->id);
});

it('can not change a department status with users', function () {
    $department = Department::factory()->create();
    $user = User::factory()->create();
    $department->users()->save($user);

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($department) {
        $mock->shouldReceive('find')
            ->andReturn($department)
            ->once();
    });

    $this->expectException(DepartmentHasUsersException::class);
    $this->app->make(DepartmentProcess::class)->status($department->id);
});

it('can not change a department status with disabled parent', function () {
    $parent = Department::factory()->create(['enabled' => false]);
    $department = Department::factory()->create(['parent_id' => $parent->id]);

    $this->mock(DepartmentRepository::class, function (MockInterface $mock) use ($department) {
        $mock->shouldReceive('find')
            ->andReturn($department)
            ->once();
    });

    $this->expectException(DepartmentHasParentDisabledException::class);
    $this->app->make(DepartmentProcess::class)->status($department->id);
});
