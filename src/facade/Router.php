<?php


namespace AF\Facade;

use AF\BaseRouter;

/**
 * Class Router
 * @package AF\Facade
 * @method static get(string $uri, string $controller)
 * @method static post(string $uri, string $controller)
 * @method static run(callable $exists = null)
 * @method static setControllerNamespace(string $namespace)
 */
class Router extends BaseFacade
{
    protected static function getBaseClass(): object
    {
        return BaseRouter::getInstance();
    }
}