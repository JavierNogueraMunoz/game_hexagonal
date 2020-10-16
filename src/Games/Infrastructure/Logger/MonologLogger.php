<?php

namespace Games\Games\Infrastructure\Logger;

use Games\Games\Domain\Logger\Entity\Log;
use Games\Games\Domain\Logger\LoggerService;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

final class MonologLogger implements LoggerService
{
    const CRITICAL = '../logs/critical.log';

    private Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger('name');
    }

    public function critical(Log $logger): void
    {
        $this->logger->pushHandler(new StreamHandler(self::CRITICAL, Logger::CRITICAL));
        $this->logger->critical($logger->getMessage(), $logger->getContext());
    }
}
