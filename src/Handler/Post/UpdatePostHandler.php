<?php

namespace App\Handler\Post;

use App\Entity\Post;
use App\Entity\User;
use App\Exception\Post\PostNotFoundException;
use App\Request\Post\CreatePostRequest;

/**
 * Class UpdatePostHandler
 * @package App\Handler\Post
 */
class UpdatePostHandler extends AbstractPostHandler
{
    public function __invoke(CreatePostRequest $request, int $postId, User $user): Post
    {
        /**
         * @var Post $post
         */
        if (!$post = $this->postRepository->findOneBy([
            'id' => $postId,
            'user' => $user
        ])) {
            throw new PostNotFoundException();
        }

        $post->setTitle($request->get('title'));
        $post->setContent($request->get('content'));
        $post->setUpdatedAt(new \DateTime());
        $this->postRepository->save($post);
        return $post;
    }
}