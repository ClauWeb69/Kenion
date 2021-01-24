<?php
namespace Helper\Middleware\Permissions;

use Helper\Connection\DB;
use Helper\Middleware\Permissions\Group;
use Helper\Middleware\Permissions\Role;
use Helper\Middleware\Permissions\User;

class Permissions
{
    function add($array = []){
        return DB::table("permissions")
            ->insert($array)
            ->exec()
            ->last_id();
    }
    function get($where = []){
        $link = DB::table("permissions");
        $link->select(["*"]);
        foreach ($where as $k => $b)
            $link->where($k, $b);
        return $link->exec()->get();
    }
    function getAll($where = []){
        $link = DB::table("permissions");
        $link->select(["*"]);
        foreach ($where as $k => $b)
            $link->where($k, $b);
        return $link->exec()->getAll();
    }
    function delete($key, $value){
        DB::table("permissions")
            ->delete()
            ->where($key, $value)
            ->exec();
    }
    function update($updates = [], $where = []){
        $link = DB::table("permissions");
        foreach ($updates as $k => $b)
            $link->update($k, $b);
        foreach ($where as $k => $b)
            $link->where($k, $b);
        $link->exec();
    }
    function group(){
        return parent::Group;
    }
    function role(){
        return parent::Role;
    }
    function user(){
        return new User;
    }
}