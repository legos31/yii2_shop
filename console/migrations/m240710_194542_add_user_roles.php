<?php

use yii\db\Migration;

/**
 * Class m240710_194542_add_user_roles
 */
class m240710_194542_add_user_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%auth_item}}', ['type', 'name', 'description'], [
            [1, 'user', 'User'],
            [1, 'admin', 'Admin'],
        ]);

        $this->batchInsert('{{%auth_item_child}}', ['parent', 'child'], [
            ['admin', 'user'],
        ]);

        $this->execute('INSERT INTO {{%auth_assignments}} (item_name, user_id) SELECT \'user\', u.id FROM {{%users}} u ORDER BY u.id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%auth_item}}', ['name' => ['user', 'admin']]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240710_194542_add_user_roles cannot be reverted.\n";

        return false;
    }
    */
}
