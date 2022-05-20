<?php

spl_autoload_register(function($class) {
    
    $root = $_SERVER['DOCUMENT_ROOT'];
    $ds = DIRECTORY_SEPARATOR;

    
    $last_elem = array_pop(explode('\\', $class));
    $subfolder = 'core';
    //echo "Class={$class}<br>";
    if (strpos($class, 'Controller_') !== false)  {
        $subfolder = 'controllers';
    } else if (strpos($class, 'Model_') !== false)  {
        $subfolder = 'models';
    } 
    
    //echo "Class={$last_elem}<br>";

    $filename = $root . $ds . 'application' . $ds . $subfolder . $ds . str_replace('\\', $ds, $last_elem) . '.php';
    
    $filename = strtolower($filename);
    
    if (file_exists($filename)) {
        require_once($filename);
    } else {
        exit("ERROR: cannot find class ${class} by path ${filename}");
    }
});


use application\core\Route;

Route::start();
