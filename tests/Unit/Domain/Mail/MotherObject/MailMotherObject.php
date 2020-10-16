<?php

namespace Tests\Unit\Domain\Mail\MotherObject;

use Games\Games\Domain\Mail\Entity\Mail;

class MailMotherObject
{
    private const ADDRESS = 'jnoguera@gmail.com';
    private const SUBJECT = 'este es el subject';
    private const BODY = 'Este es el cuerpo';

    public static function build(
        string $address = null,
        string $subject = null,
        string $body = null
    ): Mail {
        return Mail::create(
            $address ?? self::ADDRESS,
            $subject ?? self::SUBJECT,
            $body ?? self::BODY
        );
    }
}
