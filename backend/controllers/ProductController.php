<?php

namespace backend\controllers;

use common\helpers\UIRender;
use common\models\SubCategoryConfig;
use Yii;
use common\models\Product;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends BackendController
{

    public $menu = 'product';


    public function actionIndex()
    {
        $products = $this->user->products;
        $prices = [];
        return $this->render('list', ['items' => $products, 'prices' => $prices]);
    }

    public function actionCategories()
    {
        $cat = 'yandex';
        return $this->redirect('/product/categories/' . $cat);
    }

    public function actionCategoriesYandex()
    {
        $headCategory = $this->user->headCategory;
        $categories = $headCategory->categories;
        return $this->render('categories_yandex', ['items' => $categories]);
    }

    public function actionCategoriesConfig()
    {
        $this->saveButton = 'Сохранить';
        $headCategory = $this->user->headCategory;
        $categories = $headCategory->categories;
        return $this->render('categories_config', ['items' => $categories, 'user' => $this->user]);
    }


    public function actionSavesub($id)
    {
        $ui = new UIRender();
        $post = Yii::$app->request->post();
        $newConfig = Json::encode($post);
        $config = SubCategoryConfig::findOne(['sub_category_id' => $id, 'user_id' => $this->user->id]);
        if(!$config){
            $config = new SubCategoryConfig;
            $config->sub_category_id = $id;
            $config->user_id = $this->user->id;
        }

        $config->config = $newConfig;
        $config->save(false);
        return $ui->run();
    }


    /**
     * Finds the Product model based on itsP primary key value.
     * If the model is not found, a 404 HTT exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Этого элемента больше не существует.');
    }
}
