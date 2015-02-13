<?php

namespace Baileylo\Blog\User\Service;

use Baileylo\Blog\User\User;
use Baileylo\Blog\User\UserRepository;
use Illuminate\Contracts\Hashing\Hasher;

class UserService
{
    /** @var UserRepository */
    private $userRepository;

    /** @var Hasher */
    private $hasher;

    public function __construct(UserRepository $userRepository, Hasher $hasher)
    {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
    }

    public function updatePassword(User $user, $newPassword)
    {
        $user->changePassword($this->hasher, $newPassword);
        $this->userRepository->save($user);
    }

    public function updateData(User $user, $name, $email)
    {
        $user->update($name, $email);
        $this->userRepository->save($user);
    }
}
