<?php

namespace Tests\Unit\Domain\Message\MotherObject\Events;

use Games\Games\Domain\Base\Id\UUIDv4;
use Games\Games\Domain\Message\Entity\CountMessage;
use Games\Games\Domain\Message\Events\CountMessageEvent;
use Tests\Unit\Domain\Message\MotherObject\Entity\CountMessageMotherObject;

final class CountMessageEventMotherObject
{
    public static function create(
        UUIDv4 $eventId = null,
        CountMessage $countMessage = null
    ): CountMessageEvent {
        return CountMessageEvent::build(
            $eventId ?? UUIDv4::generate(),
            $countMessage ?? CountMessageMotherObject::create()
        );
    }
}
