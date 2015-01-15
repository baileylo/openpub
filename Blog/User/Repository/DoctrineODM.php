<?php

namespace Baileylo\Blog\User\Repository;

use Baileylo\Blog\User\User;
use Baileylo\Blog\User\UserRepository;
use Doctrine\ODM\MongoDB\DocumentRepository;

class DoctrineODM extends DocumentRepository implements UserRepository
{
    /**
     * @param string $identifier
     *
     * @return null|User
     */
    public function findById($identifier)
    {
        return $this->find($identifier);
    }

    /**
     * Retrieve User by their token(generated password) and UUID.
     *
     * @param String $identifier User's UUID
     * @param String $token      User's auto-generated token
     *
     * @return null|User
     */
    public function findByToken($identifier, $token)
    {
        return $this->findOneBy([
            '_id' => $identifier,
            'rememberToken' => $token
        ]);
    }

    /**
     * Retrieve a user by their email address, this is used for lgoin
     *
     * @param String $email
     *
     * @return null|User
     */
    public function findByEmail($email)
    {
        return $this->findOneByEmail($email);
    }

    /**
     * Persists a user to the database
     *
     * @param User $user
     * @param Bool $flush
     *
     * @return void
     */
    public function save(User $user, $flush = true)
    {
        $dm = $this->getDocumentManager();
        $dm->persist($user);

        if ($flush) {
            $dm->flush($user);
        }
    }
}
