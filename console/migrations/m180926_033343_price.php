<?php

use yii\db\Migration;

/**
 * Class m180926_033343_price
 */
class m180926_033343_price extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('price', 'auto_update', $this->boolean()->defaultValue(false)->notNull());
        $this->addColumn('price', 'auto_update_days', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('price', 'auto_update');
        $this->dropColumn('price', 'auto_update_days');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180926_033343_price cannot be reverted.\n";

        return false;
    }
    */
}
