<?php

namespace App\Controller;

use App\Entity\Proprietaire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProprietaireController extends AbstractController
{
    #[Route('/proprietaire', name: 'proprietaire')]
    public function index(): Response
    {
        return $this->render('proprietaire/index.html.twig', [
            'controller_name' => 'ProprietaireController',
        ]);
    }
    
    #[Route('/single-prorietaire/{id}', name: 'single-proprietaire')]
    public function singleProprietaire(int $id = 0): Response
    {
        $repository = $this->getDoctrine()->getRepository(Proprietaire::class);
        $id = $repository->findOneBy([
            'id' => $id,
        ]);
        return $this->render('proprietaire/single-proprietaire.html.twig', ["id" => $id]);
    }
}
