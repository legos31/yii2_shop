<?php

namespace shop\services;
class TransactionManager
{


    public function __construct()
    {

    }

    public function wrap(callable $function): void
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {

            $function();
            $transaction->commit();

        } catch (\Exception $e) {
            $transaction->rollBack();

            throw $e;
        }
    }
}