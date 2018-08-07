<?php

use yii\db\Migration;

/**
 * Class m180806_101443_add_products_table
 */
class m180806_101443_add_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11),
            'subcategory_id' => $this->integer(11),
            'provider_id' => $this->integer(11)->notNull(),
            'provider_title' => $this->text(),
            'provider_description' => $this->text(),
            'provider_price' => $this->integer(11)->notNull(),
            'yandex_update' => $this->date()->null(),
            'yandex_search' => $this->boolean()->null(),
            'yandex_title' => $this->text()->null(),
            'yandex_description' => $this->text()->null(),
            'custom_title' => $this->text()->null(),
            'custom_description' => $this->text()->null(),
            'custom_price' => $this->integer()->null(),
            'current_price' => $this->string(50)->defaultValue('provider'),
            'current_title' => $this->string(50)->defaultValue('provider'),
            'current_description' => $this->string(50)->defaultValue('provider'),
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
        $this->dropTable('products');
    }
}
