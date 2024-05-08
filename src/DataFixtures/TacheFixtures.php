<?php

namespace App\DataFixtures;

use App\Entity\Tache;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class TacheFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        // $product = new Product();
        // $manager->persist($product);

        $projet1 = ["EMPLOYE-1", "EMPLOYE-2"];
        $projet2 = ["EMPLOYE-0"];
        $statut = ["TO_DO", "DOING", "DONE"];

        for ($i = 0; $i < 5; $i++) {
            $tache = (new Tache())
                ->setTitle($faker->title())
                ->setDescription($faker->paragraph())
                ->setDeadline($faker->dateTime())
                ->setProjet($this->getReference("PROJET-1"))
                ->setStatut($this->getReference($faker->randomElement($statut)));
            if ($i <= 2 || $i > 4) {
                $tache->setEmploye($this->getReference($faker->randomElement($projet1)));
            }
            $manager->persist($tache);
        }

        for ($i = 0; $i < 5; $i++) {
            $tache = (new Tache())
                ->setTitle($faker->title())
                ->setDescription($faker->paragraph())
                ->setDeadline($faker->dateTime())
                ->setProjet($this->getReference("PROJET-2"))
                ->setStatut($this->getReference($faker->randomElement($statut)));
            if ($i <= 2 || $i > 4) {
                $tache->setEmploye($this->getReference($faker->randomElement($projet2)));
            }
            $manager->persist($tache);
        }

        $manager->flush();
        //relier les employes au projet




        $manager->flush();
    }
}
