<?php


namespace AF\Facade;


use Exception;

abstract class BaseFacade
{
    abstract protected static function getBaseClass();

    public static function __callStatic($name, $arguments)
    {

        $baseClass = static::getBaseClass();
        if (method_exists($baseClass, $name)) {
            return $baseClass->$name(@$arguments[0], @$arguments[1],
                @$arguments[2],
                @$arguments[3]);
        }
        throw new Exception($name . "Method not Exists");
    }
}