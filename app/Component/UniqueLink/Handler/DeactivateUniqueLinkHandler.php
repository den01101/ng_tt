<?php

declare(strict_types=1);

namespace App\Component\UniqueLink\Handler;

use App\Component\UniqueLink\Validator\UniqueLinkValidator;
use App\Component\User\Model\User;
use Illuminate\Contracts\Auth\Authenticatable;

final class DeactivateUniqueLinkHandler
{
    /**
     * @param User $user
     */
    public function handle(string $code, Authenticatable $user): void
    {
        UniqueLinkValidator::validate($code, $user);

        $user->uniqueLinks()->where(['code' => $code])->delete();
    }
}
