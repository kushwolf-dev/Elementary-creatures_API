<?php

namespace App\DataFixtures;

use App\Entity\PokemonCard;
use App\Entity\Types;
use Doctrine\DBAL\Connection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private $connection;


    public function __construct(Connection $connection)
    {

        $this->connection = $connection;
    }


    private function truncate()
    {

        $this->connection->executeQuery('SET foreign_key_checks = 0');

        $this->connection->executeQuery('TRUNCATE TABLE pokemon_card');

        $this->connection->executeQuery('SET foreign_key_checks = 1');
    }

    
    public function load(ObjectManager $manager): void
    {
       
        ## $this->truncate();

       // Création de card 
        for ($i = 0; $i < 151; $i++) {
        $card = new PokemonCard;
        $card->setName('Card ' . $i);
        $card->setDescription('Voici la carte numero : ' . $i);
        $card->setNumber($i);
        $card->setHp(100);
        $card->setWeakness(100);
        $card->setEvolve1(100);
        $card->setEvolve2(100);
        $card->setResistance(100);
        $card->setBackgroundImage(100);
        $card->setAbility(100);
        $card->setBackgroundImage(100);
        $card->setRarity(100);
        $card->setAttack1(100);
        $card->setAttack2(100);

      
        $manager->persist($card);
        $manager->flush();

    }
}}
