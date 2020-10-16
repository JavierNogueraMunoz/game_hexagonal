<?php

namespace Games\Games\Domain\Base;

final class Pattern
{
    public static function getEmail(): string
    {
        return '/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/';
    }
}
