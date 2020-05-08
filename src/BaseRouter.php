<?php

namespace AF;

use AF\Pattern\Singleton;
use Exception;

class BaseRouter
{
    use Singleton;

    private array $routes = [self::GET => [],
        self::POST => []];
    private const AT_SIGN = "@",
        CONTROLLER = "controller",
        METHOD = "method",
        URI = "uri",
        REQUEST_METHOD = "REQUEST_METHOD";

    private const ROUTE_NOT_EXISTS = "Route not Exists",
        CONTROLLER_NOT_EXISTS = "Controller not Exists";
    private const GET = "GET",
        POST = "POST";

    private array $controllerNamespaces = [];


    private function addRoute($method, $uri, $controller)
    {
        $this->routes[$method][] = $this->handleController($controller, $uri);
        return $this;
    }

    private function handleController($controller, $uri)
    {
        $action = explode(self::AT_SIGN, $controller);
        return
            [self::URI => $uri,
                self::CONTROLLER => $action[0],
                self::METHOD => $action[1]];
    }

    public function setControllerNamespace($namespace)
    {
        $this->controllerNamespaces[] = $namespace;
    }

    public function get($uri, $controller)
    {
        return $this->addRoute(self::GET, $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->addRoute(self::POST, $uri, $controller);
    }

    private function findRoute($method, $uri)
    {
        $methodRoutes = $this->routes[$method];
        $route = null;
        foreach ($methodRoutes as $routes) {
            if ($routes[self::URI] == $uri) {
                $route = $routes;
                break;
            }
        }
        if (!$route)
            throw new  Exception(self::ROUTE_NOT_EXISTS);
        return $route;
    }

    private function getRequestMethod()
    {
        return $_SERVER[self::REQUEST_METHOD];
    }

    public function getRoutes()
    {
        echo json_encode($this->routes);
    }

    public function run()
    {
        $request = (object)$_REQUEST;
        $route = $this->findRoute($this->getRequestMethod(), @$request->af_router_action);
        $controller = $route[self::CONTROLLER];
        $method = $route[self::METHOD];
        $class = null;
        foreach ($this->controllerNamespaces as $namespace) {
            $class = "$namespace\\$controller";
            if (class_exists($class)) {
                if (method_exists(new $class(), $method)) {
                    break;
                }
            }
        }
        if ($class) {
            $class = new $class();
            $response = $class->$method($request);
            if (gettype($response) == "array" or gettype($response) == "object") {
                echo json_encode($response);
            } else {
                echo $response;
            }
            return;
        }
        throw new Exception($controller . " " . self::CONTROLLER_NOT_EXISTS);
    }
}
