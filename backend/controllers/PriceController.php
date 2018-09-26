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
        $ui = new UIRender(0, '/provider');
        $post = Yii::$app->request->post();
        if ($post['id'] == 'new') {
            $price = new Price;
            $price->provider_id = $post['provider'];
            $provider = Provider::findOne(['user_id' => $this->user->id, 'id' => $post['provider']]);
            if (!$provider) {
                $ui->addError('Ошибка связи прайса с поставщиком');
            }
            $price->user_id = $this->user->id;
            if (!strlen($post['name'])) {
                $ui->addError('Укажите название прайса');
            }
        } else {
            $price = Price::findOne(['id' => $post['id'], 'user_id' => $this->user->id]);
            if (!$price) {
                $ui->addError('Прайс не найден');
                return $ui->run();
            }
        }

        $source = $post['source'];
        if ($source == 'link') {
            if ($price->isNewRecord && !strlen($post['link'])) {
                $ui->addError('Введите ссылку на файл');
            } else if (strlen($post['link'])) {
                $price->path = $post['link'];
                $price->source_type = Price::SOURCE_TYPE_LINK;
            }
        } else if ($source == 'file') {
            if ($price->isNewRecord && !strlen($post['file'])) {
                $ui->addError('Загрузите файл');
            } else if (strlen($post['file'])) {
                $price->path = $post['file'];
                $price->source_type = Price::SOURCE_TYPE_LOCAL;
            }
        } else if ($source == 'ftp') {
            $ui->addError('Данный вид загрузки пока не поддерживатся');
        } else if ($source == 'mail') {
            $ui->addError('Данный вид загрузки пока не поддерживатся');
        } else {
            $ui->addError('Данный вид загрузки пока не поддерживатся');
        }

        if (strlen($post['name'])) {
            $price->name = $post['name'];
        }

        $price->loadAutoUpdateParams($post['autoupdate']);

        if (!$ui->isError()) {
            $price->save();
        }

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
        if (($model = Price::findOne(['id' => $id, 'user_id' => $this->user->id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Этого элемента больше не существует.');
    }
}
