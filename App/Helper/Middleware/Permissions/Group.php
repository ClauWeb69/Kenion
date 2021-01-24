<?php
namespace Helper\Middleware\Permissions;


use Helper\Connection\DB;

class Group
{
    function add($array = []){
        return DB::table("permissions_group")
            ->insert($array)
            ->exec()
            ->last_id();
    }
    function pex($id){
        $link = DB::query("SELECT * FROM permissions_group
                                LEFT OUTER JOIN permissions ON permissions_group.pex = permissions.id
                                WHERE permissions_group.role = :idrole");
        $link->bind(":idrole", $id);
        return $link->exec()->getAll();
    }
    function get($where = []){
        $link = DB::table("permissions_group");
        $link->select(["*"]);
        foreach ($where as $k => $b)
            $link->where($k, $b);
        return $link->exec()->get();
    }
    function getAll($where = []){
        $link = DB::table("permissions_group");
        $link->select(["*"]);
        foreach ($where as $k => $b)
            $link->where($k, $b);
        return $link->exec()->getAll();
    }
    function delete($key, $value){
        DB::table("permissions_group")
            ->delete()
            ->where($key, $value)
            ->exec();
    }
    function update($updates = [], $where = []){
        $link = DB::table("permissions_group");
        foreach ($updates as $k => $b)
            $link->update($k, $b);
        foreach ($where as $k => $b)
            $link->where($k, $b);
        $link->exec();
    }
}