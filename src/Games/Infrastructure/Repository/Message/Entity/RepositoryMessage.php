<?php

namespace Games\Games\Infrastructure\Repository\Message\Entity;

use Games\Games\Domain\Event\DomainEventPublisher;
use Games\Games\Domain\Message\Entity\Message;
use Games\Games\Domain\Message\Repository\MessageRepository;

class RepositoryMessage implements MessageRepository
{
    public function save(Message $message): void
    {
        $messagePersistence = $this->buildMessagePersistence($message);
        $messagePersistence->save();
    }

    private function buildMessagePersistence(Message $message): MessagePersistence
    {
        return new MessagePersistence(
            $message->toSave()
        );
    }
}
