<?php

namespace App\Services\Contracts;

interface MenuService
{
    public function getAllParent(int $isActive = 2);

    public function getAllParentDataSelect($allItem = true);
}
