<?php

namespace Games\Games\Domain\Message\Events;

use Games\Games\Domain\Event\DomainEventSubscriber;
use Games\Games\Domain\Event\Entity\DomainEvent;
use Games\Games\Domain\Message\Repository\BodyRepository;

class BodyCreatedSubscriber implements DomainEventSubscriber
{
    const EVENTS = [
        'Games\Games\Domain\Message\Events\CountMessageEvent',
        'Games\Games\Domain\Message\Events\ReverseMessageEvent'
    ];

    private BodyRepository $bodyRepository;

    public function __construct(
        BodyRepository $bodyRepository
    ) {
        $this->bodyRepository = $bodyRepository;
    }

    /**
     * @param CountMessageEvent|ReverseMessageEvent $event
     * @return void
     */
    public function handle($event): void
    {
        $this->bodyRepository->save($event->entity()->getBody());
    }

    public function isSubscribedTo(DomainEvent $aDomainEvent): bool
    {
        return in_array($aDomainEvent->eventName(),self::EVENTS);
    }
}
