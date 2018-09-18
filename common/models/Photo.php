<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "photo".
 *
 * @property int $id
 * @property int $type
 * @property string $src
 * @property int $status
 * @property int $product_id
 * @property int $sort
 * @property int $view
 * @property int $created_at
 * @property int $updated_at
 */
class Photo extends \yii\db\ActiveRecord
{

    const TYPE_YANDEX_MARKET = 1;
    const TYPE_YANDEX_SEARCH = 2;
    const TYPE_LOCAL_CDN = 3;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo';
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
