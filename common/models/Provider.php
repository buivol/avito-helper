<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "provider".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $descriptions
 * @property string $logo
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Price[] $prices
 */
class Provider extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DELETED = 7;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provider';
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

    public function getPrices()
    {
        return $this->hasMany(Price::class, ['provider_id' => 'id'])->andWhere(['status' => [Price::STATUS_ACTIVE, Price::STATUS_DISABLED]]);
    }

}
