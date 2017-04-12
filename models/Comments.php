<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30.01.2017
 * Time: 0:06
 */

namespace models;


use app\db\ActiveRecord;

class Comments extends ActiveRecord
{
    protected $table = 'comments';
    protected $primaryKey = 'comment_id';
    protected $fillable = ['comment','user_id','book_id','parent_id'];
    public function getRestComments($id,$start,$user_id=17)
    {
        return $this->select(" (SELECT AVG(comment_marks.mark) FROM comment_marks WHERE comment_marks.comment_id = comments.comment_id) as rating,
        comments.comment_id,comments.comment,comments.created_at,comments.parent_id,users.id,users.name,users.img,comment_marks.mark")
            ->where("book_id = '$id' AND parent_id = 0 ")
            ->join([
                ["users on users.id = comments.user_id
                LEFT JOIN comment_marks on comment_marks.comment_id = comments.comment_id AND comment_marks.user_id = $user_id
                "]
            ])->order(" comments.created_at DESC ")->limit($start, 8)->all();
    }

    public function children($id)
    {

        $user =1 ;
if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
}
        return $this->select(" (SELECT AVG(comment_marks.mark) FROM comment_marks WHERE comment_marks.comment_id = comments.comment_id) as rating,
        comments.comment_id,comments.comment,comments.created_at,comments.parent_id,users.id,users.name,users.img,comment_marks.mark")
            ->where("parent_id = $id ")
            ->join([
                ["users on users.id = comments.user_id
                LEFT JOIN comment_marks on comment_marks.comment_id = comments.comment_id AND comment_marks.user_id = $user
                "]
            ])->order(" comments.created_at ")->all();
    }
    public function edit($id,$comment){
        $this->query("UPDATE `comments` SET `comment`='$comment' WHERE comment_id = $id");
    }
    public function count($id){
      return  $this->select("count(comment_id) as count")->where("book_id = $id")->one();
    }
    public function reting($id){
      $query =   $this->query("SELECT AVG(mark) as reting FROM comment_marks WHERE comment_id = $id");
        return $this->assoc($query);
    }
}