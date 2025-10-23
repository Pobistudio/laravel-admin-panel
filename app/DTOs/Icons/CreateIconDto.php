<?php

namespace App\DTOs\Icons;

use App\Http\Requests\Icons\CreateIconRequest;

class CreateIconDto
{
    public function __construct(
        public string $name,
        public string $section,
    ) {}

    public static function fromRequest(CreateIconRequest $request, string $section)
    {
        return new self(
            name: $request->validated('name'),
            section: $section,
        );
    }
}
