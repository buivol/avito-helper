<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'subcategory_id')->textInput() ?>

    <?= $form->field($model, 'provider_id')->textInput() ?>

    <?= $form->field($model, 'provider_title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'provider_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'provider_price')->textInput() ?>

    <?= $form->field($model, 'yandex_update')->textInput() ?>

    <?= $form->field($model, 'yandex_search')->textInput() ?>

    <?= $form->field($model, 'yandex_title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'yandex_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'custom_title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'custom_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'custom_price')->textInput() ?>

    <?= $form->field($model, 'current_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
