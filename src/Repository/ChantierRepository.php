<?php

namespace App\Repository;

use App\Entity\Chantier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Func;

class ChantierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chantier::class);
    }

    public function getNombrePersonnesPointees(Chantier $chantier): int
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(DISTINCT p.utilisateur)')
            ->join('c.pointages', 'p')
            ->andWhere('c = :chantier')
            ->setParameter('chantier', $chantier)
            ->getQuery()
            ->getSingleScalarResult();
    }    
    

    public function getNombreHeuresCumuleesPointees(Chantier $chantier): string
    {
        $pointages = $chantier->getPointages();
        $totalSeconds = 0;
    
        foreach ($pointages as $pointage) {
            $duree = $pointage->getDuree();
            $hours = $duree->format('H');
            $minutes = $duree->format('i');
            $seconds = $hours * 3600 + $minutes * 60;
            $totalSeconds += $seconds;
        }
    
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $formattedTotal = sprintf('%02d:%02d', $hours, $minutes);
    
        return $formattedTotal;
    }

    
    
    
}
