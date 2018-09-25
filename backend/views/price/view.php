<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model \common\models\Price */

$this->title = $model->name . ' от ' . $model->provider->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<h3><?= $model->name ?></h3>
<div class="row row-cards">

    <div class="col-sm-4">
        <div class="card">
            <div class="card-header">Загрузить новый файл</div>
            <div class="card-body">
                <form id="price-main">
                    <div class="form-group">
                        <label class="form-label">Название прайса</label>
                        <input type="text" class="form-control" id="price-name" name="title" placeholder="Придумайте название">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Источник</label>
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="source" value="link" class="selectgroup-input">
                                <span class="selectgroup-button selectgroup-button-icon"><i
                                            class="fe fe-link"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="source" value="ftp" class="selectgroup-input">
                                <span class="selectgroup-button selectgroup-button-icon">FTP</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="source" value="file" class="selectgroup-input"
                                       checked="checked">
                                <span class="selectgroup-button selectgroup-button-icon"><i
                                            class="fe fe-upload"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="source" value="mail" class="selectgroup-input">
                                <span class="selectgroup-button selectgroup-button-icon"><i
                                            class="fe fe-mail"></i></span>
                            </label>
                        </div>
                    </div>

                    <style>.price-source {
                            display: none;
                        }</style>

                    <div class="price-source price-source-link">
                        <div class="form-group">
                            <label class="form-label">Ссылка на файл</label>
                            <input type="text" class="form-control" name="autoupdate[link]"
                                   placeholder="вместе с http:// или https://">
                        </div>
                    </div>

                    <div class="price-source price-source-ftp">
                        <div class="card-alert alert alert-danger mb-0">
                            Данный способ временно не доступен
                        </div>
                    </div>

                    <div class="price-source price-source-file">
                        <input type="hidden" id="price-file" name="autoupdate[file]">

                        <div id="price-upload-zone" class="file-drop drop-price">
                            <span class="hint">Переместите файл в эту зону или нажмите чтобы выбрать</span>
                        </div>

                        <div class="alert alert-primary">Этот способ не поддерживает автоматическое обновлениие.<br><a
                                    href="#" class="alert-link">Подробнее про обновления</a></div>


                    </div>

                    <div class="price-source price-source-mail">
                        <div class="card-alert alert alert-danger mb-0">
                            Данный способ временно не доступен
                        </div>
                    </div>

                    <div class="price-autoupdate" style="display: none;">
                        <fieldset class="form-fieldset">
                            <div style="clear: both;">
                                <h5 style="float: left; margin-bottom: 35px;">Автообновление</h5>
                                <div class="btn-list text-right m-b-10">
                                    <input type="hidden" value="0" class="condition-active" name="autoupdate[active]">
                                    <label class="custom-switch m-0">
                                        <input type="checkbox" value="1" class="custom-switch-input" checked=""
                                               name="autoupdate[active]">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="selectgroup selectgroup-pills">
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="autoupdate[days]" value="mon"
                                               class="selectgroup-input">
                                        <span class="selectgroup-button">пн</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="autoupdate[days]" value="tue"
                                               class="selectgroup-input">
                                        <span class="selectgroup-button">вт</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="autoupdate[days]" value="wes"
                                               class="selectgroup-input">
                                        <span class="selectgroup-button">ср</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="autoupdate[days]" value="thu"
                                               class="selectgroup-input">
                                        <span class="selectgroup-button">чт</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="autoupdate[days]" value="fri"
                                               class="selectgroup-input">
                                        <span class="selectgroup-button">пт</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="autoupdate[days]" value="sat"
                                               class="selectgroup-input">
                                        <span class="selectgroup-button">сб</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="autoupdate[days]" value="sun"
                                               class="selectgroup-input">
                                        <span class="selectgroup-button">вс</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="row gutters-xs">
                                    <div class="col-6 align-self-center">
                                        <label class="form-label">Время обновления</label>
                                    </div>
                                    <div class="col-3">
                                        <?= \yii\bootstrap\Html::dropDownList('autoupdate[hours]', '17', \common\helpers\DateHelper::getHoursArray(), ['class' => 'form-control custom-select']) ?>
                                    </div>
                                    <div class="col-3">
                                        <?= \yii\bootstrap\Html::dropDownList('autoupdate[minutes]', '00', \common\helpers\DateHelper::getMinutesArray(), ['class' => 'form-control custom-select']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label">Если товар пропал из прайса:</div>
                                <label class="custom-switch">
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Скрывать позиции</span>
                                </label>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-4">

        <div class="card">
            <div class="card-header">Настройки парсера</div>
            <div class="card-body">


                <div class="form-group">
                    <div class="row gutters-xs">

                        <div class="col-7 align-self-center">
                            <label class="form-label">Колонка с наименованием</label>
                        </div>
                        <div class="col-4">
                            <?= \yii\bootstrap\Html::dropDownList('parser[excel][title]', 'F', \common\helpers\ExcelParser::getABCArray(), ['class' => 'form-control custom-select']) ?>
                        </div>
                        <span class="col-auto align-self-center">
                              <span class="form-help help-1">?</span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row gutters-xs">

                        <div class="col-7 align-self-center">
                            <label class="form-label">Первая строка</label>
                        </div>
                        <div class="col-4">
                            <input type="number" class="form-control w-100" min="1" value="3">
                        </div>
                        <span class="col-auto align-self-center">
                              <span class="form-help help-1">?</span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row gutters-xs">

                        <div class="col-7 align-self-center">
                            <label class="form-label">Номер листа (для Excel)</label>
                        </div>
                        <div class="col-4">
                            <input type="number" class="form-control w-100" min="1" value="1">
                        </div>
                        <span class="col-auto align-self-center">
                              <span class="form-help help-1">?</span>
                        </span>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row gutters-xs">

                        <div class="col-7 align-self-center">
                            <label class="form-label">Колонка с описанием</label>
                        </div>
                        <div class="col-4">
                            <?= \yii\bootstrap\Html::dropDownList('parser[excel][description]', '', \common\helpers\ExcelParser::getABCArray(true), ['class' => 'form-control custom-select']) ?>
                        </div>
                        <span class="col-auto align-self-center">
                              <span class="form-help help-1">?</span>
                        </span>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row gutters-xs">

                        <div class="col-7 align-self-center">
                            <label class="form-label">Колонка с ценой</label>
                        </div>
                        <div class="col-4">
                            <?= \yii\bootstrap\Html::dropDownList('parser[excel][price]', '', \common\helpers\ExcelParser::getABCArray(true), ['class' => 'form-control custom-select']) ?>
                        </div>
                        <span class="col-auto align-self-center">
                              <span class="form-help help-1">?</span>
                        </span>
                    </div>
                </div>

                <hr>


                <div class="form-label" style="margin-top: -10px; margin-bottom: 15px;">
                    <div class="row gutters-xs">
                        <div class="col-5">Условия</div>
                        <div class="col-6 text-right">
                            <button type="button" class="parser-add-condition btn btn-secondary btn-sm">Добавить новое
                            </button>
                        </div>
                        <span class="col-auto align-self-center">
                              <span class="form-help help-1">?</span>
                        </span>
                    </div>
                </div>


                <form id="parser-conditions">

                </form>


                <fieldset id="parser-condition-template" class="form-fieldset" style="display: none;">
                    <label class="form-label" style="float: left;">Условие <span
                                class="condition-number">-</span></label>
                    <div class="btn-list text-right m-b-10">
                        <input type="hidden" value="0" class="condition-active">
                        <label class="custom-switch m-0">
                            <input type="checkbox" value="1" class="custom-switch-input condition-active" checked="">
                            <span class="custom-switch-indicator"></span>
                        </label>
                        <a href="#" class="btn btn-field condition-remove" data-num=""><i class="fe fe-trash"></i></a>
                    </div>
                    <div class="form-group">
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="condition[num][action]" value="add"
                                       class="selectgroup-input condition-action" checked="">
                                <span class="selectgroup-button">Добавлять</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="condition[num][action]" value="skip"
                                       class="selectgroup-input condition-action">
                                <span class="selectgroup-button">Пропускать</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row gutters-xs">

                            <div class="col-4 align-self-center">
                                <label class="form-label">Если колонка</label>
                            </div>
                            <div class="col-4">
                                <?= \yii\bootstrap\Html::dropDownList('condition[num][col]', '', \common\helpers\ExcelParser::getABCArray(), ['class' => 'form-control custom-select condition-col']) ?>
                            </div>
                            <div class="col-4">
                                <?= \yii\bootstrap\Html::dropDownList('condition[num][condition]', '', \common\helpers\ExcelParser::getConditionsArray(), ['class' => 'form-control custom-select condition-condition']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group condition-text-block">
                        <input type="text" class="form-control condition-text" name="condition[num][text]"
                               placeholder="">
                    </div>
                </fieldset>


            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary parser-save">Сохранить</button>
            </div>

        </div>


    </div>

    <div class="col-sm-4">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">История обновлений</h2>
                <div class="card-options">
                    <small>(последние 30)</small>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table card-table table-striped table-vcenter">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Время</th>
                        <th>Сообщение</th>
                        <th>Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->getUpdates()->limit(30)->all() as $update): ?>
                        <tr>
                            <td><?= $update->id ?></td>
                            <td class="text-nowrap"><?= $update->humanTime ?></td>
                            <td><?= $update->message ?></td>
                            <td><span class="badge <?= $update->statusBadge ?>"><?= $update->status ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>


<script>
    require(['jquery', 'selectize', 'bootstrap', 'dropzone'], function ($, selectize) {
        $(document).ready(function () {

            console.log('init');
            $('.help-1').popover({
                trigger: 'hover',
                content: '<p>ZIP Code must be US or CDN format. You can use an extended ZIP+4 code to determine address more accurately.</p>\n' +
                    '                              <p class=\'mb-0\'><a href=\'\'>USP ZIP codes lookup tools</a></p>',
                placement: 'auto'
            });


            $(document).on('change', '.condition-condition', function (e) {
                var n = $(this).data('num');
                var v = $(this).val();
                var sh = !(v === 'empty' || v === 'not_empty');
                if (sh) $('#condition-text-block-' + n).show(100);
                else $('#condition-text-block-' + n).hide(100)
            });

            $(document).on('click', '.condition-remove', function (e) {
                e.preventDefault();
                $('#parser-condition-' + $(this).data('num')).remove();
                parserConditionsRefresh();
            });

            function refreshSourceTabs() {
                var val = $('input[name=source]:checked').val();
                $('.price-source').hide(0);
                $('.price-source-' + val).show(0)
                if (val != 'link') {
                    $('.price-autoupdate').fadeOut(100);
                } else {
                    $('.price-autoupdate').fadeIn(100);
                }
            }


            refreshSourceTabs();

            $('input[name=source]').on('change', function () {
                refreshSourceTabs();
            });


            function parserConditionsRefresh() {
                $('#parser-conditions .parser-condition').each(function (num, el) {
                    var n = num + 1;
                    $(el).attr('id', 'parser-condition-' + n);
                    $(el).find('.condition-number').text(n);
                    $(el).find('.condition-action').attr('name', 'condition[' + n + '][action]');
                    $(el).find('.condition-active').attr('name', 'condition[' + n + '][active]');
                    $(el).find('.condition-col').attr('name', 'condition[' + n + '][col]');
                    $(el).find('.condition-condition').attr('name', 'condition[' + n + '][condition]');
                    $(el).find('.condition-condition').data('num', n);
                    $(el).find('.condition-text').attr('name', 'condition[' + n + '][text]');
                    $(el).find('.condition-remove').data('num', n);
                    $(el).find('.condition-text-block').attr('id', 'condition-text-block-' + n);
                });
            }

            $('.parser-add-condition').on('click', function (e) {
                e.preventDefault();
                var anc = 'parser-condition-' + Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
                $('#parser-conditions').append('<fieldset data-num="" id="' + anc + '" class="form-fieldset parser-condition">' + $('#parser-condition-template').html() + '</fieldset>');
                // console.log(anc);
                var target_offset = $("#" + anc).offset();
                var target_top = target_offset.top;
                $('html, body').animate({scrollTop: target_top}, 1000);
                parserConditionsRefresh();
            });

            $('.parser-save').on('click', function (e) {
                e.preventDefault();
                var dataParser = $('#parser-conditions').serialize();
                var dataMain = $('#price-main').serialize();
                var data = dataMain + '&' + dataParser;
                console.log(data);
            });

            $('#input-tags').selectize({
                delimiter: ',',
                persist: false,
                create: function (input) {
                    return {
                        value: input,
                        text: input
                    }
                }
            });

            $('#select-beast').selectize({});

            $("div#price-upload-zone").dropzone({
                url: "/media/add?type=price",
                acceptedFiles: ".xls,.xlsx,.csv",
                paramName: "file",
                uploadMultiple: false,
                maxFiles: 1,
                init: function () {
                    this.on("complete", function (file) {
                        console.log('uploaded', file.name, file.xhr.response);
                        $('#price-file').val(file.xhr.response);
                        if($('#price-name').val().length < 1){
                            $('#price-name').val(file.name.split('.')[0]);
                        }
                    });
                }
            });




            $('#select-users').selectize({
                render: {
                    option: function (data, escape) {
                        return '<div>' +
                            '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                            '<span class="title">' + escape(data.text) + '</span>' +
                            '</div>';
                    },
                    item: function (data, escape) {
                        return '<div>' +
                            '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                            escape(data.text) +
                            '</div>';
                    }
                }
            });

            $('#select-countries').selectize({
                render: {
                    option: function (data, escape) {
                        return '<div>' +
                            '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                            '<span class="title">' + escape(data.text) + '</span>' +
                            '</div>';
                    },
                    item: function (data, escape) {
                        return '<div>' +
                            '<span class="image"><img src="' + data.image + '" alt=""></span>' +
                            escape(data.text) +
                            '</div>';
                    }
                }
            });
        });
    });
</script>




