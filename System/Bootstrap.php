<?php
require_once(realpath(dirname(__FILE__)."/Resources/Autoload.php"));
require_once(realpath(dirname(__FILE__)."/Resources/Configurations.php"));
require_once(realpath(dirname(__FILE__)."/Resources/Constants.php"));
require_once(realpath(dirname(__FILE__)."/Resources/Engine.php"));
require_once(realpath(dirname(__FILE__)."/Resources/Route.php"));

Route::run();
?>