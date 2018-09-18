<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "descriptions".
 *
 * @property int $id
 * @property string $text
 * @property int $product_id
 * @property int $type
 * @property int $status
 */
class Description extends \yii\db\ActiveRecord
{
    const TYPE_YANDEX_MARKET = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'descriptions';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
}
