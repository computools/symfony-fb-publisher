<?php

namespace App\Handler\Theme;

use App\Entity\User;

/**
 * Class GetThemesHandler
 * @package App\Handler\Theme
 */
class GetThemesHandler extends AbstractThemeHandler
{
    public function __invoke(User $user): array
    {
        return $this->repository->findByUser($user);
    }
}