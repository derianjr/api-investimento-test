<?php

namespace App\Investment\Exceptions;

use RuntimeException;

class InvestmentException extends RuntimeException
{
    public static function investmentAlreadyWithdrawn(): self
    {
        return new self("O investimento já foi retirado.");
    }

    public static function invalidWithdrawalDate(): self
    {
        return new self("A data de retirada não pode ser antes da criação do investimento.");
    }
}
