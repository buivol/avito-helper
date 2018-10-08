<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $items \common\models\Provider[] */

$this->title = 'Мои поставщики';
$this->params['breadcrumbs'][] = $this->title;
?>



<?php foreach ($items as $provider): ?>

    <div class="row row-cards">
        <div class="col-sm-3">
            <div class="card card-profile">
                <div class="card-header"
                     style="background-image: url(http://placekitten.com/450/200); background-size: contain; background-position: center center; background-repeat: no-repeat;"></div>
                <div class="card-body text-center">
                    <h2 class="mb-3"><?= $provider->title ?></h2>
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


        <div class="col-sm-9">
            <div class="card" data-ui="prices" data-id="<?= $provider->id ?>">
                <div class="card-header">
                    Список прайсов
                    <div class="card-options">
                        <a href="/price/new?provider=1" class="btn btn-secondary btn-sm ml-2">Добавить прайс</a>
                    </div>
                </div>
                <div class="c-body table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th class="text-center w-1"></th>
                            <th>Название</th>
                            <th>Парсер контента</th>
                            <th class="text-center">Источник</th>
                            <th>Обновление</th>
                            <th class="text-center">План</th>
                            <th class="text-center"><i class="icon-settings"></i></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($provider->prices as $price): ?>
                            <tr>
                                <td class="text-center">
                            <span class="avatar"><i class="fa fa-table" aria-hidden="true"></i>
                                <span class="avatar-status bg-<?= $price->isActive() ? 'green' : 'red' ?>"></span>
                            </span>
                                </td>
                                <td>
                                    <div><?= $price->name ?></div>
                                    <div class="small text-muted">
                                        <?= $price->humanType ?><?= $price->auto_update ? ', автообновление' : '' ?>
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
                                    <?php if ($price->source_type == \common\models\Price::SOURCE_TYPE_LINK): ?>
                                        <i class="fe fe-link" style="padding-top: 10px;"></i>
                                    <?php endif; ?>
                                    <?php if ($price->source_type == \common\models\Price::SOURCE_TYPE_LOCAL): ?>
                                        <i class="fe fe-upload" style="padding-top: 10px;"></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($price->lastUpdate): ?>
                                        <div class="small text-muted"><?= $price->lastUpdate->status ?></div>
                                        <div><?= $price->lastUpdate->humanTime ?></div>
                                    <?php else: ?>
                                        <div class="small text-muted">Еще не было</div>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="mx-auto chart-circle chart-circle-xs" data-value="0.42"
                                         data-thickness="3"
                                         data-color="blue">
                                        <canvas width="80" height="80" style="height: 40px; width: 40px;"></canvas>
                                        <div class="chart-circle-value">42%</div>
                                    </div>
                                </td>
                                <td class="text-center btn-p">
                                    <div class="item-action dropdown">
                                        <a href="javascript:void(0)" data-toggle="dropdown" class="icon"
                                           aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="/price/<?= $price->id ?>" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-edit-2"></i> Настроить</a>
                                            <?php if ($price->isForceUpdate()): ?>
                                                <a href="#" data-id="<?= $price->id ?>"
                                                   data-provider-id="<?= $price->provider_id ?>"
                                                   class="price-action-force-update dropdown-item"><i
                                                            class="dropdown-icon fe fe-repeat"></i> Обновить сейчас</a>
                                            <?php endif; ?>
                                            <?php if ($price->isActive()): ?>
                                                <a href="#" data-id="<?= $price->id ?>"
                                                   class="price-action-off dropdown-item"><i
                                                            class="dropdown-icon fe fe-pause"></i> Отключить</a>
                                            <?php else: ?>
                                                <a href="#" data-id="<?= $price->id ?>"
                                                   class="price-action-on dropdown-item"><i
                                                            class="dropdown-icon fe fe-play"></i> Включить</a>
                                            <?php endif; ?>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-trash-2"></i> Удалить</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>


<script>
    require(['jquery', 'bootstrap'], function ($, bootstrap) {
        $('.price-action-off').on('click', function (e) {
            e.preventDefault();
            ui.question({
                title: 'Отключить прайс?',
                message: 'Он не будет обновляться и выгружаться, а также не будет доступен в календаре',
                yes: 'Отключить',
                no: 'Нет',
                success: {title: 'Прайс отключен', message: 'Включить его вы сможете на этой странице в любое время'},
                onsuccess: function () {
                    //ajax off
                },
                cancel: false,
            })
        })

        $('.price-action-force-update').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id'),
                providerId = $(this).data('provider-id');
            ui.question({
                title: 'Обновить прайс?',
                message: '',
                yes: 'Да',
                no: 'Нет',
                success: {title: 'Обновление запланировано', message: 'Прайс будет обновлен в ближайшее время'},
                onsuccess: function () {
                    ui.api({url: 'price/' + id + '/forceupdate', eid: providerId});
                },
                cancel: false,
            })
        })
    });
</script>