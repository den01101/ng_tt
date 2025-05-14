<?php

declare(strict_types=1);

namespace App\Component\User\Handler;

use App\Application\Request\Dto\RegistrationRequestDto;
use App\Component\Common\Responder\Dto\ResponseDtoInterface;
use App\Component\User\Model\User;
use App\Component\User\Response\Dto\CreateUserResponseDto;
use Tymon\JWTAuth\Facades\JWTAuth;

final readonly class CreateUserHandler
{
    public function handle(RegistrationRequestDto $dto): ResponseDtoInterface
    {
        $payload = [
            'name' => $dto->user_name,
            'phone' => $dto->phone_number,
        ];

        $user = User::where($payload)->first()
            ?? User::create($payload);

        $token = JWTAuth::fromUser($user);

        return new CreateUserResponseDto($token);
    }
}
