<?php

namespace Games\Games\Domain\Message\Events;

use Games\Games\Domain\Base\Id\UUIDv4;
use Games\Games\Domain\Event\Entity\Event;
use Games\Games\Domain\Message\Entity\CountMessage;

final class CountMessageEvent extends Event
{
    private function __construct(
        UUIDv4 $eventId,
        CountMessage $countMessageEntity
    ) {
        parent::__construct(
            $eventId,
            $countMessageEntity
        );
    }

    public static function build(
        UUIDv4 $eventId,
        CountMessage $countMessageEntity
    ): CountMessageEvent {
        return new static(
            $eventId,
            $countMessageEntity
        );
    }

    public function eventName(): string
    {
        return CountMessageEvent::class;
    }
}

