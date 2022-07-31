<?php

namespace Models;

class Database{

    public static $handle = null;
    public function handle()
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $db_name = "title_shop";
        if(self::$handle === null){
            $options = [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ];
            self::$handle = new \PDO("mysql:host=$host;dbname=$db_name",$user,$password, $options);
        }
        return self::$handle;
    }

    public function query($q,...$args)
    {
        $res = self::handle()->prepare($q);
        $res->execute($args);
        return $res;
    }



}
