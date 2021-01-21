<?php
namespace Helper\Middleware;


class Csrf
{
    function token(){
        if(session_status() !== PHP_SESSION_ACTIVE)
            return "Session isn't started";
        if (empty($_SESSION['crsf']['token']))
            $_SESSION['crsf']['token'] = bin2hex(random_bytes(32));

        return $_SESSION['crsf']['token'];
    }
    function compare($token){
        return $token === self::token() ? true : false;
    }
}