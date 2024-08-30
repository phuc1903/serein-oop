<?php

namespace App\Core;

class Router {
    private static $routes = [];

    public static function showroutes(){
        return self::$routes;
    }
    public static function add($page, $controller) {
        $page="#^".$page."$#";
        self::$routes[] = ['page' => $page, 'controller' => $controller];
    }

    public static function dispatch($page) {
        foreach (self::$routes as $route) {
            if (preg_match($route['page'], $page, $matches)) {
                error_log("Matched route: " . $route['page']);
                list($controller, $method) = explode('@', $route['controller']);
                $controllerClass = 'App\Controller\\' . $controller;
                $controllerInstance = new $controllerClass();
                $controllerInstance->$method();
                return;
            }
        }
        error_log("No matching route found for: " . $page);
        require_once "app/View/404page.php";
    }
}
