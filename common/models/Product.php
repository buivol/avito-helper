<?php

namespace common\models;

use Yii;

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
 */
class Product extends \yii\db\ActiveRecord
{
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
    public function rules()
    {
        return [
            [['category_id', 'subcategory_id', 'provider_id', 'provider_price', 'yandex_search', 'custom_price', 'status', 'created_at', 'updated_at'], 'integer'],
            [['provider_id', 'provider_price'], 'required'],
            [['provider_title', 'provider_description', 'yandex_title', 'yandex_description', 'custom_title', 'custom_description'], 'string'],
            [['yandex_update'], 'safe'],
            [['current_price', 'current_title', 'current_description'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'subcategory_id' => 'Subcategory ID',
            'provider_id' => 'Provider ID',
            'provider_title' => 'Provider Title',
            'provider_description' => 'Provider Description',
            'provider_price' => 'Provider Price',
            'yandex_update' => 'Yandex Update',
            'yandex_search' => 'Yandex Search',
            'yandex_title' => 'Yandex Title',
            'yandex_description' => 'Yandex Description',
            'custom_title' => 'Custom Title',
            'custom_description' => 'Custom Description',
            'custom_price' => 'Custom Price',
            'current_price' => 'Current Price',
            'current_title' => 'Current Title',
            'current_description' => 'Current Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
