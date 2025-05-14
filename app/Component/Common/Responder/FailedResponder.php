<?php

declare(strict_types=1);

namespace App\Component\Common\Responder;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final readonly class FailedResponder
{
    public static function respond(
        ?string $message = 'Something wrong',
        ?int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
    ): JsonResponse {
        return new JsonResponse(['message' => $message], $statusCode);
    }
}
