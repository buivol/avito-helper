<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $items \common\models\Provider[] */

$this->title = 'Список';
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-title">
                    <h4>Bananza</h4>
                    <p><small>Всего товаров: 1234 из них 453 сейчас продаются и 226 в очереди</small></p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Прайс</th>
                                <th>Обновлён</th>
                                <th>Товары в обороте</th>
                                <th>Яндекс.Маркет</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Kolor Tea Shirt For Man</td>
                                <td><span class="badge badge-primary">Sale</span></td>
                                <td>January 22</td>
                                <td>$21.56</td>
                                <td><a class="btn btn-default">s</a> </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php foreach ($items as $item): ?>

    <h1><?= $item->title ?></h1>

<?php endforeach; ?>