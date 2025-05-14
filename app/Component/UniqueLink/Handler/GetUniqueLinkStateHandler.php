<?php

declare(strict_types=1);

namespace App\Component\UniqueLink\Handler;

use App\Component\Common\Responder\Dto\ResponseDtoInterface;
use App\Component\UniqueLink\Model\UniqueLink;
use App\Component\UniqueLink\Response\Dto\GetUniqueLinkStateResponseDto;
use App\Component\UniqueLink\Validator\UniqueLinkValidator;
use App\Component\User\Model\User;
use Illuminate\Contracts\Auth\Authenticatable;
use RuntimeException;

final class GetUniqueLinkStateHandler
{
    /**
     * @param User $user
     */
    public function handle(string $code, Authenticatable $user): ResponseDtoInterface
    {
        UniqueLinkValidator::validate($code, $user);

        $userLink = $user->uniqueLinksWithTrashed()->where(['code' => $code])->first();

        if (is_null($userLink)) {
            throw new RuntimeException('Link not found');
        }

        /** @var UniqueLink $userLink */
        return new GetUniqueLinkStateResponseDto($userLink->isActiveLink());
    }
}
