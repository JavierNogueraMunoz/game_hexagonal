<?php

namespace Tests\Unit\Domain\Message\MotherObject\Entity;

use Games\Games\Domain\Message\Entity\Body;
use Games\Games\Domain\Message\Entity\ReverseMessage;
use Games\Games\Domain\Message\ValueObjects\MessageId;
use Games\Games\Domain\User\User;
use Tests\Unit\Domain\Message\MotherObject\ValueObjects\MessageIdMotherObject;
use Tests\Unit\Domain\User\UserMotherObject;

final class ReverseMessageMotherObject
{
    public static function create(
        MessageId $messageId = null,
        User $user = null,
        Body $body = null
    ): ReverseMessage {
        return ReverseMessage::build(
            $messageId ?? MessageIdMotherObject::create(),
            $user ?? UserMotherObject::build(),
            $body ?? BodyMotherObject::build()
        );
    }
}
