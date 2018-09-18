<?php

use yii\db\Migration;

/**
 * Handles the creation of table `photo`.
 */
class m180918_091845_create_photo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('photo', [
            'id' => $this->primaryKey(),
            'type' => $this->smallInteger(2)->notNull(),
            'src' => $this->string(1000),
            'status' => $this->integer(2)->notNull()->defaultValue(1),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('photo');
    }
}
