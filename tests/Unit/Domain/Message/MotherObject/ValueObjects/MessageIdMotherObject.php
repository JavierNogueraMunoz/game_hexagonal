<?php

namespace Tests\Unit\Domain\Message\MotherObject\ValueObjects;

use Games\Games\Domain\Message\ValueObjects\MessageId;

final class MessageIdMotherObject
{
    private const UUID = '9be9bce9-c802-45ad-9d49-39c6b6ed808f';

    public static function create(
        ?string $uuid = null
    ): MessageId {
        return MessageId::fromString(
            $uuid ?? self::UUID
        );
    }
}
