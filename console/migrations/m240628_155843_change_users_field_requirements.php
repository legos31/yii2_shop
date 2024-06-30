<?php

use yii\db\Migration;

/**
 * Class m240628_155843_change_users_field_requirements
 */
class m240628_155843_change_users_field_requirements extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%users}}', 'username', $this->string());
        $this->alterColumn('{{%users}}', 'password_hash', $this->string());
        $this->alterColumn('{{%users}}', 'email', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%users}}', 'username', $this->string()->notNull());
        $this->alterColumn('{{%users}}', 'password_hash', $this->string()->notNull());
        $this->alterColumn('{{%users}}', 'email', $this->string()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240628_155843_change_users_field_requirements cannot be reverted.\n";

        return false;
    }
    */
}
