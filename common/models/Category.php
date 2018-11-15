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

    private $_userId = null;
    private $_subsWithProducts = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @param integer $userId
     * @return SubCategory[]
     */
    public function getSubsWithProducts($userId)
    {
        $result = [];
        $subs = $this->subCategories;
        foreach ($subs as $sub) {
            $count = $sub->getProductsCount($userId);
            if ($count) {
                $result[] = $sub;
            }
        }
        $this->_userId = $userId;
        $this->_subsWithProducts = $result;
        return $result;
    }

    public function productCount($userId)
    {
        if ($this->_userId != $userId || !$this->_subsWithProducts) {
            $subs = $this->getSubsWithProducts($userId);
        }
        $count = 0;
        foreach ($subs as $sub) {
            $count += $sub->getProductsCount($userId);
        }
        return $count;
    }



    public function getSubCategories()
    {
        return $this->hasMany(SubCategory::class, ['parent_id' => 'id'])->andWhere(['status' => Provider::STATUS_ACTIVE]);
    }
}
