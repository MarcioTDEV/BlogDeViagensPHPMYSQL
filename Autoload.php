<?php

spl_autoload_register(function ($class){
    $path = str_replace("\\","/",$class);
    if(file_exists("$path.php")){
        require "$path.php";
    }
});