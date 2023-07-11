<?php

session_start();

require "config/autoload.php";

try {
    $router = new Router();
    if(isset($_SERVER['REQUEST_URI']))
    {
        $request = $_SERVER['REQUEST_URI'];
    }
    else
    {
        $request = "/";
    }

    $router->route($routes, $request);
}
catch(Exception $e)
{
    if($e->getCode() === 404)
    {
        require "./templates/404.phtml";
    }
}















?>