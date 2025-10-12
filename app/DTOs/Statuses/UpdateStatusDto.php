<?php

namespace App\DTOs\Statuses;
use App\Http\Requests\Statuses\UpdateStatusRequest;

class UpdateStatusDto
{
    public function __construct(
        public string $id,
        public string $name,
    ) {}

    public static function fromRequest(UpdateStatusRequest $request, string $id)
    {
        return new self(
            id: $id,
            name: $request->validated('name'),
        );
    }
}
