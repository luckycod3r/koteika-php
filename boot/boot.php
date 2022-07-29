<?php

spl_autoload_register(function($class){
    include path(str_replace('\\', '/', $class.".php"));
});


