<?php

namespace App\Handler\Post;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class GetUserPostsHandler
 * @package App\Handler
 */
class GetUserPostsHandler
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    public function __construct(ContainerInterface $container)
    {
        $this->postRepository = $container->get('doctrine')->getRepository(Post::class);
    }

    public function __invoke(User $user): array
    {
        return $this->postRepository->findByUser($user);
    }
}