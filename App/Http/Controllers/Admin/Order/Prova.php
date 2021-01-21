<?php
namespace Http\Controllers\Admin\Order;

use Helper\Connection\DB;

class Prova{
    function autoload(){

        /*print_r(
            DB::query("SELECT * FROM prova WHERE word=:suca")
            ->bind(":suca", $suca)
            ->exec()
            ->getAll());*/
        DB::table("prova")
            ->update("asd", "ivan è gay")
            ->where("word", 325)
            ->exec();
        //print_r(self::$conn->errorInfo());
        //self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //View("lol");
    }
}

?>