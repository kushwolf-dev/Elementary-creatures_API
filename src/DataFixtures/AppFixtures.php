<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\PokemonCard;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;
    
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création d'un user "normal"
        $user = new User();
        $user->setEmail("user@elementaryapi.com");
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "password"));
        $manager->persist($user);
        
        // Création d'un user admin
        $userAdmin = new User();
        $userAdmin->setEmail("admin@elementaryapi.com");
        $userAdmin->setRoles(["ROLE_ADMIN"]);
        $userAdmin->setPassword($this->userPasswordHasher->hashPassword($userAdmin, "password"));
        $manager->persist($userAdmin);


       // Création de card 
        for ($i = 0; $i < 151; $i++) {
        $card = new PokemonCard;
        $card->setName('Card ' . $i);
        $card->setDescription('Voici la carte numero : ' . $i);
        $card->setNumber($i);
        $card->setType(100);
        $card->setHp(100);
        $card->setWeakness(100);
        $card->setEvolve1(100);
        $card->setEvolve2(100);
        $card->setResistance(100);
        $card->setType2(100);
        $card->setBackgroundImage(2);
        $card->setAbility(100);
        $card->setBackgroundImage(100);
        $card->setRarity(100);
        $card->setAttack1(100);
        $card->setAttack2(100);

        $manager->persist($card);
        $manager->flush();

    }
}}
