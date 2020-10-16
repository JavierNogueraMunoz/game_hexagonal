<?php

namespace Games\Games\Domain\Base;

use Games\Games\Domain\Event\Entity\DomainEvent;

abstract class Entity
{
    /** @var DomainEvent[] */
    private $events = [];

    public function pullEvents(): array
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }

    protected function recordThat(DomainEvent $event): void
    {
        $this->events[] = $event;
    }
}
