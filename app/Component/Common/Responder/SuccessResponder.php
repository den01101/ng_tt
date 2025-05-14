<?php

declare(strict_types=1);

namespace App\Component\Common\Responder;

use App\Component\Common\Responder\Dto\ResponseDtoInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final readonly class SuccessResponder
{
    public static function respond(
        ?ResponseDtoInterface $dto = null,
        ?int $statusCode = Response::HTTP_OK,
    ): JsonResponse {
        return new JsonResponse($dto?->data(), $statusCode);
    }
}
