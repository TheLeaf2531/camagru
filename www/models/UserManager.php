<?php

require_once("models/Manager.php");

class UserManager extends Manager
{
    private $id;
    private $name;
    private $email;

    public function add_user($userName, $userPassword, $userMail)
    {
        if (!empty($userName) && !empty($userPassword) && !empty($userMail) && $db = $this->database_connect())
        {
            $checkUserName = $db->prepare('SELECT COUNT(*)FROM users WHERE user_name = ?');
            $checkUserName->execute(array($userName));
            $resultUN = $checkUserName->fetchAll();
            if ($resultUN[0][0] == 0)
            {
                $user = $db->prepare('INSERT INTO users(user_name, user_password, user_mail) VALUES(?,?,?)');
                $result = $user->execute(array($userName, password_hash($userPassword, PASSWORD_DEFAULT), $userMail));
            }
            else 
            {
                //TODO : STUFF TO DISPLAY ERROR
                echo 'Username already in use<br>';
            }
            return ($result);
        }
    }

    public function remove_user($userName)
    {
        if (!empty($userName) && $db = $this->database_connect())
        {
            $user = $db->prepare('DELETE FROM users WHERE user_name = ?');
            $return = $user->execute(array($username));
        }
    }

    public function get_user($userName, $userPassword)
    {
        //TODO : STUFF FOR LOGIN
    }

}

?>