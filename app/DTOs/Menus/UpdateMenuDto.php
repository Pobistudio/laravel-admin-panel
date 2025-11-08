<?php

namespace App\DTOs\Menus;

use App\Http\Requests\Menus\UpdateMenuRequest;

class UpdateMenuDto
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $link,
        public readonly string $linkAlias,
        public readonly string $icon,
        public readonly int $parent,
        public readonly int $order,
    ) {
    }

    public static function fromRequest(UpdateMenuRequest $request, string $id)
    {
        $link      = $request->validated('link');
        $linkAlias = $request->validated('link_alias');
        $icon      = $request->validated('icon');
        $parent    = $request->validated('parent');
        $order     = $request->validated('order');

        return new self(
            id: $id,
            name: $request->validated('name'),
            link: empty($link) ? '#' : $link,
            linkAlias: empty($linkAlias) ? '#' : $linkAlias,
            icon: empty($icon) ? '#' : $icon,
            parent: $parent != '#' ? $parent : 0,
            order: empty($order) ? 0 : $order,
        );
    }
}
