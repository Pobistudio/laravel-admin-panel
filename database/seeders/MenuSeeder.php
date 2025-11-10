<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'name' => 'Dashboard',
            'icon' => 'ri-home-6-line',
            'link' => 'dashboard',
            'link_alias' => 'dashboard',
            'parent' => 0,
            'order' => 1,
        ]);

        Menu::create([
            'name' => 'User',
            'icon' => 'ri-user-line',
            'link' => 'users',
            'link_alias' => 'users',
            'parent' => 0,
            'order' => 2,
        ]);

        Menu::create([
            'name' => 'Profile',
            'link' => 'profile',
            'link_alias' => 'profile',
            'parent' => 0,
            'order' => 0,
        ]);

        $menuSettings = Menu::create([
            'name' => 'Settings',
            'icon' => 'ri-tools-line',
            'parent' => 0,
            'order' => 100,
        ]);

        $subMenuSettings = [
            [
                'name' => 'Icon',
                'link' => 'settings/icons',
                'link_alias' => 'icons',
                'parent' => $menuSettings->id,
                'order' => 1,
            ],
            [
                'name' => 'Status',
                'link' => 'settings/statuses',
                'link_alias' => 'statuses',
                'parent' => $menuSettings->id,
                'order' => 2,
            ],
            [
                'name' => 'Role',
                'link' => 'settings/roles',
                'link_alias' => 'roles',
                'parent' => $menuSettings->id,
                'order' => 3,
            ],
            [
                'name' => 'Permission',
                'link' => 'settings/permissions',
                'link_alias' => 'permissions',
                'parent' => $menuSettings->id,
                'order' => 4,
            ],
            [
                'name' => 'Menu',
                'link' => 'settings/menus',
                'link_alias' => 'menus',
                'parent' => $menuSettings->id,
                'order' => 5,
            ],
        ];

        Menu::insert($subMenuSettings);

        $menu = Menu::where('name', 'Menu')->first();

        $subMenuMenu = [
            [
                'name' => 'Assign Menu Permission',
                'link' => 'settings/menus/assign-menu-permissions',
                'link_alias' => 'assign-menu-permissions',
                'parent' => $menu->id,
                'order' => 0,
            ],
        ];

        Menu::insert($subMenuMenu);

    }
}
