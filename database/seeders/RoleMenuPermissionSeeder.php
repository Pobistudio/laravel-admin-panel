<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\RoleMenuPermission;
use Illuminate\Database\Seeder;

class RoleMenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dashboard = Menu::where('name', 'Dashboard')->first();
        $settings = Menu::where('name', 'Settings')->first();
        $role = Menu::where('name', 'Role')->first();
        $menu = Menu::where('name', 'Menu')->first();
        $permission = Menu::where('name', 'Permission')->first();
        $status = Menu::where('name', 'Status')->first();
        $icon = Menu::where('name', 'Icon')->first();
        $user = Menu::where('name', 'User')->first();
        $profile = Menu::where('name', 'Profile')->first();

        $rolemenupermission = [
            [
                'role_id' => 'admin',
                'menu_id' => $dashboard->id,
                'permission_id' => 'view'
            ],
            [
                'role_id' => 'admin',
                'menu_id' => $user->id,
                'permission_id' => 'view'
            ],
            [
                'role_id' => 'admin',
                'menu_id' => $user->id,
                'permission_id' => 'create'
            ],
            [
                'role_id' => 'admin',
                'menu_id' => $user->id,
                'permission_id' => 'update'
            ],
            [
                'role_id' => 'admin',
                'menu_id' => $user->id,
                'permission_id' => 'reset_password'
            ],
            [
                'role_id' => 'admin',
                'menu_id' => $user->id,
                'permission_id' => 'change_role'
            ],
            [
                'role_id' => 'admin',
                'menu_id' => $user->id,
                'permission_id' => 'change_status'
            ],
            [
                'role_id' => 'admin',
                'menu_id' => $profile->id,
                'permission_id' => 'view'
            ],
            [
                'role_id' => 'admin',
                'menu_id' => $profile->id,
                'permission_id' => 'change_profile'
            ],
            [
                'role_id' => 'admin',
                'menu_id' => $profile->id,
                'permission_id' => 'change_password'
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $dashboard->id,
                'permission_id' => 'view'
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $user->id,
                'permission_id' => 'view'
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $user->id,
                'permission_id' => 'create'
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $user->id,
                'permission_id' => 'update'
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $user->id,
                'permission_id' => 'reset_password'
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $user->id,
                'permission_id' => 'change_role'
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $user->id,
                'permission_id' => 'change_status'
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $status->id,
                'permission_id' => 'view',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $profile->id,
                'permission_id' => 'view'
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $profile->id,
                'permission_id' => 'change_profile'
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $profile->id,
                'permission_id' => 'change_password'
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $status->id,
                'permission_id' => 'create',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $status->id,
                'permission_id' => 'update',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $status->id,
                'permission_id' => 'change_status',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $role->id,
                'permission_id' => 'view',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $role->id,
                'permission_id' => 'create',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $role->id,
                'permission_id' => 'update',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $role->id,
                'permission_id' => 'change_status',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $menu->id,
                'permission_id' => 'view',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $menu->id,
                'permission_id' => 'create',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $menu->id,
                'permission_id' => 'update',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $menu->id,
                'permission_id' => 'change_status',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $permission->id,
                'permission_id' => 'view',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $permission->id,
                'permission_id' => 'create',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $permission->id,
                'permission_id' => 'update',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $permission->id,
                'permission_id' => 'change_status',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $icon->id,
                'permission_id' => 'view',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $icon->id,
                'permission_id' => 'create',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $icon->id,
                'permission_id' => 'update',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $icon->id,
                'permission_id' => 'change_status',
            ],
            [
                'role_id' => 'super_admin',
                'menu_id' => $settings->id,
                'permission_id' => 'view',
            ],
        ];
        RoleMenuPermission::insert($rolemenupermission);
    }
}
