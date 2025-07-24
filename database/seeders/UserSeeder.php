<?php

namespace Database\Seeders;

use App\Models\User;
use App\StatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $passwordDefault = env('DEFAULT_PASSWORD');

        User::insert([
            [
                'id' => (string) Str::uuid(),
                'status_id' => StatusEnum::ACTIVE->value,
                'role_id' => 'super_admin',
                'name' => 'The Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make($passwordDefault),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => (string) Str::uuid(),
                'status_id' => StatusEnum::ACTIVE->value,
                'role_id' => 'admin',
                'name' => 'The Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make($passwordDefault),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
