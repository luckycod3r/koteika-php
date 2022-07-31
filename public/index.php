<?php
session_start();

use Boot\Router;

use Controllers\CatalogController;
use Controllers\PageController;
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

Router::post("/handler", [HandlerController::class, 'post']);


if(Router::handle() == 404){
    view("404");
}

