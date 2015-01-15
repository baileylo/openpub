<?php

namespace Baileylo\Blog\Test\User;

use Baileylo\Blog\User\Events\UpdateRememberToken;
use Baileylo\Blog\User\User;
use Baileylo\Blog\User\UserProvider;
use Baileylo\Blog\User\UserRepository;
use Illuminate\Auth\UserInterface;
use Laracasts\CommanderEvents\EventDispatcher;
use Illuminate\Hashing\HasherInterface;
use PHPUnit_Framework_TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

class UserProviderTest extends PHPUnit_Framework_TestCase
{
    /** @var UserProvider */
    protected $provider;

    /** @var UserRepository|MockObject */
    protected $userRepo;

    /** @var EventDispatcher|MockObject */
    protected $dispatcher;

    /** @var HasherInterface|MockObject */
    protected $hasher;

    public function setUp()
    {
        $this->userRepo = $this->getMock(UserRepository::class, [], [], '', false);
        $this->dispatcher = $this->getMock(EventDispatcher::class, [], [], '', false);
        $this->hasher = $this->getMock(HasherInterface::class, [], [], '', false);
        $this->provider = new UserProvider($this->userRepo, $this->dispatcher, $this->hasher);
    }

    public function testRetrieveById()
    {
        $id = '54a7a16905be5db76c0041ab';
        $user = new User();
        $this->userRepo->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn($user);

        $this->assertSame($user, $this->provider->retrieveById($id));
    }

    public function testRetrieveByToken()
    {
        $id = '54a7a16905be5db76c0041ab';
        $token = '2mJTlqwRCODDYbggZbbBU33wGXUdKTAA';
        $user = new User();

        $this->userRepo->expects($this->once())
            ->method('findByToken')
            ->with($id, $token)
            ->willReturn($user);

        $this->assertSame($user, $this->provider->retrieveByToken($id, $token));
    }

    public function testUpdateRememberTokenDispatchesUpdateRememberToken()
    {
        $user = new User;
        $token = 'a given token';
        $expected = [new UpdateRememberToken($user, $token)];

        $this->dispatcher->expects($this->once())
            ->method('dispatch')
            ->with($expected);

        $this->provider->updateRememberToken($user, $token);
    }

    public function testRetrieveByCredentials()
    {
        $this->assertNull(
            $this->provider->retrieveByCredentials(['name' => 'baileylo', 'password' => 'mypass']),
            'retrieveByCredentials returns Null when login offset is not provided'
        );

        $parameters = ['login' => 'foo@bar.co', 'password' => 'mypass'];
        $user = new User();
        $this->userRepo->expects($this->once())
            ->method('findByEmail')
            ->with($parameters['login'])
            ->willReturn($user);

        $this->assertSame($user, $this->provider->retrieveByCredentials($parameters));
    }

    public function testValidateCredentialsWithInvalidCredentials()
    {
        $credentials = ['password' => 'myPassword'];
        $user = $this->getMock(UserInterface::class, [], [], '', false);

        $user->expects($this->once())
            ->method('getAuthPassword')
            ->willReturn('15o2ijgasidjg1251ot19204129j');

        $this->hasher->expects($this->once())
            ->method('check')
            ->with($credentials['password'], '15o2ijgasidjg1251ot19204129j')
            ->willReturn(false);

        $this->assertFalse($this->provider->validateCredentials($user, $credentials));
    }

    public function testValidateCredentialsWithValidCredentials()
    {
        $credentials = ['password' => 'myPassword'];
        $user = $this->getMock(UserInterface::class, [], [], '', false);

        $user->expects($this->once())
            ->method('getAuthPassword')
            ->willReturn('15o2ijgasidjg1251ot19204129j');

        $this->hasher->expects($this->once())
            ->method('check')
            ->with($credentials['password'], '15o2ijgasidjg1251ot19204129j')
            ->willReturn(true);

        $this->assertTrue($this->provider->validateCredentials($user, $credentials));
    }
}
