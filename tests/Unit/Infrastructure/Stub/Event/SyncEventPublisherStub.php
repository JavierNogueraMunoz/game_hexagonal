<?php

namespace Tests\Unit\Infrastructure\Stub\Event;

use Games\Games\Domain\Event\DomainEventPublisher;
use Games\Games\Domain\Event\Entity\DomainEvent;

class SyncEventPublisherStub implements  DomainEventPublisher
{
    public function publish(DomainEvent ...$domainEvents): void
    {
    }
}
