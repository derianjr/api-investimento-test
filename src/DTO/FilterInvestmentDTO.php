<?php

namespace App\DTO;

use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

class FilterInvestmentDTO
{
    public User $user;

    #[Assert\Date]
    public ?\DateTimeImmutable $startDate = null;

    #[Assert\Date]
    public ?\DateTimeImmutable $endDate = null;

    public function __construct(User $user, ?\DateTimeImmutable $startDate = null, ?\DateTimeImmutable $endDate = null)
    {
        $this->user = $user;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
}



