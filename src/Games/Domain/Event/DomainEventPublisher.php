<?php

namespace Games\Games\Domain\Event;

use Games\Games\Domain\Event\Entity\DomainEvent;

interface DomainEventPublisher
{
    public function publish(DomainEvent ...$events): void;
}
