<?php

use yii\db\Migration;

/**
 * Handles the creation of table `specifications`.
 */
class m180918_130713_create_specifications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('specifications', [
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
        $this->dropTable('specifications');
    }
}
