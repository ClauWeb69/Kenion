<?php
class View
{
    public function __construct($name, $data = [], $var = true)
    {
        foreach ($data as $k => $v)
            ${$k} = $v;
        $view = realpath("../" . FOLDER_APPLICATION . "/Views/" . implode('/', explode('.', $name)) . ".php");
        if (file_exists($view)) {
            ob_start();
            require($view);
            ($var == true) ? $d = ob_get_contents() : $d = ob_get_clean();
            return $d;
            ob_end_clean();
        }
    }
}
 ?>