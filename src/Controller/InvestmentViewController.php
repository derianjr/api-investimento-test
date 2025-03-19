<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\InvestmentRepository;

class InvestmentViewController extends AbstractController
{
    #[Route('/investment/{id}', name: 'investment_view')]
    public function view(int $id, InvestmentRepository $repository): JsonResponse
    {
        $investment = $repository->find($id);

        if (!$investment) {
            return new JsonResponse(['error' => 'Investimento não encontrado'], Response::HTTP_NOT_FOUND);
        }
        
        return new JsonResponse($investment);
    }
}