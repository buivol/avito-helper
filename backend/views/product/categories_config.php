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
                <a href="/product/categories/yandex"
                   class="list-group-item list-group-item-action d-flex align-items-center">
                    <span class="icon mr-3"><i class="fa fa-yahoo"></i></span>Маркет <span
                            class="ml-auto badge badge-secondary">14</span>
                </a>
                <a href="/product/categories/config"
                   class="list-group-item list-group-item-action d-flex align-items-center active">
                    <span class="icon mr-3"><i class="fe fe-sliders"></i></span>Настройки
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                Неотсортированные
            </div>
            <div class="table-responsive">
                <table class="table card-table table-striped table-vcenter">
                    <thead>
                    <tr>
                        <th colspan="2">Категория</th>
                        <th>Товаров</th>
                        <th colspan="2">Дни недели/время</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $category): ?>
                        <tr>
                            <td class="w-1" colspan="2">
                                <?= $category->name ?>
                            </td>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                        <?php foreach ($category->subCategories as $subCategory): ?>
                            <tr>
                                <td class="w-1">
                                    &nbsp;
                                </td>
                                <td>
                                    <?= $subCategory->name ?>
                                </td>
                                <td>
                                    <?= $subCategory->getProducts()->count() ?>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>Пн</td>
                                            <td>Вт</td>
                                            <td>Ср</td>
                                            <td>Чт</td>
                                            <td>Пт</td>
                                            <td>Сб</td>
                                            <td>Вс</td>
                                        </tr>
                                        <tr>
                                            <td>08:00 22:00</td>
                                            <td>08:00 22:00</td>
                                            <td>08:00 22:00</td>
                                            <td>08:00 22:00</td>
                                            <td>08:00 22:00</td>
                                            <td>08:00 22:00</td>
                                            <td>08:00 22:00</td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <a href="#" class="icon"><i class="fe fe-settings"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<script>
    require(['jquery', 'selectize'], function ($, selectize) {
        $(document).ready(function () {

        });
    });
</script>