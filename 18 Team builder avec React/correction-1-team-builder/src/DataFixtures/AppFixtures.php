<?php

namespace App\DataFixtures;

use App\Entity\Person;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // team #1 //
        $team = new Team();
        $team->setName("Equipe Rouge");
        $manager->persist($team);

        // person #1 //
        $person = new Person();
        $person->setFirstName('Rémy');
        $person->setLastName('Pierre');
        $person->setAge(37);
        $person->setTeam($team);
        $manager->persist($person);

        // team #2 //
        $team = new Team();
        $team->setName("Equipe Bleue");
        $manager->persist($team);

        // person #2 //
        $person = new Person();
        $person->setFirstName('Justine');
        $person->setLastName('Pourteau');
        $person->setAge(25);
        $person->setTeam($team);
        $manager->persist($person);

        // person #3 //
        $person = new Person();
        $person->setFirstName('Clémentine');
        $person->setLastName('Pierre-Pourteau');
        // $person->setAge(null);
        // $person->setTeam(null);
        $manager->persist($person);

        $manager->flush();
    }
}
