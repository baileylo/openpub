<?php

namespace Baileylo\Blog\User\Events;

use Illuminate\Auth\UserInterface;

class UpdateRememberToken
{
    /** @var UserInterface */
    private $user;

    /** @var string */
    private $token;

    /**
     * @param UserInterface $user
     * @param string        $token
     */
    public function __construct(UserInterface $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
}
