<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 26.09.2018
 * Time: 0:29
 */

namespace common\helpers;


use yii\web\UploadedFile;

class Media
{
    /**
     * @param int $userId
     */
    public static function addPrice($userId)
    {
        $file = UploadedFile::getInstanceByName('file');
        if (!$file) {
            return false;
        }

        $folder = \Yii::getAlias('@backend/web/');
        $web = 'cdn/u/' . $userId . '.' . substr(md5($userId . 'vito-price'), 1, 5) . '/price/';
        $name = time() . rand(100, 999) . '.' . $file->extension;

        if (!file_exists($folder . $web)) {
            mkdir($folder . $web, 0777, true);
        }

        $file->saveAs($folder . $web . $name);

        return $web . $name;
    }
}