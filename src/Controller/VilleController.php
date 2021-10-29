<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Entity\Restaurant;
use App\Repository\VilleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VilleController extends AbstractController
{
    #[Route('/villes', name: 'villes')]
    public function index(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(Ville::class);
        $nom = $request->request->get('nom');
        $villes = [];
        if (is_null($nom) or empty($nom)) {
            $villes = $repository->findBy([], ['nom' => "ASC"]);
        } else {
            $villes = $repository->findAll($nom);
        }
        dump($nom);
        
        return $this->render('ville/index.html.twig', [
            'villes' => $villes,
        ]);
    }

    #[Route('/single-ville/{id}', name: 'single-ville')]
    public function singleVille(int $id = 0): Response
    {
        $repository = $this->getDoctrine()->getRepository(Ville::class);
        $id = $repository->findOneBy([
            'id' => $id,
        ]);
        dump($id);
        return $this->render('ville/single-ville.html.twig', ["id" => $id]);
    }
}
