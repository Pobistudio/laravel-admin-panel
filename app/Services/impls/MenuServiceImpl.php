<?php

namespace App\Services\Impls;

use App\Exceptions\ServiceException;
use App\Models\Menu;
use App\Services\Contracts\MenuService;

class MenuServiceImpl implements MenuService
{
    /**
     * Summary of getAllParent
     * @throws \App\Exceptions\ServiceException
     * @return mixed
     */
    public function getAllParent()
    {
        $menus = Menu::where('parent', 0)
        ->where('status', 1)
        ->orWhereRaw('id = parent')
        ->orWhereRaw("link = '#'")
        ->orderBy('order', 'asc')
        ->get()->toArray();

        if (!$menus) {
            throw new ServiceException("Menu not found");
        }

        return $menus;

    }
}
