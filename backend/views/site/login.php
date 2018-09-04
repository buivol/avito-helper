<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
?>
<div class="col-lg-4">
    <div class="login-content card">
        <div class="login-form">
            <h4>Вход в AvitoHelper</h4>
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'method' => 'post']); ?>
                <div class="form-group">
                    <label>Имя пользователя</label>
                    <input type="text" name="username" class="form-control" placeholder="Имя пользователя">
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password" class="form-control" placeholder="Пароль">
                </div>
                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Войти</button>
                <div class="register-link m-t-15 text-center">
                    <p>&copy; intDigit</p>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>