<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30.01.2017
 * Time: 0:06
 */

namespace models;


class Search extends \Database
{
    public function Search($element)
    {
        $query = $this->query("SELECT `name` FROM books   WHERE `name` LIKE '%" . $element . "%' 
  UNION ALL
SELECT `name` as authors FROM authors   WHERE `name` LIKE '%" . $element . "%' 
  UNION ALL
SELECT `name` FROM publishers  WHERE `name` LIKE '%" . $element . "%'");
        $result = $this->assoc($query);
        return $result;
    }

    public function bookSearch($source)
    {
        if ($source['author'] != "") {
            $query = $this->query("SELECT bk.name from books bk  
LEFT OUTER JOIN authors au on bk.author_id = au.author_id  WHERE au.name LIKE '%" . $source['author'] . "%'");
            $result = $this->assoc($query);
        } else if ($source['publishers'] != "") {

            $query = $this->query("SELECT bk.name from books bk  
LEFT OUTER JOIN publishers ps on bk.publisher_id = ps.publisher_id WHERE ps.name LIKE '%" . $source['publication'] . "%'");
            $result = $this->assoc($query);
        }

        return $result;
    }

}