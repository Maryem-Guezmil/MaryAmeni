<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use DateTime;
use Faker\Provider\DateTime as ProviderDateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create();
        $user = [];
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setUsername($faker->name);
            $user->setFirstname($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword($faker->password);
            $user->setCreatedAt = new DateTime();
            //prendre en compte user
            $manager->persist($user);

            $users[] = $user;
        }

        $categories = [];
        for ($i = 0; $i < 15; $i++) {
            $category = new Categorie();
            $category->setTitle($faker->text((50)));
            $category->setDescription($faker->text(250));
            $category->setImage($faker->imageUrl());
            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i = 0; $i < 100; $i++) {
            $article = new Article();
            $article->setTitle($faker->text(50));
            $article->setContent($faker->text(6000));
            $article->setImage($faker->imageUrl());
            $article->setCreatedAt= new DateTime();
            $article->setAuthor($users($faker->numberBetween(0, 49)));
            $article->addCategorie($categories($faker->numberBetween(0, 14)));
            $manager->persist($article);
        }

        //les d sauv dans la bd
        $manager->flush();
    }
}
