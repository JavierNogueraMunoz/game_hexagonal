<?php

namespace Games\Games\Domain\Message\Repository;

use Games\Games\Domain\Message\Entity\Body;

interface BodyRepository
{
    public function save(Body $body): void;
}
