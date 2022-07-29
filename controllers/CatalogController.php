<?php

namespace Controllers;

class CatalogController{

    public static function index(){

        $data = db()->query("SELECT * FROM `catalog`")->fetchAll();
        view("catalog/index",[
            "data" => $data
        ]);
    }

    public static function show($id){

        $sizes = db()->query("SELECT `catalog_sizes`.`amount`, `sizes`.`name`
FROM `catalog`
INNER JOIN `catalog_sizes`ON `catalog_sizes`.`product_id` = `catalog`.`id`
INNER JOIN `sizes`ON `sizes`.`id` = `catalog_sizes`.`size_id` WHERE `catalog`.`id` = ?", $id)->fetchAll();
        $data = db()->query("SELECT * FROM `catalog` WHERE `id` = ?", $id)->fetch();
        view("catalog/show",[
            "data" => $data,
            "sizes" => $sizes
        ]);
    }

}
