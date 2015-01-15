<?php

namespace Baileylo\Blog\Test\User;

use Baileylo\Blog\User\User;
use PHPUnit_Framework_TestCase;

class UserTest extends PHPUnit_Framework_TestCase
{
    public function testRegister()
    {
        $user = User::register('foo@bar.foobar', 'somehashedpassword', 'Frank Grimes');
        $this->assertEquals('foo@bar.foobar', $user->getEmail());
        $this->assertEquals('somehashedpassword', $user->getAuthPassword());
        $this->assertEquals('Frank Grimes', $user->getName());
        $this->assertEquals('frank-grimes', $user->getSlug());
    }
}
