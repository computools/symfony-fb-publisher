<?php

namespace App\Request\Post;

use App\Request\AbstractRequest;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreatePostRequest
 * @package App\Request\Post
 */
class CreatePostRequest extends AbstractRequest
{
    public function rules(): Assert\Collection
    {
        return new Assert\Collection([
            'title' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'content' => [
                new Assert\Type('string')
            ]
        ]);
    }
}