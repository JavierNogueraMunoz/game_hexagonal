<?php

namespace Tests\Unit\Domain\Message\Services;

use Games\Games\Application\AnswerMessage\Request\AnswerMessageRequest;
use Games\Games\Domain\Message\Entity\CountMessage;
use Games\Games\Domain\Message\Entity\ReverseMessage;
use Games\Games\Domain\Message\Services\BuilderMessage;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Application\AnswerMessage\MotherObject\AnswerMessageRequestMotherObject;

final class BuildMessageTest extends TestCase
{
    private const COUNT_MESSAGE = 'count_request';
    private const REVERSE_MESSAGE = 'reverse_request';
    private const COUNT_CLASS = CountMessage::class;
    private const REVERSE_CLASS = ReverseMessage::class;

    private AnswerMessageRequest $request;

    /** @test */
    public function builderConstructCountMessage(): void
    {
        // Given
        $this->initializeValues(self::COUNT_MESSAGE);

        // When
        $message = BuilderMessage::get($this->request);

        // Then
        $this->assertInstanceOf(self::COUNT_CLASS, $message);
    }

    /** @test */
    public function builderConstructReverseMessage(): void
    {
        // Given
        $this->initializeValues(self::REVERSE_MESSAGE);

        // When
        $message = BuilderMessage::get($this->request);

        // Then
        $this->assertInstanceOf(self::REVERSE_CLASS, $message);
    }

    private function initializeValues(string $type): void
    {
        $this->request = $type === self::COUNT_MESSAGE ?
            AnswerMessageRequestMotherObject::buildCountMessage() :
            AnswerMessageRequestMotherObject::buildReverseMessage();
    }
}
