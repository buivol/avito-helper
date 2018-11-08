<?php
/* @var $this yii\web\View */
?>
<div id="timeSettingsModal" style="display: none;">
    <table class="table card-table table-striped table-vcenter">
        <tr>
            <td class="w-1">&nbsp;</td>
            <td class="text-center">Публиковать после</td>
            <td class="text-center">до</td>
        </tr>
        <?= $this->render('//parts/time_settings_day', ['day' => 'Пн', 'daySym' => 'Mon']) ?>
        <?= $this->render('//parts/time_settings_day', ['day' => 'Вт', 'daySym' => 'Tue']) ?>
        <?= $this->render('//parts/time_settings_day', ['day' => 'Ср', 'daySym' => 'Wed']) ?>
        <?= $this->render('//parts/time_settings_day', ['day' => 'Чт', 'daySym' => 'Thu']) ?>
        <?= $this->render('//parts/time_settings_day', ['day' => 'Пт', 'daySym' => 'Fri']) ?>
        <?= $this->render('//parts/time_settings_day', ['day' => 'Сб', 'daySym' => 'Sat']) ?>
        <?= $this->render('//parts/time_settings_day', ['day' => 'Вс', 'daySym' => 'Sun']) ?>
    </table>
</div>