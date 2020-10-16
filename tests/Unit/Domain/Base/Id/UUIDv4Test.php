<?php

namespace Tests\Unit\Domain\Base\Id;

use Games\Games\Domain\Base\Id\UUIDv4;
use PHPUnit\Framework\TestCase;

final class UUIDv4Test extends TestCase
{
    private const UUID = 'c4100d07-5f06-4265-80b3-c163b4c22905';

    /** @test */
    public function generateRandomUuid(): void
    {
       // When
        $uuid = UUIDv4::generate();

        // Then
        $this->assertInstanceOf(UUIDv4::class, $uuid);
    }
}
