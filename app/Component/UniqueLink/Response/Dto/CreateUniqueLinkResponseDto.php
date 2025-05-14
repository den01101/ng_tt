<?php

declare(strict_types=1);

namespace App\Component\UniqueLink\Response\Dto;

use App\Component\Common\Responder\Dto\ResponseDtoInterface;

final readonly class CreateUniqueLinkResponseDto implements ResponseDtoInterface
{
    public function __construct(
        private string $code,
    ) {
    }

    public function data(): array
    {
        return [
            'unique_link' => route('web.unique_link', ['code' => $this->code]),
        ];
    }
}
