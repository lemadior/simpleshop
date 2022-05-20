<?php

namespace application\core;

use application\core\Error;

class Route
{
    // private $error;

    // function __construct()
    // {
    //     $this->error = new Error();
    // }

    static function start()
    {
       
        // Default controller and it's method
        $controller_name = 'Main';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // Get controller's name
        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }

        //Get name of action
        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

        //Add prefixes
        $model_name = 'Model_' . ucfirst($controller_name);
	    $controller_name = 'Controller_' . ucfirst($controller_name);
        $action_name = 'action_' . $action_name;

        //get file with model
        $model_file = strtolower($model_name) . '.php';
        $model_path = 'application/models/' . $model_file;

        if (file_exists($model_path)) {
            include $model_path;
        }

        //Get file with controller's class
        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = 'application/controllers/' . $controller_file;

        if (file_exists($controller_path)) {
            include $controller_path;
        } else {
    //       Route::ErrorPage404('Controller Error');
            Error::ErrorPage404('<b>Controller Error :</b> <em>' . $controller_path . "</em> !");            
        }

        $controller_name = "\\application\\controllers\\" . $controller_name;

        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            //Maybe here would useful throw exception
            // Route::ErrorPage404('Method Error');
            Error::ErrorPage404('Method Error: ' . $action . " !");
        }
    }

    // static function ErrorPage404($err = 'ERROR')
    // {
    //     $_SESSION['error'] = $err;
    //     $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    //     header('HTTP/1.1 404 Not Found');
    //     header('Status: 404 Not Found');
    //     header('Location:' . $host . '404');
    // }

}

