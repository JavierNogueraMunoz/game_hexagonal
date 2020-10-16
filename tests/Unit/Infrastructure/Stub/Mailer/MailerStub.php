<?php

namespace Tests\Unit\Infrastructure\Stub\Mailer;

use Games\Games\Domain\Mail\Entity\Mail;
use Games\Games\Domain\Mail\Mailer;

final class MailerStub implements Mailer
{
    public function send(Mail $mail): bool
    {
        return true;
    }
}
