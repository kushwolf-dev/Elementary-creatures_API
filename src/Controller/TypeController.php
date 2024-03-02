<?php

namespace App\Controller;

use App\Repository\TypesCardRepository;
use App\Repository\PokemonCardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TypeController extends AbstractController
{
    #[Route('/api/typecards', name: 'typecard', methods: ['GET'])]
    public function getTypeCardList(TypesCardRepository $TypesCardRepository, SerializerInterface $serializer): JsonResponse
    {
        $typeCardList = $TypesCardRepository->findAll();
        $jsonTypeCardList = $serializer->serialize($typeCardList, 'json',['groups' => 'getCard']);
        return new JsonResponse($jsonTypeCardList, Response::HTTP_OK, [], true);
    }
    
    #[Route('/api/typecards/{id}', name: 'detailPokemonCard', methods: ['GET'])]
    public function getDetailPokeCard(int $id, SerializerInterface $serializer, TypesCardRepository $TypesCardRepository): JsonResponse {

        $pokemonCard = $TypesCardRepository->find($id);
        if ($pokemonCard) {
            $jsonPokemonCard = $serializer->serialize($pokemonCard, 'json',['groups' => 'getCard']);
            return new JsonResponse($jsonPokemonCard, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
   }}
