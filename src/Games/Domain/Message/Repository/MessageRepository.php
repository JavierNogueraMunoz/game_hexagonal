<?php

namespace Games\Games\Domain\Message\Repository;

use Games\Games\Domain\Message\Entity\Message;

interface MessageRepository
{
    public function save(Message $message): void;
}
