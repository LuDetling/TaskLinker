<?php

namespace App\DataFixtures;

use App\Factory\EmployeFactory;
use App\Factory\ProjetFactory;
use App\Factory\StatutFactory;
use App\Factory\TacheFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        EmployeFactory::createMany(20);
        ProjetFactory::createMany(10);
        StatutFactory::createMany(3);
        TacheFactory::createMany(50);

        // $manager->flush();
    }
}
