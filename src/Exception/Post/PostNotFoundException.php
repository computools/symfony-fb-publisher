<?php

namespace App\Exception\Post;

use App\Exception\NotFoundApiException;

/**
 * Class PostNotFoundException
 * @package App\Exception\Post
 */
class PostNotFoundException extends NotFoundApiException
{
    const MESSAGE = 'Post not found';

    public function __construct($message = self::MESSAGE)
    {
        parent::__construct($message);
    }
}