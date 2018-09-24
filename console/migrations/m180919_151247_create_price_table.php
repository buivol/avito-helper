<?php

use yii\db\Migration;

/**
 * Handles the creation of table `price`.
 */
class m180919_151247_create_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('price', [
            'id' => $this->primaryKey(),
            'parser' => $this->text(),
            'name' => $this->string(),
            'type' => $this->smallInteger(),
            'source_type' => $this->integer(),
            'path' => $this->text(),
            'provider_id' => $this->integer()->notNull(),
            'last_update' => $this->integer(),
            'update_id' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'status' => $this->integer(2)->notNull()->defaultValue(1),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->defaultValue(null),
        ]);

        $this->createTable('price_update', [
            'id' => $this->primaryKey(),
            'price_id' => $this->integer()->notNull(),
            'code' => $this->smallInteger(),
            'message' => $this->text(),
            'log' => $this->string(1024)->null(),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->defaultValue(null),
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('price');
    }
}
