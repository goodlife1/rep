<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 03.02.2017
 * Time: 12:07
 */

namespace models;

use app\db\ActiveRecord;
use models\Genres;
use models\Authors;
use models\Publishers;

class Books extends ActiveRecord
{
    public $author;
    public $publisher;
    public $genres;
    protected $table = "books";
    public $books;
    protected $fillable = ['name','description','year_production','image_path'];
public function count(){
    return $this->select("count('id')as count")->one();
}

    protected function rules()
    {
        return [
            [['name', 'description', 'year'], 'required', 'message' => 'Всі поля мають бути заповнені'],
        ];
    }


    public function ech(){
        return 'da nu ladna';
    }

    public function getBooksInf($id)
    {
        $result = $this->select()->limit($id, 9)->all();
        return   $result;
    }

    public function addNewBook($array)
    {
        $this->insert([
            'id' => NULL,
            'author_id' => $array['author_name'],
            'genres_id' => $array['genre'],
            'publisher_id' => $array['publisher'],
            'name' => $array['book_name'],
            'count_pages' => $array['count_page'],
            'publishing_year' => $array['date_published'],
            'date_of_receipt' => $array['date_admission']
        ]);
    }



}