<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 07.08.2018
 * Time: 14:04
 */

namespace backend\controllers;


use common\helpers\YandexMarket;
use yii\base\Controller;

class CronController extends Controller
{
    public function actionYandex()
    {
        $query = 'AVRX250BTBKE2';
        $result = YandexMarket::search($query);
        dd($result);
    }
}
