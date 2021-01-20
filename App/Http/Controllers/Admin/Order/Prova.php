<?php
namespace Http\Controllers\Admin\Order;

use Helper\Connection\DB;

class Prova{
    function autoload(){
        DB::connect();

        print_r(
            DB::table("prova")
            ->select(["*"])
            ->where("word", 512)
            ->exec()
            ->getAll());
        //print_r(self::$conn->errorInfo());
        //self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        View("lol");
    }
}

?>