<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180918_133135_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('head_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'photo_max' => $this->integer()->defaultValue(10),
            'status' => $this->integer(2)->notNull()->defaultValue(1),
        ]);


        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'status' => $this->integer(2)->notNull()->defaultValue(1),
        ]);

        $this->createTable('sub_category', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'status' => $this->integer(2)->notNull()->defaultValue(1),
        ]);

        $this->addColumn('user', 'head_id', $this->integer()->null());

        $this->batchInsert('head_category', ['name'], [
            ['Недвижимость'],
            ['Авто'],
            ['Для дома и дачи'],
            ['Бытовая электроника'],
            ['Работа'],
            ['Для бизнеса'],
            ['Личные вещи'],
            ['Запчасти и аксессуары'],
            ['Грузовики и спецтехника'],
            ['Мотоциклы и мототехника'],
            ['Водный транспорт'],
            ['Предложение услуг'],
            ['Хобби и отдых'],
            ['Животные'],
        ]);

        $this->batchInsert('category', ['name', 'parent_id'], [
            ['Телефоны', 4],
            ['Аудио и видео', 4],
            ['Товары для компьютера', 4],
            ['Фототехника', 4],
            ['Игры, приставки и программы', 4],
            ['Оргтехника и расходники', 4],
            ['Планшеты и электронные книги', 4],
            ['Ноутбуки', 4],
            ['Настольные компьютеры', 4],
        ]);

        $this->batchInsert('sub_category', ['name', 'parent_id'], [
            ['MP3-плееры', 2],
            ['Акустика, колонки, сабвуферы', 2],
            ['Видео, DVD и Blu-ray плееры', 2],
            ['Видеокамеры', 2],
            ['Кабели и адаптеры', 2],
            ['Микрофоны', 2],
            ['Музыка и фильмы', 2],
            ['Музыкальные центры, магнитолы', 2],
            ['Наушники', 2],
            ['Телевизоры и проекторы', 2],
            ['Усилители и ресиверы', 2],
            ['Аксессуары', 2],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }
}
