<?php
use Http\Controllers\Admin\Order\Prova as LOL;
Route::prefix("/api")->group(function(){
    Route::get('/asd', LOL::autoload());
});

?>