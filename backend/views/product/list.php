<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $items \common\models\Product[] */
/* @var $categories array */
/* @var $providers array */

$this->title = 'Список товаров';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="page-header">
    <h1 class="page-title">
        <?= $this->title ?>
    </h1>
</div>
<div class="row row-cards">
    <div class="col-lg-3">
        <div class="row">

            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Статусы</div>
                        <div class="card-options">
                            <a href="#" class="btn btn-secondary btn-sm ml-2"><i class="fe fe-check-circle"></i></a>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="selectgroup selectgroup-pills">
                            <label class="selectgroup-item" title="">
                                <input type="checkbox" name="value" value="0" class="selectgroup-input" checked="">
                                <span class="selectgroup-button selectgroup-button-icon"><i
                                            class="fe fe-play"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="checkbox" name="value" value="1" class="selectgroup-input">
                                <span class="selectgroup-button selectgroup-button-icon"><i
                                            class="fe fe-watch"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="checkbox" name="value" value="2" class="selectgroup-input">
                                <span class="selectgroup-button selectgroup-button-icon"><i
                                            class="fe fe-calendar"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="checkbox" name="value" value="3" class="selectgroup-input">
                                <span class="selectgroup-button selectgroup-button-icon"><i
                                            class="fe fe-edit"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="checkbox" name="value" value="3" class="selectgroup-input">
                                <span class="selectgroup-button selectgroup-button-icon"><i
                                            class="fe fe-zap"></i></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Категории</div>
                    </div>
                    <div class="card-body">
                        <?= $this->render('filters_categories', ['categories' => $categories]) ?>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Описание</div>
                        <div class="card-options">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <table class="w-100 btn-table" style="margin-top: -15px;">
                                <tr>
                                    <td style="color: #bebebe; font-size: 11px;">Тип описания</td>
                                    <td style="color: #bebebe; font-size: 11px;">Заполнено</td>
                                    <td style="color: #bebebe; font-size: 11px;">Активно</td>
                                </tr>
                                <tr>
                                    <td>Эпилог</td>
                                    <td>
                                              <span class="tristate tristate-switcher">
                                                <input type="radio" name="start-exists" value="-1">
                                                <input type="radio" name="start-exists" value="0" checked>
                                                <input type="radio" name="start-exists" value="1">
                                                <i></i>
                                              </span>
                                    </td>
                                    <td>
                                              <span class="tristate tristate-switcher">
                                                <input type="radio" name="start-active" value="-1">
                                                <input type="radio" name="start-active" value="0" checked>
                                                <input type="radio" name="start-active" value="1">
                                                <i></i>
                                              </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Эпилог в прайсе</td>
                                    <td>
                                              <span class="tristate tristate-switcher">
                                                <input type="radio" name="start-price-exists" value="-1">
                                                <input type="radio" name="start-price-exists" value="0" checked>
                                                <input type="radio" name="start-price-exists" value="1">
                                                <i></i>
                                              </span>
                                    </td>
                                    <td>
                                              <span class="tristate tristate-switcher">
                                                <input type="radio" name="start-price-active" value="-1">
                                                <input type="radio" name="start-price-active" value="0" checked>
                                                <input type="radio" name="start-price-active" value="1">
                                                <i></i>
                                              </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Краткое описание</td>
                                    <td>
                                              <span class="tristate tristate-switcher">
                                                <input type="radio" name="descr-exists" value="-1">
                                                <input type="radio" name="descr-exists" value="0" checked>
                                                <input type="radio" name="descr-exists" value="1">
                                                <i></i>
                                              </span>
                                    </td>
                                    <td>
                                              <span class="tristate tristate-switcher">
                                                <input type="radio" name="descr-active" value="-1">
                                                <input type="radio" name="descr-active" value="0" checked>
                                                <input type="radio" name="descr-active" value="1">
                                                <i></i>
                                              </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Характеристики</td>
                                    <td>
                                              <span class="tristate tristate-switcher">
                                                <input type="radio" name="specs-exists" value="-1">
                                                <input type="radio" name="specs-exists" value="0" checked>
                                                <input type="radio" name="specs-exists" value="1">
                                                <i></i>
                                              </span>
                                    </td>
                                    <td>
                                              <span class="tristate tristate-switcher">
                                                <input type="radio" name="specs-active" value="-1">
                                                <input type="radio" name="specs-active" value="0" checked>
                                                <input type="radio" name="specs-active" value="1">
                                                <i></i>
                                              </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Конец с прайса</td>
                                    <td>
                                              <span class="tristate tristate-switcher">
                                                <input type="radio" name="end-price-exists" value="-1">
                                                <input type="radio" name="end-price-exists" value="0" checked>
                                                <input type="radio" name="end-price-exists" value="1">
                                                <i></i>
                                              </span>
                                    </td>
                                    <td>
                                              <span class="tristate tristate-switcher">
                                                <input type="radio" name="end-price-active" value="-1">
                                                <input type="radio" name="end-price-active" value="0" checked>
                                                <input type="radio" name="end-price-active" value="1">
                                                <i></i>
                                              </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Конец</td>
                                    <td>
                                              <span class="tristate tristate-switcher">
                                                <input type="radio" name="end-exists" value="-1">
                                                <input type="radio" name="end-exists" value="0" checked>
                                                <input type="radio" name="end-exists" value="1">
                                                <i></i>
                                              </span>
                                    </td>
                                    <td>
                                              <span class="tristate tristate-switcher">
                                                <input type="radio" name="end-active" value="-1">
                                                <input type="radio" name="end-active" value="0" checked>
                                                <input type="radio" name="end-active" value="1">
                                                <i></i>
                                              </span>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Поставщики</div>
                    </div>
                    <div class="card-body">
                        <?= $this->render('filters_providers', ['providers' => $providers]) ?>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <table class="table card-table table-vcenter">
                <tbody>
                <tr>
                    <td><img src="demo/products/apple-macbook-pro.jpg" alt="" class="h-8"></td>
                    <td>
                        Apple MacBook Pro i7 3,1GHz/16/512/Radeon 560 Space Gray
                        <div class="badge badge-default badge-md">New</div>
                    </td>
                    <td class="text-right text-muted d-none d-md-table-cell text-nowrap">97 reviews</td>
                    <td class="text-right text-muted d-none d-md-table-cell text-nowrap">13 offers</td>
                    <td class="text-right">
                        <strong>$1499</strong>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

    require(['jquery'], function ($) {
        $(document).ready(function () {
            $('.ui-sibl').on('sibl-change', function (e) {
                console.log('sibl-change');
            });
        });
    });
</script>
