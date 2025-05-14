<?php

declare(strict_types=1);

namespace App\Component\User\Response\Dto;

use App\Component\Common\Responder\Dto\ResponseDtoInterface;

final readonly class CreateUserResponseDto implements ResponseDtoInterface
{
    public function __construct(
        private string $accessToken,
    ) {
    }

    public function data(): array
    {
        return [
            'access_token' => $this->accessToken,
            'token_type' => 'bearer',
        ];
    }
}
