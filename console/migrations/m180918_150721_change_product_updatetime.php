<?php

use yii\db\Migration;

/**
 * Class m180918_150721_change_product_updatetime
 */
class m180918_150721_change_product_updatetime extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('products', 'yandex_update', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180918_150721_change_product_updatetime cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180918_150721_change_product_updatetime cannot be reverted.\n";

        return false;
    }
    */
}
