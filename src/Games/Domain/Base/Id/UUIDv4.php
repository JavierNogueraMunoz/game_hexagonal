<?php

namespace Games\Games\Domain\Base\Id;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UUIDv4
{
    private UuidInterface $value;

    public static function generate(): UUIDv4
    {
        return new UUIDv4(Uuid::uuid4());
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
