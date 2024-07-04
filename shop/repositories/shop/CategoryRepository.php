<?php

namespace shop\repositories\shop;

use shop\entities\shop\Category;
use yii\web\NotFoundHttpException;

class CategoryRepository
{
    private $dispatcher;

    public function __construct()
    {
        //$this->dispatcher = $dispatcher;
    }

    public function get($id): Category
    {
        if (!$category = Category::findOne($id)) {
            throw new NotFoundHttpException('Category is not found.');
        }
        return $category;
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new \RuntimeException('Saving error.');
        }
        //$this->dispatcher->dispatch(new EntityPersisted($category));
    }

    public function remove(Category $category): void
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error.');
        }
        //$this->dispatcher->dispatch(new EntityRemoved($category));
    }
}