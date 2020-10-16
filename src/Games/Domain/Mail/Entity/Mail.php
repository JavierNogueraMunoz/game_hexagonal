<?php

namespace Games\Games\Domain\Mail\Entity;

use Games\Games\Domain\Mail\ValueObject\AddressMail;

final class Mail
{
    private AddressMail $address;
    private string $subject, $body;

    private function __construct(
        AddressMail $address,
        string $subject,
        string $body
    ) {
        $this->address = $address;
        $this->subject = $subject;
        $this->body = $body;
    }

    public static function create(
        AddressMail $address,
        string $subject,
        string $body
    ) : self {
        return new static(
            $address,
            $subject,
            $body
        );
    }

    public function getAddress(): AddressMail
    {
        return $this->address;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
