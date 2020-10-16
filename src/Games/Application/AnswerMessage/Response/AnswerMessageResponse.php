<?php

namespace Games\Games\Application\AnswerMessage\Response;

final class AnswerMessageResponse
{
    private string $message;
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public static function create(string $message): self
    {
        return new static($message);
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
