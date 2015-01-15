<?php

namespace Baileylo\Blog\Test\Post;

use Baileylo\Blog\Category\Category;
use Baileylo\Blog\Post\Post;
use Baileylo\Core\Markdown\Markdown;
use PHPUnit_Framework_TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

class PostTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $title = 'A generic post title';
        $description  = 'A generic post description';
        $body = 'An extremely generic post about generic posts.';
        $generatedHtml = '<h1>lols!</h1> I\'m not going to do that';
        /** @var MarkDown|MockObject $converter */
        $converter = $this->getMock(Markdown::class, [], [], '', false);

        $converter->expects($this->once())
            ->method('toHtml')
            ->with($body)
            ->willReturn($generatedHtml);

        $post = Post::create($title, $description, $body, $converter);

        $this->assertEquals($title, $post->getTitle());
        $this->assertEquals($description, $post->getDescription());
        $this->assertEquals($body, $post->getMarkdown());
        $this->assertEquals($generatedHtml, $post->getHtml());
        $this->assertCount(0, $post->getCategories());
    }

    public function testAddCategory()
    {
        $category = new Category('phpunit');
        $post = new Post();
        $post->addCategory($category);

        $this->assertCount(1, $post->getCategories());
        $this->assertSame($category, $post->getCategories()->first());
    }

    public function testPublish()
    {
        $when = new \DateTime();
        $post = new Post();
        $post->publish($when);

        $this->assertSame($when, $post->getPublishDate());
    }
}
