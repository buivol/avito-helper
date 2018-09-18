<?php

use yii\db\Migration;

/**
 * Class m180918_143914_edit_yacats
 */
class m180918_143914_edit_yacats extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ya_category', 'name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ya_category', 'name');
    }

}
