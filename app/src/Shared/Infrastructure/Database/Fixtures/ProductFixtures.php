<?php

namespace App\Shared\Infrastructure\Database\Fixtures;

use App\Products\Domain\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 10; $i++) {
            $product = new Product(
                $faker->word,                
                $faker->randomFloat(2, 10, 1000), 
                $faker->word                 
            );
            $product->setIsActive($faker->boolean); 

            $manager->persist($product);
        }

        $manager->flush();
    }
}
