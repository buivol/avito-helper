<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 07.08.2018
 * Time: 14:04
 */

namespace backend\controllers;


use common\helpers\YandexMarket;
use common\models\Product;
use yii\base\Controller;

class CronController extends Controller
{
    public function actionYandex()
    {

        $product = Product::findOne(1);
        $product->updateYandex();
    }
}
