
<?php
use Controllers\Admin\Order\Prova23 as LOL;

Route::prefix("/api")->group(function(){

    Route::get('/asd', LOL::autoload());
});



?>