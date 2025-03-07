<?php

namespace App\DTO;

use App\Entity\User;
use App\Validator\Constraints as AppAssert;
use Symfony\Component\Validator\Constraints as Assert;

    readonly class CreateInvestmentDTO
{
    #[Assert\NotBlank(message: "O usuário é obrigatório.")]
    public User $user;

    #[Assert\NotBlank(message: "O valor do investimento é obrigatório.")]
    #[Assert\Positive(message: "O valor do investimento deve ser positivo.")]
    public float $initialValue;

    #[Assert\NotBlank(message: "A data de criação é obrigatória.")]
    #[Assert\Type(type: "\DateTimeImmutable", message: "A data de criação deve estar em um formato válido.")]
    public \DateTimeImmutable $createdAt;

    public function __construct(User $user, float $initialValue, \DateTimeImmutable $createdAt)
    {
        $this->user = $user;
        $this->initialValue = $initialValue;
        $this->createdAt = $createdAt;
    }
}