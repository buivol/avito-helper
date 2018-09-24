<?php

namespace common\models;

use common\helpers\DateHelper;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "price_update".
 *
 * @property int $id
 * @property int $price_id
 * @property int $code
 * @property string $message
 * @property string $log
 * @property int $created_at
 * @property int $updated_at
 *
 * @property string $humanTime
 * @property string $status
 * @property string $statusBadge
 */
class PriceUpdate extends \yii\db\ActiveRecord
{

    const STATUS_CODE_SUCCESS = 1;
    const STATUS_CODE_ERROR_PARSER = 2;
    const STATUS_CODE_ERROR_FILE_NOT_FOUND = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price_update';
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

    public function getHumanTime()
    {
        return DateHelper::human($this->created_at);
    }

    public function getStatus()
    {
        return [
            self::STATUS_CODE_SUCCESS => 'Успешно',
            self::STATUS_CODE_ERROR_PARSER => 'Ошибка парсера',
            self::STATUS_CODE_ERROR_FILE_NOT_FOUND => 'Ошибка. Файл не найден'
        ][$this->code];
    }

    public function getStatusBadge()
    {
        return [
            self::STATUS_CODE_SUCCESS => 'badge-success',
            self::STATUS_CODE_ERROR_PARSER => 'badge-danger',
            self::STATUS_CODE_ERROR_FILE_NOT_FOUND => 'badge-danger'
        ][$this->code];
    }
}
