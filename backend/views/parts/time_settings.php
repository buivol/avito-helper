<?php
/* @var $this yii\web\View */
?>
<table class="table card-table table-striped table-vcenter">
    <tr>
        <td class="w-1">&nbsp;</td>
        <td class="text-center">Публиковать после</td>
        <td class="text-center">до</td>
    </tr>
    <?= $this->render('//parts/time_settings_day', ['day' => 'Пн', 'daySym' => 'mon']) ?>
    <?= $this->render('//parts/time_settings_day', ['day' => 'Вт', 'daySym' => 'tue']) ?>
    <?= $this->render('//parts/time_settings_day', ['day' => 'Ср', 'daySym' => 'wed']) ?>
    <?= $this->render('//parts/time_settings_day', ['day' => 'Чт', 'daySym' => 'thu']) ?>
    <?= $this->render('//parts/time_settings_day', ['day' => 'Пт', 'daySym' => 'fri']) ?>
    <?= $this->render('//parts/time_settings_day', ['day' => 'Сб', 'daySym' => 'sat']) ?>
    <?= $this->render('//parts/time_settings_day', ['day' => 'Вс', 'daySym' => 'sun']) ?>
</table>
