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
 *
 * @property SubCategory[] $subCategories
 */
class Category extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DELETED = 7;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    public function getSubCategories()
    {
        return $this->hasMany(SubCategory::class, ['parent_id' => 'id'])->andWhere(['status' => Provider::STATUS_ACTIVE]);
    }
}
