<?php

use yii\db\Migration;

/**
 * Handles the creation of table `descriptions`.
 */
class m180918_125915_create_descriptions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('descriptions', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'type' => $this->smallInteger(2)->notNull(),
            'status' => $this->integer(2)->notNull()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('descriptions');
    }
}
