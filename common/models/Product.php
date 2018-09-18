<?php

namespace common\models;

use common\helpers\YandexMarket;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $category_id
 * @property int $subcategory_id
 * @property int $provider_id
 * @property string $provider_art
 * @property string $provider_title
 * @property string $provider_description
 * @property int $provider_price
 * @property string $yandex_update
 * @property int $yandex_search
 * @property int $vendor_id
 * @property float $price
 * @property string $title
 * @property string $description
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_id
 */
class Product extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DELETED = 7;

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
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function updateYandexPhoto($productId, $photos)
    {
        if (!count($photos)) {
            return 0;
        }
        $dbPhotos = Photo::findAll(['product_id' => $productId, 'type' => Photo::TYPE_YANDEX_MARKET]);
        $dbPhotos = ArrayHelper::map($dbPhotos, 'id', 'src');
        $rows = [];


        foreach ($photos as $photo) {
            if (!in_array($photo, $dbPhotos)) {
                $rows[] = [
                    'src' => $photo,
                    'product_id' => $productId,
                    'type' => Photo::TYPE_YANDEX_MARKET,
                    'created_at' => time(),
                ];
            }
        }

        if (count($rows)) {
            try {
                return Yii::$app->db->createCommand()->batchInsert(Photo::tableName(), ['src', 'product_id', 'type', 'created_at'], $rows)->execute();
            } catch (\Exception $e) {
                return 0;
            }
        }

        return 0;

    }


    public static function updateYandexNames($productId, $names)
    {
        if (!count($names)) {
            return 0;
        }

        $rows = [];
        $dbNames = Name::findAll(['product_id' => $productId, 'type' => Name::TYPE_YANDEX_MARKET]);
        $dbNames = ArrayHelper::map($dbNames, 'id', 'text');
        foreach ($names as $name) {
            if (!in_array($name, $dbNames)) {
                $rows[] = [
                    'text' => $name,
                    'product_id' => $productId,
                    'type' => Name::TYPE_YANDEX_MARKET,
                ];
            }
        }

        if (count($rows)) {
            try {
                return Yii::$app->db->createCommand()->batchInsert(Name::tableName(), ['text', 'product_id', 'type'], $rows)->execute();
            } catch (\Exception $e) {
                return 0;
            }
        }

        return 0;
    }

    public static function updateYandexDescriptions($productId, $descriptions)
    {
        if (!count($descriptions)) {
            return 0;
        }

        $rows = [];
        $dbDescriptions = Description::findAll(['product_id' => $productId, 'type' => Description::TYPE_YANDEX_MARKET]);
        $dbDescriptions = ArrayHelper::map($dbDescriptions, 'id', 'text');
        foreach ($descriptions as $description) {
            if (!in_array($description, $dbDescriptions)) {
                $rows[] = [
                    'text' => $description,
                    'product_id' => $productId,
                    'type' => Description::TYPE_YANDEX_MARKET,
                ];
            }
        }

        if (count($rows)) {
            try {
                return Yii::$app->db->createCommand()->batchInsert(Description::tableName(), ['text', 'product_id', 'type'], $rows)->execute();
            } catch (\Exception $e) {
                return 0;
            }
        }

        return 0;
    }

    public static function updateYandexSpecifications($productId, $specifications)
    {
        if (!count($specifications)) {
            return 0;
        }

        $rows = [];
        $dbSpecification = Specification::findAll(['product_id' => $productId, 'type' => Specification::TYPE_YANDEX_MARKET]);
        $dbSpecification = ArrayHelper::map($dbSpecification, 'id', 'text');
        foreach ($specifications as $specification) {
            if (!in_array($specification, $dbSpecification)) {
                $rows[] = [
                    'text' => $specification,
                    'product_id' => $productId,
                    'type' => Specification::TYPE_YANDEX_MARKET,
                ];
            }
        }

        if (count($rows)) {
            try {
                return Yii::$app->db->createCommand()->batchInsert(Specification::tableName(), ['text', 'product_id', 'type'], $rows)->execute();
            } catch (\Exception $e) {
                return 0;
            }
        }

        return 0;
    }


    public function updateYandex()
    {
        $result = YandexMarket::search($this->provider_art);
        $data = $result['data'];

        Product::updateYandexPhoto($this->id, $data['photos']);
        Product::updateYandexNames($this->id, $data['names']);
        Product::updateYandexDescriptions($this->id, $data['descriptions']);
        Product::updateYandexSpecifications($this->id, $data['specifications']);

        if (isset($data['vendor']['id'])) {
            $vendor = Vendor::findOne(['yandex_id' => $data['vendor']['id']]);
            if (!$vendor) {
                $vendor = new Vendor;
                $vendor->yandex_id = $data['vendor']['id'];
            }
            if (isset($data['vendor']['name'])) {
                $vendor->title = $data['vendor']['name'];
            }
            if (isset($data['vendor']['logo'])) {
                $vendor->logo = $data['vendor']['logo'];
            }

            $vendor->save();
            $this->vendor_id = $vendor->id;
        }

        $this->save();

        dd($result);
    }
}
