<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vendor`.
 */
class m180918_103107_create_vendor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('vendor', [
            'id' => $this->primaryKey(),
            'yandex_id' => $this->integer(),
            'title' => $this->string()->notNull(),
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
        $this->dropTable('vendor');
    }
}
