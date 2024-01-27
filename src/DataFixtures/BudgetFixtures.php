<?php

namespace App\DataFixtures;

use App\Entity\Budget;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BudgetFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $budget1 = new Budget();
        $budget1->setNom('Alimentation');
        $this->addReference('budget1', $budget1);
        $manager->persist($budget1);

        $budget2 = new Budget();
        $budget2->setNom('Vie quotidienne');
        $this->addReference('budget2', $budget2);
        $manager->persist($budget2);

        $budget3 = new Budget();
        $budget3->setNom('Enfants & Scolarité');
        $this->addReference('budget3', $budget3);
        $manager->persist($budget3);

        $budget4 = new Budget();
        $budget4->setNom('Santé');
        $this->addReference('budget4', $budget4);
        $manager->persist($budget4);

        $budget5 = new Budget();
        $budget5->setNom('Logement');
        $this->addReference('budget5', $budget5);
        $manager->persist($budget5);

        $budget6 = new Budget();
        $budget6->setNom('Transports');
        $this->addReference('budget6', $budget6);
        $manager->persist($budget6);

        $budget7 = new Budget();
        $budget7->setNom('Loisirs');
        $this->addReference('budget7', $budget7);
        $manager->persist($budget7);

        $manager->flush();
    }
}
