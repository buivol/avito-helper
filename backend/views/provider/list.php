<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $items \common\models\Provider[] */

$this->title = 'Мои поставщики';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row row-cards">
    <div class="col-sm-4">
        <div class="card card-profile">
            <div class="card-header"
                 style="background-image: url(http://www.bonanzacom.ru/templates/images/logo.png); background-size: contain; background-position: center center; background-repeat: no-repeat;"></div>
            <div class="card-body text-center">
                <h2 class="mb-3">Bonanza</h2>
                <p class="mb-4">
                    Tel.: +7 (495) 780 58 20<br>
                    E-mail: <a href="mailto:info@bonanzacom.ru">info@bonanzacom.ru</a><br>
                    <a href="http://www.bonanzacom.ru" target="_blank">www.bonanzacom.ru</a>
                </p>
                <button class="btn btn-outline-default btn-sm">
                    <span class="fa fa-pencil"></span> Настроить
                </button>
            </div>
        </div>
    </div>


    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                Список прайсов
                <div class="card-options">
                    <a href="/price/new?provider=1" class="btn btn-secondary btn-sm ml-2">Добавить прайс</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                    <thead>
                    <tr>
                        <th class="text-center w-1"></th>
                        <th>Название</th>
                        <th>Парсер контента</th>
                        <th class="text-center">Источник</th>
                        <th>Обновление</th>
                        <th class="text-center">Запланировано</th>
                        <th class="text-center"><i class="icon-settings"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center">
                            <span class="avatar"><i class="fa fa-table" aria-hidden="true"></i>
                                <span class="avatar-status bg-green"></span>
                            </span>
                        </td>
                        <td>
                            <div>HI-END Premium</div>
                            <div class="small text-muted">
                                1.24 мб, Excell
                            </div>
                        </td>
                        <td>
                            <div class="clearfix">
                                <div class="float-left">
                                    <strong>42%</strong>
                                </div>
                                <div class="float-right">
                                    <small class="text-muted">76 из 210</small>
                                </div>
                            </div>
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-yellow" role="progressbar" style="width: 42%"
                                     aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </td>
                        <td class="text-center">
                            <i class="fa fa-cloud" style="padding-top: 10px;"></i>
                        </td>
                        <td>
                            <div class="small text-muted">Успешно</div>
                            <div>4 минуты назад</div>
                        </td>
                        <td class="text-center">
                            <div class="mx-auto chart-circle chart-circle-xs" data-value="0.42" data-thickness="3"
                                 data-color="blue">
                                <canvas width="80" height="80" style="height: 40px; width: 40px;"></canvas>
                                <div class="chart-circle-value">42%</div>
                            </div>
                        </td>
                        <td class="text-center btn-p">
                            <a class="icon" href="/price/1">
                                <i class="fe fe-edit"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





