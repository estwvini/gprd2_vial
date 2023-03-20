<?php

namespace Tests;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

trait RefreshDatabaseWithTenant
{
    use RefreshDatabase {
        beginDatabaseTransaction as parentBeginDatabaseTransaction;
    }

    /**
     * The database connections that should have transactions.
     *
     * `null` is the default landlord connection
     * `tenant` is the tenant connection
     */
    protected array $connectionsToTransact = [null, 'tenant'];

    /**
     * We need to hook initialize tenancy _before_ we start the database
     * transaction, otherwise it cannot find the tenant connection.
     */
    public function beginDatabaseTransaction()
    {
        $this->initializeTenant();

        $this->parentBeginDatabaseTransaction();
    }

    public function initializeTenant()
    {
        $tenantId = 'local';

//        **** ParallelTesting *****
//        $tenant = Tenant::firstOr(function () use ($tenantId) {
//            config(['tenancy.database.prefix' => config('tenancy.database.prefix') . ParallelTesting::token() . '_']);
//
//            $dbName = config('tenancy.database.prefix') . $tenantId;
//
//            DB::unprepared("DROP DATABASE IF EXISTS `{$dbName}`");
//
//            $t = Tenant::create(['id' => $tenantId]);
//
//            if ( ! $t->domains()->count()) {
//                $t->domains()->create(['domain' => $tenantId . '.localhost']);
//            }
//
//            return $t;
//        });

        $tenant = Tenant::firstOr(function () use ($tenantId) {

            $dbName = config('tenancy.database.prefix') . $tenantId;
            DB::unprepared("DROP DATABASE IF EXISTS " . $dbName);

            $tenant = Tenant::create([
                'id' => $tenantId
            ]);
            $tenant->domains()->create([
                'domain' => $tenantId . '.localhost'
            ]);
            return $tenant;
        });

        tenancy()->initialize($tenant);

        URL::forceRootUrl('http://' . $tenantId . '.localhost');
    }
}
