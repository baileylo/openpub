<?php

namespace Baileylo\User\Repository;

use Baileylo\Blog\User\Repository\DoctrineODM;
use Baileylo\Blog\User\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\UnitOfWork;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Persisters\DocumentPersister;
use PHPUnit_Framework_TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

class DoctrineODMTest extends PHPUnit_Framework_TestCase
{
    /** @var DocumentManager|MockObject */
    protected $dm;

    /** @var UnitOfWork|MockObject */
    protected $uow;

    /** @var ClassMetadata|MockObject */
    protected $metadata;

    /** @var DoctrineODM */
    protected $repository;

    /** @var DocumentPersister|MockObject */
    protected $persister;

    /** @var DoctrineODM|MockObject $mock */
    protected $mockRepository;

    public function setUp()
    {
        $this->metadata = $this->getMock(ClassMetadata::class, [], [], '', false);
        $this->uow = $this->getMock(UnitOfWork::class, [], [], '', false);
        $this->dm = $this->getMock(DocumentManager::class, [], [], '', false);
        $this->persister = $this->getMock(DocumentPersister::class, [], [], '', false);
        $this->repository = new DoctrineODM(
            $this->dm,
            $this->uow,
            $this->metadata
        );

        $this->mockRepository = $this->getMock(DoctrineODM::class, ['find', 'findOneBy', 'findOneByEmail'], [], '', false);
    }

    public function testFindByIdCallsFind()
    {
        $id = '54a7a16905be5db76c0041ab';
        $user = new User();

        $this->mockRepository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($user);

        $this->assertSame($user, $this->mockRepository->findById($id));
    }

    public function testFindByTokenCallsFindOneBy()
    {
        $id = '54a7a16905be5db76c0041ab';
        $token = 'sGA4K3VCyBd0LZmTMk0zHwiBOINYNxKC';
        $user = new User();

        $this->mockRepository->expects($this->once())
            ->method('findOneBy')
            ->with(['_id' => $id, 'rememberToken' => $token])
            ->willReturn($user);

        $this->assertSame($user, $this->mockRepository->findByToken($id, $token));
    }

    public function testFindByEmail()
    {
        $email = 'foo@bar.fizz';
        $user = new User;

        $this->mockRepository->expects($this->once())
            ->method('findOneByEmail')
            ->with($email)
            ->willReturn($user);

        $this->assertSame($user, $this->mockRepository->findByEmail($email));
    }
}
