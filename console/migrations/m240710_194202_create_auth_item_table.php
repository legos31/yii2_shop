<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth_item}}`.
 */
class m240710_194202_create_auth_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%auth_item}}', [
            'name' => $this->string(64)->notNull(),
            'type' => $this->integer()->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->binary(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY(name)',
        ]);

        $this->createIndex('idx-auth_item-type', '{{%auth_item}}', 'type');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%auth_item}}');
    }
}
