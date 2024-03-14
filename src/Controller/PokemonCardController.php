<?php

namespace App\Controller;

use App\Entity\PokemonCard;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PokemonCardRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PokemonCardController extends AbstractController
{

    #[Route('/api/pokemoncards', name:"createBook", methods: ['POST'])]
    public function createPokemonCard(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator): JsonResponse 
    {

        $pokemonCard = $serializer->deserialize($request->getContent(), PokemonCard::class, 'json');
        $em->persist($pokemonCard);
        $em->flush();

        $jsonPokemonCard = $serializer->serialize($pokemonCard, 'json', ['groups' => 'getPokemonCard']);
        
        $location = $urlGenerator->generate('detailPokemonCard', ['id' => $pokemonCard->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonPokemonCard, Response::HTTP_CREATED, ["Location" => $location], true);
   }
   
    #[Route('/api/pokemoncards', name: 'pokemoncard', methods: ['GET'])]
    public function getPokeCardList(PokemonCardRepository $PokemonCardRepository, SerializerInterface $serializer): JsonResponse
    {
        $pokemonCardList = $PokemonCardRepository->findAll();
        $jsonPokemonCardList = $serializer->serialize($pokemonCardList, 'json');
        return new JsonResponse($jsonPokemonCardList, Response::HTTP_OK, [], true);
    }
    
    #[Route('/api/pokemoncards/{id}', name: 'detailPokemonCard', methods: ['GET'])]
    public function getDetailPokeCard(int $id, SerializerInterface $serializer, PokemonCardRepository $PokemonCardRepository): JsonResponse {

        $pokemonCard = $PokemonCardRepository->find($id);
        if ($pokemonCard) {
            $jsonPokemonCard = $serializer->serialize($pokemonCard, 'json');
            return new JsonResponse($jsonPokemonCard, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
    

    #[Route('/api/pokemoncards/{id}', name:"updatePokemonCard", methods:['PUT'])]

    public function updatePokemonCard(Request $request, SerializerInterface $serializer, PokemonCard $currentPokemonCard, EntityManagerInterface $em): JsonResponse 
    {
         // Get the updated PokemonCard from the request body
    $updatedPokemonCard = $serializer->deserialize($request->getContent(), PokemonCard::class, 'json');

    // Update the PokemonCard
    $em->persist($updatedPokemonCard);
    $em->flush();

    // Return a no content response
    return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
   }

    #[Route('/api/pokemoncards/{id}', name: 'deletePokemonCard', methods: ['DELETE'])]
    public function deletePokemonCard(PokemonCard $pokemonCard, EntityManagerInterface $em): JsonResponse 
    {
        $em->remove($pokemonCard);
        $em->flush();
    
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

   }
