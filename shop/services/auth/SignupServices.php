<?php

namespace shop\services\auth;

use shop\entities\User;
use shop\forms\auth\SignupForm;
use Yii;

class SignupServices
{
    public function signup(SignupForm $form): User
    {

        $user = User::create($form->username, $form->email, $form->password);

        $this->save($user);
        if (!$this->sendEmail($user, $form))
        {
            throw new \RuntimeException('Mail delivery error.');
        }
        return $user;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user, $form)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($form->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    public function save($user)
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving user error.');
        }
    }

}