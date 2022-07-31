<?php

namespace Controllers;

use Models\Cart;

class HandlerController{

    public static function post()
    {


        $action = $_POST["action"];

        if($action == "cart"){

            



        }
        else if ($action == "cart_add"){




        }
        else{
            echo 0;
        }

    }
    
    
}


?>