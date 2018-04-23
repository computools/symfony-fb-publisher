<?php

namespace App\Handler\Post;

use App\Entity\Post;
use App\Entity\User;
use App\Request\Post\CreatePostRequest;

/**
 * Class CreatePostHandler
 * @package App\Handler\Post
 */
class CreatePostHandler extends AbstractPostHandler
{
    public function __invoke(CreatePostRequest $request, User $user): Post
    {
        $post = new Post();
        $now = new \DateTime();
        $post->setUser($user);
        $post->setTitle($request->get('title'));
        $post->setContent($request->get('content'));
        $post->setCreatedAt($now);
        $post->setUpdatedAt($now);
        $this->postRepository->save($post);
        return $post;
    }
}