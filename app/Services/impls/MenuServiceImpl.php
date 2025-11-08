<?php

namespace App\Services\Impls;

use App\DTOs\Menus\CreateMenuDto;
use App\DTOs\Menus\UpdateMenuDto;
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

    /**
     * Summary of getMenuByid
     * @param string $id
     * @return Menu|null
     */
    public function getMenuByid(string $id)
    {
        return Menu::where('id', $id)->first();
    }

    public function create(CreateMenuDto $dto)
    {
        $menu = Menu::where('name', $dto->name)->first();

        if ($menu) {
            throw new ServiceException("Menu with name {$dto->name} already exists");
        }

        $menu = Menu::create([
            'name'       => $dto->name,
            'link'       => !empty($dto->link) ? $dto->link : '#',
            'link_alias' => !empty($dto->linkAlias) ? $dto->linkAlias : '#',
            'icon'       => !empty($dto->icon) ? $dto->icon : '#',
            'parent'     => $dto->parent != '#' ? $dto->parent : 0,
            'order'      => $dto->order,
        ]);

        if (!$menu) {
            throw new ServiceException("Failed to create menu");
        }

        return $menu;
    }

    /**
     * Summary of update
     * @param UpdateMenuDto $dto
     * @throws \App\Exceptions\ServiceException
     * @return Menu
     */
    public function update(UpdateMenuDto $dto)
    {
        $menu = Menu::find($dto->id);
        if (!$menu) {
            throw new ServiceException("Menu with id {$dto->id} not found");
        }

        $menu->name = $dto->name;
        $menu->link = !empty($dto->link) ? $dto->link : '#';
        $menu->link_alias = !empty($dto->linkAlias) ? $dto->linkAlias : '#';
        $menu->icon = !empty($dto->icon) ? $dto->icon : '#';
        $menu->parent = $dto->parent != '#' ? $dto->parent : 0;
        $menu->order = $dto->order;

        $updated = $menu->save();

        if (!$updated) {
            throw new ServiceException("Failed to update menu");
        }

        return $menu;
    }
}
