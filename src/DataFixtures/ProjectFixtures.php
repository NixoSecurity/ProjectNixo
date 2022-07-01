<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Project;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 10; $i++) 
        {
            $project = new Project();
            $project->setTitle($faker->realText(10, 1) );
            $project->setDescription($faker->realText(200, 1));
            $project->setCover('projectCover.jpg');
            $project->setCity($faker->city);
            $project->setCategory($this->getReference("category_".rand(0, 4)));
    
            $manager->persist($project);
        }
        $manager->flush();    
    }   
}
