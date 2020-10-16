<?php

namespace Tests\Unit\Domain\Message\MotherObject\Entity;

use Games\Games\Domain\Mail\ValueObject\AddressMail;
use Games\Games\Domain\Message\Entity\Body;
use Games\Games\Domain\Message\ValueObjects\BodyId;
use Tests\Unit\Domain\Mail\MotherObject\AddressMailMotherObject;
use Tests\Unit\Domain\Message\MotherObject\ValueObjects\BodyIdMotherObject;

final class BodyMotherObject
{
    private const SUBJECT  = 'subject';
    private const CONTENT = 'content';

    public static function build(
        BodyId $bodyId = null,
        AddressMail $address = null,
        string $subject = null,
        string $content = null
    ): Body {
        return Body::create(
            $bodyId ?? BodyIdMotherObject::build(),
            $address ?? AddressMailMotherObject::build(),
            $subject ?? self::SUBJECT,
            $content ?? self::CONTENT
        );
    }
}
