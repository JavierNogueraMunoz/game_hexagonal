<?php

namespace Tests\Unit\Domain\Message\Entity;

use Games\Games\Domain\Message\Entity\Body;
use Games\Games\Domain\Message\Entity\CountMessage;
use Games\Games\Domain\Message\ValueObjects\MessageId;
use Games\Games\Domain\User\User;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\Message\MotherObject\Entity\BodyMotherObject;
use Tests\Unit\Domain\Message\MotherObject\ValueObjects\MessageIdMotherObject;
use Tests\Unit\Domain\User\UserMotherObject;

final class CountMessageTest extends TestCase
{
    private const RESPONSE = 'count_response';

    private Body $body;
    private User $user;
    private MessageId $messageId;
    private array $response;

    /** @test */
    public function createCountMessage(): void
    {
        // Given
        $this->initializeValues();

        // When
        $message = $this->buildCountMessage();

        // Then
        $this->assertEquals(
            $this->response,
            $message->getResponse()
        );
    }

    /** @test */
    public function createCountMessageCreateEvents(): void
    {
        // Given
        $this->initializeValues();

        // When
        $message = $this->buildCountMessage();
        $event = $message->pullEvents();

        // Then
        $this->assertEquals($message, $event[0]->entity());
    }

    /** @test */
    public function createCountMessageAndPassToPrimitives(): void
    {
        // Given
        $this->initializeValues();
        $message = $this->buildCountMessage();

        // When
        $messageToSave = $message->toPrimitives();

        // Then
        $this->assertEquals($this->messageId->format(), $messageToSave['id']);
        $this->assertEquals($this->user->toPrimitives(), $messageToSave['user']);
        $this->assertEquals($this->body->toPrimitives(), $messageToSave['body']);
    }

    /** @test */
    public function createCountMessageAndPassToSave(): void
    {
        // Given
        $this->initializeValues();
        $message = $this->buildCountMessage();

        // When
        $messageToSave = $message->toSave();

        // Then
        $this->assertEquals($this->messageId->format(), $messageToSave['id']);
        $this->assertEquals($this->user->getUserIdFormat(), $messageToSave['user_id']);
        $this->assertEquals($this->body->getBodyIdFormat(), $messageToSave['body_id']);
    }

    private function initializeValues(): void
    {
        $this->body = BodyMotherObject::build();
        $this->messageId = MessageIdMotherObject::create();
        $this->user = UserMotherObject::build();

        $this->response = [
            self::RESPONSE => [
                'body' => $this->body->getResponseCountText()
            ]
        ];
    }

    private function buildCountMessage(): CountMessage
    {
        return CountMessage::build(
            $this->messageId,
            $this->user,
            $this->body
        );
    }
}
