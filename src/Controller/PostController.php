<?php

namespace App\Controller;

use App\Handler\Post\AddPostThemeHandler;
use App\Handler\Post\CreatePostHandler;
use App\Handler\Post\DeletePostHandler;
use App\Handler\Post\GetUserPostsHandler;
use App\Handler\Post\RemovePostThemeHandler;
use App\Handler\Post\UpdatePostHandler;
use App\Handler\Publication\CreatePublicationHandler;
use App\Request\Post\CreatePostRequest;
use App\Response\Post\PostTransformer;
use App\Response\Publication\PublicationTransformer;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PostController
 * @package App\Controller
 *
 * @Rest\Route("/post")
 */
class PostController extends BaseController
{
    /**
     * @Rest\Get("")
     */
    public function getUserPosts()
    {
        return $this->json(
            $this->collection(
                $this->get(GetUserPostsHandler::class)($this->getUser()),
                new PostTransformer()
            )
        );
    }

    /**
     * @Rest\Post("")
     */
    public function createPost(CreatePostRequest $request): JsonResponse
    {
        $post = $this->get(CreatePostHandler::class)($request, $this->getUser());
        $this->flush();
        return $this->json(
            $this->item($post, new PostTransformer()),
            Response::HTTP_CREATED
        );
    }

    /**
     * @Rest\Put("/{postId}")
     */
    public function updatePost(CreatePostRequest $request, int $postId): JsonResponse
    {
        $post = $this->get(UpdatePostHandler::class)($request, $postId, $this->getUser());
        $this->flush();
        return $this->json(
            $this->item($post, new PostTransformer()),
            Response::HTTP_OK
        );
    }

    /**
     * @Rest\Delete("/{postId}")
     */
    public function deletePost(int $postId): JsonResponse
    {
        $this->get(DeletePostHandler::class)($postId, $this->getUser());
        $this->flush();
        return $this->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Rest\Put("/{postId}/theme/{themeId}")
     */
    public function addTheme(int $postId, int $themeId): JsonResponse
    {
        $post = $this->get(AddPostThemeHandler::class)($postId, $themeId, $this->getUser());
        $this->flush();
        return $this->json(
            $this->item($post, new PostTransformer()),
            Response::HTTP_OK
        );
    }

    /**
     * @Rest\Delete("/{postId}/theme/{themeId}")
     */
    public function removeTheme(int $postId, int $themeId): JsonResponse
    {
        $post = $this->get(RemovePostThemeHandler::class)($postId, $themeId, $this->getUser());
        $this->flush();
        return $this->json(
            $this->item($post, new PostTransformer()),
            Response::HTTP_OK
        );
    }

    /**
	 * @Rest\Post("/{postId}/publication/{channelId}")
	 */
    public function publishPost(int $postId, int $channelId): JsonResponse
	{
		$publication = $this->get(CreatePublicationHandler::class)($postId, $channelId, $this->getUser());
		$this->flush();
		return $this->json(
			$this->item($publication, new PublicationTransformer()),
			Response::HTTP_CREATED
		);
	}
}


