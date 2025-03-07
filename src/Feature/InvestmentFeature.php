<?php

namespace App\Feature;

use App\Entity\Investment;
use App\Repository\InvestmentRepository;
use App\DTO\CreateInvestmentDTO;

class InvestmentFeature
{
    public function __construct(
        private InvestmentRepository $investmentRepository,

    ) {}

    public function execute( CreateInvestmentDTO $dto): Investment
    {
        return $this->investmentRepository->save(new Investment($dto));
    }
}