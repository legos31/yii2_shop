<?php

namespace shop\helpers;

use shop\entities\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class UserHelper
{
    public static function statusList(): array
    {
        return [
            User::STATUS_INACTIVE => 'Wait',
            User::STATUS_ACTIVE => 'Active',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case User::STATUS_INACTIVE:
                $class = 'badge bg-primary';
                break;
            case User::STATUS_ACTIVE:
                $class = 'badge bg-success';
                break;
            default:
                $class = 'badge bg-primary';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}