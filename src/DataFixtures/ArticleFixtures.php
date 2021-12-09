<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 100; $i++)
        {
            $article = new Article();

            $sentence = $faker->sentence(4);
            $title = substr($sentence, 0, strlen($sentence) - 1);
            $article->setTitle($title)
                    ->setAuthor($faker->name())
                    ->setContent($faker->text(3000))
                    ->setCreatedAt($faker->dateTimeThisYear());

            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
