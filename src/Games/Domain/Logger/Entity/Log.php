<?php

namespace Games\Games\Domain\Logger\Entity;

final class Log
{
    private string $message;
    private array $context;

    private function __construct(
        string $message,
        array $context
    ) {
        $this->message = $message;
        $this->context = $context;
    }

    public static function build(
        string $message,
        array $context
    ): self {
        return new static($message, $context);
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
