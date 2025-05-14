<?php

declare(strict_types=1);

namespace App\Component\UniqueLink\Validator;

use App\Component\User\Model\User;
use Illuminate\Contracts\Auth\Authenticatable;
use RuntimeException;

final class UniqueLinkValidator
{
    /**
     * @param User $user
     */
    public static function validate(string $code, Authenticatable $user): void
    {
        if ($user->uniqueLinksWithTrashed()->where('code', $code)->doesntExist()) {
            throw new RuntimeException('Access denied');
        }
    }
}
