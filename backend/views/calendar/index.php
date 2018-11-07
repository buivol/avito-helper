<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Календарь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row row-cards">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Календарь</div>
            </div>
            <div class="card-body">
                <div id="calendar">

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Выбранная дата</div>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>


<script>
    require(['calendar', 'jquery'], function (calendar, $) {
        $(document).ready(function () {
            var currentYear = new Date().getFullYear();
            console.log('calendar init', currentYear)
            $('head').append('<link rel="stylesheet" type="text/css" href="/v1/src/assets/css/calendar.css">');
            $('#calendar').calendar({
                enableContextMenu: false,
                enableRangeSelection: true,
                style: 'background',
                contextMenuItems: [

                ],
                selectRange: function(e) {
                    console.log('range', e);
                    //editEvent({ startDate: e.startDate, endDate: e.endDate });
                },
                dataSource: [
                    {
                        startDate: new Date(currentYear, 1, 4),
                        endDate: new Date(currentYear, 1, 15)
                    },
                    {
                        startDate: new Date(currentYear, 3, 5),
                        endDate: new Date(currentYear, 5, 15)
                    },
                    {
                        startDate: new Date(currentYear, 5, 7),
                        endDate: new Date(currentYear, 6, 7)
                    },
                    {
                        startDate: new Date(currentYear, 5, 3),
                        name: 'test',
                        color: 'lime',
                        endDate: new Date(currentYear, 5, 9)
                    }
                ]

            });
        });
    });
</script>





