<?php
spl_autoload_register(function ($name) {
    $class = realpath("../" . FOLDER_APPLICATION . "/" . $name . ".php");
    if(file_exists($class))
        require_once($class);
});
?>