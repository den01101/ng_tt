<?php

declare(strict_types=1);

namespace App\Component\Common\Responder\Dto;

interface ResponseDtoInterface
{
    public function data(): array;
}
