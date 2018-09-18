<?php

use yii\db\Migration;

/**
 * Handles the creation of table `provider`.
 */
class m180918_093834_create_provider_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('provider', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'descriptions' => $this->text(),
            'logo' => $this->string()->null(),
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
        $this->dropTable('provider');
    }
}
