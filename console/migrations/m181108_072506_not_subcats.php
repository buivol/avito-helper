<?php

use yii\db\Migration;

/**
 * Class m181108_072506_not_subcats
 */
class m181108_072506_not_subcats extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('sub_category', 'hide_xml', $this->boolean()->notNull()->defaultValue(false));
        $this->batchInsert('sub_category', ['name', 'parent_id', 'hide_xml'], [
            ['Любые', 9, 1],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181108_072506_not_subcats cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181108_072506_not_subcats cannot be reverted.\n";

        return false;
    }
    */
}
