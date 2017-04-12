<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.01.2017
 * Time: 20:22
 */
class Database extends app\Validator
{

    public $_bd;
    public $query;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        require_once ROOT . "/config.php";

        $obj_mysqli = new mysqli(HOST, USER, PASSWORD, DATA_BASE);
        if (@!$obj_mysqli->error) {
            $this->_bd = $obj_mysqli;
            $this->_bd->query("SET NAMES utf8");

        }
    }


    public function query($sql)
    {
//echo $sql;
        return $this->_bd->query($sql);
    }

    public function assoc($query)
    {
        while ($result = $query->fetch_assoc()) {
            $array[] = $result;
        }
        return $array;
    }

    public function fetch_array($query)
    {
        while ($result = $query->fetch_array()) {
            $array[] = $result;
        }
        return $array;
    }


}