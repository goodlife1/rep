<?php

namespace models;

use app\db\ActiveRecord;

class Users extends ActiveRecord
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'password'];

    protected function rules()
    {
        return [
            [['password','email'],'required','message'=>'всі поля мають бути заповнені']
        ];
    }
    public function getByEmail($email){
        return $this->select()->where("email = '$email'")->one();
    }

    public function emailVerify($email)
    {

        if (count($this->select()->where("email = '$email'")->all())) {
            $this->errors[] = 'Ця електронна пошта вже зареєстррована';
            return false;
        } else

            return true;

    }
    public function editImg($path){
        $id = $_SESSION['user'];
        $this->query("UPDATE `users` SET `img`='$path' WHERE id =  $id");
    }
}