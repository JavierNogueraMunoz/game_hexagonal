<?php

namespace Games\Games\Domain\Mail\Events;

use Games\Games\Domain\Mail\Entity\Mail;
use Games\Games\Domain\Mail\Mailer;
use Games\Games\Domain\Event\DomainEventSubscriber;
use Games\Games\Domain\Event\Entity\DomainEvent;
use Games\Games\Domain\Message\Events\CountMessageEvent;
use Games\Games\Domain\Message\Events\ReverseMessageEvent;
use Games\Games\Domain\Message\Entity\Body;

class MailSubscriber implements DomainEventSubscriber
{
    const EVENTS = [
        'Games\Games\Domain\Message\Events\CountMessageEvent',
        'Games\Games\Domain\Message\Events\ReverseMessageEvent'
    ];

    private Mailer $interfaceMailer;

    public function __construct(
        Mailer $interfaceMailer
    ) {
        $this->interfaceMailer = $interfaceMailer;
    }

    /**
     * @param CountMessageEvent|ReverseMessageEvent $event
     * @return void
     */
    public function handle($event): void
    {
        $mail = $this->buildEmail($event->entity()->getBody());
        $this->interfaceMailer->send($mail);
    }

    public function isSubscribedTo(DomainEvent $aDomainEvent): bool
    {
        return in_array($aDomainEvent->eventName(),self::EVENTS);
    }

    private function buildEmail(Body $body): Mail
    {
        return Mail::create(
            $body->getAddress(),
            $body->getSubject(),
            $body->getContent()
        );
    }

}
