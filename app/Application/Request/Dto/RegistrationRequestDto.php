<?php

declare(strict_types=1);

namespace App\Application\Request\Dto;

final readonly class RegistrationRequestDto implements RequestDtoInterface
{
    public function __construct(
        public string $user_name,
        public string $phone_number,
    ) {
    }
}
