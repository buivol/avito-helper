<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'subcategory_id',
            'provider_id',
            'provider_title:ntext',
            'provider_description:ntext',
            'provider_price',
            'yandex_update',
            'yandex_search',
            'yandex_title:ntext',
            'yandex_description:ntext',
            'custom_title:ntext',
            'custom_description:ntext',
            'custom_price',
            'current_price',
            'current_title',
            'current_description',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
