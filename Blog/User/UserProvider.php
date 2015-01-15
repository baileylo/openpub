<?php

namespace Baileylo\Blog\User;

use Baileylo\Blog\User\Events\UpdateRememberToken;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserProviderInterface;
use Illuminate\Hashing\HasherInterface;
use Laracasts\CommanderEvents\EventDispatcher;

class UserProvider implements UserProviderInterface
{
    /** @var UserRepository */
    protected $repository;

    /** @var EventDispatcher */
    private $dispatcher;

    /** @var HasherInterface */
    private $hasher;

    /**
     * @param UserRepository  $userRepo
     * @param EventDispatcher $dispatcher
     * @param HasherInterface $hasher
     */
    public function __construct(UserRepository $userRepo, EventDispatcher $dispatcher, HasherInterface $hasher)
    {
        $this->repository = $userRepo;
        $this->dispatcher = $dispatcher;
        $this->hasher = $hasher;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     *
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveById($identifier)
    {
        return $this->repository->findById($identifier);
    }

    /**
     * Retrieve a user by by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string $token
     *
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByToken($identifier, $token)
    {
        return $this->repository->findByToken($identifier, $token);
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Auth\UserInterface $user
     * @param  string                         $token
     *
     * @return void
     */
    public function updateRememberToken(UserInterface $user, $token)
    {
        $this->dispatcher->dispatch([new UpdateRememberToken($user, $token)]);
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     *
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (!isset($credentials['login'])) {
            return null;
        }

        return $this->repository->findByEmail($credentials['login']);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Auth\UserInterface $user
     * @param  array                          $credentials
     *
     * @return bool
     */
    public function validateCredentials(UserInterface $user, array $credentials)
    {
        $plain = $credentials['password'];

        return $this->hasher->check($plain, $user->getAuthPassword());
    }
}
