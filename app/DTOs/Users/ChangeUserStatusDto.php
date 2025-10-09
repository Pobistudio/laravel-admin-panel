<?php

namespace App\DTOs\Users;

use App\Http\Requests\Users\ChangeUserStatusRequest;

class ChangeUserStatusDto
{
    public function __construct(
        public string $id,
        public ?string $statusId,
    ) {}

    public static function fromRequest(ChangeUserStatusRequest $request, $id)
    {
        return new self(
            id: $id,
            statusId: $request->validated('status'),
        );
    }
}
