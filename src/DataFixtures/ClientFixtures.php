<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Client;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 2; $i++ )
        {
        $client = new Client();
        $client->setName('client_' . $i);
        $this->addReference("client_$i",$client);

        $manager->persist($client);
        }
        $manager->flush();
    }
}
