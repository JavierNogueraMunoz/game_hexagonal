<?php

namespace Tests\Unit\Domain\Base\Exceptions;

use Games\Games\Domain\Base\Exceptions\AddressNotValid;
use PHPUnit\Framework\TestCase;

final class AddressNotValidTest extends TestCase
{
    private const MESSAGE = 'MessageDoctrine';
    private const CODE = 500;
    private const MESSAGE_DEFAULT = 'Address not valid.';
    private const CODE_DEFAULT = 400;

    private AddressNotValid $exception;

    /** @test */
    public function buildExceptionWithDefaultValues(): void
    {
        // When
        $this->exception = AddressNotValid::create();

        // Then
        $this->assertEquals(self::MESSAGE_DEFAULT, $this->exception->getMessage());
        $this->assertEquals(self::CODE_DEFAULT, $this->exception->getCode());
    }

    /** @test */
    public function buildExceptionWithValues(): void
    {
        // When
        $this->exception = AddressNotValid::create(self::MESSAGE, self::CODE);

        // Then
        $this->assertEquals(self::MESSAGE, $this->exception->getMessage());
        $this->assertEquals(self::CODE, $this->exception->getCode());
    }
}
