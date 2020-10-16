<?php

namespace Games\Games\Domain\Event\Repository;

use Games\Games\Domain\Event\Entity\DomainEvent;

interface EventStoreRepository
{
    public function save(DomainEvent $event): void;
}
