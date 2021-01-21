<?php
namespace Helper\Html;

use Helper\Middleware\Filter;
use Helper\Middleware\Csrf;

class Form{
    function open($param){
        $arg = "<form";
        foreach ($param as $k => $b)
            $arg .= " ".Filter::xss($k).'="'.Filter::xss($k).'"';
        $arg .= ">";
        return $arg;
    }
    function text($name, $class = null, $id = null, $required = false, $disabled = false){
        return "<input type='text' name='{$name}' ".($class ? "class='{$class}'" : '')." ".($id ? "id='{$id}'" : '')." ".($required ? "required" : '')." ".($disabled ? "disabled" : '')." />";
    }
    function password($name, $class = null, $id = null, $required = false, $disabled = false){
        return "<input type='password' name='{$name}' ".($class ? "class='{$class}'" : '')." ".($id ? "id='{$id}'" : '')." ".($required ? "required" : '')." ".($disabled ? "disabled" : '')." />";
    }
    function number($name, $class = null, $id = null, $step = 1, $min = 0, $max = false, $required = false, $disabled = false){
        return "<input type='number' name='{$name}' ".($class ? "class='{$class}'" : '')." ".($step ? "step={$step}" : '')." ".($min ? "min={$min}" : '')." ".($max ? "max={$max}" : '')." ".($id ? "id='{$id}'" : '')." ".($required ? "required" : '')." ".($disabled ? "disabled" : '')." />";
    }
    function email($name, $class = null, $id = null, $required = false, $disabled = false){
        return "<input type='email' name='{$name}' ".($class ? "class='{$class}'" : '')." ".($id ? "id='{$id}'" : '')." ".($required ? "required" : '')." ".($disabled ? "disabled" : '')." />";
    }
    function crsf(){
        return "<input type='hidden' name='crsf_token' value='".Csrf::token()."' />";
    }
    function close(){
        return "</form>";
    }
}
?>