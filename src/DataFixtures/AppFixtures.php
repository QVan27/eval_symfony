<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Ville;
use App\Entity\Restaurant;
use App\Entity\Proprietaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $ville = new Ville();
            $ville->setNom($faker->city);

            for ($j = 0; $j < 10; $j++) {

                $proprietaire = new Proprietaire();
                $proprietaire->setPrenom($faker->firstName)
                    ->setNom($faker->lastName)
                    ->setDateNaissance($faker->dateTimeBetween('1960-01-01', '1998-01-01'));
                $manager->persist($proprietaire);


                $restaurant = new Restaurant();
                $restaurant->setNom($faker->company)
                    ->setAdresse($faker->address)
                    ->setImage($faker->imageUrl(200, 200, "business"))
                    ->setVille($ville)
                    ->setProprietaire($proprietaire);
                $manager->persist($restaurant);
            }
            $manager->persist($ville);
        }

        $manager->flush();
    }
}
