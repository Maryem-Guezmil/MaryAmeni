<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setTitle("titre de produit n $i");
            $article->setContent("<p>contenu de produit n $i<p/>");
            $article->setImage("http://placehold.it/350x150");
           // $article->setCreatedAt(new \DateTime());
           $manager->persist($article);

        }
        $manager->flush();
    }
}
