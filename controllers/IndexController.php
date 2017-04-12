<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07.02.2017
 * Time: 10:48
 */

namespace controllers;


class IndexController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionAuthor()
    {
        return $this->render('author');
    }
}