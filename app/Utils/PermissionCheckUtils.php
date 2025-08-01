<?php

namespace App\Utils;

use Illuminate\Support\Facades\DB;

class PermissionCheckUtils
{
    public static function execute(string $value)
    {
        $splitValue = explode('.', $value);
        $sizeValue  = count($splitValue);

        if ($sizeValue != 2) {
            return false;
        }

        $link            = $splitValue[0];
        $permission      = $splitValue[1];
        $menuPermissions = self::getMenusPermissions();

        return !empty(array_filter($menuPermissions, function ($item) use ($link, $permission) {
            if (str_starts_with($link, $item['link'])) {
                return in_array($permission, $item['permissions']);
            }
        }));
    }

    private static function getMenusPermissions()
    {
        $userID          = SessionUtils::get('id');
        $role            = SessionUtils::get('role');
        $menuPermissions = CacheUtils::get('menuPermissions', [$role]);

        if (!$menuPermissions) {
            $menuPermissions = self::getMenuPermissionByUser($userID);
            CacheUtils::put('menuPermissions', [$role], $menuPermissions);
        }

        return $menuPermissions;
    }

    private static function getMenuPermissionByUser($userID)
    {
        $response = DB::table('users')
                ->select('menus.link', DB::raw('GROUP_CONCAT(role_menu_permission.permission_id ORDER BY role_menu_permission.permission_id ASC) as permissions'))
                ->leftJoin('role_menu_permission', 'role_menu_permission.role_id', '=', 'users.role_id')
                ->leftJoin('menus', 'menus.id', '=', 'role_menu_permission.menu_id')
                ->where('users.id', $userID)
                ->where('menus.link', '!=', '#')
                ->groupBy('users.id', 'role_menu_permission.role_id', 'role_menu_permission.menu_id')
                ->get()->toArray();

        $result = [];

        foreach ($response as $item) {
            $data['link'] = $item->link;
            $data['permissions'] = explode(',', $item->permissions);
            array_push($result, $data);
        }
        return $result;
    }
}
