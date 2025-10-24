<?php

namespace App\Services\Impls;

use App\Exceptions\ServiceException;
use App\Models\Menu;
use App\Services\Contracts\MenuService;
use App\Utils\MappingUtils;

class MenuServiceImpl implements MenuService
{
    /**
     * Summary of getAllParent
     * @param int $isActive
     * @throws \App\Exceptions\ServiceException
     * @return Menu
     */
    public function getAllParent(int $isActive = 2)
    {

        if ($isActive < 2) {
            $menus = Menu::where('parent', 0)
                    ->where('is_active', $isActive)
                    ->orWhereRaw('id = parent')
                    ->orWhereRaw("link = '#'")
                    ->orderBy('order', 'asc')
                    ->get();
        } else {
            $menus = Menu::where('parent', 0)
                    ->orWhereRaw('id = parent')
                    ->orWhereRaw("link = '#'")
                    ->orderBy('order', 'asc')
                    ->get();
        }


        if (!$menus) {
            throw new ServiceException("Menu not found");
        }

        return $menus;
    }

    /**
     * Summary of getAllParentDataSelect
     */
    public function getAllParentDataSelect($allItem = true)
    {
        $icons = $this->getAllParent( 1)->toArray();

        if ($allItem) {
            array_unshift($icons, [ 'id' => '#', 'name' => 'Default Parent' ]);
        }

        return MappingUtils::mapToValueLabel($icons, 'id', 'name');
    }
}
