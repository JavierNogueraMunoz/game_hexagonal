<?php

namespace Tests\Unit\Domain\Message\ValueObjects;

use Games\Games\Domain\Message\ValueObjects\BodyId;
use PHPUnit\Framework\TestCase;

final class BodyIdTest extends TestCase
{
    private const UUID = '9be9bce9-c802-45ad-9d49-39c6b6ed808f';

    private string $bodyId;

    /** @test */
    public function fromStringBodyId(): void
    {
        // Given
        $this->initializeValues();

        // When
        $uuid = BodyId::fromString($this->bodyId);

        // Then
        $this->assertSame($this->bodyId, $uuid->format());
    }

    private function initializeValues(): void
    {
        $this->bodyId = self::UUID;
    }
}
