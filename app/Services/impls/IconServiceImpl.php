<?php

namespace App\Services\Impls;

use App\DTOs\Icons\CreateIconDto;
use App\Exceptions\ServiceException;
use App\Models\Icon;
use App\Services\Contracts\IconService;
use App\Utils\MappingUtils;

class IconServiceImpl implements IconService
{
    public function getIconTypesSelect()
    {
        $data = [
            [
                "id" => "line",
                "name" => "Line"
            ],
            [
                "id" => "fill",
                "name" => "Fill"
            ],
        ];

        return MappingUtils::mapToValueLabel($data, 'id', 'name');
    }

    public function create(CreateIconDto $dto)
    {
        $id = 'ri-'.str_replace(' ', '-', strtolower($dto->name));
        $icon = Icon::find($id);

        if ($icon) {
            throw new ServiceException("Icon with name {$dto->name} already exists");
        }

        $icon = Icon::create([
            'id' => $id,
            'name' => $dto->name,
            'section' => $dto->section
        ]);

        if (!$icon) {
            throw new ServiceException("Failed to create icon");
        }

        return $icon;
    }
}
