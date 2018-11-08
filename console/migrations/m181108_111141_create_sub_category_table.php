<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sub_category`.
 */
class m181108_111141_create_sub_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sub_category_configs', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'sub_category_id' => $this->integer()->notNull(),
            'config' => $this->text()->notNull(),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sub_category_configs');
    }
}
