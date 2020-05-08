<?php


namespace AF\Facade;

use AF\BaseRouter;
use Exception;

/**
 * @method static get(string $uri, string $controller)
 * @method static post(string $uri, string $controller)
 * @method static setControllerNamespace(string $namespace)
 */
class Router
{
    public static function __callStatic($name, $arguments)
    {
        $baseRouter = BaseRouter::getInstance();
        if (method_exists($baseRouter, $name)) {
            return $baseRouter->$name(@$arguments[0], @$arguments[1],
                @$arguments[2],
                @$arguments[3]);
        }
        throw new Exception($name . "Method not Exists");
    }

    public static function run()
    {
        BaseRouter::getInstance()->run();
    }
}