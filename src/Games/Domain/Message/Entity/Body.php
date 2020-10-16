<?php

namespace Games\Games\Domain\Message\Entity;

use Games\Games\Domain\Mail\ValueObject\AddressMail;
use Games\Games\Domain\Message\ValueObjects\BodyId;

final class Body
{
    private BodyId $bodyId;
    private AddressMail $address;
    private string $subject, $content;

    private function __construct(
        BodyId $bodyId,
        AddressMail $address,
        string $subject,
        string $content
    ) {
        $this->bodyId = $bodyId;
        $this->address = $address;
        $this->subject = $subject;
        $this->content = $content;
    }

    public static function create(
        BodyId $bodyId,
        AddressMail $address,
        string $subject,
        string $content
    ): self
    {
        return new static($bodyId, $address, $subject, $content);
    }

    public function getResponseCountText(): array
    {
        return [
            'address' => $this->address->getMailAddress(),
            'subject' => $this->subject,
            'content' => $this->getCountText()
        ];
    }

    public function getResponseReverseText(): array
    {
        return [
            'address' => $this->address->getMailAddress(),
            'subject' => $this->subject,
            'content' => $this->getReverseText()
        ];
    }


    public function getReverseText(): string
    {
        return strrev($this->content);
    }

    public function getCountText(): int
    {
        return strlen($this->content);
    }

    public function getBodyIdFormat(): string
    {
        return $this->bodyId->format();
    }

    public function getAddress(): AddressMail
    {
        return $this->address;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function toPrimitives(): array
    {
        return [
            'address' => $this->address->getMailAddress(),
            'subject' => $this->subject,
            'content' => $this->content
        ];
    }

    public function toSave(): array
    {
        return [
            'id' => $this->bodyId->format(),
            'address' => $this->address->getMailAddress(),
            'subject' => $this->subject,
            'content' => $this->content
        ];
    }
}
