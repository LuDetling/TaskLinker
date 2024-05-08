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

        $projet1 = (new Projet())
            ->setTitle($faker->title())
            ->addEmploye($this->getReference('EMPLOYE-1'))
            ->addEmploye($this->getReference('EMPLOYE-2'));
        $manager->persist($projet1);
        $this->addReference("PROJET-1", $projet1);

        $projet2 = (new Projet())
            ->setTitle($faker->title())
            ->addEmploye($this->getReference('EMPLOYE-0'));
        $manager->persist($projet2);
        $this->addReference("PROJET-2", $projet2);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
