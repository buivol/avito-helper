<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "vendor".
 *
 * @property int $id
 * @property int $yandex_id
 * @property string $title
 * @property string $logo
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Vendor extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DELETED = 7;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor';
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
