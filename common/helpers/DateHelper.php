<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 20.09.2018
 * Time: 11:49
 */

namespace common\helpers;


class DateHelper
{
    const MON = 2;
    const TUE = 4;
    const WES = 8;
    const THU = 16;
    const FRI = 32;
    const SAT = 64;
    const SUN = 128;


    /**
     * Функция склонения числительных в русском языке 1, 3, 5
     *
     * @param int $number Число которое нужно просклонять
     * @param array $titles Массив слов для склонения
     * @return string
     **/
    public static function decOfNum($number, $titles = ['минута', 'минуты', 'минут'])
    {
        $cases = array(2, 0, 1, 1, 1, 2);
        return $number . " " . $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
    }


    /**
     * Возвращает дату в человекопонятном формате (5 минут назад, никогда, 14 сентября 13:48)
     *
     * @param int $timestamp
     * @return string
     */
    public static function human($timestamp)
    {

        //dd($timestamp);


        $timestamp = intval($timestamp);

        if (!$timestamp) {
            return 'никогда';
        }


        $mouths = [
            'января',
            'февраля',
            'марта',
            'апреля',
            'мая',
            'июня',
            'июля',
            'августа',
            'сентября',
            'октября',
            'ноября',
            'декабря'
        ];
        $now = time();


        if ($timestamp > $now) {
            return 'в будущем';
        }

        $rat = $now - $timestamp;

        if ($rat <= 60) {
            return 'только что';
        }

        if ($rat <= 3600) {
            $minutes = ceil($rat / 60);
            return $minutes . ' ' . self::decOfNum($minutes) . ' назад';
        }

        if ($rat <= 10800) {
            $hours = ceil($rat / 3600);
            $hoursTxt = 'час';
            if ($hours == 2) {
                $hoursTxt = 'два';
            }
            if ($hours == 3) {
                $hoursTxt = 'три';
            }
            return $hoursTxt . ' ' . self::decOfNum($hours, ['час', 'часа', 'часов']) . ' назад';
        }

        $dayStart = mktime(0, 0, 0);
        $yesterdayStart = mktime(0, 0, 0) - 86400;

        if ($timestamp >= $dayStart) {
            $start = 'сегодня';
        } else if ($timestamp >= $yesterdayStart) {
            $start = 'вчера';
        } else {
            $month = date('n', $timestamp) - 1;
            $start = date('d', $timestamp) . ' ' . $mouths[$month];
        }

        return $start . ' в ' . date('H:i');

    }

    public static function getHoursArray()
    {
        $z = [];
        for ($i = 0; $i < 24; $i++) {
            $v = ($i < 10) ? ('0' . $i) : $i;
            $z[$v] = $v;
        }
        return $z;
    }

    public static function getMinutesArray()
    {
        $z = [];
        for ($i = 0; $i < 60; $i += 5) {
            $v = ($i < 10) ? ('0' . $i) : $i;
            $z[$v] = $v;
        }
        return $z;
    }

}