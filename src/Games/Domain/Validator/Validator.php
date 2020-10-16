<?php

namespace Games\Games\Domain\Validator;

interface Validator
{
    public function xml(string $xml, string $type): bool;
}
