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

        <div class="products-header">
            Выделено <span>0</span>
            <div class="dropdown pull-right">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    <i class="fe fe-more-horizontal"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Обновить с маркета</a>
                </div>
            </div>
            <div class="dropdown pull-right mr-2">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    <i class="fe fe-play mr-2"></i>Статус
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Запланировать</a>
                    <a class="dropdown-item" href="#">Сменить даты</a>
                    <a class="dropdown-item" href="#">Убрать с продажи</a>
                </div>
            </div>
            <div class="dropdown pull-right mr-2">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                    <i class="fe fe-file-text mr-2"></i>Описание
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Настроить</a>
                    <a class="dropdown-item" href="#">Редактировать эпилог</a>
                    <a class="dropdown-item" href="#">Редактировать конец</a>
                </div>
            </div>
        </div>

        <div class="card">
            <table class="table card-table table-vcenter">
                <thead>
                <tr>
                    <th colspan="2">Название</th>
                    <th>Статус</th>
                    <th>Срок</th>
                    <th>Цена</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input"
                                   checked="">
                            <span class="custom-control-label"></span>
                        </label></td>
                    <td>
                        Apple MacBook Pro i7 3,1GHz/16/512/Radeon 560 Space Gray
                    </td>
                    <td>В продаже</td>
                    <td>24.12 - 01.01 (08:00)</td>
                    <td class="text-right">
                        1199
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
            var filterQuery = '';

            function refreshFilterQuery() {
                filterQuery = '/api/products.json?r=' + Math.random();

                //categories

                console.log('changedFilterQuery', filterQuery);
            }

            $('.filter-change-sibl').on('sibl-change', function (e) {
                refreshFilterQuery();
            });
        });
    });
</script>
