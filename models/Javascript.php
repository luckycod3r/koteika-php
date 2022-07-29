<?php

namespace Models;

class Javascript{

    public static function private($path){
        $code = 'zKoAz2'.base64_encode(file_get_contents(asset("scripts/".$path)));
        echo "<script>system.correct('$code')</script>";
    }

    public static function public($path){
        echo "<script src='".asset("scripts/$path")."'></script>";
    }

}



?>