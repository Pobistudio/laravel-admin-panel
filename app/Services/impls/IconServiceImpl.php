<?php

namespace App\Services\Impls;

use App\DTOs\Icons\CreateIconDto;
use App\DTOs\Icons\UpdateIconDto;
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
        $id = str_replace(' ', '-', strtolower($dto->name));
        $id = 'ri-'.$id.'-'.$dto->type;
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

    public function update(UpdateIconDto $dto)
    {
        $iconWithId = Icon::find($dto->id);
        if (!$iconWithId) {
            throw new ServiceException("Icon with id {$dto->id} not found");
        }

        $newId = str_replace(' ', '-', strtolower($dto->name));
        $newId = 'ri-'.$newId.'-'.$dto->type;

        if ($newId != $dto->id) {
            $statusWithName = Icon::find($newId);

            if ($statusWithName) {
                throw new ServiceException("Icon with name {$dto->name} already exists");
            }
        }

        $iconWithId->id = $newId;
        $iconWithId->name = $dto->name;
        $iconWithId->section = $dto->section;
        return $iconWithId->save();
    }

    public function getIconById(string $id)
    {
        return Icon::find($id);
    }

    public function changeStatus(string $id, bool $isActive)
    {
        $icon = Icon::find($id);
        if (!$icon) {
            throw new ServiceException("Icon with id {$id} not found");
        }
        $icon->is_active = $isActive;
        return $icon->save();
    }
}
