<?php

namespace Models;


class Cart{

    public function getFullCart(){
        return $_SESSION["cart"];
    }

    public function add($itemID){
        $cart = $_SESSION["cart"];
        $cart = $itemID;
    }

    public static function compile(){

    }


}



?>