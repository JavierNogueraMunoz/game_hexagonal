<?php

namespace Tests\Unit\Domain\Message\MotherObject\ValueObjects;

use Games\Games\Domain\Message\ValueObjects\BodyId;

final class BodyIdMotherObject
{
    private const UUID = '9be9bce9-c802-45ad-9d49-39c6b6ed808f';

    public static function build(
        ?string $uuid = null
    ): BodyId {
        return BodyId::fromString(
            $uuid ?? self::UUID
        );
    }
}
