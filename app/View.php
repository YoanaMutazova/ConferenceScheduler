<?php

class View
{
    public static $controllerName;
    public static $actionName;
    
    public static function make($model)
    {
        require 'views/' . self::$controllerName . '/' . self::$actionName . '.php';
    }
}