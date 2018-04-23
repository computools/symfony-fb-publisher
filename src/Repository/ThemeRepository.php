<?php

namespace App\Repository;

use App\Entity\User;

/**
 * Class ThemeRepository
 * @package App\Repository
 */
class ThemeRepository extends AbstractRepository
{
    public function findByUser(User $user): array
    {
        return $this->findBy([
            'user' => $user
        ]);
    }
}