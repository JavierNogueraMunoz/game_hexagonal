<?php

namespace App\Providers;

use Games\Games\Domain\Validator\Validator;
use Games\Games\Infrastructure\Validator\ValidatorService;
use Illuminate\Support\ServiceProvider;

final class ValidatorXMLServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            Validator::class,
            ValidatorService::class
        );
    }
}
