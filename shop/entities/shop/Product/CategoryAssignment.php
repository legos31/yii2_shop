<?php

namespace shop\entities\shop\Product;

use shop\entities\shop\Category;
use yii\db\ActiveRecord;

class CategoryAssignment extends ActiveRecord
{
    public static function create($categoryId): self
    {
        $assignment = new static();
        $assignment->category_id = $categoryId;
        return $assignment;
    }

    public function isForCategory($id): bool
    {
        return $this->category_id == $id;
    }

    public static function tableName(): string
    {
        return '{{%shop_category_assignments}}';
    }

    public function findCategory($id): Category
    {
        return Category::findOne($id);
    }
}