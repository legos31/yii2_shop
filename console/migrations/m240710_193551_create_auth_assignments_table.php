<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth_assignments}}`.
 */
class m240710_193551_create_auth_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%auth_assignments}}', [
            'id' => $this->bigPrimaryKey(),
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-auth_assignments-user_id}}', '{{%auth_assignments}}', 'user_id');

        $this->addForeignKey('{{%fk-auth_assignments-user_id}}', '{{%auth_assignments}}', 'user_id', '{{%users}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%auth_assignments}}');
    }
}
