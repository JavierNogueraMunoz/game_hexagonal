<?php

namespace Tests\Unit\Domain\Message\Entity;

use Games\Games\Domain\Message\Entity\Body;
use Games\Games\Domain\Message\Entity\ReverseMessage;
use Games\Games\Domain\Message\ValueObjects\MessageId;
use Games\Games\Domain\User\User;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\Message\MotherObject\Entity\BodyMotherObject;
use Tests\Unit\Domain\Message\MotherObject\ValueObjects\MessageIdMotherObject;
use Tests\Unit\Domain\User\UserMotherObject;

final class ReverseMessageTest extends TestCase
{
    private const RESPONSE = 'reverse_response';

    private User $user;
    private Body $body;
    private MessageId $messageId;
    private array $response;

    /** @test */
    public function createReverseMessage(): void
    {
        // Given
        $this->initializeValues();

        // When
        $message = $this->buildReverseMessage();

        // Then
        $this->assertEquals(
            $this->response,
            $message->getResponse()
        );
    }

    /** @test */
    public function createReverseMessageCreateEvents(): void
    {
        // Given
        $this->initializeValues();

        // When
        $message = $this->buildReverseMessage();
        $event = $message->pullEvents();

        // Then
        $this->assertEquals($message, $event[0]->entity());
    }

    /** @test */
    public function createCountMessageAndPassToPrimitives(): void
    {
        // Given
        $this->initializeValues();
        $message = $this->buildReverseMessage();

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
        $message = $this->buildReverseMessage();

        // When
        $messageToSave = $message->toSave();

        // Then
        $this->assertEquals($this->messageId->format(), $messageToSave['id']);
        $this->assertEquals($this->user->getUserIdFormat(), $messageToSave['user_id']);
        $this->assertEquals($this->body->getBodyIdFormat(), $messageToSave['body_id']);
    }

    private function initializeValues(): void
    {
        $this->user = UserMotherObject::build();
        $this->body = BodyMotherObject::build();
        $this->messageId = MessageIdMotherObject::create();

        $this->response = [
            self::RESPONSE => [
                'body' => $this->body->getResponseReverseText()
            ]
        ];
    }

    private function buildReverseMessage(): ReverseMessage
    {
        return ReverseMessage::build(
            $this->messageId,
            $this->user,
            $this->body
        );
    }
}
