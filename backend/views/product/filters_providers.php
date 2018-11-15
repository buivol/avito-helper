<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $providers array */

?>


<ul class="ul-checkboxes">
    <?php foreach ($providers as $provider): ?>
        <li>
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input ui-sibl ui-sibl-parent filter-change-sibl" data-sibl="provider-<?= $provider['id'] ?>"
                       name="filterProvider[]"
                       value="<?= $provider['id'] ?>" checked="checked">
                <span class="custom-control-label count-label"><?= $provider['name'] ?><span><?= $provider['count'] ?></span></span>
            </label>
            <ul>
                <?php foreach ($provider['prices'] as $price): ?>
                <li>
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input ui-sibl ui-sibl-child filter-change-sibl" data-sibl="provider-<?= $price['parent_id'] ?>"
                               name="filterPrice[]"
                               value="<?= $price['id'] ?>" checked="checked">
                        <span class="custom-control-label count-label"><?= $price['name'] ?><span><?= $price['count'] ?></span></span>
                    </label>
                </li>
                <?php endforeach; ?>
            </ul>
        </li>

    <?php endforeach; ?>
</ul>