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
/* @var $user \common\models\User */

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
                            <?php $config = $subCategory->getUserConfig($user->id); ?>
                            <tr>
                                <td class="w-1">
                                    &nbsp;
                                </td>
                                <td>
                                    <?= $subCategory->name ?>
                                </td>
                                <td>
                                    <?= $subCategory->getProducts($user->id)->count() ?>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td id="sub-day-td-mon-<?= $subCategory->id ?>"
                                                class="text-center sub-day-td<?= $config['mon']['active'] ? '' : ' sub-day-td-inactive' ?>">
                                                Пн
                                            </td>
                                            <td id="sub-day-td-tue-<?= $subCategory->id ?>"
                                                class="text-center sub-day-td<?= $config['tue']['active'] ? '' : ' sub-day-td-inactive' ?>">
                                                Вт
                                            </td>
                                            <td id="sub-day-td-wed-<?= $subCategory->id ?>"
                                                class="text-center sub-day-td<?= $config['wed']['active'] ? '' : ' sub-day-td-inactive' ?>">
                                                Ср
                                            </td>
                                            <td id="sub-day-td-thu-<?= $subCategory->id ?>"
                                                class="text-center sub-day-td<?= $config['thu']['active'] ? '' : ' sub-day-td-inactive' ?>">
                                                Чт
                                            </td>
                                            <td id="sub-day-td-fri-<?= $subCategory->id ?>"
                                                class="text-center sub-day-td<?= $config['fri']['active'] ? '' : ' sub-day-td-inactive' ?>">
                                                Пт
                                            </td>
                                            <td id="sub-day-td-sat-<?= $subCategory->id ?>"
                                                class="text-center sub-day-td<?= $config['sat']['active'] ? '' : ' sub-day-td-inactive' ?>">
                                                Сб
                                            </td>
                                            <td id="sub-day-td-sun-<?= $subCategory->id ?>"
                                                class="text-center sub-day-td<?= $config['sun']['active'] ? '' : ' sub-day-td-inactive' ?>">
                                                Вс
                                            </td>
                                        </tr>
                                        <tr>
                                            <?= $this->render('//parts/time_sub_td', ['id' => $subCategory->id, 'day' => 'mon', 'config' => $config]) ?>
                                            <?= $this->render('//parts/time_sub_td', ['id' => $subCategory->id, 'day' => 'tue', 'config' => $config]) ?>
                                            <?= $this->render('//parts/time_sub_td', ['id' => $subCategory->id, 'day' => 'wed', 'config' => $config]) ?>
                                            <?= $this->render('//parts/time_sub_td', ['id' => $subCategory->id, 'day' => 'thu', 'config' => $config]) ?>
                                            <?= $this->render('//parts/time_sub_td', ['id' => $subCategory->id, 'day' => 'fri', 'config' => $config]) ?>
                                            <?= $this->render('//parts/time_sub_td', ['id' => $subCategory->id, 'day' => 'sat', 'config' => $config]) ?>
                                            <?= $this->render('//parts/time_sub_td', ['id' => $subCategory->id, 'day' => 'sun', 'config' => $config]) ?>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <a href="#" class="icon categories-config-action"
                                       data-sub-id="<?= $subCategory->id ?>"><i class="fe fe-settings"></i></a>
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


<div class="modal fade" id="modal-time-settings">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Настройка времени выдачи</h5>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?= $this->render('//parts/time_settings', []) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button type="button" id="save-time-settings" data-sub-id="-1" class="btn btn-primary">Сохранить
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    require(['jquery', 'selectize'], function ($, selectize) {
        $(document).ready(function () {
            $('.categories-config-action').on('click', function (e) {
                e.preventDefault();
                var subId = $(this).data('sub-id');
                // configure time settings html
                var dayArray = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
                for (var i = 0; i < dayArray.length; i++) {
                    var day = dayArray[i];
                    $('#time-settings-day-' + day + '-active').prop('checked', !$('#sub-day-td-' + day + '-' + subId).hasClass('sub-day-td-inactive'));
                    $('#time-settings-day-' + day + '-start-hours').val($('#sub-' + subId + '-' + day + '-start-hours').text());
                    $('#time-settings-day-' + day + '-end-hours').val($('#sub-' + subId + '-' + day + '-end-hours').text());
                    $('#time-settings-day-' + day + '-start-minutes').val($('#sub-' + subId + '-' + day + '-start-minutes').text());
                    $('#time-settings-day-' + day + '-end-minutes').val($('#sub-' + subId + '-' + day + '-end-minutes').text());
                }
                $('#save-time-settings').data('sub-id', subId);
                $('#modal-time-settings').modal('show');
            })

            $('#save-time-settings').on('click', function (e) {
                var subId = $(this).data('sub-id');
                var dayArray = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
                var config = [];
                //visible changes
                for (var i = 0; i < dayArray.length; i++) {
                    var day = dayArray[i];
                    var confDay = {
                        active: false,
                        start: {
                            hours: $('#time-settings-day-' + day + '-start-hours').val(),
                            minutes: $('#time-settings-day-' + day + '-start-minutes').val(),
                        },
                        end: {
                            hours: $('#time-settings-day-' + day + '-end-hours').val(),
                            minutes: $('#time-settings-day-' + day + '-end-minutes').val(),
                        }
                    };
                    if ($('#time-settings-day-' + day + '-active').is(':checked')) {
                        confDay.active = true;
                        $('#sub-day-td-' + day + '-' + subId).removeClass('sub-day-td-inactive');
                        $('#sub-time-td-' + day + '-' + subId).removeClass('sub-time-td-inactive');
                    } else {
                        confDay.active = false;
                        $('#sub-day-td-' + day + '-' + subId).addClass('sub-day-td-inactive');
                        $('#sub-time-td-' + day + '-' + subId).addClass('sub-time-td-inactive');
                    }
                    $('#sub-' + subId + '-' + day + '-start-hours').text(confDay.start.hours);
                    $('#sub-' + subId + '-' + day + '-end-hours').text(confDay.end.hours);
                    $('#sub-' + subId + '-' + day + '-start-minutes').text(confDay.start.minutes);
                    $('#sub-' + subId + '-' + day + '-end-minutes').text(confDay.end.minutes);
                    config[day] = confDay;
                }
                ui.api({
                    url: 'product/' + subId + '/savesub',
                    data: config,
                });
                $('#modal-time-settings').modal('hide');
            });
        });
    });
</script>