<?php

namespace App\Utils;

use App\Models\Menu;

class MenuUtils
{
    public static function getSidebar(array $segments)
    {
        $menus = self::getMenus();
        return self::sidebarGenerator($menus, $segments);
    }

    public static function getPreviewTreeMenu()
    {
        return self::sidebarGenerator(self::buildTreeMenu(self::getMenusByParams()), [], true);
    }

    private static function sidebarGenerator(array $menus, array $segments, $isPreview = false)
    {
        $sidebar = '';
        $hover   = !$isPreview ? 'hover:bg-slate-500 hover:rounded-lg hover:text-lap-white' : '';

        foreach ($menus as $item) {
            $link         = implode('/', $segments);
            $isActive     = str_starts_with($link, $item['link']) || $link == self::findLink($link, $item['children']);
            $bgSelectMenu = $isActive ? 'bg-slate-500 drop-shadow-xl rounded-lg text-lap-white' : '';

            if ($isPreview) {
               $bgSelectMenu = '';
            }

            $icon = '';

            if ($item['icon'] != '#') {
                $icon = '<i class="'.$item['icon'].' ri-lg"></i>';
            } else {
                $icon = '<span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>';
            }

            $order = $isPreview ? '['.$item['order'].'] ' : '';

            if ($item['children']) {
                $showNestedMenu = $isActive ? '' : 'hidden';
                $rotateToggle   = $isActive ? 'rotate-180' : '';

                $sidebar .= '<li class="relative my-2">';
                $sidebar .= '<a href="#" class="flex items-center justify-between p-2 '. $hover .' menu-toggle">';
                $sidebar .= '<span class="flex gap-2 items-center text-sm">'. $icon . $order . $item['name'] .'</span>';
                $sidebar .= '<svg class="w-4 h-4 transition-transform duration-200 transform '. $rotateToggle .'" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
                $sidebar .= '</a>';
                $sidebar .= '<ul class="ml-4 nested-menu '. $showNestedMenu .'">';
                $sidebar .= self::sidebarGenerator($item['children'], $segments, $isPreview);
                $sidebar .= '</ul>';
            } else {
                $linkAlias = !$isPreview ? route($item['link_alias']) : '#';
                $sidebar .= '<li class="my-2">';
                $sidebar .= '<a href="'. $linkAlias .'" class="flex items-center justify-between p-2 '. $bgSelectMenu . ' ' . $hover .' ">';
                $sidebar .= '<span class="flex gap-2 items-center text-sm">'. $icon . $order . $item['name'] .'</span>';
                $sidebar .= '</a>';
            }

            $sidebar .= '</li>';
        }
        return $sidebar;
    }

    private static function getMenus()
    {
        $role  = SessionUtils::get('role');
        $menus = CacheUtils::get('menus', [$role]);

        if (!$menus) {
            $menus = self::getMenusByParams($role);
            CacheUtils::put('menus', [$role], $menus);
        }

        $menus = self::buildTreeMenu($menus);
        return $menus;
    }

    private static function getMenusByParams($role = ''): array
    {
        $menus = Menu::leftJoin('role_menu_permission', 'role_menu_permission.menu_id', '=', 'menus.id')
        ->select('menus.*');

        if ($role) {
            $menus->where('role_menu_permission.role_id', $role);
        }

        return $menus->where('menus.is_active', 1)
            ->groupBy('menus.id')  // Changed from role_menu_permission.menu_id
            ->orderBy('menus.order', 'asc')  // Also specify table for clarity
            ->get()
            ->toArray();
    }

    private static function buildTreeMenu(array $menus, int $parent = 0): array
    {
        $tree = [];

        foreach ($menus as $element) {
            if ($element['parent'] == $parent) {
                $children = self::buildTreeMenu($menus, $element['id']);
                $element['children'] = [];

                if ($children) {
                    $element['children'] = $children;
                }

                if ($element['order'] != 0) {
                    $tree[] = $element;
                }
            }
        }
        return $tree;
    }

    private static function findLink($path, $menus) {
        foreach ($menus as $menu) {
            if (isset($menu['link']) && str_starts_with(ltrim($path, '/'), $menu['link'])) {
                return true;
            }

            if (isset($menu['children']) && is_array($menu['children'])) {
                if (self::findLink( $path,  $menu['children'])){
                    return $path;
                }
            }
        }
    }
}
