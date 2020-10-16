<?php

namespace Tests\Unit\Application\AnswerMessage\Request;

use Games\Games\Application\AnswerMessage\Request\AnswerMessageRequest;
use PHPUnit\Framework\TestCase;

final class AnswerMessageRequestTest extends TestCase
{
    private const UUID = 'c7b2bea6-a460-4804-a869-140c6abb4214';
    private const USER_DEFAULT = [];
    private const BODY_DEFAULT = [];
    private const TYPE_DEFAULT = 'type';

    private string $uuid;
    private array $user;
    private array $body;
    private string $type;

    /** @test */
    public function buildAnswerMessageRequestCorrectForm(): void
    {
        // Given
        $this->initializeValues();

        // When
        $response = $this->buildAnswerMessageRequest();

        // Then
        $this->assertEquals($this->uuid, $response->getUuid());
        $this->assertEquals($this->body, $response->getBody());
        $this->assertEquals($this->type, $response->getType());
    }

    private function buildAnswerMessageRequest(): AnswerMessageRequest
    {
        return AnswerMessageRequest::create(
            $this->uuid,
            $this->user,
            $this->body,
            $this->type
        );
    }

    private function initializeValues(): void
    {
        $this->uuid = self::UUID;
        $this->user = self::USER_DEFAULT;
        $this->body = self::BODY_DEFAULT;
        $this->type = self::TYPE_DEFAULT;
    }
}
