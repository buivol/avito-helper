<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "price".
 *
 * @property int $id
 * @property string $parser
 * @property string $name
 * @property int $type
 * @property int $source_type
 * @property string $path
 * @property int $provider_id
 * @property int $last_update
 * @property int $update_id
 * @property int $user_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PriceUpdate $lastUpdate
 * @property Provider $provider
 * @property PriceUpdate[] $updates
 */
class Price extends \yii\db\ActiveRecord
{

    const SOURCE_TYPE_LOCAL = 1;
    const SOURCE_TYPE_LINK = 2;
    const SOURCE_TYPE_FTP = 3;
    const SOURCE_TYPE_EMAIL = 4;

    const TYPE_XLS = 1;
    const TYPE_CSV = 2;

    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DELETED = 7;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
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

    public function getLastUpdate()
    {
        return $this->hasOne(PriceUpdate::class, ['id' => 'last_update']);
    }

    public function getUpdates()
    {
        return $this->hasMany(PriceUpdate::class, ['price_id' => 'id']);
    }

    public function getProvider()
    {
        return $this->hasOne(Provider::class, ['id' => 'provider_id']);
    }

}
