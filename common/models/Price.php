<?php

namespace common\models;

use common\helpers\DateHelper;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "price".
 *
 * @property int $id
 * @property string $parser
 * @property string $name
 * @property int $type
 * @property int $source_type
 * @property string $path
 * @property int $provider_id
 * @property int $last_update
 * @property int $update_id
 * @property int $user_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $auto_update
 * @property int $auto_update_days
 * @property int $auto_update_hours
 * @property int $auto_update_minutes
 * @property int $auto_update_hide
 *
 * @property PriceUpdate $lastUpdate
 * @property Provider $provider
 * @property PriceUpdate[] $updates
 */
class Price extends \yii\db\ActiveRecord
{

    const SOURCE_TYPE_LOCAL = 1;
    const SOURCE_TYPE_LINK = 2;
    const SOURCE_TYPE_FTP = 3;
    const SOURCE_TYPE_EMAIL = 4;

    const TYPE_XLS = 1;
    const TYPE_CSV = 2;

    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DELETED = 7;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
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

    public function loadAutoUpdateParams($array)
    {
        $active = $this->source_type == self::SOURCE_TYPE_LINK;

        $bits = 0;
        if(isset($array['days']['mon']) && $array['days']['mon']){
            $bits += DateHelper::MON;
        }
        if(isset($array['days']['tue']) && $array['days']['tue']){
            $bits += DateHelper::TUE;
        }
        if(isset($array['days']['wes']) && $array['days']['wes']){
            $bits += DateHelper::WES;
        }
        if(isset($array['days']['thu']) && $array['days']['thu']){
            $bits += DateHelper::THU;
        }
        if(isset($array['days']['fri']) && $array['days']['fri']){
            $bits += DateHelper::FRI;
        }
        if(isset($array['days']['sat']) && $array['days']['sat']){
            $bits += DateHelper::SAT;
        }
        if(isset($array['days']['sun']) && $array['days']['sun']){
            $bits += DateHelper::SUN;
        }
        $active = $bits && $active && isset($array['active']) && $array['active'];

        $this->auto_update = $active;
        $this->auto_update_days = $bits;
        $this->auto_update_hours = intval($array['hours']);
        $this->auto_update_minutes = intval($array['minutes']);
        $this->auto_update_hide = isset($array['hide']) && $array['hide'];

    }

    public function checkDay($flag)
    {
        return (($this->auto_update_days & $flag) == $flag);
    }

    public function getLastUpdate()
    {
        return $this->hasOne(PriceUpdate::class, ['id' => 'last_update']);
    }

    public function getUpdates()
    {
        return $this->hasMany(PriceUpdate::class, ['price_id' => 'id']);
    }

    public function getProvider()
    {
        return $this->hasOne(Provider::class, ['id' => 'provider_id']);
    }

}
