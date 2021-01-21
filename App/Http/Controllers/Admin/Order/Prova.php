<?php
namespace Http\Controllers\Admin\Order;

use Helper\Connection\DB;

class Prova{
    function autoload($suca){

        print_r(
            DB::query("SELECT * FROM prova WHERE word=:suca")
            ->bind(":suca", $suca)
            ->exec()
            ->getAll());
        //print_r(self::$conn->errorInfo());
        //self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //View("lol");
    }
}

?>