<?php

namespace Tests\Unit\Domain\User;

use Games\Games\Domain\User\UserId;
use PHPUnit\Framework\TestCase;

final class UserIdTest extends TestCase
{
    private const UUID = '9be9bce9-c802-45ad-9d49-39c6b6ed808f';

    private string $userId;

    /** @test */
    public function fromStringUserId(): void
    {
        // Given
        $this->initializeValues();

        // When
        $uuid = UserId::fromString($this->userId);

        // Then
        $this->assertSame($this->userId, $uuid->format());
    }

    private function initializeValues(): void
    {
        $this->userId = self::UUID;
    }
}
