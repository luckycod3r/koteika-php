<?php
session_start();

use Boot\Router;

use Controllers\CatalogController;
use Controllers\PageController;
use Models\Database;
use Models\Javascript;

require_once('../boot/boot.php');
require_once('../boot/Helpers.php');

$db = new Database();

Router::get("/", [PageController::class, 'index']);

Router::get("/catalog", [CatalogController::class, 'index']);
Router::get("/catalog/(\d+)", [CatalogController::class, 'show']);

if(Router::handle() == 404){
    view("404");
}

