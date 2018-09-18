<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 31.08.2018
 * Time: 12:31
 */

namespace backend\controllers;


use common\models\User;
use yii\web\Controller;

/**
 * Backend Controller
 *
 * @property User $user
 */
class BackendController extends Controller
{
    public $user = null;

    public function beforeAction($action)
    {
        if($action->id == 'login' || $action->id == 'logout'){
            return parent::beforeAction($action); // TODO: Change the autogenerated stub
        }

        if(\Yii::$app->user->isGuest){
//            dd('redirect');
            header('Location: /login');
            die();
        }

        $this->user = \Yii::$app->getUser()->getIdentity();

        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
}