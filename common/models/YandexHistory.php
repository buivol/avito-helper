<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "yandex_history".
 *
 * @property int $id
 * @property string $query
 * @property string $body
 * @property string $link
 * @property string $code
 * @property string $api_key
 * @property int $created_at
 * @property int $updated_at
 */
class YandexHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yandex_history';
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

    public function setBody($body)
    {
        $path = Yii::getAlias('@backend/logs/yandex-history/');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $path .= time() . rand(100, 999) . '.json';
        file_put_contents($path, $body);
        $this->body = $path;
    }
}
