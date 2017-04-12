<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07.02.2017
 * Time: 10:47
 */

namespace controllers;

use models\Users;

class RegisterController extends Controller
{
    public function actionIndex()
    {
        $user = new Users();
        if(count($_POST)!=0 && $user->validate($_POST)){
            if($user->emailVerify($_POST['email'])){
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $user->create($_POST);
                return   header( 'Location: /login');
            }
        }
       $this->render('registration',['model'=>$user]);
    }



}