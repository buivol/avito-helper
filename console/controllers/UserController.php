<?php
/**
 * Created by PhpStorm.
 * User: buivol
 * Date: 14.08.2018
 * Time: 15:02
 */

namespace console\controllers;


use common\models\User;
use yii\console\Controller;

class UserController extends Controller
{
    public function actionCreate($email, $login, $password)
    {
        $user = new User();
        $user->email = $email;
        $user->setPassword($password);
        $user->username = $login;
        $user->generateAuthKey();
        $user->generatePasswordResetToken();
        $user->save(0);

        return 'saved';
    }
}