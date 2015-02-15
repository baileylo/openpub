<?php

namespace Baileylo\Blog\User;

use App\Events\UpdateRememberMeToken;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Hashing\Hasher;

class UserProvider implements \Illuminate\Contracts\Auth\UserProvider
{
    /** @var UserRepository */
    protected $repository;

    /** @var Dispatcher */
    private $dispatcher;

    /** @var Hasher */
    private $hasher;

    /**
     * @param UserRepository $userRepo
     * @param Dispatcher     $dispatcher
     * @param Hasher         $hasher
     */
    public function __construct(UserRepository $userRepo, Dispatcher $dispatcher, Hasher $hasher)
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
     * @return Authenticatable|null
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
     * @return Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        return $this->repository->findByToken($identifier, $token);
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  Authenticatable $user
     * @param  string          $token
     *
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        $this->dispatcher->fire(new UpdateRememberMeToken($user, $token));
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     *
     * @return Authenticatable|null
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
     * @param  Authenticatable $user
     * @param  array           $credentials
     *
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain = $credentials['password'];

        return $this->hasher->check($plain, $user->getAuthPassword());
    }
}
