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
    /**
 * Creates a new PokemonCard in the database.
 *
 * @param Request $request The request object
 * @param SerializerInterface $serializer The serializer service
 * @param EntityManagerInterface $em The entity manager service
 * @param UrlGeneratorInterface $urlGenerator The URL generator service
 * @return JsonResponse The response object
 */
public function createPokemonCard(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator): JsonResponse 
{
    // Deserialize the request body into a PokemonCard object
    $pokemonCard = $serializer->deserialize($request->getContent(), PokemonCard::class, 'json');

    // Persist the PokemonCard to the database
    $em->persist($pokemonCard);
    $em->flush();

    // Serialize the PokemonCard into JSON
    $jsonPokemonCard = $serializer->serialize($pokemonCard, 'json', ['groups' => 'getPokemonCard']);

    // Generate the location header for the new PokemonCard
    $location = $urlGenerator->generate('detailPokemonCard', ['id' => $pokemonCard->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

    // Return a response with the PokemonCard JSON and a location header
    return new JsonResponse($jsonPokemonCard, Response::HTTP_CREATED, ["Location" => $location], true);
}


   
    #[Route('/api/pokemoncards', name: 'pokemoncard', methods: ['GET'])]
    /**
    * Returns a list of all PokemonCards.
    *
    * @param PokemonCardRepository $PokemonCardRepository The PokemonCard repository
    * @param SerializerInterface $serializer The serializer service
    * @return JsonResponse A JSON response containing a list of PokemonCards
 */
public function getPokeCardList(PokemonCardRepository $PokemonCardRepository, SerializerInterface $serializer): JsonResponse
{
    $pokemonCardList = $PokemonCardRepository->findAll();
    $jsonPokemonCardList = $serializer->serialize($pokemonCardList, 'json');
    return new JsonResponse($jsonPokemonCardList, Response::HTTP_OK, [], true);
}
    


    /**
 * Returns a specific PokemonCard based on its ID.
 *
 * @param int $id The ID of the PokemonCard to retrieve
 * @param PokemonCardRepository $PokemonCardRepository The PokemonCard repository
 * @param SerializerInterface $serializer The serializer service
 * @return JsonResponse A JSON response containing the requested PokemonCard or a 404 Not Found error
 */
public function getDetailPokeCard(int $id, PokemonCardRepository $PokemonCardRepository, SerializerInterface $serializer): JsonResponse {

    $pokemonCard = $PokemonCardRepository->find($id);
    if ($pokemonCard) {
        $jsonPokemonCard = $serializer->serialize($pokemonCard, 'json');
        return new JsonResponse($jsonPokemonCard, Response::HTTP_OK, [], true);
    }
    return new JsonResponse(null, Response::HTTP_NOT_FOUND);
}
    

    /**
 * Updates a PokemonCard in the database.
 *
 * @param Request $request The request object
 * @param SerializerInterface $serializer The serializer service
 * @param PokemonCard $currentPokemonCard The PokemonCard to update
 * @param EntityManagerInterface $em The entity manager service
 * @return JsonResponse The response object
 */
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

    /**
 * Deletes a PokemonCard from the database.
 *
 * @param PokemonCard $pokemonCard The PokemonCard to delete
 * @param EntityManagerInterface $em The entity manager service
 * @return JsonResponse A no content response
 */
public function deletePokemonCard(PokemonCard $pokemonCard, EntityManagerInterface $em): JsonResponse 
{
    $em->remove($pokemonCard);
    $em->flush();

    return new JsonResponse(null, Response::HTTP_NO_CONTENT);
}

   }
