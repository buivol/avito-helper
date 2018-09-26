<?php

use yii\db\Migration;

/**
 * Class m180926_034343_price
 */
class m180926_034343_price extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('price', 'auto_update_hours', $this->integer(3)->notNull()->defaultValue(23));
        $this->addColumn('price', 'auto_update_minutes', $this->integer(3)->notNull()->defaultValue(45));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('price', 'auto_update_hours');
        $this->dropColumn('price', 'auto_update_minutes');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180926_034343_price cannot be reverted.\n";

        return false;
    }
    */
}
