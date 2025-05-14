<?php

declare(strict_types=1);

namespace App\Application\Controller\User;

use App\Application\Request\CreateUserRequest;
use App\Component\Common\Responder\FailedResponder;
use App\Component\Common\Responder\SuccessResponder;
use App\Component\User\Handler\CreateUserHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

final readonly class CreateUserAction
{
    public function __construct(
        private CreateUserHandler $handler,
    ) {
    }

    public function __invoke(CreateUserRequest $request): JsonResponse
    {
        try {
            return SuccessResponder::respond(
                $this->handler->handle($request->toDto()),
            );
        } catch (Throwable $throwable) {
            return FailedResponder::respond($throwable->getMessage());
        }
    }
}
