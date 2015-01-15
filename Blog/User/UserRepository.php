<?php

namespace Baileylo\Blog\User;

interface UserRepository
{
    /**
     * @param string $identifier
     *
     * @return null|User
     */
    public function findById($identifier);

    /**
     * Retrieve User by their token(generated password) and UUID. This is used
     * for the remember me token.
     *
     * @param String $identifier User's UUID
     * @param String $token      User's auto-generated token
     *
     * @return null|User
     */
    public function findByToken($identifier, $token);

    /**
     * Retrieve a user by their email address, this is used for lgoin
     *
     * @param String $email
     *
     * @return null|User
     */
    public function findByEmail($email);

    /**
     * Persists a user to the database
     *
     * @param User $user
     * @param Bool $flush
     *
     * @return void
     */
    public function save(User $user, $flush = true);
}
