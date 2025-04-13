<?php

namespace App\Repository;

use App\Entity\Dinosaurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dinosaurs>
 */
class DinosaursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dinosaurs::class);
    }

    public function findByCoolStatus(bool $cool): array
    {
        return $this->createQueryBuilder('d')
            ->where('d.isLookingCool = :cool')
            ->setParameter('cool', $cool)
            ->getQuery()
            ->getResult();
    }
}
