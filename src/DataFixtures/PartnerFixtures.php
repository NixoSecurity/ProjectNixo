<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Partner;
use Faker;

class PartnerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i < 8; $i++)
        {
        $partner = new Partner();
        $partner->setTitle($faker->company);
        $partner->setCover('logo.png');
        $partner->setUrl('https://nixo-dvt.fr/');
        $partner->setRecommendation($faker->realText(200, 2));
        $partner->setFirstname($faker->firstName);
        $partner->setLastname($faker->lastName);
        $partner->setJobTitle($faker->word);
        $partner->setRecoDate($faker->dateTimeBetween('-2 years'));
        
        $manager->persist($partner);
        }



        $manager->flush();
    }
}
