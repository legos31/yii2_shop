<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth_item_children}}`.
 */
class m240710_194402_create_auth_item_children_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%auth_item_child}}', [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
            'PRIMARY KEY(parent, child)',
        ]);

        $this->addForeignKey('fk-auth_item_child-parent', '{{%auth_item_child}}', 'parent', '{{%auth_item}}', 'name', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-auth_item_child-child', '{{%auth_item_child}}', 'child', '{{%auth_item}}', 'name', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%auth_item_children}}');
    }
}
