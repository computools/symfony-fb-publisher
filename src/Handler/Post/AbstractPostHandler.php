<?php

namespace App\Handler\Post;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractPostHandler
 * @package App\Handler\Post
 */
abstract class AbstractPostHandler
{
    /**
     * @var PostRepository
     */
    protected $postRepository;

    public function __construct(ContainerInterface $container)
    {
        $this->postRepository = $container->get('doctrine')->getRepository(Post::class);
    }
}