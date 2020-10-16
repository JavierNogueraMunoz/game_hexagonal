<?php

namespace Games\Games\Domain\Logger;

use Games\Games\Domain\Logger\Entity\Log;

interface LoggerService
{
    public function critical(Log $logger): void;
}
