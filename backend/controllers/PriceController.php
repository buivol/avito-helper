<?php

namespace backend\controllers;

use common\helpers\UIRender;
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

    public function actionNew($provider)
    {
        $provider = Provider::findOne(['id' => $provider, 'user_id' => $this->user->id]);
        if (!$provider) {
            return $this->goBack('/provider');
        }
        $this->backButton = '/provider';
        $this->saveButton = 'Добавить';
        $model = new Price;
        $model->provider_id = $provider->id;
        $model->source_type = Price::SOURCE_TYPE_LOCAL;

        return $this->render('view', ['model' => $model]);
    }

    public function actionSave()
    {
        $ui = new UIRender(1, '/provider');
        $ui->addError('тестовая ошибка 1');
        $ui->addError('тестовая ошибка 2');
        $ui->addError('тестовая ошибка 3');
        $ui->addError('тестовая ошибка 4', 'parser');
        return $ui->run();
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
