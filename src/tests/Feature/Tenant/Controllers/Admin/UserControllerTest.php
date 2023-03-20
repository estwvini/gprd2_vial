<?php
declare(strict_types=1);

use App\Models\System\User;
use App\Processes\Admin\UserProcess;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery\MockInterface;
use Tests\RefreshDatabaseWithTenant;

uses(
    RefreshDatabaseWithTenant::class
);

beforeEach(function () {
    actingAs(User::find(1));
});

it('can view users page', function () {
    $response = $this->get(route('index.users'));

    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('view'));
});

it('can view change fiscal year page', function () {
    $response = $this->get(route('change_fiscal_year.users'));

    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('modal'));
});

it('can change fiscal in session', function () {
    $response = $this->post(route('update.change_fiscal_year.users'), [
        'execution' => 2021,
        'planning' => 2022,
    ]);

    $response->assertSuccessful()
        ->assertJson(fn(AssertableJson $json) => $json->has('message.type'))
        ->assertSessionHas('fiscalYearPlanning')
        ->assertSessionHas('fiscalYearExecution');

    $this::assertEquals(2021, session('fiscalYearExecution'));
    $this::assertEquals(2022, session('fiscalYearPlanning'));
});

it('can check username exist', function () {
    $this->mock(UserProcess::class, function (MockInterface $mock) {
        $mock->shouldReceive('checkUsernameExists')
            ->andReturn(true)
            ->once();
    });

    $response = $this->get(route('checkusername.create.users'));

    $response->assertSuccessful()
        ->assertContent('false');
});


