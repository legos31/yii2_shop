<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_category_assignments}}`.
 */
class m240704_161708_create_shop_category_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_category_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-shop_category_assignments}}', '{{%shop_category_assignments}}', ['product_id', 'category_id']);

        $this->createIndex('{{%idx-shop_category_assignments-product_id}}', '{{%shop_category_assignments}}', 'product_id');
        $this->createIndex('{{%idx-shop_category_assignments-category_id}}', '{{%shop_category_assignments}}', 'category_id');

        $this->addForeignKey('{{%fk-shop_category_assignments-product_id}}', '{{%shop_category_assignments}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-shop_category_assignments-category_id}}', '{{%shop_category_assignments}}', 'category_id', '{{%shop_categories}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_category_assignments}}');
    }
}
