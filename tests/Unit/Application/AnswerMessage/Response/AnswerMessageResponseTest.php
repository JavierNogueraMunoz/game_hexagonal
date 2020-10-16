<?php

namespace Tests\Unit\Application\AnswerMessage\Response;

use Games\Games\Application\AnswerMessage\Response\AnswerMessageResponse;
use PHPUnit\Framework\TestCase;

final class AnswerMessageResponseTest extends TestCase
{
    private const MESSAGE_DEFAULT = 'type';

    private string $message;

    /** @test */
    public function buildAnswerMessageResponseCorrectForm(): void
    {
        // Given
        $this->initializeValues();

        // When
        $response = $this->buildAnswerMessageResponse();

        // Then
        $this->assertEquals($this->message, $response->getMessage());
    }

    private function buildAnswerMessageResponse(): AnswerMessageResponse
    {
        return AnswerMessageResponse::create(
            $this->message
        );
    }

    private function initializeValues(): void
    {
        $this->message = self::MESSAGE_DEFAULT;
    }
}
