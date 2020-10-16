<?php

namespace Tests\Integration\Infrastructure\Mailer;

use Games\Games\Domain\Mail\Entity\Mail;
use Games\Games\Domain\Mail\Mailer;
use PHPMailer\PHPMailer\PHPMailer;

final class MailerServiceStub implements Mailer
{
    private PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();
    }

    public function send(Mail $mail): bool
    {
        return true;
    }
}
