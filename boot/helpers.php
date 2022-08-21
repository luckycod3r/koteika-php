<?php

use Models\Cart;
use Models\Database;

function db(){
    $conn = new Database();
    return $conn;
}

function cart(){
    $cart = new Cart();
    retun $cart;

}

function view($page, $params = [])
{
    ob_start();
    extract($params);
    include path("views/pages/$page.php");

    $content = ob_get_contents();
    ob_get_clean();
    if(isset($layout)){
        require_once path("views/layouts/$layout.php");
    }
    else{
        require_once path("views/layouts/main.php");
    }

}

function stylesheet($href){
    return '<link rel="stylesheet" href="'.asset("style/$href").'">';
}

function domain(){
    return "localhost";
}
function path($path) {
    return __DIR__ . '/../' . $path;
}

function asset($path)
{
    return "http://".domain()."/public/" . $path;
}

function url($path)
{
    return "http://".domain()."/" . $path;
}
