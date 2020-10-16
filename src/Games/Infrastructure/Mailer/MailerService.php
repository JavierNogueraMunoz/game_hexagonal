<?php

namespace Games\Games\Infrastructure\Mailer;

use Games\Games\Domain\Mail\Entity\Mail;
use Games\Games\Domain\Mail\Mailer;
use Illuminate\Support\Facades\Config;
use PHPMailer\PHPMailer\PHPMailer;

class MailerService implements Mailer
{
    private PHPMailer $mail;
    private string $recipient;

    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->configurationMailer();
    }

    public function send(Mail $mail): bool
    {
        $this->buildMail($mail);
        
        return $this->mail->Send();
    }

    private function configurationMailer(): void
    {
        $config = Config::get('mail.mailers');
        $this->mail->IsSMTP();
        $this->mail->Mailer = $config['transport'];
        $this->mail->SMTPDebug  = $config['debug'];
        $this->mail->SMTPAuth   = $config['smtp_auth'];
        $this->mail->SMTPSecure = $config['secure'];
        $this->mail->Port       = $config['port'];
        $this->mail->Host       = $config['host'];
        $this->mail->Username   = $config['username'];
        $this->mail->Password   = $config['password'];
        $this->mail->SetFrom($config['address']);
        $this->mail->isHTML(true);
        $this->recipient = $config['recipient'];
    }

    private function buildMail(Mail $mail): void
    {
        $this->buildAddress($mail);
        $this->buildSubject($mail);
        $this->buildContent($mail);
    }

    private function buildAddress(Mail $mail): void
    {
        $this->mail->AddAddress($mail->getAddress()->getMailAddress(), $this->recipient);
    }

    private function buildSubject(Mail $mail): void
    {
        $this->mail->Subject = $mail->getSubject();
    }

    private function buildContent(Mail $mail): void
    {
        $content = "<b>".$mail->getBody().".</b>";
        $this->mail->MsgHTML($content);
    }
}
