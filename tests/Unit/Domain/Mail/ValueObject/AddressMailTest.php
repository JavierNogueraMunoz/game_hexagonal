<?php

namespace Tests\Unit\Domain\Mail\ValueObject;

use Games\Games\Domain\Base\Exceptions\AddressNotValid;
use Games\Games\Domain\Mail\ValueObject\AddressMail;
use PHPUnit\Framework\TestCase;

final class AddressMailTest extends TestCase
{
    private const ADDRESS_VALID = 'jnoguera@gmail.com';
    private const ADDRESS_INVALID = 'jnogueragmail.com';

    private string $address;

    /** @test */
    public function buildAddressMaillValid(): void
    {
        // Given
        $this->initializeValues(self::ADDRESS_VALID);

        // When
        $address = AddressMail::create($this->address);

        // Then
        $this->assertSame($this->address, $address->getMailAddress());
    }

    /** @test */
    public function buildAddressMaillThrowAddressNotValid(): void
    {
        // Given
        $this->initializeValues(self::ADDRESS_INVALID);

        // Then
        $this->expectException(AddressNotValid::class);

        // When
        AddressMail::create($this->address);
    }

    private function initializeValues(string $address): void
    {
        $this->address = $address;
    }
}
