<?php

namespace Tests\Unit\Infrastructure\InMemory;

use Games\Games\Domain\Event\EventStoreRepository;

class InMemoryRepositoryEvent implements EventStoreRepository
{
    public function save($event): void
    {
    }
}
