<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30.01.2017
 * Time: 0:06
 */

namespace models;


use app\db\ActiveRecord;

class  CommentMark extends ActiveRecord
{
    protected $table = 'comment_marks';
    protected $fillable = ['comment_id','user_id','mark'];

    public function exist($comment_id){
        $user =$_SESSION['user'];
        $comment = $this->select()->where("comment_id = $comment_id AND user_id = $user ")->all();
        if(count($comment)==1){
            echo "true";
            return true;

        }else{
            echo "asdf";
            false;
        }
    }

    public function update($mark,$comment_id)
    {
        $user =$_SESSION['user'];
        $this->query("UPDATE `comment_marks` SET `mark`= $mark WHERE comment_id = $comment_id AND user_id = $user ");
    }

}