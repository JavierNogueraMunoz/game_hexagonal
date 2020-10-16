<?php

namespace Games\Games\Domain\Message\Events;

use Games\Games\Domain\Base\Id\UUIDv4;
use Games\Games\Domain\Event\Entity\Event;
use Games\Games\Domain\Message\Entity\ReverseMessage;

final class ReverseMessageEvent extends Event
{
    private function __construct(
        UUIDv4 $eventId,
        ReverseMessage $reverseMessage
    ) {
       parent::__construct(
           $eventId,
           $reverseMessage
       );
    }

    public static function build(
        UUIDv4 $eventId,
        ReverseMessage $reverseMessage
    ): ReverseMessageEvent {
        return new static(
            $eventId,
            $reverseMessage
        );
    }

    public function eventName(): string
    {
        return ReverseMessageEvent::class;
    }
}

