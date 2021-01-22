<?php
namespace Helper\Middleware\Permissions;

use Helper\Connection\DB;
use Helper\Middleware\Permissions\Group;
use Helper\Middleware\Permissions\Role;

class Permissions implements Group,Role
{
    function add($array = []){
        return DB::table("permissions")
            ->insert($array)
            ->exec()
            ->last_id();
    }
    function get($where = []){
        $link = DB::table("permissions");
        foreach ($where as $k => $b)
            $link->where($k, $b);
        return $link->exec()->get();
    }
    function current(){
        $link = DB::table("permissions");
        $link->where("id", self::id());
        return $link->exec()->get();
    }
    function getAll($where = []){
        $link =DB::table("permissions");
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
    function Role(){
        return parent::Role;
    }
}