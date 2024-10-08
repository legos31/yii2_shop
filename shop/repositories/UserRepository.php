<?php

namespace shop\repositories;

use shop\dispatchers\EventDispatcher;
use shop\entities\User;
use yii\web\NotFoundHttpException;
use Yii;

class UserRepository
{
    private $dispatcher;

    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function findByUsernameOrEmail($value): ?User
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }

    public function save(User $user): bool
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving user error.');
        }
        $this->dispatcher->dispatchAll($user->releaseEvents());
        return true;
    }

    public function getByPasswordResetToken($token): User|null
    {
        if (!$this->isPasswordResetTokenValid($token)) {
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

    public function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function findByVerificationToken($token): User
    {
        return User::findOne([
            'verification_token' => $token,
            'status' => User::STATUS_INACTIVE
        ]);
    }

    public function findByNetworkIdentity($network, $identity): ?User
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }

    public function get($id): User
    {
        return $this->getBy(['id' => $id]);
    }

    public function getByEmailConfirmToken($token): User
    {
        return $this->getBy(['email_confirm_token' => $token]);
    }
    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new \RuntimeException('Removing error.');
        }
        $this->dispatcher->dispatchAll($user->releaseEvents());
    }

    /**
     * @param $productId
     * @return iterable|User[]
     */
    public function getAllByProductInWishList($productId): iterable
    {
        return User::find()
            ->alias('u')
            ->joinWith('wishlistItems w', false, 'INNER JOIN')
            ->andWhere(['w.product_id' => $productId])
            ->each();
    }


}