<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\InvestmentRepository;

class ListAllController extends AbstractController
{
    #[Route('/investments', name: 'investment_list')]
    public function list(InvestmentRepository $repository): JsonResponse
    {
        $investments = $repository->findAll();

        if (empty($investments)) {
            return new JsonResponse(['error' => 'Nenhum investimento encontrado'], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($investments);
    }
}
