<?php

use yii\db\Migration;

/**
 * Class m180918_131725_update_products_table
 */
class m180918_131725_update_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('products', 'provider_price');
        $this->addColumn('products', 'price_min', $this->decimal(10, 2)->after('price'));
        $this->addColumn('products', 'price_max', $this->decimal(10, 2)->after('price_min'));
        $this->addColumn('products', 'price_rrc', $this->decimal(10,2)->after('price_max'));
        $this->addColumn('products', 'price_zak', $this->decimal(10,2)->after('price_rrc'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180918_131725_update_products_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180918_131725_update_products_table cannot be reverted.\n";

        return false;
    }
    */
}
