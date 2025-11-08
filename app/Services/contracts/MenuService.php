<?php

namespace App\Services\Contracts;

use App\DTOs\Menus\CreateMenuDto;
use App\DTOs\Menus\UpdateMenuDto;

interface MenuService
{
    public function getAllParent(int $isActive = 2);

    public function getAllParentDataSelect($allItem = true);

    public function getMenuByid(string $id);

    public function create(CreateMenuDto $dto);

    public function update(UpdateMenuDto $dto);
}
