<?php


namespace Models;

class User{

    public static function isLogged()
    {
        if(isset($_SESSION["user"])){
            return true;
        }
        return false;
    }

    public static function logIn()
    {
        $db = new Database();
        if(isset($_POST["login"])){
            $query = $db->query("SELECT * FROM `users` WHERE `login` = ? AND `password`= ?",$_POST["login"],md5($_POST["password"]));
            if($query->rowCount() > 0){
                $_SESSION["user"] = $query->fetch();
                return true;
            }
            else{
                return false;
            }
        }

    }
}
