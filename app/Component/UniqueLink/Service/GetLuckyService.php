<?php

declare(strict_types=1);

namespace App\Component\UniqueLink\Service;

final class GetLuckyService
{
    public static function cacheKey(string $code, int $userId): string
    {
        return sprintf('get_lucky_%s_%d', $code, $userId);
    }
}
