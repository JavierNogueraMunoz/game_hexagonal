<?php

namespace Tests\Unit\Domain\Logger\MotherObject;

use Games\Games\Domain\Logger\Entity\Log;

final class LogMotherObject
{
    const MESSAGE = 'MessageDoctrine error';
    const CONTEXT = [];

    public static function build(
        string $message = null,
        array $context = null
    ): Log {
        return Log::build(
            $message ?? self::MESSAGE,
            $context ?? self::CONTEXT
        );
    }
}
