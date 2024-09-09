<?php

namespace shop\listeners\Shop\Product;


use shop\events\ProductAppearedInStock;
use shop\jobs\ProductAvailabilityNotification;
use shop\repositories\UserRepository;
use yii\queue\Queue;

class ProductAppearedInStockListener
{

    private Queue $queue;

    public function __construct(UserRepository $users, Queue $queue)
    {

        $this->queue = $queue;
    }

    public function handle(ProductAppearedInStock $event): void
    {
        if ($event->product->isActive()) {
            $this->queue->push(new ProductAvailabilityNotification($event->product));
        }
    }
}