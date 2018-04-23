<?php

namespace App\Handler\Theme;

use App\Entity\Theme;
use App\Repository\ThemeRepository;
use Psr\Container\ContainerInterface;

/**
 * Class AbstractThemeHandler
 * @package App\Handler\Theme
 */
abstract class AbstractThemeHandler
{
    /**
     * @var ThemeRepository
     */
    protected $repository;

    public function __construct(ContainerInterface $container)
    {
        $this->repository = $container->get('doctrine')->getRepository(Theme::class);
    }
}