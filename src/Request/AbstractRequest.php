<?php

namespace App\Request;

use Fesor\RequestObject\ErrorResponseProvider;
use Fesor\RequestObject\RequestObject;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class AbstractRequest
 * @package App\Request
 */
abstract class AbstractRequest extends RequestObject implements ErrorResponseProvider
{
    public function getErrorResponse(ConstraintViolationListInterface $errors): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Bad request',
            'errors' => array_map(function(ConstraintViolation $violation) {
                return [
                    'path' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage()
                ];
            }, iterator_to_array($errors)),
        ], Response::HTTP_BAD_REQUEST);
    }
}