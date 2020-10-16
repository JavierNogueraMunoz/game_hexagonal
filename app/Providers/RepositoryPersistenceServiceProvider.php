<?php

namespace App\Providers;

use Games\Games\Domain\Event\Repository\EventStoreRepository;
use Games\Games\Domain\Message\Repository\BodyRepository;
use Games\Games\Domain\Message\Repository\MessageRepository;
use Games\Games\Domain\User\UserRepository;
use Games\Games\Infrastructure\Repository\Event\RepositoryEventStore;
use Games\Games\Infrastructure\Repository\Message\Entity\RepositoryMessage;
use Games\Games\Infrastructure\Repository\Message\ValueObjects\RepositoryBody;
use Games\Games\Infrastructure\Repository\User\RepositoryUser;
use Illuminate\Support\ServiceProvider;

class RepositoryPersistenceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            EventStoreRepository::class,
            RepositoryEventStore::class
        );

        $this->app->bind(
            MessageRepository::class,
            RepositoryMessage::class
        );

        $this->app->bind(
            BodyRepository::class,
            RepositoryBody::class
        );

        $this->app->bind(
            UserRepository::class,
            RepositoryUser::class
        );
    }
}
