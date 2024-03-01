<?php

namespace App\DataFixtures;

use App\Entity\PokemonCard;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

       // Création d'une vingtaine de livres ayant pour titre
        for ($i = 0; $i < 151; $i++) {
        $card = new PokemonCard;
        $card->setName('Card ' . $i);
        $card->setDescription('Voici la carte numero : ' . $i);
        $card->setNumber($i);
        $card->setType(100);
        $manager->persist($card);
        $manager->flush();

    }
}}
