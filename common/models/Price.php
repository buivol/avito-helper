<?php

namespace common\models;

use common\helpers\DateHelper;
use common\helpers\Parser;
use League\Flysystem\Util;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Exception;
use yii\helpers\Json;

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
 * @property array $conditions
 * @property string $humanType
 * @property Product[] $products
 */
class Price extends \yii\db\ActiveRecord
{

    const SOURCE_TYPE_LOCAL = 1;
    const SOURCE_TYPE_LINK = 2;
    const SOURCE_TYPE_FTP = 3;
    const SOURCE_TYPE_EMAIL = 4;

    const TYPE_UNKNOWN = 0;
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
        if (isset($array['days']['mon']) && $array['days']['mon']) {
            $bits += DateHelper::MON;
        }
        if (isset($array['days']['tue']) && $array['days']['tue']) {
            $bits += DateHelper::TUE;
        }
        if (isset($array['days']['wes']) && $array['days']['wes']) {
            $bits += DateHelper::WES;
        }
        if (isset($array['days']['thu']) && $array['days']['thu']) {
            $bits += DateHelper::THU;
        }
        if (isset($array['days']['fri']) && $array['days']['fri']) {
            $bits += DateHelper::FRI;
        }
        if (isset($array['days']['sat']) && $array['days']['sat']) {
            $bits += DateHelper::SAT;
        }
        if (isset($array['days']['sun']) && $array['days']['sun']) {
            $bits += DateHelper::SUN;
        }
        $active = $bits && $active && isset($array['active']) && $array['active'];

        $this->auto_update = $active;
        $this->auto_update_days = $bits;
        $this->auto_update_hours = intval($array['hours']);
        $this->auto_update_minutes = intval($array['minutes']);
        $this->auto_update_hide = isset($array['hide']) && $array['hide'];

    }

    /**
     * @param array $array
     * @param array $conditions
     */
    public function loadParserParams($array, $conditions)
    {
        $parser = $array;
        $parser['conditions'] = $conditions;
        $this->parser = Json::encode($parser);
    }

    /**
     * @param string $param
     * @param null $default
     * @return null
     */
    public function getParserParam($param, $default = null)
    {
        if (!strlen($this->parser)) {
            return $default;
        }
        $parserJson = Json::decode($this->parser);
        if (isset($parserJson[$param])) {
            return $parserJson[$param];
        }
        return $default;
    }


    public function startParser()
    {
        if ($this->source_type == self::SOURCE_TYPE_LINK) {
            try {
                $content = file_get_contents($this->path);
            } catch (\Exception $exception) {
                //todo not found
                dd('not found', $exception);
            }
            $fname = tempnam(sys_get_temp_dir(), 'avito-helper-parser-price-');
            file_put_contents($fname, $content);
        } else if ($this->source_type == self::SOURCE_TYPE_LOCAL) {
            if (!file_exists($this->path)) {
                //todo not found
                dd('not found (local)', $this->path);
            }
            $fname = $this->path;
        } else {
            //todo unsupported source type
            dd('unsupported source type', $this->source_type);
        }

        if ($this->type == self::TYPE_XLS) {
            $mime = Util\MimeType::detectByContent($content);
            if (!Parser::checkMime($this->type, $mime)) {
                //todo mime error
                dd('Mime error', $mime);
            }

            try {
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fname);

            } catch (\Exception $exception) {
                //todo xls read error
                dd('xls read error', $exception);
            }
            $sheetIndex = (int)$this->getParserParam('list', 1) - 1;
            if ($sheetIndex < 0) {
                $sheetIndex = 0;
            }
            $first = (int)$this->getParserParam('line', 1);
            if ($first < 0) {
                $first = 0;
            }
            $titleChar = $this->getParserParam('title', 'A');
            $descriptionChar = $this->getParserParam('description', 'B');
            $priceChar = $this->getParserParam('price', 'C');

            try {
                $sheet = $spreadsheet->getSheet($sheetIndex);
            } catch (\Exception $exception) {
                dd('xls sheet error', $exception);
            }

            $last = $sheet->getHighestRow();
            $conditions = $this->getConditions();
            $rows = [];
            foreach ($sheet->getRowIterator($first, $last) as $row) {
                $title = $sheet->getCell($titleChar . $row->getRowIndex())->getValue();
                $description = $sheet->getCell($descriptionChar . $row->getRowIndex())->getValue();
                $price = (float)$sheet->getCell($priceChar . $row->getRowIndex())->getValue();
                if (!$title || strlen($title) < 2) {
                    continue;
                }
                $cellIterator = $row->getCellIterator();
                $rowArray = [];
                foreach ($cellIterator as $cell) {
                    $rowArray[$cell->getColumn()] = $cell->getValue();
                }
                if (Parser::checkConditions($rowArray, $conditions)) {
                    $data = [
                        'row' => $row->getRowIndex(),
                        'sheet' => $sheet->getTitle(),
                        'title' => $title,
                        'description' => $description,
                        'price' => $price,
                    ];
                    $rows[$row->getRowIndex()] = $data;
                }
            }

            foreach ($rows as $row) {
                //$product = self::findOne()
            }
            dd($rows);

        }

    }

    public function loadFromFile($path)
    {
        file_get_contents($path);
    }

    /**
     * @return array
     */
    public function getConditions()
    {
        if (!strlen($this->parser)) {
            return [];
        }
        $parserJson = Json::decode($this->parser);
        $conditions = isset($parserJson['conditions']) ? $parserJson['conditions'] : [];
        return $conditions;
    }

    public function getHumanType()
    {
        return [
            self::TYPE_UNKNOWN => 'Неизвестный',
            self::TYPE_CSV => 'Csv',
            self::TYPE_XLS => 'Excel',
        ][$this->type ? $this->type : self::TYPE_UNKNOWN];
    }

    public function isForceUpdate()
    {
        return ($this->source_type == self::SOURCE_TYPE_LINK);
    }

    public function isActive()
    {
        return ($this->status == self::STATUS_ACTIVE);
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

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['price_id' => 'id']);
    }

}
