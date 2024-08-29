<?php

namespace common\bootstrap;

use shop\cart\Cart;
use shop\cart\cost\calculator\DynamicCost;
use shop\cart\cost\calculator\SimpleCost;
use shop\cart\storage\HybridStorage;
use shop\services\auth\PasswordResetService;
use shop\services\contact\ContactService;
use shop\services\sms\LoggedSender;
use shop\services\sms\SmsRu;
use shop\services\sms\SmsSender;
use Yii;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use yii\caching\Cache;
use yii\rbac\ManagerInterface;

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

        Yii::$container->setSingleton(Client::class, function () {
            return ClientBuilder::create()->setHosts([
                'http://localhost:9200'
            ])->build();
        });

        Yii::$container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });

        Yii::$container->setSingleton(Cart::class, function () use ($app) {
            return new Cart(
                new HybridStorage($app->get('user'), 'cart', 3600 * 24, $app->db),
                new DynamicCost(new SimpleCost())
            );
        });

        Yii::$container->setSingleton(ManagerInterface::class, function () use ($app) {
            return $app->authManager;
        });

        Yii::$container->setSingleton(SmsSender::class, function () use ($app) {
            return new LoggedSender(
                new SmsRu($app->params['smsRuKey']),
                \Yii::getLogger()
            );
        });
    }
}