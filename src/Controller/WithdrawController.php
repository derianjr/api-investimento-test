<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Investment;
use App\Exceptions\InvestmentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;

#[Route('/investment/withdraw', name: 'withdraw_')]
class WithdrawController extends AbstractController
{
    #[Route('/{id}', name: 'execute', methods: ['POST'])]
    public function execute(int $id, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['error' => 'Usuário não autenticado'], 401);
        }
        
        $investment = $entityManager->getRepository(Investment::class)->find($id);
        
        if (!$investment || $investment->owner() !== $user) {
            return $this->json(['error' => 'Investimento não encontrado'], 404);
        }

        $payload = json_decode($request->getContent(), true);
        $withdrawDate = isset($payload['withdraw_date']) ? new DateTimeImmutable($payload['withdraw_date']) : new DateTimeImmutable();
        $amount = isset($payload['amount']) ? (float) $payload['amount'] : 0;

        if ($amount <= 0) {
            return $this->json(['error' => 'Valor de saque inválido'], 400);
        }

        try {
            $finalAmount = $investment->withdraw($amount, $withdrawDate);
            $entityManager->flush();

            return $this->json([
                'message' => 'Saque realizado com sucesso',
                'valor_final' => $finalAmount,
                'data_retirada' => $withdrawDate->format('Y-m-d H:i:s')
            ]);
        } catch (InvestmentException $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
    }
}
