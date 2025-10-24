<?php

namespace App\Services\Contracts;

use App\DTOs\Icons\CreateIconDto;
use App\DTOs\Icons\UpdateIconDto;

interface IconService
{
    public function getIconTypesSelect();

    public function create(CreateIconDto $dto);

    public function update(UpdateIconDto $dto);

    public function getIconById(string $id);

    public function changeStatus(string $id, bool $isActive);

    public function getAll(int $isActive = 2);

    public function getIconsDataSelect($allItem = true);
}
