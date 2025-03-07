<?php

namespace App\Feature;

use App\Entity\Investment;
use App\Entity\User;
use App\Repository\InvestmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\DTO\CreateInvestmentDTO;

class InvestmentFeature
{
    public function __construct(
        private InvestmentRepository $investmentRepository,
        private EntityManagerInterface $entityManager
    ) {}

    public function execute(User $user, CreateInvestmentDTO $dto): void
    {
        $investment = new Investment($dto);

        $this->investmentRepository->save($investment);
    }
}