<?php

namespace App\DataFixtures;

use App\Entity\PokemonCard;
use App\Entity\TypesCard;
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

        $this->connection->executeQuery('TRUNCATE TABLE types');

        $this->connection->executeQuery('SET foreign_key_checks = 1');
    }

    
    public function load(ObjectManager $manager): void
    {
       
         ##$this->truncate();

        // Création des auteurs.
        $listTypes = [];
        for ($i = 0; $i < 10; $i++) {
        // Création de l'auteur lui-même.
        $type = new TypesCard();
        $type->setNameType("type" . $i);
        $type->setColorType("color". $i);
        
        $manager->persist($type);
        // On sauvegarde l'auteur créé dans un tableau.
        $listTypes[] = $type;
        }
       // Création de card 
        for ($i = 0; $i < 151; $i++) {
        $card = new PokemonCarD;
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
        $card->addTypesCard($listTypes[array_rand($listTypes)]);
        


      
        $manager->persist($card);
        $manager->flush();

    }
}}
