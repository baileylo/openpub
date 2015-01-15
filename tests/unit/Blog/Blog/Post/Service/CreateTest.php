<?php

namespace Baileylo\Blog\Test\Post\Service;

use Baileylo\Blog\Category\Category;
use Baileylo\Blog\Post\Post;
use Baileylo\Blog\Post\PostRepository;
use Baileylo\Blog\Post\Service\Create\CreateService;
use Baileylo\BlogApp\Controller\Post\Create\Validator;
use Baileylo\Core\Laravel\Validation\ValidationResponse;
use Baileylo\Core\Markdown\Markdown;
use Illuminate\Support\MessageBag;
use PHPUnit_Framework_TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

class CreateTest extends PHPUnit_Framework_TestCase
{
    /** @var \Baileylo\Blog\Post\Service\Create\CreateService */
    protected $service;

    /** @var MockObject|Validator */
    protected $validator;

    /** @var MockObject|Markdown */
    protected $markdown;

    /** @var [] A sample data set */
    protected $postData;

    /** @var PostRepository|MockObject */
    protected $postRepo;
    
    public function setUp()
    {
        $this->validator = $this->getMock(Validator::class, [], [], '', false);
        $this->markdown = $this->getMock(Markdown::class, [], [], '', false);
        $this->postRepo = $this->getMock(PostRepository::class, [], [], '', false);
        $this->service = new Create\Create($this->validator, $this->markdown, $this->postRepo);

        $this->postData = [
            'title' => 'My First Post',
            'description' => 'A example first post',
            'categories' => 'Example',
            'body' => 'Hey Guys, welcome to Blogpressamazing',
            'isPublished' => 'yes'
        ];
    }

    public function testCreatedPostContainsErrorsFromValidation()
    {
        $failure = new ValidationResponse(new MessageBag(['bar' => 'Bar is a required field']));

        $this->assertValidationWillFail($failure, $this->postData);

        $createdPost = $this->service->create($this->postData);
        $this->assertEquals(new Post(), $createdPost->getPost());
        $this->assertSame($failure->getErrors(), $createdPost->getErrors());
    }

    public function testGenericPostAttributesArePopulatedAndSaved()
    {
        $this->assertValidationWillPass($this->postData);

        $post = $this->service->create($this->postData)->getPost();

        $this->assertEquals($this->postData['title'], $post->getTitle());
        $this->assertEquals($this->postData['description'], $post->getDescription());
        $this->assertEquals($this->postData['body'], $post->getMarkdown());
    }

    public function testCreateIgnoresDuplicateCategories()
    {
        $this->postData['category'] = 'phpunit, testing, phpunit';

        $this->assertValidationWillPass($this->postData);
        $post = $this->service->create($this->postData)->getPost();
        $categories = $post->getCategories()->toArray();
        $this->assertCount(2, $categories);
        $this->assertEquals([new Category('phpunit'), new Category('testing')], $categories);
    }

    public function testCreateSetsPublishedToNow()
    {
        $this->postData['isPublished'] = 'yes';
        $this->assertValidationWillPass($this->postData);

        $post = $this->service->create($this->postData)->getPost();
        $this->assertEquals(new \DateTime(), $post->getPublishDate());
    }

    public function testCreateLeavesPublishedNull()
    {
        $this->postData['isPublished'] = 'no';
        $this->assertValidationWillPass($this->postData);

        $post = $this->service->create($this->postData)->getPost();
        $this->assertNull($post->getPublishDate());
    }

    /**
     * @param ValidationResponse $failure
     * @param array             $data
     */
    protected function assertValidationWillFail(ValidationResponse $failure, array $data)
    {
        $this->postRepo->expects($this->never())->method('save');
        $this->validator->expects($this->once())
            ->method('validate')
            ->with($data)
            ->willReturn($failure);
    }

    /**
     * @param array $data
     */
    protected function assertValidationWillPass(array $data)
    {
        $this->postRepo->expects($this->once())->method('save');
        $this->validator->expects($this->once())
            ->method('validate')
            ->with($data)
            ->willReturn(true);
    }
}
