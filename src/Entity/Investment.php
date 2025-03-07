<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;
use App\Entity\User;
use App\DTO\CreateInvestmentDTO;
use App\Investment\Exceptions\InvestmentException;
use App\jsonSerializable;

/** @SuppressWarnings(PHPMD.ExcessivePublicCount) */

#[ORM\Entity(repositoryClass: "App\Repository\InvestmentRepository")]
class Investment implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User $owner;

    #[ORM\Column(type: "datetime_immutable")]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: "float")]
    private float $initialValue;

    #[ORM\Column(type: "float")]
    private float $balance;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $withdrawnAt = null;

    #[ORM\Column(type: "boolean", options: ['default' => false])]
    private bool $isWithdrawn = false;

    public function __construct(CreateInvestmentDTO $dto)
    {
        Assert::greaterThan($dto->initialValue, 0, "O valor do investimento deve ser positivo.");
        $this->owner = $dto->user;
        $this->createdAt = $dto->createdAt;
        $this->initialValue = $dto->initialValue;
        $this->balance = $dto->initialValue;
    }

    public function calculateBalance(): void
    {
        $today = new DateTimeImmutable();
        $months = $this->createdAt->diff($today)->m + ($this->createdAt->diff($today)->y * 12);
        $this->balance = $this->initialValue * pow(1.0052, $months);
    }

    public function withdraw(DateTimeImmutable $withdrawDate): float
    {
        if ($this->isWithdrawn) {
            throw new InvestmentException("O investimento já foi retirado.");
        }

        if ($withdrawDate < $this->createdAt) {
            throw new InvestmentException("A data de retirada não pode ser antes da criação do investimento.");
        }

        $this->calculateBalance();

        $profit = $this->balance - $this->initialValue;
        $taxPercentage = match (true) {
            $withdrawDate->diff($this->createdAt)->y < 1 => 22.5,
            $withdrawDate->diff($this->createdAt)->y < 2 => 18.5,
            default => 15,
        };

        $tax = ($profit / $this->balance) * ($profit * ($taxPercentage / 100));
        $finalAmount = $this->balance - $tax;

        $this->isWithdrawn = true;
        $this->withdrawnAt = $withdrawDate;
        $this->balance = 0;

        return $finalAmount;
    }

    public function jsonSerialize(): array
    {
    return [
        'id' => $this->id,
        'criado_em' => $this->createdAt->format('Y-m-d H:i:s'),
        'valor_inicial' => $this->initialValue,
        'saldo' => $this->balance,
        'retirado_em' => $this->withdrawnAt?->format('Y-m-d H:i:s'),
        'retirado' => $this->isWithdrawn,
        'owner' => $this->owner,
        ];
    }

    public function id(): int
    {
        return $this->id;
    }

    public function owner(): User
    {
        return $this->owner;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function initialValue(): float
    {
        return $this->initialValue;
    }

    public function balance(): float
    {
        return $this->balance;
    }

    public function withdrawnAt(): ?DateTimeImmutable
    {
        return $this->withdrawnAt;
    }

    public function isWithdrawn(): bool
    {
        return $this->isWithdrawn;
    }

    public function validateWithdrawal(): self
    {
        if ($this->isWithdrawn) {
            throw new InvestmentException("Este investimento já foi retirado.");
        }

        return $this;
    }
}
