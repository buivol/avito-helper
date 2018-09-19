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
use yii\helpers\Json;

class CronController extends Controller
{
    public function actionYandex()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $result = [
            'action' => 'cron/yandex',
            'count' => 0,
            'updatedId' => null,
            'message' => 'prepare to find',
        ];

        $count = Product::find()->where(['yandex_search' => 0, 'status' => [Product::STATUS_ACTIVE, Product::STATUS_DISABLED]])->count();

        $result['count'] = $count;

        if (!$count) {
            $result['message'] = 'all products already updated';
            return $result;
        }

        $product = Product::findOne(['yandex_search' => 0, 'status' => [Product::STATUS_ACTIVE, Product::STATUS_DISABLED]]);
        $product->updateYandex();

        $result['updatedId'] = $product->id;
        $result['message'] = 'updated product ' . $product->provider_art;

        return $result;

    }
}
