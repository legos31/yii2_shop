<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_values}}`.
 */
class m240704_161729_create_shop_values_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_values}}', [
            'product_id' => $this->integer()->notNull(),
            'characteristic_id' => $this->integer()->notNull(),
            'value' => $this->string(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-shop_values}}', '{{%shop_values}}', ['product_id', 'characteristic_id']);

        $this->createIndex('{{%idx-shop_values-product_id}}', '{{%shop_values}}', 'product_id');
        $this->createIndex('{{%idx-shop_values-characteristic_id}}', '{{%shop_values}}', 'characteristic_id');

        $this->addForeignKey('{{%fk-shop_values-product_id}}', '{{%shop_values}}', 'product_id', '{{%shop_products}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-shop_values-characteristic_id}}', '{{%shop_values}}', 'characteristic_id', '{{%shop_characteristics}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_values}}');
    }
}
