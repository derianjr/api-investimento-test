<?php

namespace App\Repository;

use App\Entity\Investment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class InvestmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Investment::class);
    }

    public function save(Investment $investment, bool $flush = true): Investment
    {
        $this->getEntityManager()->persist($investment);
        if ($flush) {
            $this->flush();
        }
        return $investment;
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}
