<?php
/**
 * @var string $daySym
 * @var string $day
 */
?>
<tr>
    <td class="w-1">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input type="checkbox" class="custom-control-input" id="time-settings-day-<?= $daySym ?>-active">
            <span class="custom-control-label"><?= $day ?></span>
        </label>
    </td>
    <td class="text-center">
        <div class="row">
            <div class="col-6">
                <?= \yii\bootstrap\Html::dropDownList('', '08', \common\helpers\DateHelper::getHoursArray(), ['id' => 'time-settings-day-' . $daySym . '-start-hours', 'class' => 'form-control custom-select']) ?>
            </div>
            <div class="col-6">
                <?= \yii\bootstrap\Html::dropDownList('', '00', \common\helpers\DateHelper::getMinutesArray(), ['id' => 'time-settings-day-' . $daySym . '-start-minutes', 'class' => 'form-control custom-select']) ?>
            </div>
        </div>
    </td>
    <td class="text-center">
        <div class="row">
            <div class="col-6">
                <?= \yii\bootstrap\Html::dropDownList('', '22', \common\helpers\DateHelper::getHoursArray(), ['id' => 'time-settings-day-' . $daySym . '-end-hours', 'class' => 'form-control custom-select']) ?>
            </div>
            <div class="col-6">
                <?= \yii\bootstrap\Html::dropDownList('', '00', \common\helpers\DateHelper::getMinutesArray(), ['id' => 'time-settings-day-' . $daySym . '-end-minutes', 'class' => 'form-control custom-select']) ?>
            </div>
        </div>
    </td>
</tr>