<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 15; $i++) {
            $article = new Article();
            $article->setTitre("" . $i);
            $article->setContent("Le numero de cet article est : " . $i);
            $article->setUrlAlias("" . $i);
            $article->setPublished(date_create());
            $manager->persist($article);
        }
        $manager->flush();
    }
}
