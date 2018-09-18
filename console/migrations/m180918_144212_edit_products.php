<?php

use yii\db\Migration;

/**
 * Class m180918_144212_edit_products
 */
class m180918_144212_edit_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('products', 'subcategory_id');
        $this->dropColumn('products', 'category_id');
        $this->addColumn('products', 'yandex_category_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180918_144212_edit_products cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180918_144212_edit_products cannot be reverted.\n";

        return false;
    }
    */
}
