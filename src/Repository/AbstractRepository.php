<?php
declare(strict_types=1);

namespace Hotel\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Abstract Class AbstractRepository
 * @package Hotel\Repository
 * @author Renato Rodrigues de Araujo <renato.r.araujo@gmail.com>
 */
abstract class AbstractRepository extends ServiceEntityRepository
{
    /**
     * @param $entity
     */
    public function store($entity): void
    {
        $this->_em->persist($entity);
    }
}
