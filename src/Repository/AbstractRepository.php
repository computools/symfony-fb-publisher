<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class AbstractRepository
 * @package App\Repository
 */
class AbstractRepository extends EntityRepository
{
    public function save($object): void
    {
        $this->getEntityManager()->persist($object);
    }

    public function remove($object): void
    {
        $this->getEntityManager()->remove($object);
    }
}