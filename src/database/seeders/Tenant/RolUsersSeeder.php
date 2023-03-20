<?php

namespace Database\Seeders\Tenant;

use App\Models\System\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolUsersSeeder extends Seeder
{

    public function run()
    {
        /** ------------
         * Default roles
         * ------------- */

        // Administrator
        $administratorRoleSlug = 'administrator';
        $adminRole = config('acl.role')::create([
            'name' => 'Administrador del sistema',
            'slug' => $administratorRoleSlug,
            'description' => 'Administrador del sistema',
            'editable' => false
        ]);

        // Developer
        $devRoleSlug = 'developer';
        $devRole = config('acl.role')::create([
            'name' => 'Desarrollador',
            'slug' => $devRoleSlug,
            'description' => 'Gestionar el correcto funcionamiento del sistema',
            'editable' => false
        ]);

        // Planner
        $plnRole = config('acl.role')::create([
            'name' => 'Director de Planificación',
            'slug' => 'planner',
            'description' => 'Rol planificador',
            'editable' => true
        ]);

        // Authority
        $autRole = config('acl.role')::create([
            'name' => 'Autoridad',
            'slug' => 'authority',
            'description' => 'Rol autoridad',
            'editable' => true
        ]);

        // Support
        $sptRole = config('acl.role')::create([
            'name' => 'Apoyo',
            'slug' => 'support',
            'description' => 'Rol apoyo',
            'editable' => true
        ]);

        // Leader
        $leaderRole = config('acl.role')::create([
            'name' => 'Líder',
            'slug' => 'leader',
            'description' => 'Rol líder',
            'editable' => true
        ]);

        // Director
        $directorRole = config('acl.role')::create([
            'name' => 'Director',
            'slug' => 'director',
            'description' => 'Rol Director de área',
            'editable' => true
        ]);

        // financial
        $financialRole = config('acl.role')::create([
            'name' => 'Financiero',
            'slug' => 'financial',
            'description' => 'Rol Financiero',
            'editable' => true
        ]);

        // financial
        config('acl.role')::create([
            'name' => 'Vialidad',
            'slug' => 'vialidad',
            'description' => 'Rol Módulo Vialidad',
            'editable' => true
        ]);

        /** ------------
         * Default users
         * ------------- */

        $admin = User::create([
            'id' => 1,
            'username' => 'admin',
            'first_name' => 'admin',
			'name' => 'Administrador Global',
            'email' => 'admin@admin.com',
            'last_name' => '',
            'password' => bcrypt('adminpass'),
            'remember_token' => md5(uniqid('', true)),
            'changed_password' => 1,
            'identification_type' => 'other',
            'enabled' => 1
        ]);
        $admin->assignRole($administratorRoleSlug);

        $dev = User::create([
            'id' => 2,
            'username' => 'developer',
            'first_name' => 'developer',
			'name' => 'Developer',
            'email' => 'developer@developer.com',
            'last_name' => '',
            'password' => bcrypt('Congope@123'),
            'remember_token' => md5(uniqid('', true)),
            'changed_password' => 1,
            'identification_type' => 'other',
            'enabled' => 1
        ]);
        $dev->assignRole($devRole);

        DB::statement("select setval('users_id_seq', (select max(id) from users)+1)");
    }
}
