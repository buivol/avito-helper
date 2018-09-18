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
        $newPhotos = [];


        foreach ($photos as $photo) {
            if (!in_array($photo, $dbPhotos)) {
                $newPhotos[] = $photo;
            }
        }


        if (count($newPhotos)) {
            $rows = [];
            foreach ($newPhotos as $newPhoto) {
                $rows[] = [
                    'src' => $newPhoto,
                    'product_id' => $productId,
                    'type' => Photo::TYPE_YANDEX_MARKET,
                    'created_at' => time(),
                ];
            }
            try {
                return Yii::$app->db->createCommand()->batchInsert(Photo::tableName(), ['src', 'product_id', 'type', 'created_at'], $rows)->execute();
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
