<?php

namespace frontend\services\contact;

use shop\forms\ContactForm;
use yii\mail\MailerInterface;

class ContactService
{
    private string $supportEmail;
    private MailerInterface $mailer;
    private string $adminEmail;

    public function __construct(string $supportEmail, string $adminEmail, MailerInterface $mailer)
    {
        $this->supportEmail = $supportEmail;
        $this->mailer = $mailer;
        $this->adminEmail = $adminEmail;
    }

    public function sendEmail(ContactForm $form)
    {
        $send = $this->mailer->compose()
            ->setTo($this->adminEmail)
            ->setFrom($this->supportEmail)
            ->setReplyTo([$form->email => $form->name])
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();
        if (!$send) {
            throw new \RuntimeException('Email sanding error.');
        }

        return true;
    }

}