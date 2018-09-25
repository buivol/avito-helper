<?php

namespace backend\controllers;

use common\models\Price;
use common\models\Provider;
use Yii;
use yii\web\NotFoundHttpException;

class PriceController extends BackendController
{

    public $menu = 'provider';

    public function actionView($id)
    {
        $this->backButton = '/provider';
        $this->saveButton = 'Сохранить';
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Provider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Price::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Этого элемента больше не существует.');
    }
}
