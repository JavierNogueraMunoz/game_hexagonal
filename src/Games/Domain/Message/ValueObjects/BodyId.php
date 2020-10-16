<?php

namespace Games\Games\Domain\Message\ValueObjects;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class BodyId
{
    private UuidInterface $value;

    public static function fromString(string $string): BodyId
    {
        return new BodyId(Uuid::fromString($string));
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
