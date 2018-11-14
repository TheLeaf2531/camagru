<?php

class Manager
{

    protected function database_connect()
    {
        $dsn    =  'mysql:host=192.168.99.100:3306;dbname=db;charset=utf8';
        $usr    =  'root';
        $pass   =  'pass';
      
        try
        {
            $db = new PDO($dsn, $usr, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return ($db);
        }
        catch(PDOException $e)
        {
            echo 'Connection failed :<br>' . $e->getMessage();
        }
    }
}

?>