<?php

namespace App\Handler\Post;

use App\Entity\User;
use App\Exception\Post\PostNotFoundException;

/**
 * Class DeletePostHandler
 * @package App\Handler\Post
 */
class DeletePostHandler extends AbstractPostHandler
{
    public function __invoke(int $postId, User $user)
    {
        if (!$post = $this->postRepository->findOneBy([
            'id' => $postId,
            'user' => $user
        ])) {
            throw new PostNotFoundException();
        }
        $this->postRepository->remove($post);
    }
}