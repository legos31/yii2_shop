<?php

namespace shop\entities\shop\Product;

use shop\entities\shop\Characteristic;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Value extends ActiveRecord
{
    public static function create($characteristicId, $value): self
    {
        $object = new static();
        $object->characteristic_id = $characteristicId;
        $object->value = $value;
        return $object;
    }

    public static function blank($characteristicId): self
    {
        $object = new static();
        $object->characteristic_id = $characteristicId;
        return $object;
    }

    public function change($value): void
    {
        $this->value = $value;
    }

    public function isForCharacteristic($id): bool
    {
        return $this->characteristic_id == $id;
    }

    public function getCharacteristic(): ActiveQuery
    {
        return $this->hasOne(Characteristic::class, ['id' => 'characteristic_id']);
    }

    public static function tableName(): string
    {
        return '{{%shop_values}}';
    }
}