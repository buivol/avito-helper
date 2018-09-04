<?php

use yii\db\Migration;

/**
 * Class m180831_093849_add_user_id_column_on_products_table
 */
class m180831_093849_add_user_id_column_on_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'user_id', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products', 'user_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180831_093849_add_user_id_column_on_products_table cannot be reverted.\n";

        return false;
    }
    */
}
