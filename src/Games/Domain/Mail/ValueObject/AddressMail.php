<?php

namespace Games\Games\Domain\Mail\ValueObject;

use Games\Games\Domain\Base\Exceptions\AddressNotValid;
use Games\Games\Domain\Base\Pattern;

final class AddressMail
{
    private string $address;

    private function __construct(
        string $address
    ) {
        $this->setAddress($address);
    }

    /**
     * @param string $address
     * @throw AddressNotValid
     * @return void
     */
    private function setAddress(string $address): void
    {
        if(!preg_match(Pattern::getEmail(), $address)) {
            throw AddressNotValid::create();
        }

        $this->address = $address;
    }

    public static function create(
        string $address
    ) : self {
        return new static(
            $address
        );
    }

    public function getMailAddress(): string
    {
        return $this->address;
    }
}
