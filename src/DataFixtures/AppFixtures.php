<?php

namespace App\DataFixtures;

use App\Factory\TodoFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // création de 10 fake data
        TodoFactory::new()->many(10)->create();

        $manager->flush();
    }
}
