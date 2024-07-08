<?php

use yii\db\Migration;

/**
 * Class m240706_084838_add_shop_product_fields
 */
class m240706_084838_add_shop_product_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_products}}', 'weight', $this->integer()->notNull());
        $this->addColumn('{{%shop_products}}', 'quantity', $this->integer()->notNull());

        $this->addColumn('{{%shop_modifications}}', 'quantity', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_modifications}}', 'quantity');

        $this->dropColumn('{{%shop_products}}', 'quantity');
        $this->dropColumn('{{%shop_products}}', 'weight');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240706_084838_add_shop_product_fields cannot be reverted.\n";

        return false;
    }
    */
}
