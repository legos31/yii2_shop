<?php

namespace shop\repositories\shop;

use EventDispatcher;
use shop\entities\shop\Product\Product;
use yii\web\NotFoundHttpException;

class ProductRepository
{
    private $dispatcher;

    public function __construct()
    {
        //$this->dispatcher = $dispatcher;
    }

    public function get($id): Product
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundHttpException('Product is not found.');
        }
        return $product;
    }

    public function existsByBrand($id): bool
    {
        return Product::find()->andWhere(['brand_id' => $id])->exists();
    }

    public function existsByMainCategory($id): bool
    {
        return Product::find()->andWhere(['category_id' => $id])->exists();
    }

    public function save(Product $product): void
    {
        if (!$product->save()) {
            throw new \RuntimeException('Saving error.');
        }
//        $this->dispatcher->dispatchAll($product->releaseEvents());
//        $this->dispatcher->dispatch(new EntityPersisted($product));
    }

    public function remove(Product $product): void
    {
        if (!$product->delete()) {
            throw new \RuntimeException('Removing error.');
        }
//        $this->dispatcher->dispatchAll($product->releaseEvents());
//        $this->dispatcher->dispatch(new EntityRemoved($product));
    }
}