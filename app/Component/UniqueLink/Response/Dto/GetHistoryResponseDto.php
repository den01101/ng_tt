<?php

declare(strict_types=1);

namespace App\Component\UniqueLink\Response\Dto;

use App\Component\Common\Responder\Dto\ResponseDtoInterface;

final readonly class GetHistoryResponseDto implements ResponseDtoInterface
{
    public function __construct(
        private array $records,
    ) {
    }

    public function data(): array
    {
        return array_map(
            static fn (array $record) => $record,
            $this->records,
        );
    }
}
