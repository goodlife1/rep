<?php
/**
 * Created by PhpStorm.
 * User: Vasya
 * Date: 26.01.2017
 * Time: 16:43
 */

namespace controllers;

use models\Books;
use models\CommentMark;
use models\Comments;


class BooksController extends Controller
{
    public $tpl;

    public function actionIndex()
    {
        $book = new Books();
        if (isset($_POST['position'])) {
            @$model = $book->getBooksInf(($_POST['position'] - 1) * 9);
            echo json_encode($model);
            exit();
        }
        $model = $book->getBooksInf(0);
        $count = $book->count();
        $count = ceil($count['count'] / 9);
        return $this->render('show_books', ['model' => $model, 'count' => $count]);
    }


    public function actionShow($id)
    {
        $model = new Books();
        $comment = new Comments();
        $model = $model->find($id);
        $comments = $comment->count($id);
        $number = ceil($comments['count'] / 8);

        return $this->render('show_book',
            ['model' => $model, 'comments' => $number, 'comment_model' => $comment, 'id' => $id]);
    }

    public function actionComments($book_id, $id)
    {
        $comment = new Comments();

        $user = 1;
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }
        $array['parent'] = $comment->getRestComments($book_id, ($id - 1) * 8, $user);
        $children = new Comments();
        if (count($array['parent']) > 0)
            foreach ($array['parent'] as $parent) {
                $array['children'][$parent['comment_id']] = $children->children($parent['comment_id']);

            }



        echo json_encode($array);

    }


    public function actionNew_Book()
    {

        $book = new Books();
        if (count($_POST) && $book->validate($_POST)) {
            $key = '';
            $keys = array_merge(range(0, 9), range('a', 'z'));

            for ($i = 0; $i < 9; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $type = explode("/", $_FILES['img']['type']);
            $name = "/public/image/$key." . $type[1];
            $uploadfile = ROOT . "/public/image/$key." . $type[1];
            move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile);
            $book->create([
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'year_production' => $_POST['year'],
                'image_path' => $name
            ]);
            header("Location: /");
        }
        return $this->render('new_book', ['model' => $book]);
    }

    public function actionNew_Comment($id = 0)
    {
        $comment = new Comments();
        if (isset($_POST['comment'])) {
            $comment->create([
                'user_id' => $_SESSION['user'],
                'comment' => $_POST['comment'],
                'book_id' => $_POST['book_id'],
                'parent_id' => $id
            ]);
        }
    }

    public function actionComment_Mark($marc, $comment_id)
    {

        $model = new CommentMark();
        if ($model->exist($comment_id)) {
            $model->update($marc, $comment_id);
        } else {
            $mark = new CommentMark();
            $mark->create([
                'mark' => $marc,
                'comment_id' => $comment_id,
                'user_id' => $_SESSION['user']
            ]);
        }
    }

    public function actionDelete_Comment($id)
    {
        $comment = new Comments();
        $comment->delete(" comment_id = $id");
    }

    public function actionEdit_Comment($id)
    {
        $comment = new Comments();
        $comment->edit($id, $_POST['comment']);
    }


}