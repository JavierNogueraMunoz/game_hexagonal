<?php

namespace Games\Games\Domain\User;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UserId
{
    private UuidInterface $value;

    public static function fromString(string $string): UserId
    {
        return new UserId(Uuid::fromString($string));
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
