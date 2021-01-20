<?php
namespace Helper\Connection;
use \PDO;

class DB
{
    private static $conn = null;
    private static $table = null;
    private static $column = [];
    private static $query = null;
    private static $binds = [];
    private static $where = [];
    private static $bind = [];

    private static $select = null;
    private static $update = [];

    private static $link = null;
    function connect($database = null){
        $db_name = DB_DATABASE;
        if($database && !empty($database))
            $db_name = $database;

        self::$conn = new PDO('mysql:dbname='.$db_name.';host='.DB_HOST.';charset=utf8', DB_USER, DB_PASSW);
        self::$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    }

    function query($query){
        self::$query = $query;
        self::$link = static::$conn->prepare($query);
        return new self;
    }

    function bind($key, $value, $param = PDO::PARAM_STR){
        self::$binds[$key] = $value;
        self::$link->bindParam($key, $value, $param);
        return new self;
    }
    function table($table){
        self::$table = $table;
        return new self;
    }
    function select($column = []){
        self::$column = $column;
        $coln = "";
        foreach ($column as $cl)
            $coln .= $cl.",";

        $coln = rtrim($coln, ",");
        self::$query = "SELECT ".$coln." FROM ".self::$table." ";
        return new self;
    }
    function update($n, $v){
        self::$update[] = [$n => $v];

        self::$query = "UPDATE ".self::$table." SET ";
        foreach(self::$update as $k => $value){
            foreach($value as $key => $val) {
                self::$bind[] = $val;
                $index = end(array_keys(self::$bind));
                self::$query .= $key . " = :{$index},";
            }
        }
        self::$query = rtrim(self::$query, ",");
        return new self;
    }
    function where($key, $value, $or = false){
        $index = end(array_keys(self::$bind))+1;
        self::$where[$index][$key] = [$or => $value];
        self::$bind[$index] = $value;
        return new self;
    }
    function last_id(){
        return self::$link->lastInsertId();
    }
    function exec(){
        self::queryBuild();
        self::$link->execute();
        return new self;
    }
    function queryBuild(){
        if(!empty(self::$table)){
            if(count(self::$where) > 0){
                $whereStr = "WHERE ";
                $count = count(self::$where);
                foreach(self::$where as $idW => $whS){
                    foreach($whS as $key => $value){
                        foreach($value as $k => $b){
                            $count--;
                            $whereStr .="{$key}=:{$idW}".($count>0 ? ($k ? " OR " : " AND ") : "");
                        }
                    }
                }
                self::$query .= " ".$whereStr;
            }
            self::query(self::$query);
            if(count(self::$bind) > 0){
                foreach(self::$bind as $k => &$b) {
                    self::$link->bindParam(":".$k, $b);
                }
            }
        }
    }
    function getAll(){
        return self::$link->fetchAll(PDO::FETCH_ASSOC);
    }
}
