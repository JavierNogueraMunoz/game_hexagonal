<?php

namespace Tests\Unit\Domain\Message\Events;

use Games\Games\Domain\Base\Id\UUIDv4;
use Games\Games\Domain\Message\Entity\CountMessage;
use Games\Games\Domain\Message\Events\CountMessageEvent;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\Message\MotherObject\Entity\CountMessageMotherObject;

final class CountMessageEventTest extends TestCase
{
    const FORMAT = 'Y-m-d H:m:s';

    private UUIDv4 $eventId;
    private CountMessage $countMessage;

    /** @test */
    public function createCountMessageEvent(): void
    {
        // Given
        $this->initializeValues();

        // When
        $event = CountMessageEvent::build(
            $this->eventId,
            $this->countMessage
        );

        // Then
        $this->assertEntity($event);
        $this->assertEventName($event);
    }

    private function assertEntity(CountMessageEvent $event): void
    {
        $this->assertEquals($this->countMessage,  $event->entity());
    }

    private function assertEventName(CountMessageEvent $event): void
    {
        $this->assertEquals(CountMessageEvent::class,  $event->eventName());
    }

    private function initializeValues(): void
    {
        $this->eventId = UUIDv4::generate();
        $this->countMessage = CountMessageMotherObject::create();
    }
}
