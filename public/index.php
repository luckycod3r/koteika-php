<?php
session_start();

use Boot\Router;

use Controllers\CatalogController;
use Controllers\PageController;
use Controllers\RequestController;
use Models\Database;
use Models\Cart;
use Models\Javascript;
use Controllers\HandlerController;

require_once('../boot/boot.php');
require_once('../boot/helpers.php');

$db = new Database();

Router::get("/", [PageController::class, 'index']);

Router::get("/catalog", [CatalogController::class, 'index']);
Router::get("/catalog/(\d+)", [CatalogController::class, 'show']);
Router::get("/ajax", [CatalogController::class, 'show']);



// REQUEST AREA
Router::post("/ajax", [RequestController::class, 'post']);
Router::get("/ajax", [RequestController::class, 'get']);

Router::post("/handler", [HandlerController::class, 'post']);


if(Router::handle() == 404){
    view("404");
}

