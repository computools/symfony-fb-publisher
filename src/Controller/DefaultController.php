<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends BaseController
{
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'API for template project'
        ]);
    }
}