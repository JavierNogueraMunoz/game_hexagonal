<?php

namespace Tests\Unit\Domain\Message\ValueObjects;

use Games\Games\Domain\Message\ValueObjects\MessageId;
use PHPUnit\Framework\TestCase;

final class MessageIdTest extends TestCase
{
    private const UUID = '9be9bce9-c802-45ad-9d49-39c6b6ed808f';

    private string $messageId;

    /** @test */
    public function fromStringMessageId(): void
    {
        // Given
        $this->initializeValues();

        // When
        $uuid = MessageId::fromString($this->messageId);

        // Then
        $this->assertSame($this->messageId, $uuid->format());
    }

    private function initializeValues(): void
    {
        $this->messageId = self::UUID;
    }
}
