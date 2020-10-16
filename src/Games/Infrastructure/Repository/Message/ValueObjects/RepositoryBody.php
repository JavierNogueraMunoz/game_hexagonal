<?php

namespace Games\Games\Infrastructure\Repository\Message\ValueObjects;

use Games\Games\Domain\Message\Entity\Body;
use Games\Games\Domain\Message\Repository\BodyRepository;

final class RepositoryBody implements BodyRepository
{
    public function save(Body $body): void
    {
        $bodyPersistence = $this->buildBodyPersistence($body);
        $bodyPersistence->save();
    }

    private function buildBodyPersistence(Body $body): BodyPersistence
    {
        return new BodyPersistence(
            $body->toSave()
        );
    }
}
