<?php

namespace shop\repositories\shop;

use shop\entities\shop\Characteristic;
use yii\web\NotFoundHttpException;

class CharacteristicRepository
{
    public function get($id): Characteristic
    {
        if (!$characteristic = Characteristic::findOne($id)) {
            throw new NotFoundHttpException('Characteristic is not found.');
        }
        return $characteristic;
    }

    public function save(Characteristic $characteristic): void
    {
        if (!$characteristic->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Characteristic $characteristic): void
    {
        if (!$characteristic->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}