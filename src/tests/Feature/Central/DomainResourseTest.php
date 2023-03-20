<?php

declare(strict_types=1);

use App\Filament\Resources\DomainResource;
use App\Models\Domain;
use App\Models\Tenant;
use App\Models\User;
use Filament\Pages\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $user = User::factory()->create();
    actingAsUserInCentralApp($user);
});

it('can render domains page', function () {
    $this->get(DomainResource::getUrl())->assertSuccessful();
});

it('can list domains table', function () {

    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });

    $domains = Domain::factory()->count(5)->for($tenant)->create();

    livewire(DomainResource\Pages\ListDomains::class)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($domains);
});

it('can render domains domain column', function () {
    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });

    Domain::factory()->count(5)->for($tenant)->create();

    livewire(DomainResource\Pages\ListDomains::class)
        ->assertSuccessful()
        ->assertCanRenderTableColumn('domain');
});

it('can search domains by domain', function () {
    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });

    $domains = Domain::factory()->count(5)->for($tenant)->create();

    $search = $domains->first()->domain;

    livewire(DomainResource\Pages\ListDomains::class)
        ->searchTable($search)
        ->assertCanSeeTableRecords(Domain::query()->where('domain', 'iLike', '%' . $search . '%')->get())
        ->assertCanNotSeeTableRecords(Domain::query()->whereNot('domain', 'iLike', '%' . $search . '%')->get());
});

it('can bulk delete domains', function () {
    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });

    $domains = Domain::factory()->count(5)->for($tenant)->create();

    livewire(DomainResource\Pages\ListDomains::class)
        ->callTableBulkAction(DeleteBulkAction::class, $domains);

    foreach ($domains as $domain) {
        $this->assertModelMissing($domain);
    }
});

it('can edit domain in table action', function () {
    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });

    $domain = Domain::factory()->for($tenant)->create();

    livewire(DomainResource\Pages\ListDomains::class)
        ->callTableAction(EditAction::class, $domain, data: [
            'domain' => $domainName = fake()->domainName,
            'tenant_id' => $tenant->id
        ])
        ->assertHasNoTableActionErrors();

    $this->assertDatabaseHas('domains', [
        'domain' => $domainName,
    ]);
});

it('can validate edited domain in table action', function () {
    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });

    $domain = Domain::factory()->for($tenant)->create();

    livewire(DomainResource\Pages\ListDomains::class)
        ->callTableAction(EditAction::class, $domain, data: [
            'domain' => null,
            'tenant_id' => null,
        ])
        ->assertHasTableActionErrors([
            'domain' => ['required'],
            'tenant_id' => ['required'],
        ]);
});

it('can render create domain page', function () {
    $this->get(DomainResource::getUrl('create'))->assertSuccessful();
});

it('can create domain', function () {
    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });

    $newDomain = Domain::factory()->make();

    Tenant::withoutEvents(function () use ($newDomain, $tenant) {
        livewire(DomainResource\Pages\CreateDomain::class)
            ->fillForm([
                'domain' => $newDomain->domain,
                'tenant_id' => $tenant->id,
            ])
            ->call('create')
            ->assertHasNoFormErrors();
    });
    $this->assertDatabaseHas(Domain::class, [
        'domain' => $newDomain->domain
    ]);
});

it('can validate input form in create domain', function () {
    Tenant::withoutEvents(function () {
        livewire(DomainResource\Pages\CreateDomain::class)
            ->fillForm([
                'domain' => null,
                'tenant_id' => null,
            ])
            ->call('create')
            ->assertHasFormErrors([
                'domain' => ['required'],
                'tenant_id' => ['required'],
            ]);
    });
});

it('can render edit domain page', function () {
    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });

    $this->get(DomainResource::getUrl('edit', [
        'record' => Domain::factory()->for($tenant)->create(),
    ]))->assertSuccessful();
});

it('can retrieve data for edit domain form', function () {
    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });
    $domain = Domain::factory()->for($tenant)->create();

    livewire(DomainResource\Pages\EditDomain::class, [
        'record' => $domain->getKey(),
    ])
        ->assertFormSet([
            'domain' => $domain->domain,
            'tenant_id' => $domain->tenant_id,
        ]);
});

it('can save edited domain data', function () {
    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });
    $domain = Domain::factory()->for($tenant)->create();
    $newData = Domain::factory()->make();

    livewire(DomainResource\Pages\EditDomain::class, [
        'record' => $domain->getKey(),
    ])
        ->fillForm([
            'domain' => $newData->domain,
            'tenant_id' => $tenant->id
        ])
        ->call('save')
        ->assertHasNoFormErrors();
    $domain = Domain::query()->find($newData->id);

    expect($domain)->id->toBe($newData->id);
});
