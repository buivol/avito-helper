<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $category_id
 * @property int $subcategory_id
 * @property int $provider_id
 * @property string $provider_title
 * @property string $provider_description
 * @property int $provider_price
 * @property string $yandex_update
 * @property int $yandex_search
 * @property string $yandex_title
 * @property string $yandex_description
 * @property string $custom_title
 * @property string $custom_description
 * @property int $custom_price
 * @property string $current_price
 * @property string $current_title
 * @property string $current_description
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_id
 */
class Product extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DELETED = 7;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
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
