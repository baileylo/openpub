<?php

namespace Baileylo\Blog\Test\Post\Service;

use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\Service\Create\CreatedPost;
use Baileylo\Core\Laravel\Validation\ValidationResponse;
use Illuminate\Support\MessageBag;
use PHPUnit_Framework_TestCase;

class CreatedPostTest extends PHPUnit_Framework_TestCase
{
    /** @var Post */
    protected $post;

    /** @var CreatedPost */
    protected $validPost;

    /** @var CreatedPost */
    protected $invalidPost;

    /** @var ValidationResponse */
    protected $failure;
    
    public function setUp()
    {
        $this->post = new Post();
        $this->failure = new ValidationResponse(new MessageBag(['something' => 'broken']));
        $this->validPost = new CreatedPost($this->post);
        $this->invalidPost = new CreatedPost($this->post, $this->failure);
    }

    public function testGetPost()
    {
        $this->assertSame($this->post, $this->validPost->getPost());
        $this->assertSame($this->post, $this->invalidPost->getPost());
    }

    public function testHasErrors()
    {
        $this->assertTrue($this->invalidPost->hasErrors());
        $this->assertFalse($this->validPost->hasErrors());
    }

    public function getErrors()
    {
        $this->assertInstanceOf(MessageBag::class, $this->validPost->getErrors());
        $this->assertSame($this->failure->getErrors(), $this->invalidPost->getErrors());
    }
}
