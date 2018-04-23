<?php

namespace App\Handler\Theme;

use App\Entity\User;
use App\Exception\Theme\ThemeNotFoundException;

/**
 * Class DeleteThemeHandler
 * @package App\Handler\Theme
 */
class DeleteThemeHandler extends AbstractThemeHandler
{
    public function __invoke(int $themeId, User $user): void
    {
        if (!$theme = $this->repository->findOneBy([
            'id' => $themeId,
            'user' => $user
        ])) {
            throw new ThemeNotFoundException();
        }

        $this->repository->remove($theme);
    }
}