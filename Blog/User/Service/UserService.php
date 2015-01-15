<?php

namespace Baileylo\Blog\User\Service;

use Baileylo\Blog\User\User;
use Baileylo\Blog\User\UserRepository;
use Illuminate\Hashing\HasherInterface;

class UserService
{
    /** @var UserRepository */
    private $userRepository;

    /** @var HasherInterface */
    private $hasher;

    public function __construct(UserRepository $userRepository, HasherInterface $hasher)
    {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
    }

    public function updatePassword(User $user, $newPassword)
    {
        $user->changePassword($newPassword, $this->hasher);
        $this->userRepository->save($user);
    }

    public function updateData(User $user, $name, $email)
    {
        $user->update($name, $email);
        $this->userRepository->save($user);
    }
}
