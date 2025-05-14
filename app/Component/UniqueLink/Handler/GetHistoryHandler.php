<?php

declare(strict_types=1);

namespace App\Component\UniqueLink\Handler;

use App\Component\Common\Responder\Dto\ResponseDtoInterface;
use App\Component\UniqueLink\Response\Dto\GetHistoryResponseDto;
use App\Component\UniqueLink\Service\GetLuckyService;
use App\Component\UniqueLink\Validator\UniqueLinkValidator;
use App\Component\User\Model\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cache;

final class GetHistoryHandler
{
    /**
     * @param User $user
     */
    public function handle(string $code, Authenticatable $user): ResponseDtoInterface
    {
        UniqueLinkValidator::validate($code, $user);

        return new GetHistoryResponseDto(
            array_reverse(Cache::get(GetLuckyService::cacheKey($code, $user->id), [])),
        );
    }
}
