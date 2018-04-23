<?php

namespace App\Handler\Post;

use App\Entity\Post;
use App\Entity\Theme;
use App\Entity\User;
use App\Exception\Post\PostNotFoundException;
use App\Exception\Theme\ThemeNotFoundException;
use App\Repository\ThemeRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RemovePostThemeHandler
 * @package App\Handler\Post
 */
class RemovePostThemeHandler extends AbstractPostHandler
{
    /**
     * @var ThemeRepository
     */
    private $themeRepository;

    public function __construct(ContainerInterface $container)
    {
        $this->themeRepository = $container->get('doctrine')->getRepository(Theme::class);
        parent::__construct($container);
    }

    public function __invoke(int $postId, int $themeId, User $user): Post
    {
        /**
         * @var Post|null $post
         */
        if (!$post = $this->postRepository->findOneBy([
            'id' => $postId,
            'user' => $user
        ])) {
            throw new PostNotFoundException();
        }

        /**
         * @var Theme|null $theme
         */
        if (!$theme = $this->themeRepository->find($themeId)) {
            throw new ThemeNotFoundException();
        }

        $post->removeTheme($theme);
        $this->postRepository->save($post);
        return $post;
    }
}