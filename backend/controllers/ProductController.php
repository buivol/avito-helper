<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
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
        $headCategory = $this->user->headCategory;
        $categories = $headCategory->categories;
        return $this->render('categories_config', ['items' => $categories]);
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
