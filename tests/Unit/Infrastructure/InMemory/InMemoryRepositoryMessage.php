<?php

namespace Tests\Unit\Infrastructure\InMemory;

use Games\Games\Domain\Message\Entity\Message;
use Games\Games\Domain\Message\Repository\MessageRepository;

class InMemoryRepositoryMessage implements MessageRepository
{
    public function save(Message $message): void
    {
    }
}
