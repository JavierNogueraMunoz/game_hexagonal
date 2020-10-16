<?php

namespace Tests\Unit\Domain\Message\MotherObject\Events;

use Games\Games\Domain\Base\Id\UUIDv4;
use Games\Games\Domain\Event\EventId;
use Games\Games\Domain\Message\Entity\ReverseMessage;
use Games\Games\Domain\Message\Events\ReverseMessageEvent;
use Tests\Unit\Domain\Message\MotherObject\Entity\ReverseMessageMotherObject;

final class ReverseMessageEventMotherObject
{
    public static function create(
        EventId $eventId = null,
        ReverseMessage $reverseMessage = null
    ): ReverseMessageEvent {
        return ReverseMessageEvent::build(
            $eventId ?? UUIDv4::generate(),
            $reverseMessage ?? ReverseMessageMotherObject::create()
        );
    }
}
