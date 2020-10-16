<?php

namespace Tests\Unit\Domain\Message\MotherObject\Entity;

use Games\Games\Domain\Message\Entity\Body;
use Games\Games\Domain\Message\Entity\CountMessage;
use Games\Games\Domain\Message\ValueObjects\MessageId;
use Games\Games\Domain\User\User;
use Tests\Unit\Domain\Message\MotherObject\ValueObjects\MessageIdMotherObject;
use Tests\Unit\Domain\User\UserMotherObject;

final class CountMessageMotherObject
{
    public static function create(
        MessageId $uuid = null,
        User $user = null,
        Body $body = null
    ): CountMessage {
        return CountMessage::build(
            $uuid ?? MessageIdMotherObject::create(),
            $user ?? UserMotherObject::build(),
            $body ?? BodyMotherObject::build()
        );
    }
}
