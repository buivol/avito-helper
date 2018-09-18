<?php

use yii\db\Migration;

/**
 * Handles the creation of table `names`.
 */
class m180918_124343_create_names_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('names', [
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
        $this->dropTable('names');
    }
}
