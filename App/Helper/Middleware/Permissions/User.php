<?php
namespace Helper\Middleware\Permissions;

use Helper\Connection\DB;

class User
{
    public static $role = null;
    public static $pex = [];
    public static $id = null;

    function add($array = []){
        return DB::table("permissions_role")
            ->insert($array)
            ->exec()
            ->last_id();
    }

    function id($id){
        self::$id = $id;
        return new self;
    }

    function role(){
        return Role::user(self::$id);
    }
    function pex(){
        $link = DB::query("SELECT * FROM permissions_user
                                LEFT OUTER JOIN permissions ON permissions_user.pex = permissions.id
                                WHERE permissions_user.user = :iduser
                                ");
        $link->bind(":iduser", self::$id);
        return $link->exec()->getAll();
    }
    function check($pex){
        $userPex = self::allPex();
        if(in_array(strtolower("*"), $userPex))
            return true;

        if(in_array(strtolower($pex), $userPex))
            return true;

        $perm = "";
        foreach (explode(".", $pex) as $b){
            if(strtolower($perm.$b) == strtolower($pex))
                return false;

            $perm .= $b.".";
            if(in_array(strtolower($perm."*"), $userPex))
                return true;
        }
        return false;
    }
    function allPex(){
        $link = DB::query("SELECT permissions.permission FROM permissions
                                LEFT OUTER JOIN permissions_user ON permissions_user.pex = permissions.id
                                LEFT OUTER JOIN permissions_group ON permissions_group.pex = permissions.id
                                LEFT OUTER JOIN permissions_role_user ON permissions_role_user.role = permissions_group.role
                                WHERE permissions_user.user = :iduser OR permissions_role_user.user = :iduserrole
                                ");
        $link->bind(":iduser", self::$id);
        $link->bind(":iduserrole", self::$id);
        $result = $link->exec()->getAll();
        foreach($result as $pex){
            self::$pex[] = strtolower($pex["permission"]);
        }
        return self::$pex;
    }
    function delete($key, $value){
        DB::table("permissions_role")
            ->delete()
            ->where($key, $value)
            ->exec();
    }
}