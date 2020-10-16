<?php

namespace Tests\Unit\Domain\Mail\Entity;

use Games\Games\Domain\Mail\Entity\Mail;
use Games\Games\Domain\Mail\ValueObject\AddressMail;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\Mail\MotherObject\AddressMailMotherObject;

final class MailTest extends TestCase
{
    private const SUBJECT = 'subject';
    private const BODY = 'body';

    private AddressMail $address;
    private string $subject, $body;

    /** @test */
    public function buildEmailDomain(): void
    {
        // Given
        $this->initializeValues();

        // When
        $email = $this->buildEmail();

        // Then
        $this->assertSame($this->address, $email->getAddress());
        $this->assertSame($this->subject, $email->getSubject());
        $this->assertSame($this->body, $email->getBody());
    }


    private function initializeValues(): void
    {
        $this->address = AddressMailMotherObject::build();
        $this->subject = self::SUBJECT;
        $this->body = self::BODY;
    }

    private function buildEmail(): Mail
    {
        return Mail::create(
            $this->address,
            $this->subject,
            $this->body
        );
    }
}
