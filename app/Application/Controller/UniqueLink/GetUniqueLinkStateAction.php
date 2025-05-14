<?php

declare(strict_types=1);

namespace App\Application\Controller\UniqueLink;

use App\Component\Common\Responder\FailedResponder;
use App\Component\Common\Responder\SuccessResponder;
use App\Component\UniqueLink\Handler\GetUniqueLinkStateHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

final readonly class GetUniqueLinkStateAction
{
    public function __construct(
        private GetUniqueLinkStateHandler $handler,
    ) {
    }

    public function __invoke(string $code): JsonResponse
    {
        try {
            return SuccessResponder::respond(
                $this->handler->handle($code, auth('api')->user()),
            );
        } catch (Throwable $throwable) {
            return FailedResponder::respond($throwable->getMessage());
        }
    }
}
