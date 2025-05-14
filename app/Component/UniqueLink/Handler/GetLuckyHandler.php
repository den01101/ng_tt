<?php

declare(strict_types=1);

namespace App\Component\UniqueLink\Handler;

use App\Component\Common\Responder\Dto\ResponseDtoInterface;
use App\Component\UniqueLink\Job\GetLuckyJob;
use App\Component\UniqueLink\Response\Dto\GetLuckyResponseDto;
use App\Component\UniqueLink\Service\GetLuckyService;
use App\Component\UniqueLink\Validator\UniqueLinkValidator;
use App\Component\User\Model\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cache;

final class GetLuckyHandler
{
    /**
     * @param User $user
     */
    public function handle(string $code, Authenticatable $user): ResponseDtoInterface
    {
        UniqueLinkValidator::validate($code, $user);

        $cacheKey = GetLuckyService::cacheKey($code, $user->id);

        dispatch(new GetLuckyJob($cacheKey))->withoutDelay();

        $records = Cache::get($cacheKey);
        $lastRecord = end($records);

        return new GetLuckyResponseDto(...$lastRecord);
    }
}
