<?php

namespace Games\Games\Domain\Message;

use Games\Games\Domain\Message\Entity\CountMessage;
use Games\Games\Domain\Message\Entity\ReverseMessage;
use Games\Games\Domain\Message\Entity\Body;
use Games\Games\Domain\User\User;

final class FactoryMessage
{
    public static function build(
        string $type,
        $messageId,
        User $user,
        Body $body
    ) {
        return self::getBuilder($messageId, $user, $body)[$type];
    }

    private static function getBuilder(
        $messageId,
        User $user,
        Body $body
    ): array {
        return [
            'count_request' => CountMessage::build(
                $messageId,
                $user,
                $body
            ),
            'reverse_request' => ReverseMessage::build(
                $messageId,
                $user,
                $body
            )
        ];
    }
}
