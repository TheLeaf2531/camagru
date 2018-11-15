<?php

class Controller
{
    public static function CreateView($ViewName)
    {
        require_once("./views/$ViewName" . '.php');
    }
}

?>