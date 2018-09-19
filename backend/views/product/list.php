<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $items \common\models\Product[] */

$this->title = 'Список';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php foreach ($items as $item): ?>

    <h1><?= $item->provider_art ?></h1>

<?php endforeach; ?>