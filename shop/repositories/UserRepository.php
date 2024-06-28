<?php

namespace common\repositories;

use shop\entities\User;
use yii\web\NotFoundHttpException;

class UserRepository
{
    public function findByUsernameOrEmail($value): ?User
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }

    public function save(User $user): bool
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving user error.');
        }

        return true;
    }

    public function getByPasswordResetToken($token): User|null
    {
        if (!self::isPasswordResetTokenValid($token)) {
            return null;
        }
        return $this->getBy([
            'password_reset_token' => $token,
            'status' => User::STATUS_ACTIVE,
        ]);
    }

    private function getBy(array $conditions): User
    {
        if (!$user = User::find()->andWhere($conditions)->limit(1)->one())
        {
            throw new NotFoundHttpException('User not found.');
        }

        return $user;
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

}