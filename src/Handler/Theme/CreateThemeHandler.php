<?php

namespace App\Handler\Theme;

use App\Entity\Theme;
use App\Entity\User;
use App\Request\Theme\CreateThemeRequest;

/**
 * Class CreateThemeHandler
 * @package App\Handler\Theme
 */
class CreateThemeHandler extends AbstractThemeHandler
{
    public function __invoke(CreateThemeRequest $request, User $user): Theme
    {
        $now = new \DateTime();
        $theme = new Theme();
        $theme->setUser($user);
        $theme->setTitle($request->get('title'));
        $theme->setCreatedAt($now);
        $theme->setUpdatedAt($now);
        $this->repository->save($theme);
        return $theme;
    }
}