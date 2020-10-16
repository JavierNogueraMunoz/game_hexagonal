<?php

namespace Games\Games\Domain\Message\ValueObjects;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class MessageId
{
    /** @var UuidInterface */
    private $value;

    public static function fromString(string $string): MessageId
    {
        return new MessageId(Uuid::fromString($string));
    }

    private function __construct(UuidInterface $value)
    {
        $this->value = $value;
    }

    public function format(): string
    {
        return $this->value->toString();
    }
}
