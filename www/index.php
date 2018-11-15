<?php

spl_autoload_register(function ($class){
    if (file_exists('./classes/' . $class . '.php'))
        include './classes/' . $class . '.php';
    else if (file_exists('./controllers/' . $class . '.php'))
        include './controllers/' . $class . '.php'; 
});

require_once('routes.php');

//echo $_GET['url'];



?>