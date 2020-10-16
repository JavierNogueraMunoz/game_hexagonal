<?php

namespace Tests\Unit\Domain\Mail\MotherObject;

use Games\Games\Domain\Mail\ValueObject\AddressMail;

final class AddressMailMotherObject
{
    private const ADDRESSMAIL = 'jnoguera@gmail.com';

    public static function build(
        string $addressMail = null
    ): AddressMail {
        return AddressMail::create(
            $addressMail ?? self::ADDRESSMAIL
        );
    }
}
