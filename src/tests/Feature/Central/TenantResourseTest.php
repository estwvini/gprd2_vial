<?php

declare(strict_types=1);

use App\Filament\Resources\TenantResource;
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

it('can render tenant page', function () {
    $this->get(TenantResource::getUrl())->assertSuccessful();
});

it('can list tenant table', function () {

    $tenants = Tenant::withoutEvents(function () {
        return Tenant::factory()->count(2)->create();
    });

    livewire(TenantResource\Pages\ListTenants::class)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($tenants);
});

it('can render tenant identifier column', function () {

    Tenant::withoutEvents(function () {
        return Tenant::factory()->count(2)->create();
    });

    livewire(TenantResource\Pages\ListTenants::class)
        ->assertSuccessful()
        ->assertCanRenderTableColumn('id');
});

it('can search tenant by id', function () {
    $tenants = Tenant::withoutEvents(function () {
        return Tenant::factory()->count(2)->create();
    });

    $id = $tenants->first()->id;

    livewire(TenantResource\Pages\ListTenants::class)
        ->searchTable($id)
        ->assertCanSeeTableRecords($tenants->where('id', $id))
        ->assertCanNotSeeTableRecords($tenants->where('id', '!=', $id));
});

it('can bulk delete tenants', function () {
    $tenants = Tenant::withoutEvents(function () {
        return Tenant::factory()->count(2)->create();
    });

    livewire(TenantResource\Pages\ListTenants::class)
        ->callTableBulkAction(DeleteBulkAction::class, $tenants);

    foreach ($tenants as $tenant) {
        $this->assertModelMissing($tenant);
    }
});

it('can edit tenants in table action', function () {
    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });

    livewire(TenantResource\Pages\ListTenants::class)
        ->callTableAction(EditAction::class, $tenant, data: [
            'id' => $id = fake()->uuid,
        ])
        ->assertHasNoTableActionErrors();

    $this->assertDatabaseHas('tenants', [
        'id' => $id,
    ]);
});

it('can validate edited tenant in table action', function () {
    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });

    livewire(TenantResource\Pages\ListTenants::class)
        ->callTableAction(EditAction::class, $tenant, data: [
            'id' => null,
        ])
        ->assertHasTableActionErrors(['id' => ['required']]);
});

it('can render create tenant page', function () {
    $this->get(TenantResource::getUrl('create'))->assertSuccessful();
});

it('can create tenant', function () {
    $newTenant = Tenant::factory()->make();

    Tenant::withoutEvents(function () use ($newTenant) {
        livewire(TenantResource\Pages\CreateTenant::class)
            ->fillForm([
                'id' => $newTenant->id
            ])
            ->call('create')
            ->assertHasNoFormErrors();
    });
    $this->assertDatabaseHas(Tenant::class, [
        'id' => $newTenant->id
    ]);
});

it('can validate input form in create tenant', function () {
    Tenant::withoutEvents(function () {
        livewire(TenantResource\Pages\CreateTenant::class)
            ->fillForm([
                'id' => null,
            ])
            ->call('create')
            ->assertHasFormErrors(['id' => 'required']);
    });
});

it('can render edit tenant page', function () {
    Tenant::withoutEvents(function () {
        $this->get(TenantResource::getUrl('edit', [
            'record' => Tenant::factory()->create(),
        ]))->assertSuccessful();
    });
});

it('can retrieve data for edit tenant form', function () {
    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });

    livewire(TenantResource\Pages\EditTenant::class, [
        'record' => $tenant->getKey(),
    ])
        ->assertFormSet([
            'id' => $tenant->getKey()
        ]);
});

it('can save edited tenant data', function () {
    $tenant = Tenant::withoutEvents(function () {
        return Tenant::factory()->create();
    });
    $newData = Tenant::factory()->make();

    livewire(TenantResource\Pages\EditTenant::class, [
        'record' => $tenant->getKey(),
    ])
        ->fillForm([
            'id' => $newData->getKey()
        ])
        ->call('save')
        ->assertHasNoFormErrors();
    $tenant = Tenant::query()->find($newData->id);

    expect($tenant)->id->toBe($newData->id);
});

