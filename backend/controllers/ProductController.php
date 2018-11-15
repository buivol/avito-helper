<?php

namespace backend\controllers;

use common\helpers\UIRender;
use common\models\Category;
use common\models\Provider;
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

        $categories = $providers = [];
        $categoriesAll = $this->user->headCategory->categories;
        if ($categoriesAll) {
            foreach ($categoriesAll as $category) {
                $count = $category->productCount($this->user->id);
                if ($count) {
                    $subsAll = $category->getSubsWithProducts($this->user->id);
                    $subs = [];
                    foreach ($subsAll as $sub) {
                        $subs[] = [
                            'id' => $sub->id,
                            'parent_id' => $sub->parent_id,
                            'name' => $sub->name,
                            'count' => $sub->getProductsCount($this->user->id),
                        ];
                    }
                    $categories[] = [
                        'id' => $category->id,
                        'name' => $category->name,
                        'count' => $count,
                        'subs' => $subs,
                    ];
                }
            }
        }

        /** @var Provider[] $providersAll */
        $providersAll = $this->user->getProviders()->with(['prices', 'prices.products'])->all();
        if ($providersAll) {
            foreach ($providersAll as $provider) {
                if ($provider->productsCount) {
                    $prices = [];
                    foreach ($provider->prices as $price) {
                        if (count($price->products)) {
                            $prices[] = [
                                'id' => $price->id,
                                'name' => $price->name,
                                'count' => count($price->products),
                                'parent_id' => $price->provider_id,
                            ];
                        }
                    }
                    $providers[] = [
                        'id' => $provider->id,
                        'name' => $provider->title,
                        'count' => $provider->productsCount,
                        'prices' => $prices,
                    ];
                }
            }
        }

        return $this->render('list', ['items' => $products, 'categories' => $categories, 'providers' => $providers]);
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
        if (!$config) {
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
