<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Filament\Http\Livewire\Auth\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

test('users can authenticate in central app', function () {
    $user = User::factory()->create();

    livewire(Login::class)
        ->fillForm([
            'email' => $user->email,
            'password' => 'adminpass',
        ])
        ->call('authenticate')
        ->assertRedirect(config('filament.home_url'));

    $this->assertAuthenticated('web_central_app');
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    livewire(Login::class)
        ->fillForm([
            'email' => $user->email,
            'password' => '1234',
        ])
        ->call('authenticate')
        ->assertHasErrors();
});
