<?php

namespace Models;


class Cart{

    public function getFullCart(){
        if(isset($_SESSION["cart"])){
            return $_SESSION["cart"];
        }
    }

    public function add($itemID){
        if(!isset($_SESSION["cart"])){
            $cart = $_SESSION["cart"];
            $cart = $itemID;
            return "Добавлен новый эелемент $itemID";
        }

    }



}



?>