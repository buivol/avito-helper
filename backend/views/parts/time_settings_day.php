<?php
/**
 * @var string $daySym
 * @var string $day
 */
?>
<tr>
    <td class="w-1">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input type="checkbox" class="custom-control-input" id="timeSettingsDay<?= $daySym ?>Active" checked="">
            <span class="custom-control-label"><?= $day ?></span>
        </label>
    </td>
    <td class="text-center">
        <div class="row">
            <div class="col-6">
                <?= \yii\bootstrap\Html::dropDownList('', '08', \common\helpers\DateHelper::getHoursArray(), ['id' => 'timeSettingsDay' . $daySym . 'StartHours', 'class' => 'form-control custom-select']) ?>
            </div>
            <div class="col-6">
                <?= \yii\bootstrap\Html::dropDownList('', '00', \common\helpers\DateHelper::getMinutesArray(), ['id' => 'timeSettingsDay' . $daySym . 'StartMinutes', 'class' => 'form-control custom-select']) ?>
            </div>
        </div>
    </td>
    <td class="text-center">
        <div class="row">
            <div class="col-6">
                <?= \yii\bootstrap\Html::dropDownList('', '22', \common\helpers\DateHelper::getHoursArray(), ['id' => 'timeSettingsDay' . $daySym . 'EndHours', 'class' => 'form-control custom-select']) ?>
            </div>
            <div class="col-6">
                <?= \yii\bootstrap\Html::dropDownList('', '00', \common\helpers\DateHelper::getMinutesArray(), ['id' => 'timeSettingsDay' . $daySym . 'EndMinutes', 'class' => 'form-control custom-select']) ?>
            </div>
        </div>
    </td>
</tr>