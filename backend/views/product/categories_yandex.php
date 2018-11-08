<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 07/11/2018
 * Time: 14:01
 */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $items \common\models\Category[] */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-md-2">
        <h3 class="page-title mb-5"><?= $this->title ?></h3>
        <div>
            <div class="list-group list-group-transparent mb-0">
                <a href="/product/categories/yandex" class="list-group-item list-group-item-action d-flex align-items-center active">
                    <span class="icon mr-3"><i class="fa fa-yahoo"></i></span>Маркет <span class="ml-auto badge badge-primary">14</span>
                </a>
                <a href="/product/categories/config" class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"><i class="fe fe-sliders"></i></span>Настройки
                </a>
            </div>
        </div>
    </div>

    <?= $this->render('categories_yandex_unsorted', ['categories' => $items]) ?>
</div>


<script>
    require(['jquery', 'selectize'], function ($, selectize) {
        $(document).ready(function () {
            $('.ui-sel').selectize({});
        });
    });
</script>