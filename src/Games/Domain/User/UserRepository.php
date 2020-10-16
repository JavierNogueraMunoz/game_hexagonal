<?php

namespace Games\Games\Domain\User;

interface UserRepository
{
    public function save(User $user): void;
}
