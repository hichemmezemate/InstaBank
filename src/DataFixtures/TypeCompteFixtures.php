<?php

namespace App\DataFixtures;

use App\Entity\TypeCompte;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeCompteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $type = new TypeCompte();
        $type->setLibelle('Compte courant');
        $this->addReference('courant', $type);
        $manager->persist($type);

        $type1 = new TypeCompte();
        $type1->setLibelle('Compte épargne');
        $this->addReference('epargne', $type1);
        $manager->persist($type1);

        $type2 = new TypeCompte();
        $type2->setLibelle('Compte-titre');
        $this->addReference('titre', $type2);
        $manager->persist($type2);

        $type3 = new TypeCompte();
        $type3->setLibelle('Compte à terme');
        $this->addReference('terme', $type3);
        $manager->persist($type3);

        $manager->flush();
    }
}
