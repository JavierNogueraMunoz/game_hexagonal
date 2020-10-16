<?php

namespace Tests\Unit\Infrastructure\Stub\Validator;

use Games\Games\Domain\Validator\Validator;

class ValidatorStub implements Validator
{
    public function xml(string $xml, string $type): bool
    {
       return true;
    }
}
