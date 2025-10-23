<?php

namespace App\DTOs\Icons;

use App\Http\Requests\Icons\UpdateIconRequest;

class UpdateIconDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $type,
        public string $section,
    ) {}

    public static function fromRequest(UpdateIconRequest $request, string $id)
    {
        return new self(
            id: $id,
            name: $request->validated('name'),
            type: $request->validated('type'),
            section: $request->validated('section'),
        );
    }
}
