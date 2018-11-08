<?php

/* @var $this yii\web\View */
/* @var $user \common\models\User */

$this->title = 'Панель управления';
?>
<div class="page-header">
    <h1 class="page-title">
        <?= $this->title ?>
    </h1>
</div>

<div class="row row-cards">

    <div class="col-12">
        <div class="card">
            <div class="card-body p-3 text-center">
                <?= $user->xmlLink ?>
            </div>
        </div>
    </div>
</div>