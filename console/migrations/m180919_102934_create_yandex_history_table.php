<?php

use yii\db\Migration;

/**
 * Handles the creation of table `yandex_history`.
 */
class m180919_102934_create_yandex_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('yandex_history', [
            'id' => $this->primaryKey(),
            'query' => $this->text(),
            'body' => $this->text(),
            'link' => $this->text(),
            'code' => $this->string(),
            'api_key' => $this->string(),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('yandex_history');
    }
}
