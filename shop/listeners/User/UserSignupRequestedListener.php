<?php

namespace shop\listeners\User;


use shop\events\UserSignUpRequest;
use yii\mail\MailerInterface;

class UserSignupRequestedListener
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(UserSignUpRequest $event): void
    {
        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                ['user' => $event->user]
            )
            ->setTo($event->user->email)
            ->setSubject('Signup confirm')
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Email sending error.');
        }
    }
}