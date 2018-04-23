<?php

namespace App\Controller;

use App\Response\User\UserTransformer;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class UserController
 * @package App\Controller
 *
 * @Rest\Route("/user")
 */
class UserController extends BaseController
{
    /**
     * @Rest\Get("")
     */
    public function getUserInfo(): JsonResponse
    {
        return $this->json(
            $this->item($this->getUser(), new UserTransformer())
        );
    }
}