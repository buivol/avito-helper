<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Json;

/**
 * This is the model class for table "sub_category_configs".
 *
 * @property int $id
 * @property int $user_id
 * @property int $sub_category_id
 * @property string $config
 * @property int $created_at
 * @property int $updated_at
 *
 * @property array $configArray
 */
class SubCategoryConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_category_configs';
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

    public function getConfigArray()
    {
        return Json::decode($this->config);
    }

    public static function getDefault()
    {
        return [
            'mon' => [
                'active' => true,
                'start' => [
                    'hours' => '08',
                    'minutes' => '00',
                ],
                'end' => [
                    'hours' => '22',
                    'minutes' => '00',
                ],
            ],
            'tue' => [
                'active' => true,
                'start' => [
                    'hours' => '08',
                    'minutes' => '00',
                ],
                'end' => [
                    'hours' => '22',
                    'minutes' => '00',
                ],
            ],
            'wed' => [
                'active' => true,
                'start' => [
                    'hours' => '08',
                    'minutes' => '00',
                ],
                'end' => [
                    'hours' => '22',
                    'minutes' => '00',
                ],
            ],
            'thu' => [
                'active' => true,
                'start' => [
                    'hours' => '08',
                    'minutes' => '00',
                ],
                'end' => [
                    'hours' => '22',
                    'minutes' => '00',
                ],
            ],
            'fri' => [
                'active' => true,
                'start' => [
                    'hours' => '08',
                    'minutes' => '00',
                ],
                'end' => [
                    'hours' => '22',
                    'minutes' => '00',
                ],
            ],
            'sat' => [
                'active' => true,
                'start' => [
                    'hours' => '08',
                    'minutes' => '00',
                ],
                'end' => [
                    'hours' => '22',
                    'minutes' => '00',
                ],
            ],
            'sun' => [
                'active' => true,
                'start' => [
                    'hours' => '08',
                    'minutes' => '00',
                ],
                'end' => [
                    'hours' => '22',
                    'minutes' => '00',
                ],
            ],
        ];
    }
}
