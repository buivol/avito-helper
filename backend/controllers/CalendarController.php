<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 31/10/2018
 * Time: 12:35
 */

namespace backend\controllers;


class CalendarController extends BackendController
{

    public $menu = 'calendar';

    public function actionIndex()
    {
        return $this->render('index');
    }

}