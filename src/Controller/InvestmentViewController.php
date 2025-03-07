<?php

namespace App\Controller;

use App\Entity\Investment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class InvestmentViewController extends AbstractController
{
    #[Route('/investment/{id}', name: 'investment_view')]
    public function view(int $id, EntityManagerInterface $entityManager): Response
    {
        $investment = $entityManager->getRepository(Investment::class)->find($id);

        if (!$investment) {
            throw $this->createNotFoundException('Investimento não encontrado');
        }
        return $this->render('investment/view.html.twig', [
            'investment' => $investment,
        ]);
    }
}
