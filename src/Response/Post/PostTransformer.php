<?php

namespace App\Response\Post;

use App\Entity\Post;
use App\Response\Publication\PublicationTransformer;
use App\Response\Theme\ThemeTransformer;
use League\Fractal\TransformerAbstract;

/**
 * Class PostTransformer
 * @package App\Response\Post
 */
class PostTransformer extends TransformerAbstract
{
    public function transform(Post $post): array
    {
        return [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'created_at' => $post->getCreatedAt(),
            'updated_at' => $post->getUpdatedAt(),
            'themes' => $post->getThemes() ? (new ThemeTransformer())->transformCollection($post->getThemes()) : [],
			'publications' => $post->getPublications() ? (new PublicationTransformer())->transformCollection($post->getPublications()) : []
        ];
    }
}