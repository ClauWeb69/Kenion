<?php
namespace Http\Models;

use Helper\Connection\DB;

class User
{
    function add($array = []){
        return DB::table("Users")
            ->insert($array)
            ->exec()
            ->last_id();
    }
    function get($where = []){
        $link = DB::table("Users");
        foreach ($where as $k => $b)
            $link->where($k, $b);
        return $link->exec()->get();
    }
    function current(){
        $link = DB::table("Users");
        $link->where("id", self::id());
        return $link->exec()->get();
    }
    function getAll($where = []){
        $link =DB::table("Users");
        foreach ($where as $k => $b)
            $link->where($k, $b);
        return $link->exec()->getAll();
    }
    function delete($key, $value){
        DB::table("Users")
            ->delete()
            ->where($key, $value)
            ->exec();
    }
    function update($updates = [], $where = []){
        $link = DB::table("Users");
        foreach ($updates as $k => $b)
            $link->update($k, $b);

        foreach ($where as $k => $b)
            $link->where($k, $b);

        $link->exec();
    }
    function hash($s = null){
        return hash("sha256", md5($s));
    }
    function id(){
        return isset($_SESSION["User"]["id"]) && !empty($_SESSION["User"]["id"]) ? $_SESSION["User"]["id"] : false;
    }
    function login($id){
        $_SESSION["User"]["id"] = (int)$id;
    }
    function logout(){
        if(isset($_SESSION["User"]["id"])) {
            unset($_SESSION["User"]["id"]);
            session_regenerate_id();
        }
    }
    function exist($where = []){
        $link=DB::table("Users");
        foreach ($where as $k => $b)
            $link->where($k, $b);
        return $link->exec()->count() > 0 ? true : false;
    }
    function is_login(){
        if(isset($_SESSION["User"]["id"]) && !empty($_SESSION["User"]["id"]))
            return true;
        return false;
    }
}