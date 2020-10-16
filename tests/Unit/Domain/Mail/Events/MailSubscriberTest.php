<?php

namespace Tests\Unit\Domain\Email\Events;

use Games\Games\Domain\Mail\Events\MailSubscriber;
use Games\Games\Domain\Mail\Mailer;
use Games\Games\Domain\Message\Events\CountMessageEvent;
use Games\Games\Domain\Message\Events\ReverseMessageEvent;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\Message\MotherObject\Events\CountMessageEventMotherObject;
use Tests\Unit\Domain\Message\MotherObject\Events\ReverseMessageEventMotherObject;

final class MailSubscriberTest extends TestCase
{
    private MailSubscriber $emailSubscriber;
    private CountMessageEvent $countMessageEvent;
    private ReverseMessageEvent $reverseMessageEvent;
    private Mailer $interfaceMailer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->emailSubscriber = $this->buildEmailSubscriber();
    }

    /** @test */
    public function emailSubscriberHandle(): void
    {
        // Given
        $this->countMessageEvent = $this->getEventCountMessage();

        // Then
        $this->interfaceMailer->expects($this->once())
            ->method('send');

        // When
        $this->emailSubscriber->handle($this->countMessageEvent);
    }

    /** @test */
    public function emailSubscriberIsSubscriberToCountMessageEvent(): void
    {
        // Given
        $this->countMessageEvent = $this->getEventCountMessage();

        // When
        $response = $this->emailSubscriber->isSubscribedTo($this->countMessageEvent);

        // Then
        $this->assertTrue($response);
    }

    /** @test */
    public function emailSubscriberIsSubscriberToReverseMessageEvent(): void
    {
        // Given
        $this->reverseMessageEvent = $this->getEventReverseMessage();

        // When
        $response = $this->emailSubscriber->isSubscribedTo($this->reverseMessageEvent);

        // Then
        $this->assertTrue($response);
    }

    private function buildEmailSubscriber(): MailSubscriber
    {
        $this->interfaceMailer = $this->getMockBuilder(Mailer::class)->getMock();
        return new MailSubscriber($this->interfaceMailer);
    }

    private function getEventCountMessage(): CountMessageEvent
    {
        return CountMessageEventMotherObject::create();
    }

    private function getEventReverseMessage(): ReverseMessageEvent
    {
        return ReverseMessageEventMotherObject::create();
    }
}
