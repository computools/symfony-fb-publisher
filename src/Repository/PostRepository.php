<?php

namespace App\Repository;

use App\Entity\Post;
use App\Entity\Theme;
use App\Entity\User;

/**
 * Class PostRepository
 * @package App\Repository
 */
class PostRepository extends AbstractRepository
{
    public function findByUser(User $user): array
    {
        return $this->findBy([
            'user' => $user
        ]);
    }

    public function removePost(Post $post): void
    {
        $this->getEntityManager()->remove($post);
    }

    public function getByTheme(Theme $theme, User $user): array
    {
        $query = $this->createQueryBuilder('p')
            ->where(':theme MEMBER OF p.themes')
            ->andWhere('p.user = :user')
            ->setParameters([
                'theme' => $theme,
                'user' => $user
            ]);
        return $query->getQuery()->getResult();
    }
}