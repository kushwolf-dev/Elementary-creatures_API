<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PokemonCardController extends AbstractController
{
    #[Route('/api/pokemoncards', name: 'pokemoncard', methods: ['GET'])]
    public function getPokemonCardList(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'welcome to your new controller!',
            'path' => 'src/Controller/PokemonCardController.php',
        ]);
    }}
