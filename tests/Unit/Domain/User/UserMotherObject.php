<?php

namespace Tests\Unit\Domain\User;

use Games\Games\Domain\Mail\ValueObject\AddressMail;
use Games\Games\Domain\User\User;
use Games\Games\Domain\User\UserId;

final class UserMotherObject
{
    private const USER_ID = '9be9bce9-c802-45ad-9d49-39c6b6ed808f';
    private const ADDRESS = 'jnoguera@gmail.com';
    private const NAME = 'name';
    private const SURNAME = 'surname';

    public static function build(
        UserId $userId = null,
        AddressMail $addressMail = null,
        string $name = null,
        string $surname = null
    ): User {
        return User::create(
            $userId ?? UserId::fromString(self::USER_ID),
            $addressMail ?? AddressMail::create(self::ADDRESS),
            $name ?? self::NAME,
            $surname ?? self::SURNAME
        );
    }
}
