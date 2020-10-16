<?php

namespace Tests\Unit\Infrastructure\Stub\Logger;

use Games\Games\Domain\Logger\Entity\Log;
use Games\Games\Domain\Logger\LoggerService;
use Monolog\Logger;

class MonologgerStub  implements LoggerService
{
    private Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger('name');
    }

    public function critical(Log $logger): void
    {
    }
}
