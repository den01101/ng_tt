<?php

declare(strict_types=1);

namespace App\Application\Controller\UniqueLink;

use App\Component\Common\Responder\FailedResponder;
use App\Component\Common\Responder\SuccessResponder;
use App\Component\UniqueLink\Handler\CreateUniqueLinkHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

final readonly class CreateUniqueLinkAction
{
    public function __construct(
        private CreateUniqueLinkHandler $handler,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        try {
            return SuccessResponder::respond(
                $this->handler->handle(auth('api')->user()),
            );
        } catch (Throwable $throwable) {
            return FailedResponder::respond($throwable->getMessage());
        }
    }
}
