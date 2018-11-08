<?php
/**
 * @var int $id
 * @var array $config
 * @var string $day
 */
?>
<td class="text-center sub-time-td<?= $config[$day]['active'] ? '' : ' sub-time-td-inactive' ?>" id="sub-time-td-<?= $id ?>">
    <span id="sub-<?= $id ?>-<?= $day ?>-start-hours"><?= $config[$day]['start']['hours'] ?></span>:<span id="sub-<?= $id ?>-<?= $day ?>-start-minutes"><?= $config[$day]['start']['minutes'] ?></span>&nbsp;
    <span id="sub-<?= $id ?>-<?= $day ?>-end-hours"><?= $config[$day]['end']['hours'] ?></span>:<span id="sub-<?= $id ?>-<?= $day ?>-end-minutes"><?= $config[$day]['end']['minutes'] ?></span>
</td>

