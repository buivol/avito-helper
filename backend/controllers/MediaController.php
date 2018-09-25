<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 07.08.2018
 * Time: 14:04
 */

namespace backend\controllers;

use common\helpers\Media;
use common\models\Product;
use yii\base\Controller;
use yii\web\UploadedFile;

class MediaController extends BackendController
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    public function actionUpload($type = 'unsorted')
    {
        $result = false;
        if($type == 'price') {
            $result = Media::addPrice($this->user->id);
        }
        die($result);

    }
}
