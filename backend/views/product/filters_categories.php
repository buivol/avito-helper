<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $categories array */

?>


<ul class="ul-checkboxes">
    <?php foreach ($categories as $category): ?>
        <li>
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input ui-sibl ui-sibl-parent filter-change-sibl" data-sibl="category-<?= $category['id'] ?>"
                       name="filterCategoryParent[]"
                       value="<?= $category['id'] ?>" checked="checked">
                <span class="custom-control-label count-label"><?= $category['name'] ?><span><?= $category['count'] ?></span></span>
            </label>
            <ul>
                <?php foreach ($category['subs'] as $sub): ?>
                <li>
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input ui-sibl ui-sibl-child filter-change-sibl" data-sibl="category-<?= $sub['parent_id'] ?>"
                               name="filterCategorySub[]"
                               value="<?= $sub['id'] ?>" checked="checked">
                        <span class="custom-control-label count-label"><?= $sub['name'] ?><span><?= $sub['count'] ?></span></span>
                    </label>
                </li>
                <?php endforeach; ?>
            </ul>
        </li>

    <?php endforeach; ?>
</ul>