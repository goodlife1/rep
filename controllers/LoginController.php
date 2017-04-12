<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07.02.2017
 * Time: 10:47
 */

namespace controllers;

use models\Users;

class LoginController extends Controller
{
    public function actionIndex()
    {
        $model = new Users();
        if (count($user = $model->getByEmail($_POST['email']))) {
            if ($this->passwordVerify($user)) {
                $_SESSION['user'] = $user['id'];
                return header('Location: /');

            }
        }
        return $this->render('login');
    }

    private function passwordVerify($user)
    {
        if (password_verify($_POST['password'], $user['password'])) {
            return true;
        } else
            return false;
    }

    public function actionLogout()
    {
        unset($_SESSION['user']);
        return header('Location: /');
    }

    public function actionEdit()
    {
    $user = new Users();
        if (count($_FILES) ) {

            $key = '';
            $keys = array_merge(range(0, 9), range('a', 'z'));

            for ($i = 0; $i < 9; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $type = explode("/", $_FILES['img']['type']);
            $name ="/public/image/$key.".$type[1];
            $uploadfile = ROOT."/public/image/$key.".$type[1];
            move_uploaded_file($_FILES['img']['tmp_name'] , $uploadfile);
            $user->editImg($name);
            header("Location: /");
        }

        return $this->render('photo_edit');
    }

}