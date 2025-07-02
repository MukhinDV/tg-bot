<?php

declare(strict_types=1);

namespace App\src\Factory;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class FailedResponseFactory
{
    public static function createResponse(ConstraintViolationListInterface $constraintViolationList): JsonResponse
    {
        $errors = [];

        /** @var ConstraintViolationInterface $constraintViolation */
        foreach ($constraintViolationList as $constraintViolation) {
            $errors[] = [
                'name' => $constraintViolation->getPropertyPath(),
                'error' => $constraintViolation->getMessage(),
            ];
        }

        return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
    }
}
