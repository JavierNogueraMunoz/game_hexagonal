<?php

namespace Tests\Unit\Domain\Message\Entity;

use Games\Games\Domain\Mail\ValueObject\AddressMail;
use Games\Games\Domain\Message\Entity\Body;
use Games\Games\Domain\Message\ValueObjects\BodyId;
use PHPUnit\Framework\TestCase;

final class BodyTest extends TestCase
{
    private const UUID = '9be9bce9-c802-45ad-9d49-39c6b6ed808f';
    private const ADDRESS = 'jnoguera@gmail.com';
    private const SUBJECT = 'subject';
    private const CONTENT = 'content';
    private const CONTENT_COUNT = 7;
    private const CONTENT_REVERSE = 'tnetnoc';

    private BodyId $bodyId;
    private AddressMail $address;
    private string $subject, $content;

    /** @test */
    public function buildBodyWithCorrectValues(): void
    {
        // Given
        $this->initializeValues();

        // When
        $body = $this->buildBody();

        // Then
        $this->assertEquals($this->bodyId->format(), $body->getBodyIdFormat());
        $this->assertEquals($this->address, $body->getAddress());
        $this->assertEquals($this->subject, $body->getSubject());
        $this->assertEquals($this->content, $body->getContent());
    }

    /** @test */
    public function getCountTextOfBody(): void
    {
        // Given
        $this->initializeValues();

        // When
        $body = $this->buildBody();

        // Then
        $this->assertEquals(self::CONTENT_COUNT, $body->getCountText());
    }

    /** @test */
    public function getReverseTextOfBody(): void
    {
        // Given
        $this->initializeValues();

        // When
        $body = $this->buildBody();

        // Then
        $this->assertEquals(self::CONTENT_REVERSE, $body->getReverseText());
    }

    /** @test */
    public function getResponseReverseTextOfBody(): void
    {
        // Given
        $this->initializeValues();

        // When
        $response = ($this->buildBody())->getResponseReverseText();

        // Then
        $this->assertEquals($this->address->getMailAddress(), $response['address']);
        $this->assertEquals($this->subject, $response['subject']);
        $this->assertEquals(self::CONTENT_REVERSE, $response['content']);
    }

    /** @test */
    public function getResponseCountTextOfBody(): void
    {
        // Given
        $this->initializeValues();

        // When
        $response = ($this->buildBody())->getResponseCountText();

        // Then
        $this->assertEquals($this->address->getMailAddress(), $response['address']);
        $this->assertEquals($this->subject, $response['subject']);
        $this->assertEquals(self::CONTENT_COUNT, $response['content']);
    }

    /** @test */
    public function buildBodyWithValuesAndPassToPrimitives(): void
    {
        // Given
        $this->initializeValues();
        $body = $this->buildBody();

        // When
        $bodyPrimitives = $body->toPrimitives();

        // Then
        $this->assertSame($this->address->getMailAddress(), $bodyPrimitives['address']);
        $this->assertSame($this->subject, $bodyPrimitives['subject']);
        $this->assertSame($this->content, $bodyPrimitives['content']);
    }

    /** @test */
    public function buildBodyWithValuesAndPassToSave(): void
    {
        // Given
        $this->initializeValues();
        $body = $this->buildBody();

        // When
        $bodyPrimitives = $body->toSave();

        // Then
        $this->assertSame($this->bodyId->format(), $bodyPrimitives['id']);
        $this->assertSame($this->address->getMailAddress(), $bodyPrimitives['address']);
        $this->assertSame($this->subject, $bodyPrimitives['subject']);
        $this->assertSame($this->content, $bodyPrimitives['content']);
    }

    private function initializeValues(): void
    {
        $this->bodyId = BodyId::fromString(self::UUID);
        $this->address = AddressMail::create(self::ADDRESS);
        $this->subject = self::SUBJECT;
        $this->content = self::CONTENT;
    }

    private function buildBody(): Body
    {
        return Body::create(
            $this->bodyId,
            $this->address,
            $this->subject,
            $this->content
        );
    }
}
