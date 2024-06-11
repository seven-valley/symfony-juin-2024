<?php

namespace App\DataFixtures;

use App\Entity\Cocktail;
use App\Entity\Couleur;
use App\Entity\Fruit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $vert = new Couleur();
        $vert->setNom('vert');
        $manager->persist($vert);
        $rouge = new Couleur();
        $rouge->setNom('rouge');
        $manager->persist($rouge);
        //--------------------------
        $grenade = new Fruit();
        $grenade->setNom('grenade');
        $grenade->setCouleur($rouge);
        $manager->persist($grenade);

        $cerise = new Fruit();
        $cerise->setNom('cerise');
        $cerise->setCouleur($rouge); 
        $manager->persist($cerise);

        $kiwi = new Fruit();
        $kiwi->setNom('kiwi');
        $kiwi->setCouleur($vert); 
        $manager->persist($kiwi);

        $pomme = new Fruit();
        $pomme->setNom('pomme');
        $pomme->setCouleur($vert);
        $manager->persist($pomme); 
        //--------------------------

        $grenadine = New Cocktail();
        $grenadine->setNom('Grenadine Coktail');
        $grenadine->setFruit($grenade);
        $manager->persist($grenadine);

        $jus = New Cocktail();
        $jus->setNom('Cocktail jus de pomme');
        $jus->setFruit($pomme);
        $manager->persist($jus);;
            
        
      



      

        $manager->flush();

        $manager->flush();
    }
}
