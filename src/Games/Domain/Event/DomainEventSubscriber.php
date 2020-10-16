<?php

namespace Games\Games\Domain\Event;

use Games\Games\Domain\Event\Entity\DomainEvent;

interface DomainEventSubscriber
{
    public function handle(DomainEvent $event): void;

    public function isSubscribedTo(DomainEvent $event): bool;
}
