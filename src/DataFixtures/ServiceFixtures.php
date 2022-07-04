<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Service;
use Faker;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 8; $i++)
        {
          $service = new Service();
          $service->setName($faker->colorName);
          $service->setDescription($faker->realText(200, 2));
          $this->addReference("service_$i",$service);

          $manager->persist($service);
        }       
         
        $manager->flush();
    }
}
