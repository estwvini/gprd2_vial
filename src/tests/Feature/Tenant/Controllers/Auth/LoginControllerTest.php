<?php

use App\Models\System\Role;
use App\Models\System\User;
use App\Providers\RouteServiceProvider;
use Tests\RefreshDatabaseWithTenant;

uses(RefreshDatabaseWithTenant::class);

test('login screen can be rendered', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();
    $role = Role::factory()->create();
    $user->assignRole($role);

    $response = $this->post('/login', [
        'username' => $user->username,
        'password' => 'adminpass',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();
    $role = Role::factory()->create();
    $user->assignRole($role);

    $this->post('/login', [
        'username' => $user->username,
        'password' => '12345678',
    ]);

    $this->assertGuest();
});

test('disabled users can not authenticate', function () {
    $user = User::factory()->create([
        'enabled' => 0
    ]);
    $role = Role::factory()->create();
    $user->assignRole($role);

    $this->post('/login', [
        'username' => $user->username,
        'password' => 'adminpass',
    ]);

    $this->assertGuest();
});

test('users without roles can not authenticate', function () {
    $user = User::factory()->create();
    $this->post('/login', [
        'username' => $user->username,
        'password' => 'adminpass',
    ]);

    $this->assertGuest();
});

test('exists variables in session after successful login', function () {
    $user = User::factory()->create();
    $role = Role::factory()->create();
    $user->assignRole($role);

    $response = $this->post('/login', [
        'username' => $user->username,
        'password' => 'adminpass',
    ]);

    $this->assertAuthenticated();
    $response->assertSessionHas('changedPassword');
});
