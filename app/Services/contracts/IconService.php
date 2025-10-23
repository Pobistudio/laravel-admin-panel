<?php

namespace App\Services\Contracts;

use App\DTOs\Icons\CreateIconDto;

interface IconService
{
    public function getIconTypesSelect();

    public function create(CreateIconDto $dto);
}
