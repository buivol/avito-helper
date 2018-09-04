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
    public function actionYandex($name = 'AVRX250BTBKE2')
    {
        $result = [];
        $result['search'] = YandexMarket::search($name);
        dd($result);
    }
}
