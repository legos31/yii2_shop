<?php

namespace shop\services;

use Yii;
use yii\rbac\ManagerInterface;

class RoleManager
{
    private $manager;

    public function __construct()
    {
        $this->manager = Yii::$app->authManager;
    }

    public function assign($userId, $name): void
    {
        $am = $this->manager;
        $am->revokeAll($userId);
        if (!$role = $am->getRole($name)) {
            throw new \DomainException('Role "' . $name . '" does not exist.');
        }
        $am->revokeAll($userId);
        $am->assign($role, $userId);
    }
}