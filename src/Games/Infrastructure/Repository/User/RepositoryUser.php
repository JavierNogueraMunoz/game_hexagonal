<?php

namespace Games\Games\Infrastructure\Repository\User;

use Games\Games\Domain\User\User;
use Games\Games\Domain\User\UserRepository;

final class RepositoryUser implements UserRepository
{
    public function save(User $user): void
    {
        $userPersistence = $this->buildUserPersistence($user);
        $userPersistence->save();
    }

    private function buildUserPersistence(User $user): UserPersistence
    {
        return new UserPersistence(
            $user->toSave()
        );
    }
}
