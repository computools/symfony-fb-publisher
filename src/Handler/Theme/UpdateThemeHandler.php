<?php

namespace App\Handler\Theme;

use App\Entity\Theme;
use App\Entity\User;
use App\Exception\Theme\ThemeNotFoundException;
use App\Request\Theme\CreateThemeRequest;

/**
 * Class UpdateThemeHandler
 * @package App\Handler\Theme
 */
class UpdateThemeHandler extends AbstractThemeHandler
{
    public function __invoke(int $themeId, CreateThemeRequest $request, User $user): Theme
    {
        /**
         * @var Theme|null $theme
         */
        if (!$theme = $this->repository->findOneBy([
            'id' => $themeId,
            'user' => $user
        ])) {
            throw new ThemeNotFoundException();
        }

        $theme->setTitle($request->get('title'));
        $this->repository->save($theme);
        return $theme;
    }
}