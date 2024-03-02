<?php

namespace App\Controller;

use App\Repository\PokemonCardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

class PokemonCardController extends AbstractController
{
    #[Route('/api/pokemoncards', name: 'pokemoncard', methods: ['GET'])]
    public function getPokeCardList(PokemonCardRepository $PokemonCardRepository, SerializerInterface $serializer): JsonResponse
    {
        $pokemonCardList = $PokemonCardRepository->findAll();
        $jsonPokemonCardList = $serializer->serialize($pokemonCardList, 'json');
        return new JsonResponse($jsonPokemonCardList, Response::HTTP_OK, [], true);
    }

    #[Route('/api/pokemoncards/{id}', name: 'detailPokemonCard', methods: ['GET'])]
    public function getDetailPokeCard(int $id, SerializerInterface $serializer, PokemonCardRepository $PokemonCardRepository): JsonResponse
    {

        $pokemonCard = $PokemonCardRepository->find($id);
        if ($pokemonCard) {
            $jsonPokemonCard = $serializer->serialize($pokemonCard, 'json');
            return new JsonResponse($jsonPokemonCard, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}
