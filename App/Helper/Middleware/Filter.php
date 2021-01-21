<?php
namespace Helper\Middleware;

class Filter
{
    function string($s){
        return filter_var($s, FILTER_SANITIZE_STRING);
    }
    function int($s){
        return (int)filter_var($s, FILTER_SANITIZE_NUMBER_INT);
    }
    function float($s){
        return (float)filter_var($s, FILTER_SANITIZE_NUMBER_FLOAT);
    }
    function email($s){
        return filter_var($s, FILTER_SANITIZE_EMAIL);
    }
    function url($s){
        return filter_var($s, FILTER_SANITIZE_URL);
    }
    function xss($s){
        return filter_var(rawurldecode($s), FILTER_SANITIZE_URL);
    }
}