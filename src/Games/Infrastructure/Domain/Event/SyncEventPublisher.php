<?php

namespace Games\Games\Infrastructure\Domain\Event;

use Games\Games\Domain\Event\DomainEventPublisher;
use Games\Games\Domain\Event\DomainEventSubscriber;
use Games\Games\Domain\Event\Entity\DomainEvent;
use Games\Games\Domain\Event\Repository\EventStoreRepository;

final class SyncEventPublisher implements DomainEventPublisher
{
    /** @var DomainEventSubscriber[] */
    private $subscribers;
    private EventStoreRepository $eventStoreRepository;

    /**
     * SyncEventPublisher constructor.
     * @param EventStoreRepository $eventStoreRepository
     * @param DomainEventSubscriber[] ...$subscriber
     */
    public function __construct(
        $eventStoreRepository,
        ...$subscriber
    ) {
        $this->subscribers = $subscriber;
        $this->eventStoreRepository = $eventStoreRepository;
    }

    public function publish(DomainEvent ...$domainEvents): void
    {
        foreach ($domainEvents as $domainEvent) {
            $this->eventStoreRepository->save($domainEvent);
            foreach ($this->subscribers as $aSubscriber) {
                if ($aSubscriber->isSubscribedTo($domainEvent)) {
                    $aSubscriber->handle($domainEvent);
                }
            }
        }
    }
}
