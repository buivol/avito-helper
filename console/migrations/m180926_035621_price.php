<?php

use yii\db\Migration;

/**
 * Class m180926_035621_price
 */
class m180926_035621_price extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('price', 'auto_update_hide', $this->boolean()->defaultValue(0)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('price', 'auto_update_hide');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180926_035621_price cannot be reverted.\n";

        return false;
    }
    */
}
