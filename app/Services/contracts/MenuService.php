<?php

namespace App\Services\Contracts;

use App\DTOs\Menus\CreateMenuDto;

interface MenuService
{
    public function getAllParent(int $isActive = 2);

    public function getAllParentDataSelect($allItem = true);

    public function create(CreateMenuDto $dto);
}
