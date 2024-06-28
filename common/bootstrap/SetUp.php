<?php

namespace common\bootstrap;

use shop\services\auth\PasswordResetService;
use shop\services\contact\ContactService;
use Yii;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Yii::$container->setSingleton(MailerInterface::class, function () use ($app){
            return $app->mailer;
        });

        Yii::$container->setSingleton(PasswordResetService::class, [], [
            [$app->params['supportEmail'] => $app->name . ' robot'],
            //$app->mailer,
        ]);

        Yii::$container->setSingleton(ContactService::class, [], [
            $app->params['supportEmail'],
            $app->params['adminEmail'],
        ]);
    }
}