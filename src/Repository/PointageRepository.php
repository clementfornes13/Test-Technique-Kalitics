<?php

namespace App\Repository;

use App\Entity\Pointage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class PointageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pointage::class);
    }

    public function save(Pointage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Pointage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getTotalHoursForUserInWeek(int $userId, \DateTimeInterface $weekStart, \DateTimeInterface $weekEnd): float
    {
        $pointages = $this->createQueryBuilder('p')
            ->where('p.utilisateur = :userId')
            ->andWhere('p.date BETWEEN :weekStart AND :weekEnd')
            ->setParameter('userId', $userId)
            ->setParameter('weekStart', $weekStart)
            ->setParameter('weekEnd', $weekEnd)
            ->getQuery()
            ->getResult();
    
        $totalMinutes = 0;
        foreach ($pointages as $pointage) {
            $totalMinutes += $pointage->getDureeInMinutes();
        }
    
        return $totalMinutes / 60;
    }    

}
