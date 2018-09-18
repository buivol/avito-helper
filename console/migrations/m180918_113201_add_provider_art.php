<?php

use yii\db\Migration;

/**
 * Class m180918_113201_add_provider_art
 */
class m180918_113201_add_provider_art extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'provider_art', $this->string()->notNull()->after('provider_title'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products', 'provider_art');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180918_113201_add_provider_art cannot be reverted.\n";

        return false;
    }
    */
}
