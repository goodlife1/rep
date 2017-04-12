<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02.02.2017
 * Time: 0:59
 */
namespace app\db;

class ActiveRecord extends \Database
{
    protected $table;
    protected  $primaryKey = 'id';
    protected $fillable = array();
    private $param = " * ";
    public $sql;
    private $where = "";
    private $join = "";
    private $order = "";
    private $how ="";
    private $limit = "";
    public function find($id){
     return $this->sql =  $this->select()->where("$this->primaryKey = $id")->one();
    }
    protected  function select($request = "*")
    {
        $this->sql = "";
        if (isset($request)) {
            $this->param = " " . $request . " ";
        }
        $this->sql = "SELECT " . $this->param . " FROM " . $this->table . " ";
        return $this;
    }
    protected function how($name){
        $this->how = $name;
        return $this;
    }
    public function all()
    {
        $this->sql .= $this->how.$this->join . $this->where . $this->order.$this->limit;
//        echo $this->sql;
        $query = $this->_bd->query($this->sql);
        return $this->assoc($query);
    }

    protected function one()
    {
        $this->sql .= $this->join . $this->where . $this->order;
        $query = $this->_bd->query($this->sql);
        return $query->fetch_assoc();
    }
    protected function limit($start,$count){
        $this->limit .= "LIMIT $start,$count";
        return $this;
    }
    protected function where($condition)
    {
        $this->where = " WHERE " . $condition." ";
        return $this;
    }

    public function delete($condition)
    {
        $this->sql = "DELETE FROM `" . $this->table . "` WHERE " . $condition." ";
//        echo $this->sql;
        $this->query($this->sql);
    }

    protected function join($param = [])
    {
        $array = array();
        foreach ($param as $value) {
            $array[] = $value[0];
        }
        if (count($param) >= 1) {
            $this->join = " LEFT OUTER JOIN " . implode(" LEFT OUTER JOIN ", $array);
        }
        return $this;
    }

    protected function order($order)
    {
        $this->order = " ORDER BY " . $order;
        return $this;
    }

    public function create($array)
    {
        foreach ($this->fillable as $value) {
            $keys[] = $value;
            $values[] = $array[$value];
        }
        $query = "INSERT INTO $this->table (";
        foreach ($keys as $value) {
            $query .= "`$value`, ";
        }

        $query = substr($query, 0, -2);
        $query .= ") VALUES (";
        foreach ($values as $value) {
            $query .= "'$value', ";
        }
        $query = substr($query, 0, -2);
        $query .= ");";
        $this->_bd->query($query);
    }



}