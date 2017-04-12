<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.01.2017
 * Time: 19:05
 */

namespace controllers;


class Controller
{

    public $valid_error = array();
    public $file_path;
    public $key_get = array('author_name', 'book_name', 'page_count', 'year', 'edition_name', 'date_admission');
    public $array_assoc;
    public $tpl;
    public $args;

    public function __construct()
    {
    }


    public function breakToArray($str)
    {
        $array = explode("\n", $str);

        foreach ($array as $key => $value) {

            $value = trim($value);
            $array[$key] = explode("\t", $value);
        }
        unset($array[count($array) - 1]);


        return $array;
    }


    public function getResult($description, $answer)
    {
        if (is_array($answer)) {
            $answer = implode(" ", $answer);
        }
        return $description . " " . $answer;
    }


    public function extract_sub_array($array, $key)
    {
        $sub_arr = array();
        foreach ($array as $keys => $value) {
            $sub_arr[$keys] = $value[$key];

        }
        return $sub_arr;
    }

    public function trans_arr_assoc($array)
    {
        foreach ($array as $key => $value) {
            $this->array_assoc[$key] = array_combine($this->key_get, $value);
        }

        return $this->array_assoc;
    }

    public function render($tpl_name, $args_assoc= [])
    {
        $this->args = $args_assoc;
        $this->tpl = $tpl_name;
        include ROOT . "/view/default/main.php";


    }

    public function render_view($tpl_name, $args_assoc = [])
    {
        if (count($args_assoc) != 0) {
            $this->args = $args_assoc;
        }
        if (count($this->args) != 0) {
            extract($this->args);
        }

        include ROOT . "/view/default/" . $tpl_name . ".php";
    }
}