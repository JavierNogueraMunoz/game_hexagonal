<?php

namespace App\Providers;

use Games\Games\Domain\Mail\Mailer;
use Games\Games\Infrastructure\Mailer\MailerService;
use Illuminate\Support\ServiceProvider;

final class MailerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            Mailer::class,
            MailerService::class
        );
    }
}
