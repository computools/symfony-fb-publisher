<?php

namespace App\Controller;

use App\Handler\Theme\CreateThemeHandler;
use App\Handler\Theme\DeleteThemeHandler;
use App\Handler\Theme\GetPostsByThemeHandler;
use App\Handler\Theme\GetThemesHandler;
use App\Handler\Theme\UpdateThemeHandler;
use App\Request\Theme\CreateThemeRequest;
use App\Response\Post\PostTransformer;
use App\Response\Theme\ThemeTransformer;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ThemeController
 * @package App\Controller
 *
 * @Rest\Route("/theme")
 */
class ThemeController extends BaseController
{
    /**
     * @Rest\Get("")
     */
    public function getThemes(): JsonResponse
    {
        return $this->json(
            $this->collection(
                $this->get(GetThemesHandler::class)($this->getUser()),
                new ThemeTransformer()
            )
        );
    }

    /**
     * @Rest\Post("")
     */
    public function createTheme(CreateThemeRequest $request): JsonResponse
    {
        $theme = $this->get(CreateThemeHandler::class)($request, $this->getUser());
        $this->flush();
        return $this->json(
            $this->item(
                $theme,
                new ThemeTransformer()
            ),
            Response::HTTP_CREATED
        );
    }

    /**
     * @Rest\Put("/{themeId}")
     */
    public function updateTheme(int $themeId, CreateThemeRequest $request): JsonResponse
    {
        $theme = $this->get(UpdateThemeHandler::class)($themeId, $request, $this->getUser());
        $this->flush();
        return $this->json(
            $this->item(
                $theme,
                new ThemeTransformer()
            )
        );
    }

    /**
     * @Rest\Delete("/{themeId}")
     */
    public function deleteTheme(int $themeId)
    {
        $this->get(DeleteThemeHandler::class)($themeId, $this->getUser());
        $this->flush();
        return $this->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Rest\Get("/{themeId}/post")
     */
    public function getPostsByTheme(int $themeId): JsonResponse
    {
        return $this->json(
            $this->collection(
                $this->get(GetPostsByThemeHandler::class)($themeId, $this->getUser()),
                new PostTransformer()
            )
        );
    }
}