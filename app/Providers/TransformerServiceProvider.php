<?php

namespace App\Providers;

use Games\Games\Domain\Transformer\TransformerArrayToXML;
use Games\Games\Domain\Transformer\TransformerXMLToString;
use Games\Games\Infrastructure\Transformer\TransformerArrayToXMLService;
use Games\Games\Infrastructure\Transformer\TransformerXMLToStringService;
use Illuminate\Support\ServiceProvider;

final class TransformerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            TransformerArrayToXML::class,
            TransformerArrayToXMLService::class
        );

        $this->app->bind(
            TransformerXMLToString::class,
            TransformerXMLToStringService::class
        );
    }
}
