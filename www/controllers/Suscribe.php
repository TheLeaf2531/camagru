<?php 

class Suscribe extends Controller
{
    public $t_username;
    public $t_mail;
    public $t_pass;
    public $data = array();


    public static function CreateView($ViewName)
    {
        $pass_test = "Aa01";





        if (!empty($_POST['user_password']) && !empty($_POST['user_login']) &&!empty($_POST['user_mail']))        
        {
            if (self::check_login($_POST['user_login']))
                echo 'Login OK<br>';
            if (self::check_password($_POST['user_password']))
                echo 'Password OK<br>';
            //$data['user_password'] = $_POST['user_password'];
            //$data['user_login'] = $_POST['user_login'];
            //$data['user_mail'] = $_POST['user_mail'];
        }
        require_once("./views/$ViewName" . '.php');
    }

    private function check_login($string)
    {
        $pattern = '/[a-zA-Z0-9]/';
        $lenght = strlen($string);

        if (preg_match($pattern, $_POST['user_login']))
            return (FALSE);
        if (lenght < 4 && lenght > 16)
            return (FALSE);
        echo 'OK';
        return (TRUE);
    }

    private function check_password($string)
    {
        if (preg_match("@[A-Z]@", $string))
            return (FALSE);
        if (preg_match("@[a-z]@", $string))
            return (FALSE);
        if (preg_match("@[0-9]@", $string))
            return (FALSE);
        if (preg_match("@[^\w]@", $string))
            return (FALSE);
        if (preg_match("(?=\S{8,})", $string))
            return (FALSE);
        echo "stop";
        return (TRUE);
    }

}

?>