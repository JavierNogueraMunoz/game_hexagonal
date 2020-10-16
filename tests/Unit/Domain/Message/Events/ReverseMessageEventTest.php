<?php

namespace Tests\Unit\Domain\Message\Events;

use Games\Games\Domain\Base\Id\UUIDv4;
use Games\Games\Domain\Message\Entity\ReverseMessage;
use Games\Games\Domain\Message\Events\ReverseMessageEvent;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\Message\MotherObject\Entity\ReverseMessageMotherObject;

final class ReverseMessageEventTest extends TestCase
{
    const FORMAT = 'Y-m-d H:m:s';

    private UUIDv4 $eventId;
    private ReverseMessage $reverseMessage;

    /** @test */
    public function createReverseMessageEvent(): void
    {
        // Given
        $this->initializeValues();

        // When
        $event = ReverseMessageEvent::build(
            $this->eventId,
            $this->reverseMessage
        );

        // Then
        $this->assertEntity($event);
        $this->assertEventName($event);
    }

    private function assertEntity(ReverseMessageEvent $event): void
    {
        $this->assertEquals($this->reverseMessage,  $event->entity());
    }

    private function assertEventName(ReverseMessageEvent $event): void
    {
        $this->assertEquals(ReverseMessageEvent::class,  $event->eventName());
    }


    private function initializeValues(): void
    {
        $this->eventId = UUIDv4::generate();
        $this->reverseMessage = ReverseMessageMotherObject::create();
    }
}
