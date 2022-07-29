<?php


namespace Boot;

class Router
{

    private static $routes = [];

    public static function get($url,$callback)
    {
        self::addRoute("get",$url,$callback);
    }

    public static function post($url,$callback)
    {
        self::addRoute("post",$url,$callback);
    }

    public static function addRoute($method, $url, $callback){
        self::$routes[] = (object) [
            "method" => $method,
            "pattern" => '/^'. str_replace("/", "\/", $url) .'$/',
            "controller" => $callback[0],
            "action" => $callback[1],
        ];
    }

    public static function handle()
    {
       [$route, $matches] = self::getMatchedRoutes();
       if($route == null){
           return 404;
       }
       else call_user_func_array([new $route->controller, $route->action],$matches);
    }

    public static function getMatchedRoutes()
    {
        foreach (self::$routes as $route){
            $isMethodMatched =  strtoupper($route->method) === strtoupper($_SERVER['REQUEST_METHOD']);
            if(preg_match($route->pattern,$_SERVER["REQUEST_URI"],$matches) && $isMethodMatched){
                array_shift($matches);
                return [$route, $matches];
            }
        }
    }

}