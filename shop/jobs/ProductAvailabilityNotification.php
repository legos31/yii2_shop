<?php

namespace shop\jobs;

use shop\entities\shop\Product\Product;
use shop\entities\User;
use shop\repositories\UserRepository;
use yii\mail\MailerInterface;
use yii\queue\JobInterface;

class ProductAvailabilityNotification implements JobInterface
{

    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function execute($queue)
    {
        foreach ($this->getUsers()->getAllByProductInWishList($this->product->id) as $user) {
            if ($user->isActive()) {
                try {
                    $this->sendEmailNotification($user, $this->product);
                } catch (\Exception $e) {
                    \Yii::$app->errorHandler->handleException($e);
                }
            }
        }
    }

    private function sendEmailNotification(User $user, Product $product): void
    {
        $sent = $this->getMailer()
            ->compose(
                ['html' => 'shop/wishlist/available-html', 'text' => 'shop/wishlist/available-text'],
                ['user' => $user, 'product' => $product]
            )
            ->setTo($user->email)
            ->setSubject('Product is available')
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Email sending error to ' . $user->email);
        }
    }

    private function getUsers(): UserRepository
    {
        //потому что после десериализации объект не создастся
        return \Yii::$container->get(UserRepository::class);
    }

    private function getMailer(): MailerInterface
    {
        //потому что после десериализации объект не создастся
        return \Yii::$container->get(MailerInterface::class);
    }
}