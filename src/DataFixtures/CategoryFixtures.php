<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 5; $i++ )
        {
            $category = new Category();
            $category->setName($faker->realText(15, 1));
            $this->addReference("category_$i",$category);

            $manager->persist($category);
        }      
        $manager->flush();
    }
}

// new merge
