<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property int $status
 * @property int $hide_xml
 *
 * @property Product[] $products
 */
class SubCategory extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DELETED = 7;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_category';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['sub_category_id' => 'id'])->andWhere(['status' => [Product::STATUS_ACTIVE, Product::STATUS_DISABLED]]);
    }

}
