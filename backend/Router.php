<?php

namespace App;

class Router
{
    protected $routes = [];

    private function addRoute($route, $controller, $action, $method)
    {
        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    public function get($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "GET");
    }

    public function post($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "POST");
    }

    public function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes[$method] as $route => $info) {
            $routePattern = preg_replace('/\/:[^\/]+/', '/([^/]+)', $route);
            $routePattern = '/^' . str_replace('/', '\/', $routePattern) . '$/';

            if (preg_match($routePattern, $uri, $matches)) {
                array_shift($matches);

                $controller = new $info['controller']();
                call_user_func_array([$controller, $info['action']], $matches);

                return;
            }
        }

        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
}