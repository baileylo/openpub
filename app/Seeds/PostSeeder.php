<?php

namespace Baileylo\BlogApp\Seeds;

use Baileylo\Blog\Category\Category;
use Baileylo\Blog\Post\Post;
use Baileylo\Core\Markdown\Markdown;
use Doctrine\ODM\MongoDB\DocumentManager;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /** @var \Faker\Generator */
    protected $faker;

    /** @var DocumentManager */
    protected $dm;

    /** @var Markdown */
    protected $converter;

    protected $categories = [];

    public function run()
    {
        $this->faker = \Faker\Factory::create();
        $this->dm = $this->container[DocumentManager::class];
        $this->converter = $this->container[Markdown::class];

        foreach($this->faker->words(15) as $categoryName) {
            $this->categories[] = new Category($categoryName);
        }

        foreach(range(0, 100000) as $count) {
            echo 'Creating post ' . $count . PHP_EOL;
            $this->dm->persist($this->createPost($count));

            if ($count % 1000) {
                $this->dm->flush();
                $this->dm->clear();
            }
        }

        $this->dm->flush();
    }

    public function createPost($count)
    {
        $post = new Post();
        $post->update(
            $this->faker->catchPhrase,
            implode("\n", $this->faker->sentences(3)),
            implode("\n", $this->faker->paragraphs(3)),
            $this->converter
        );

        $post->setSlug(Str::slug($post->getTitle()) ."-b-{$count}");
        $post->publish($this->faker->dateTimeBetween('-5 years', 'now'));

        foreach(range(0, rand(1, 4)) as $size) {
            $categories = $this->categories;
            shuffle($categories);
            $categories = array_slice($categories, 0, $size);
            foreach($categories as $category) {
                $post->addCategory($category);
            }
        }

        return $post;
    }
}
