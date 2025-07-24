<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => 'super_admin',
                'name' => 'Super Admin',
                'child_roles' => 'super_admin,admin',
            ],
            [
                'id' => 'admin',
                'name' => 'Admin',
                'child_roles' => 'admin',
            ],
        ];

        Role::insert($roles);
    }
}
