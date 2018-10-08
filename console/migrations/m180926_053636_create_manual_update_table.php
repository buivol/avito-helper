<?php

use yii\db\Migration;

/**
 * Handles the creation of table `manual_update`.
 */
class m180926_053636_create_manual_update_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('manual_update', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('manual_update');
    }
}
