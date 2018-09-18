<?php

use yii\db\Migration;

/**
 * Class m180918_123157_change_products_table
 */
class m180918_123157_change_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'vendor_id', $this->integer());
        $this->dropColumn('products', 'yandex_title');
        $this->dropColumn('products', 'yandex_description');
        $this->dropColumn('products', 'custom_title');
        $this->dropColumn('products', 'custom_description');
        $this->dropColumn('products', 'custom_price');
        $this->dropColumn('products', 'current_price');
        $this->dropColumn('products', 'current_title');
        $this->dropColumn('products', 'current_description');
        $this->addColumn('products', 'price', $this->decimal(10,2)->null());
        $this->addColumn('products', 'title', $this->text()->null());
        $this->addColumn('products', 'description', $this->text()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products', 'vendor_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180918_123157_change_products_table cannot be reverted.\n";

        return false;
    }
    */
}
