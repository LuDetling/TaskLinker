<?php

namespace App\DataFixtures;

use App\Entity\Employe;
use App\Factory\EmployeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EmployeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i < 3; $i++) {
            $employe = (new Employe())
                ->setEmail($faker->email())
                ->setDateStart($faker->dateTime())
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setStatut($faker->text(10));
            $manager->persist($employe);
        }
        $manager->flush();
    }
}
