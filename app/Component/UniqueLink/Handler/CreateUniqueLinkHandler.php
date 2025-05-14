<?php

declare(strict_types=1);

namespace App\Component\UniqueLink\Handler;

use App\Component\Common\Responder\Dto\ResponseDtoInterface;
use App\Component\UniqueLink\Model\UniqueLink;
use App\Component\UniqueLink\Response\Dto\CreateUniqueLinkResponseDto;
use App\Component\UniqueLink\Service\UniqueLinkService;
use App\Component\User\Model\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use RuntimeException;
use Throwable;

final class CreateUniqueLinkHandler
{
    private const int EXPIRES_AT = 604800;

    public function __construct(
        private readonly UniqueLinkService $service,
    ) {
    }

    /**
     * @param User $user
     */
    public function handle(Authenticatable $user): ResponseDtoInterface
    {
        try {
            DB::beginTransaction();

            $user->uniqueLinks()->delete();

            $userId = $user->id;
            $salt = Uuid::uuid4()->toString();
            $code = $this->service->createCode($userId, $salt);

            UniqueLink::create([
                'user_id' => $userId,
                'code' => $code,
                'salt' => $salt,
                'expires_at' => Carbon::createFromTimestamp(time() + self::EXPIRES_AT),
            ]);

            DB::commit();

            return new CreateUniqueLinkResponseDto($code);
        } catch (Throwable $throwable) {
            DB::rollBack();

            throw new RuntimeException($throwable->getMessage());
        }
    }
}
