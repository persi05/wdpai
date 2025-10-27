<?php

require_once 'src/controllers/SecurityController.php';

class Routing {
    public static $routes = [
        "login" => [
            "controller" => "SecurityController",
            "action" => "login"
        ],
        "register" => [
            "controller" => "SecurityController",
            "action" => "register"
        ],
    ];
    
    public static function run(string $path) {
        switch ($path) {
            case 'dashboard':
                // TODO connect with database
                // get elements to present on dashboard

                include 'public/views/dashboard.html';
                break;
            case 'login':
            case 'register':

                // TODO get grom form user email,passowrd
                // check in database if user exist
                // if exist then return dashboard

                $controller = Routing::$routes[$path]["controller"];
                $action = Routing::$routes[$path]["action"];


                $controllerObj = new $controller;
                $controllerObj->$action();
                break;
            default:
                include 'public/views/404.html';
                break;
        }
    }
}