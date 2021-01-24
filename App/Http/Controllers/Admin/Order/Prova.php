<?php
namespace Http\Controllers\Admin\Order;

use Helper\Connection\DB;
use Helper\Middleware\Permissions\Permissions;

class Prova{
    function autoload(){
        if(Permissions::user()->id(1)->check("scopa.admiasdasdsn"))
            echo "asd";
    }
}

?>