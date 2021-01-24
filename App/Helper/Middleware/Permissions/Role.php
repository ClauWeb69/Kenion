<?php
namespace Helper\Middleware\Permissions;

use Helper\Connection\DB;

class Role
{
    function add($array = []){
        return DB::table("permissions_role")
            ->insert($array)
            ->exec()
            ->last_id();
    }
    function user($id){
        $link = DB::query("SELECT * FROM permissions_role_user
                                LEFT OUTER JOIN permissions_role ON permissions_role_user.user = permissions_role.user
                                WHERE permissions_role_user.user = :iduser");
        $link->bind(":iduser", $id);
        return $link->exec()->getAll();
    }
    function get($where = []){
        $link = DB::table("permissions_role");
        $link->select(["*"]);
        foreach ($where as $k => $b)
            $link->where($k, $b);
        return $link->exec()->get();
    }
    function getAll($where = []){
        $link = DB::table("permissions_role");
        $link->select(["*"]);
        foreach ($where as $k => $b)
            $link->where($k, $b);
        return $link->exec()->getAll();
    }
    function delete($key, $value){
        DB::table("permissions_role")
            ->delete()
            ->where($key, $value)
            ->exec();
    }
    function update($updates = [], $where = []){
        $link = DB::table("permissions_role");
        foreach ($updates as $k => $b)
            $link->update($k, $b);
        foreach ($where as $k => $b)
            $link->where($k, $b);
        $link->exec();
    }
}