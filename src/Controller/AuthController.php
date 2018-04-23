<?php

namespace App\Controller;

use App\Handler\Auth\RegistrationHandler;
use App\Helper\AuthTokenHelper;
use App\Request\RegistrationRequest;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class AuthController
 * @package App\Controller
 *
 * @Rest\Route("/auth")
 */
class AuthController extends BaseController
{
    /**
     * @Rest\Post("")
     */
    public function authorize(): void
    {

    }

    /**
     * @Rest\Post("/register")
     *
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        $response = $this->json([
            'token' => $this->get(RegistrationHandler::class)($request)
        ]);
        $this->flush();
        return $response;
    }
}