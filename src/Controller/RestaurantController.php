<?php

namespace App\Controller;


use App\Entity\Restaurant;
use App\Repository\RestaurantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RestaurantController extends AbstractController
{
    #[Route('/', name: '_home')]
    public function index(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(Restaurant::class);
        $nom = $request->request->get('nom');
        $restaurants = [];
        if (is_null($nom) or empty($nom)) {
            $restaurants = $repository->findBy([], ['nom' => "ASC"]);
        } else {
            $restaurants = $repository->findAll($nom);
        }
        dump($restaurants);
        return $this->render('restaurant/index.html.twig', [
            'restaurants' => $restaurants,
        ]);
    }

    #[Route('/single-restaurant/{id}', name: 'single-restaurant')]
    public function singleRestaurant(int $id = 0): Response
    {
        $repository = $this->getDoctrine()->getRepository(Restaurant::class);
        $id = $repository->findOneBy([
            'id' => $id,
        ]);
        dump($id);
        return $this->render('restaurant/single-restaurant.html.twig', ["id" => $id]);
    }
}
