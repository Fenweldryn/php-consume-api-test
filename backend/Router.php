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
            // Convert route definition to a regular expression to support dynamic parameters
            $routePattern = preg_replace('/\/:[^\/]+/', '/([^/]+)', $route);
            $routePattern = '/^' . str_replace('/', '\/', $routePattern) . '$/';

            if (preg_match($routePattern, $uri, $matches)) {
                array_shift($matches); // Remove the full match from the results

                $controller = new $info['controller']();
                call_user_func_array([$controller, $info['action']], $matches);

                return; // Stop the loop and exit the method once a match is found and dispatched
            }
        }

        // Handle the case where no route is matched
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
}