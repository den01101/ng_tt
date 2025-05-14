<?php

declare(strict_types=1);

namespace App\Component\UniqueLink\Service;

final class UniqueLinkService
{
    public function createCode(int $userId, string $salt): string
    {
        return md5(sprintf('%s:%d:%s', config('unique_link.salt'), $userId, $salt));
    }
}
