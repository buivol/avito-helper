<?php

use yii\db\Migration;

/**
 * Class m181115_113145_add_price_id_to_product_table
 */
class m181115_113145_add_price_id_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'price_id', $this->integer()->notNull()->defaultValue(1)->after('provider_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products', 'price_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181115_113145_add_price_id_to_product_table cannot be reverted.\n";

        return false;
    }
    */
}
