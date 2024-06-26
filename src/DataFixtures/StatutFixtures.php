<?php

namespace App\DataFixtures;

use App\Entity\Statut;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatutFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $statut1 = new Statut();
        $statut1->setLibelle('To Do');
        $this->setReference("TO_DO", $statut1);
        $manager->persist($statut1);
        $statut2 = new Statut();
        $statut2->setLibelle('Doing');
        $this->setReference("DOING", $statut2);
        $manager->persist($statut2);
        $statut3 = new Statut();
        $statut3->setLibelle('Done');
        $this->setReference("DONE", $statut3);
        $manager->persist($statut3);
        $manager->flush();
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
