<?php
class Route
{
    private static $prefix = "";
    function get($route, $func = null){
        self::start("GET", $route, $func);
    }
    function post($route, $func = null){
        self::start("POST", $route, $func);
    }
    function delete($route, $func = null){
        self::start("DELETE", $route, $func);
    }
    function put($route, $func = null){
        self::start( "PUT", $route, $func);
    }
    function patch($route, $func = null){
        self::start("PATCH", $route, $func);
    }
    function options($route, $func = null){
        self::start("OPTIONS", $route, $func);
    }
    function any($route, $func = null){
        self::start("ALL", $route, $func);
    }
    function ajax($route, $func = null){
        if (strtolower((string) @$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            self::start("ALL", $route, $func);
    }
    function prefix($prefix){
        static::$prefix = $prefix;
        return new self;
    }
    function group($func = null){
        call_user_func($func);
        static::$prefix = "";
    }
    function start($method, $route, $func = null)
    {
        $route = static::$prefix.$route;
        if (strtolower($method) === "all")
            $method = $_SERVER['REQUEST_METHOD'];

        static $routes = [];

        if (!$func) {
            $f = null;
            $n = '';
            $argv = [];
            foreach (explode('/', $route) as $arg) {
                $n .= ($n == '/' ? $arg : "/$arg");
                $n = strtolower($n);

                if ($r)
                    $argv[] = $arg;

                if (isset($routes[$method][$n])) {
                    $r = $routes[$method][$n];
                    $argv = [];
                    if ($route == $n)
                        break;
                }
                if (isset($routes[$method]["$n/"])) {
                    $r = $routes[$method]["$n/"];
                    $argv = [];
                }
            }

            if(!$r || (count($argv) < $r['mandatory']) || (count($argv) > $r['argc']))
                exit(http_response_code(404));
            return call_user_func_array($r['func'], $argv);
        }

        $name = [];
        $argc = 0;
        $mandatory = 0;
        foreach(explode('/', $route) as $arg) {
            switch(@$arg[0]) {
                case '!': ++$argc; ++$mandatory; break;
                case '?': ++$argc; break;
                default: $name[] = $arg; break;
            }
        }
        $name = implode('/', $name);
        if ($argc)
            $name .= '/';
        $name = strtolower($name);
        $routes[$method][$name] = ['func' => $func, 'argc' => $argc, 'mandatory' => $mandatory];



        return 0;
    }
    function run(){
        foreach(glob("../Routes/*.{php}", GLOB_BRACE) as $filename)
            require_once(realpath($filename));

        echo Route::start($_SERVER['REQUEST_METHOD'], (string)@explode('?', $_SERVER['REQUEST_URI'])[0]);
    }
}

?>