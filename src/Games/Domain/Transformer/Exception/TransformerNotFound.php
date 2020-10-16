<?php

namespace Games\Games\Domain\Transformer\Exception;

use Exception;
use Throwable;

final class TransformerNotFound extends Exception
{
    private const MESSAGE = 'Transformer not found';
    private const CODE = 400;

    private function __construct(string $message, int $code, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function create(string $message = self::MESSAGE, int $code = self::CODE): self
    {
        return new static($message, $code);
    }
}
