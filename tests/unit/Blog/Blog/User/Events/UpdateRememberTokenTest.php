<?php

namespace Baileylo\Blog\Test\User\Events;

use Baileylo\Blog\User\Events\UpdateRememberToken;
use Illuminate\Auth\UserInterface;
use PHPUnit_Framework_TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

class UpdateRememberTokenTest extends PHPUnit_Framework_TestCase
{
    /** @var UpdateRememberToken */
    protected $event;

    /** @var UserInterface|MockObject */
    protected $user;

    /** @var String */
    protected $token;
    
    public function setUp()
    {
        $this->user = $this->getMock(UserInterface::class, [], [], '', false);
        $this->token = 'myfaketoken';
        $this->event = new UpdateRememberToken($this->user, $this->token);
    }

    public function testGetToken()
    {
        $this->assertEquals($this->token, $this->event->getToken());
    }

    public function testGetUser()
    {
        $this->assertSame($this->user, $this->event->getUser());
    }
}
