<?php

namespace Database\Seeders;

use App\Models\System\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'name' => 'Administrador Global',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Congope@123'),
            'remember_token' => md5(uniqid('', true)),
        ]);
    }
}
