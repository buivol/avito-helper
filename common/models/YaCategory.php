<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ya_category".
 *
 * @property int $id
 * @property int $yandex_id
 * @property string $name
 * @property int $sub_category_id
 */
class YaCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ya_category';
    }
}
