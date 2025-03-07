<?php

namespace App\DTO;

use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

    readonly class FilterInvestmentDTO
{
    public User $user;

    #[Assert\Date]
    public ?\DateTimeImmutable $startDate;

    #[Assert\Date]
    public ?\DateTimeImmutable $endDate;

    public function __construct(User $user, ?\DateTimeImmutable $startDate = null, ?\DateTimeImmutable $endDate = null)
    {
        $this->user = $user;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
}



