<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 07/11/2018
 * Time: 14:01
 */

/* @var $this yii\web\View */
/* @var $categories \common\models\Category[] */

?>
<div class="col-md-10">
    <div class="card">
        <div class="card-header">
            Неотсортированные
            <div class="card-options">
                <a href="#save-sort" class="btn btn-primary btn-sm ml-2">Сохранить</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-striped table-vcenter">
                <thead>
                <tr>
                    <th colspan="2">Пример товара</th>
                    <th>Маркет</th>
                    <th>Назначить категорию</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="w-1"><span class="avatar"
                                          style="border-radius: 4px; width: 75px; height: 75px; background-image: url(https://placezombie.com/640x360?r=1)"></span>
                    </td>
                    <td>Наушники ASUS rogue 12x wifi bluetooth</td>
                    <td>Игровые наушники ASUS</td>
                    <td>
                        <select class="form-control">
                            <option hidden>Выбрать категорию</option>
                            <?php foreach ($categories as $category): ?>
                                <?php if (count($category->subCategories)) : ?>
                                    <optgroup label="<?= $category->name ?>">
                                        <?php foreach ($category->subCategories as $subCategory): ?>
                                            <option value="<?= $subCategory->id ?>"><?= $subCategory->name ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>