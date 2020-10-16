<?php

namespace Games\Games\Domain\Event\Entity;

use DateTimeImmutable;
use Games\Games\Domain\Base\Id\UUIDv4;

abstract class Event implements DomainEvent
{
    const FORMAT = 'Y-m-d H:m:s';

    /** @var UUIDv4 */
    protected $id;
    protected $entity;
    /** @var DateTimeImmutable */
    protected $occurredOn;

    public function __construct(
        UUIDv4 $eventId,
        $event
    ) {
        $this->id = $eventId;
        $this->entity = $event;
        $this->occurredOn = new DateTimeImmutable();
    }

    public function toSave(): array
    {
        return [
            'id' => $this->id->format(),
            'entity' => json_encode($this->entity->toPrimitives()),
            'occurredOn' => $this->occurredOn->format(self::FORMAT)
        ];
    }

    public function entity()
    {
        return $this->entity;
    }
}
