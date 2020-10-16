<?php

namespace Tests\Unit\Domain\User;

use Games\Games\Domain\Mail\ValueObject\AddressMail;
use Games\Games\Domain\User\User;
use Games\Games\Domain\User\UserId;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    private const USER_ID = '9be9bce9-c802-45ad-9d49-39c6b6ed808f';
    private const MAIL = 'jnoguera@gmail.com';
    private const NAME = 'Name';
    private const SURNAME = 'Surname';

    private UserId $userId;
    private AddressMail $mail;
    private string $name, $surname;

    /** @test */
    public function buildUserWithValuesAndPassToPrimitives(): void
    {
        // Given
        $this->initializeValues();
        $user = $this->buildUser();

        // When
        $userPrimitives = $user->toPrimitives();

        // Then
        $this->assertSame($this->userId->format(), $userPrimitives['userId']);
        $this->assertSame($this->mail->getMailAddress(), $userPrimitives['mail']);
        $this->assertSame($this->name, $userPrimitives['name']);
        $this->assertSame($this->surname, $userPrimitives['surname']);
    }

    /** @test */
    public function buildUserWithValuesAndPassToSave(): void
    {
        // Given
        $this->initializeValues();
        $user = $this->buildUser();

        // When
        $userPrimitives = $user->toSave();

        // Then
        $this->assertSame($this->userId->format(), $userPrimitives['id']);
        $this->assertSame($this->mail->getMailAddress(), $userPrimitives['address']);
        $this->assertSame($this->name, $userPrimitives['name']);
        $this->assertSame($this->surname, $userPrimitives['surname']);
    }

    private function initializeValues(): void
    {
        $this->userId = $this->buildUserId();
        $this->mail = $this->buildMail();
        $this->name = self::NAME;
        $this->surname = self::SURNAME;
    }

    private function buildUserId(): UserId
    {
        return UserId::fromString(self::USER_ID);
    }

    private function buildMail(): AddressMail
    {
        return AddressMail::create(self::MAIL);
    }

    private function buildUser(): User
    {
        return User::create(
            $this->userId,
            $this->mail,
            $this->name,
            $this->surname
        );
    }
}
