<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 09.10.2018
 * Time: 11:29
 */

namespace common\helpers;


use common\models\Price;

class Parser
{

    public static function checkMime($type, $mime)
    {
        $map = [
            Price::TYPE_XLS => [
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => true,
            ]
        ];
        return isset($map[$type][$mime]);
    }

    /**
     * @param array $row
     * @param array $conditions
     *
     * @return bool
     */
    public static function checkConditions($row, $conditions)
    {
        $add = true;
        foreach ($conditions as $condition) {
            if ($condition['active'] && array_key_exists($condition['col'], $row)) {
                $col = isset($row[$condition['col']]);
                $cond = $condition['condition'];
                if ($cond == ExcelParser::CONDITION_BETTER) {
                    $usl = ((float)$col > (float)$condition['text']);
                } else if ($cond == ExcelParser::CONDITION_BETTER_OR_EQUAL) {
                    $usl = ((float)$col >= (float)$condition['text']);
                } else if ($cond == ExcelParser::CONDITION_EMPTY) {
                    $usl = ($col == null || $col == '');
                } else if ($cond == ExcelParser::CONDITION_EQUAL) {
                    $usl = ($col == $condition['text']);
                } else if ($cond == ExcelParser::CONDITION_NO_EQUAL) {
                    $usl = ($col != $condition['text']);
                } else if ($cond == ExcelParser::CONDITION_NOT_EMPTY) {
                    $usl = !($col == null || $col == '');
                } else if ($cond == ExcelParser::CONDITION_NOT_EMPTY) {
                    $usl = !($col == null || $col == '');
                } else if ($cond == ExcelParser::CONDITION_WORSE) {
                    $usl = ((float)$col < (float)$condition['text']);
                } else if ($cond == ExcelParser::CONDITION_WORSE_OR_EQUAL) {
                    $usl = ((float)$col <= (float)$condition['text']);
                } else {
                    $usl = false;
                }

                if ($usl) {
                    $add = $condition['action'] == 'add';
                } else {
                    $add = $condition['action'] == 'skip';
                }
            }
        }
        return $add;
    }

    public static function getMimeType($filename)
    {
        $mimetype = false;
        if (function_exists('finfo_fopen')) {
            // open with FileInfo
        } elseif (function_exists('getimagesize')) {
            // open with GD
        } elseif (function_exists('exif_imagetype')) {
            // open with EXIF
        } elseif (function_exists('mime_content_type')) {
            $mimetype = mime_content_type($filename);
        }
        return $mimetype;
    }
}