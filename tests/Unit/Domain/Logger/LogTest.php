<?php

namespace Tests\Unit\Domain\Logger;

use Games\Games\Domain\Logger\Entity\Log;
use PHPUnit\Framework\TestCase;

class LogTest extends TestCase
{
    private const MESSAGE = '';
    private const CONTEXT = [];

    private string $message;
    private array $context;

    /** @test */
    public function buildLoggerDomain(): void
    {
        // Given
        $this->initializeValues();

        // When
        $logger = Log::build(
            $this->message,
            $this->context
        );

        // Then
        $this->assertSame($logger->getMessage(), $this->message);
        $this->assertSame($logger->getContext(), $this->context);
    }

    private function initializeValues(): void
    {
        $this->message = self::MESSAGE;
        $this->context = self::CONTEXT;
    }
}
