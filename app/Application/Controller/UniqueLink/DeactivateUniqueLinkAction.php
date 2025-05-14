<?php

declare(strict_types=1);

namespace App\Application\Controller\UniqueLink;

use App\Component\Common\Responder\FailedResponder;
use App\Component\Common\Responder\SuccessResponder;
use App\Component\UniqueLink\Handler\DeactivateUniqueLinkHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

final readonly class DeactivateUniqueLinkAction
{
    public function __construct(
        private DeactivateUniqueLinkHandler $handler,
    ) {
    }

    public function __invoke(string $code): JsonResponse
    {
        try {
            $this->handler->handle($code, auth('api')->user());

            return SuccessResponder::respond();
        } catch (Throwable $throwable) {
            return FailedResponder::respond($throwable->getMessage());
        }
    }
}
