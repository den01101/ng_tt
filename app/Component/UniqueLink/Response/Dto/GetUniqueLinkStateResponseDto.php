<?php

declare(strict_types=1);

namespace App\Component\UniqueLink\Response\Dto;

use App\Component\Common\Responder\Dto\ResponseDtoInterface;

final readonly class GetUniqueLinkStateResponseDto implements ResponseDtoInterface
{
    public function __construct(
        private bool $isActive,
    ) {
    }

    public function data(): array
    {
        return [
            'is_active' => $this->isActive,
        ];
    }
}
