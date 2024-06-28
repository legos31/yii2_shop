<?php

namespace shop\services\auth;

use shop\entities\User;
use shop\forms\auth\PasswordResetRequestForm;
use shop\repositories\UserRepository;
use Yii;
use yii\base\InvalidArgumentException;
use yii\mail\MailerInterface;

class PasswordResetService
{

    private array $supportEmail;
    private MailerInterface $mailer;
    private UserRepository $user;

    public function __construct($supportEmail, MailerInterface $mailer, UserRepository $user)
    {
        $this->supportEmail = $supportEmail;
        $this->mailer = $mailer;
        $this->user = $user;
    }

    public function request (PasswordResetRequestForm $form): bool
    {
        $user = $this->user->findByUsernameOrEmail($form->email);

        if (!$user) {
            throw new \DomainException('User not found.');
        }

        if (!$this->user->isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$this->user->save($user)) {
                throw new \DomainException('Saving error.');
            }
        }

        $send = $this->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($form->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
        if (!$send) {
            throw new \RuntimeException('Email sanding error.');
        }

        return true;
    }

    public function validateToken ($token)
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        $user = $this->user->getByPasswordResetToken($token);
        if (!$user) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
    }

    public function reset($token, $form)
    {
        $user = $this->user->getByPasswordResetToken($token);
        if (!$user) {
            throw new \DomainException('User not found.');
        }

        $user->setPassword($form->password);
        $user->removePasswordResetToken();
        $user->generateAuthKey();

        $this->user->save($user);
    }

    public function resendVerifyEmail($form)
    {
        $user = $this->user->findByUsernameOrEmail($form->email);

        if (!$user) {
            throw new \DomainException('User not found.');
        }

        //TODO
        $user->generateEmailVerificationToken();
        $user->save();
        //end TODO

        $send = $this->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($form->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();

        if (!$send) {
            throw new \RuntimeException('Email sanding error.');
        }

        return true;
    }

    public function validateVerificationToken($token)
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Verify email token cannot be blank.');
        }
        $user = $this->user->findByVerificationToken($token);
        if (!$user) {
            throw new InvalidArgumentException('Wrong verify email token.');
        }
    }

    public function verifyEmail($token)
    {
        $user = $this->user->findByVerificationToken($token);
        $user->status = User::STATUS_ACTIVE;
        $user->verification_token = null;
        return $this->user->save($user) ? $user : null;
    }


}