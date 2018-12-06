<?php 

class Users extends Controller
{
    private $passwordLenght = 6;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if (isLoggedIn())
            redirect('');

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            if (empty($data['email']))
                $data['email_err'] = 'Please enter an email adress';
            else
                if ($this->userModel->findUserByEmail($data['email']))
                    $data['email_err'] = 'Email is already taken';


            if (empty($data['name']))
                $data['name_err'] = 'Please enter a name';
            else
                if ($this->userModel->findUserByName($data['name']))
                    $data['name_err'] = 'Name is already taken';
            
            if (empty($data['password']))
            {
                $data['password_err'] = 'Please enter a password';
            }
            else if (strlen($data['password']) < $this->passwordLenght)
            {
                $data['password_err'] = 'Password must be at least 6 characters';
            }
            if (empty($data['confirm_password']))
            {
                $data['confirm_password_err'] = 'Please confirm your password';
            }
            else if ($data['password'] != $data['confirm_password'])
            {
                $data['confirm_password_err'] = 'Passwords do not match';
            }
            if (empty($data['name_err']) && empty($data['mail_err']) && empty($data['confirm_password_err']) && empty($data['password_err']))
            {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->register($data))
                {
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                }
                else
                    die('Something went terribly wrong O_o"');
            }
            else
            {
                $this->view('users/register', $data);
            }
        }
        else
        {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            $this->view('users/register', $data);
        }
    }

    public function login()
    {

        if (isLoggedIn())
            redirect('');
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'password' => trim($_POST['password']),
                'name_err' => '',
                'password_err' => ''
            ];

            if (empty($data['name']))
                $data['name_err'] = "Please enter your user name";

            if (empty($data['password']))
                $data['password_err'] = "Please enter your password";

            if(!$this->userModel->findUserByName($data['name']))
                $data['name_err'] = 'User not found';

            if (empty($data['name_err']) && empty($data['name_err']))
            {
                $loggedInUser = $this->userModel->login($data['name'], $data['password']);
                if ($loggedInUser)
                {
                    $this->createUserSession($loggedInUser);
                }
                else
                {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data); 
                }
            }
            else
                $this->view('users/login', $data);
        }
        else
        {
            $data = [
                'name' => '',
                'password' => '',
                'name_err' => '',
                'password_err' => ''
            ];
            $this->view('users/login', $data);         
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        redirect('');
    }


    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id']))
            return (true);
        else
            return (false);
    }
}

?>