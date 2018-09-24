<?php

namespace backend\controllers;

use common\models\Provider;
use Yii;
use yii\web\NotFoundHttpException;

class ProviderController extends BackendController
{

    public $menu = 'provider';

    public function actionIndex()
    {
        $providers = $this->user->providers;
        return $this->render('list', ['items' => $providers]);
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
        if (($model = Provider::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Этого элемента больше не существует.');
    }
}
