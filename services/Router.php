<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class Router {

    private function parseRequest(string $request)
    {
        $route = [];

        $routeData = explode("/", $request); // we split the request using the / character

        $route["path"] = "/".$routeData[1]; // the path is what is after the first /

        if(count($routeData) > 2) // if we have more than one /
        {
            $route["parameter"] = $routeData[2]; // the parameter is after the second /
        }
        else
        {
            $route["parameter"] = null; // we don't have a parameter
        }

        return $route;
    }

    public function route(array $routes, string $request)
    {
        $requestData = $this->parseRequest($request); // we analyze the request and sort it

        $routeFound = false;

        foreach($routes as $route) // we go through the list of routes we built in the autoload
        {
            $controller = $route["controller"];
            $method = $route["method"];
            $parameter = $route["parameter"];

            if($route["path"] === $requestData["path"]) // if the path exists
            {
                if($route["parameter"] && $requestData["parameter"] !== null) // if a parameter was needed and we have one
                {
                    $routeFound = true;

                    $ctrl = new $controller();
                    $ctrl->$method($requestData["parameter"]);
                }
                else if(!$route["parameter"] && $requestData["parameter"] === null) // or a parameter was not needed and we don't have one
                {
                    $routeFound = true;

                    $ctrl = new $controller();
                    $ctrl->$method();
                }
            }
        }

        if(!$routeFound) // anything else will throw an exception telling us the route does not exist
        {
            throw new Exception("Route not found", 404);
        }
    }
}
