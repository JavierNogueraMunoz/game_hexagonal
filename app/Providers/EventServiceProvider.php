<?php

namespace App\Providers;

use Games\Games\Domain\Event\DomainEventPublisher;
use Games\Games\Domain\Event\Repository\EventStoreRepository;
use Games\Games\Domain\Mail\Events\MailSubscriber;
use Games\Games\Domain\Message\Events\BodyCreatedSubscriber;
use Games\Games\Domain\User\UserCreatedSubscriber;
use Games\Games\Infrastructure\Domain\Event\SyncEventPublisher;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /** @var array */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }

    public function register()
    {
        $this->app->bind(
            DomainEventPublisher::class,
            function () {
                return new SyncEventPublisher(
                    resolve(EventStoreRepository::class),
                    resolve(MailSubscriber::class),
                    resolve(UserCreatedSubscriber::class),
                    resolve(BodyCreatedSubscriber::class)
                );
            }
        );
    }
}
