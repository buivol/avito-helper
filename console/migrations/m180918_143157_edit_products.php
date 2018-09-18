<?php

use yii\db\Migration;

/**
 * Class m180918_143157_edit_products
 */
class m180918_143157_edit_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'yandex_model_id', $this->integer(11));
        $this->addColumn('products', 'sub_category_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products', 'yandex_model_id');
        $this->dropColumn('products', 'sub_category_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180918_143157_edit_products cannot be reverted.\n";

        return false;
    }
    */
}
