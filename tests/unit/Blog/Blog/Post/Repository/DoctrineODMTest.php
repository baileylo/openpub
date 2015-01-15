<?php

namespace Baileylo\Blog\Post\Repository;

use Baileylo\Blog\Post\Post;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository;
use PHPUnit_Framework_TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

class DoctrineODMTest extends PHPUnit_Framework_TestCase
{
    /** @var DocumentRepository|MockObject */
    protected $doctrine;

    /** @var DoctrineODM */
    protected $repository;
    
    public function setUp()
    {
        $this->doctrine = $this->getMock(DocumentRepository::class, [], [], '', false);
        $this->repository = new DoctrineODM($this->doctrine);
    }

    public function testSave()
    {
        /** @var DocumentManager|MockObject $dm */
        $dm = $this->getMock(DocumentManager::class, [], [], '', false);
        $post = new Post();

        $this->doctrine->expects($this->once())
            ->method('getDocumentManager')
            ->willReturn($dm);

        $dm->expects($this->once())->method('persist')->with($this->identicalTo($post));;
        $dm->expects($this->never())->method('flush');

        $this->repository->save($post, false);
    }

    public function testSaveAndFlush()
    {
        /** @var DocumentManager|MockObject $dm */
        $dm = $this->getMock(DocumentManager::class, [], [], '', false);
        $post = new Post();

        $this->doctrine->expects($this->once())
            ->method('getDocumentManager')
            ->willReturn($dm);

        $dm->expects($this->once())->method('persist')->with($this->identicalTo($post));;
        $dm->expects($this->once())->method('flush')->with($this->identicalTo($post));

        $this->repository->save($post);
    }
}
