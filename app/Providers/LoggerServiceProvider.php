<?php

namespace App\Providers;

use Games\Games\Domain\Logger\LoggerService;
use Games\Games\Infrastructure\Logger\MonologLogger;
use Illuminate\Support\ServiceProvider;

final class LoggerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            LoggerService::class,
            MonologLogger::class
        );
    }
}
