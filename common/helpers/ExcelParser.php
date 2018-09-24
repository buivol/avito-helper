<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 24.09.2018
 * Time: 10:35
 */

namespace common\helpers;


class ExcelParser
{

    const CONDITION_EQUAL = 'equal';
    const CONDITION_NO_EQUAL = 'no_equal';
    const CONDITION_EMPTY = 'empty';
    const CONDITION_NOT_EMPTY = 'not_empty';
    const CONDITION_BETTER = 'better';
    const CONDITION_WORSE = 'worse';
    const CONDITION_BETTER_OR_EQUAL = 'better_or_equal';
    const CONDITION_WORSE_OR_EQUAL = 'worse_or_equal';

    public static function getABCArray($notRequired = false, $notRequiredOptions = ['' => 'Отсутствует'])
    {

        $z = [
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
            'E' => 'E',
            'F' => 'F',
            'G' => 'G',
            'H' => 'H',
            'I' => 'I',
            'J' => 'J',
            'K' => 'K',
            'L' => 'L',
            'M' => 'M',
            'N' => 'N',
            'O' => 'O',
            'P' => 'P',
            'Q' => 'Q',
            'R' => 'R',
            'S' => 'S',
            'T' => 'T',
            'U' => 'U',
            'V' => 'V',
            'W' => 'W',
            'X' => 'X',
            'Y' => 'Y',
            'Z' => 'Z',
        ];
        if($notRequired) {
            $z = $notRequiredOptions + $z;
        }
        return $z;
    }


    public static function getConditionsArray()
    {
        return [
            self::CONDITION_EQUAL => 'Равна',
            self::CONDITION_NO_EQUAL => 'Не равна',
            self::CONDITION_EMPTY => 'Пустая',
            self::CONDITION_NOT_EMPTY => 'Не пустая',
            self::CONDITION_BETTER => 'Больше',
            self::CONDITION_WORSE => 'Меньше',
            self::CONDITION_BETTER_OR_EQUAL => 'Больше или равна',
            self::CONDITION_WORSE_OR_EQUAL => 'Меньше или равна',
        ];
    }
}