<?php

namespace Games\Games\Domain\User;

use Games\Games\Domain\Event\DomainEventSubscriber;
use Games\Games\Domain\Event\Entity\DomainEvent;
use Games\Games\Domain\Message\Events\CountMessageEvent;
use Games\Games\Domain\Message\Events\ReverseMessageEvent;

class UserCreatedSubscriber implements DomainEventSubscriber
{
    const EVENTS = [
        'Games\Games\Domain\Message\Events\CountMessageEvent',
        'Games\Games\Domain\Message\Events\ReverseMessageEvent'
    ];

    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * @param CountMessageEvent|ReverseMessageEvent $event
     * @return void
     */
    public function handle($event): void
    {
        $this->userRepository->save($event->entity()->getUser());
    }

    public function isSubscribedTo(DomainEvent $aDomainEvent): bool
    {
        return in_array($aDomainEvent->eventName(),self::EVENTS);
    }
}
