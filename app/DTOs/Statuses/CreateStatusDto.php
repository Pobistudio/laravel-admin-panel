<?php

namespace App\DTOs\Statuses;

use App\Http\Requests\Statuses\CreateStatusRequest;

class CreateStatusDto
{
    public function __construct(
        public string $name,
    ) {}

    public static function fromRequest(CreateStatusRequest $request)
    {
        return new self(
            name: $request->validated('name'),
        );
    }
}
