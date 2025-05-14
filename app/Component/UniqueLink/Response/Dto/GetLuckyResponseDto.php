<?php

declare(strict_types=1);

namespace App\Component\UniqueLink\Response\Dto;

use App\Component\Common\Responder\Dto\ResponseDtoInterface;

final readonly class GetLuckyResponseDto implements ResponseDtoInterface
{
    public function __construct(
        private int $number,
        private bool $win,
        private int $amount,
    ) {
    }

    public function data(): array
    {
        return [
            'number' => $this->number,
            'win' => $this->win,
            'amount' => $this->amount,
        ];
    }
}
