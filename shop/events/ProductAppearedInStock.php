<?php

namespace shop\events;

use shop\entities\Shop\Product\Product;

class ProductAppearedInStock
{
    public $product;
    //этот класс передать в событие, которое происходит при появлении товара и передать сюда товар
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}