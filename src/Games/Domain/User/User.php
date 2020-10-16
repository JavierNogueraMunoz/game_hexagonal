<?php

namespace Games\Games\Domain\User;

use Games\Games\Domain\Mail\ValueObject\AddressMail;

final class User
{
    private UserId $userId;
    private AddressMail $mail;
    private string $name, $surname;

    private function __construct(
        UserId $userId,
        AddressMail $mail,
        string $name,
        string $surname
    ) {
        $this->userId = $userId;
        $this->mail = $mail;
        $this->name = $name;
        $this->surname = $surname;
    }

    public static function create(
        UserId $userId,
        AddressMail $mail,
        string $name,
        string $surname
    ): self {
        return new static(
            $userId,
            $mail,
            $name,
            $surname
        );
    }

    public function getUserIdFormat(): string
    {
        return $this->userId->format();
    }

    public function toPrimitives(): array
    {
        return [
            'userId' => $this->userId->format(),
            'mail' => $this->mail->getMailAddress(),
            'name' => $this->name,
            'surname' => $this->surname
        ];
    }

    public function toSave(): array
    {
        return [
            'id' => $this->userId->format(),
            'address' => $this->mail->getMailAddress(),
            'name' => $this->name,
            'surname' => $this->surname
        ];
    }
}
