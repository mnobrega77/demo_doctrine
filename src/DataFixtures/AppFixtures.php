<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use App\Entity\Livre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create('fr_FR');

// on crée 4 auteurs avec noms et prénoms "aléatoires" en français
        $auteurs = [];

        for ($i = 0; $i < 10; $i++) {
            $auteur = new Auteur();
            $auteur->setNom($faker->lastName);
            $auteur->setPrenom($faker->firstName);

            $manager->persist($auteur);
            $auteurs[] = $auteur;

        }


        // nouvelle boucle pour créer des livres



        for ($i = 0; $i < 30; $i++) {
            $livre = new Livre();
            $livre->setTitre($faker->sentence($nbWords = 4, $variableNbWords = true));
            $livre->setEditeur($faker->word);
            $livre->setDescription($faker->sentence(10, true));
            $livre->setCouverture('http://placeimg.com/640/480/nature');
            $livre->setDateParution(new \DateTime());
            $livre->setAuteur($auteurs[$i % 9]);

            $manager->persist($livre);
        }

        $manager->flush();
    }

}
