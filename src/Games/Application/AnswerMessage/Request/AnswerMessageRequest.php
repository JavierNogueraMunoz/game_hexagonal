<?php

namespace Games\Games\Application\AnswerMessage\Request;

final class AnswerMessageRequest
{
    private array $user, $body;
    private string $uuid, $type;

    private function __construct(
        string $uuid,
        array $user,
        array $body,
        string $type
    ) {
        $this->uuid = $uuid;
        $this->user = $user;
        $this->body = $body;
        $this->type = $type;
    }

    public static function create(
        string $uuid,
        array $user,
        array $body,
        string $type
    ): self {
        return new static(
            $uuid,
            $user,
            $body,
            $type
        );
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getUser(): array
    {
        return $this->user;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
