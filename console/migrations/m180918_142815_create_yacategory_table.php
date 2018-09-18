<?php

use yii\db\Migration;

/**
 * Handles the creation of table `yacategory`.
 */
class m180918_142815_create_yacategory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ya_category', [
            'id' => $this->primaryKey(),
            'yandex_id' => $this->integer()->notNull(),
            'sub_category_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ya_category');
    }
}
