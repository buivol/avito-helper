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


            <?php foreach ($items as $item): ?>
                <ul>
                    <li>
                        <?= $item->name ?>
                        <?php if (count($item->subCategories)) : ?>
                            <ul>
                                <?php foreach ($item->subCategories as $subCategory): ?>
                                    <li><?= $subCategory->name ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                </ul>
            <?php endforeach; ?>


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
                    <tr>
                        <td class="w-1">
                            <sssß
                        </td>
                        <td>Наушники ASUS rogue 12x wifi bluetooth</td>
                        <td>Игровые наушники ASUS</td>
                        <td>
                            <select class="form-control">
                                <option hidden>Выбрать категорию</option>
                                <?php foreach ($categories as $category): ?>
                                    <?php if (count($category->subCategories)) : ?>
                                        <optgroup label="<?= $category->name ?>">
                                            <?php foreach ($category->subCategories as $subCategory): ?>
                                                <option value="<?= $subCategory->id ?>"><?= $subCategory->name ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
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