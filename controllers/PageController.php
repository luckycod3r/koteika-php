<?php


namespace Controllers;

use Models\User;

class PageController{

    public static function index()
    {
        $data = [];
        $data["news"] = db()->query("SELECT * FROM `news`")->fetchAll();

        view("index",[
            "data" => $data
        ]);


    }

    public static function error()
    {
        view("404");
    }

}