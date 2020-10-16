<?php

namespace Games\Games\Domain\Mail;

use Games\Games\Domain\Mail\Entity\Mail;

interface Mailer
{
    public function send(Mail $mail): bool;
}
