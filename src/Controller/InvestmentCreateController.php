<?php

namespace App\Controller;

use App\Entity\User;
use App\DTO\CreateInvestmentDTO;
use App\Feature\InvestmentFeature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/investment/create', name: 'investment_create', methods: ['POST'])]
class InvestmentCreateController extends AbstractController
{
    public function __invoke(
        Request $request,
        InvestmentFeature $feature,
    ): JsonResponse {
        /** @var User $user */
        $user = $this->getUser();
        if  (!$user) {
            return $this->json([
                'error' => 'Usuário não autenticado',
                'debug' => [
                    'headers' => $request->headers->all(),
                    'token' => $request->headers->get('Authorization')
                ]
            ], 401);
        }
        $payload = $request->getPayload();

        $dto = new CreateInvestmentDTO(
            $user,
            (float) $payload->get('initial_value'),
            new \DateTimeImmutable($payload->get('created_at'))
        );

        $investment = $feature->execute($dto);

        return $this->json(['status' => JsonResponse::HTTP_OK, 'investment' => $investment]);  
    }
}