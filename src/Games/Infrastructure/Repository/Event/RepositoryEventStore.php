<?php

namespace Games\Games\Infrastructure\Repository\Event;

use Games\Games\Domain\Event\Entity\DomainEvent;
use Games\Games\Domain\Event\Repository\EventStoreRepository;

final class RepositoryEventStore implements EventStoreRepository
{
    public function save(DomainEvent $event): void
    {
        $eventPersistence = $this->buildEventPersistence($event);
        $eventPersistence->save();
    }

    private function buildEventPersistence(DomainEvent $event): EventPersistence
    {
        return new EventPersistence($event->toSave());
    }
}
