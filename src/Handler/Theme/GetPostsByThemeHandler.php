<?php

namespace App\Handler\Theme;

use App\Entity\Post;
use App\Entity\Theme;
use App\Entity\User;
use App\Exception\Theme\ThemeNotFoundException;
use App\Repository\PostRepository;
use Psr\Container\ContainerInterface;

/**
 * Class GetPostsByThemeHandler
 * @package App\Handler\Theme
 */
class GetPostsByThemeHandler extends AbstractThemeHandler
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    public function __construct(ContainerInterface $container)
    {
        $this->postRepository = $container->get('doctrine')->getRepository(Post::class);
        parent::__construct($container);
    }

    public function __invoke(int $themeId, User $user): array
    {
        /**
         * @var Theme $theme
         */
        if (!$theme = $this->repository->findOneBy([
            'id' => $themeId,
            'user' => $user
        ])) {
            throw new ThemeNotFoundException();
        }

        return $this->postRepository->getByTheme($theme, $user);
    }
}