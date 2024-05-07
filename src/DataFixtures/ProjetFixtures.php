<?php

namespace App\DataFixtures;

use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProjetFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        for ($i = 0; $i < 2; $i++) {
            $projet = (new Projet())
                ->setTitle($faker->title());
            $manager->persist($projet);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
