<?php

namespace Games\Games\Domain\Message\Entity;

use Games\Games\Domain\Base\Entity;
use Games\Games\Domain\Message\Entity\Body;
use Games\Games\Domain\Message\ValueObjects\MessageId;
use Games\Games\Domain\User\User;

abstract class Message extends Entity
{
    private MessageId $messageId;
    private User $user;
    private Body $body;

    protected function __construct(
        MessageId $messageId,
        User $user,
        Body $body
    ) {
        $this->messageId = $messageId;
        $this->user = $user;
        $this->body   = $body;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getBody(): Body
    {
        return $this->body;
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->messageId->format(),
            'user' => $this->user->toPrimitives(),
            'body' => $this->body->toPrimitives()
        ];
    }

    public function toSave(): array
    {
        return [
            'id' => $this->messageId->format(),
            'user_id' => $this->user->getUserIdFormat(),
            'body_id' => $this->body->getBodyIdFormat()
        ];
    }
}
