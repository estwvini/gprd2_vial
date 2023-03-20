<?php

declare(strict_types=1);

use App\Filament\Pages\Dashboard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can render home page', function () {

    $user = User::factory()->create();

    actingAsUserInCentralApp($user);

    $this->get(Dashboard::getUrl())->assertSuccessful();
});
