<?php

use yii\db\Migration;

/**
 * Class m180918_092955_edit_photo_table
 */
class m180918_092955_edit_photo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('photo', 'sort', $this->integer()->defaultValue(99)->notNull());
        $this->addColumn('photo', 'view', $this->boolean()->defaultValue(1));
        $this->addColumn('photo', 'product_id', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('photo', 'sort');
        $this->dropColumn('photo', 'view');
        $this->dropColumn('photo', 'product_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180918_092955_edit_photo_table cannot be reverted.\n";

        return false;
    }
    */
}
