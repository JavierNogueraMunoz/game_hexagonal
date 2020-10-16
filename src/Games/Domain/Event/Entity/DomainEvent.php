<?php

namespace Games\Games\Domain\Event\Entity;

interface DomainEvent
{
    public function eventName(): string;

    public function entity();

    public function toSave(): array;
}
