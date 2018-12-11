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
                'confirmation_hash' => '',
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
                $data['password_err'] = 'Please enter a password';
            else if (strlen($data['password']) < $this->passwordLenght)
                $data['password_err'] = 'Password must be at least 6 characters';


            if (empty($data['confirm_password']))
                $data['confirm_password_err'] = 'Please confirm your password';
            else if ($data['password'] != $data['confirm_password'])
                $data['confirm_password_err'] = 'Passwords do not match';
            

            if (empty($data['name_err']) && empty($data['mail_err']) && empty($data['confirm_password_err']) && empty($data['password_err']))
            {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $data['confirmation_hash'] = hash("md5", $data['email']);
                if ($this->userModel->register($data))
                {
                    
                    $to      = $data['email'];
                    $subject = 'Email confirmation !';
                    $message = 'Hello \n\n Some other stuff to follow';
                    $headers = array(
                        'From' => 'confirmation@camagru.com',
                        'Reply-To' => 'webmaster@example.com',
                        'X-Mailer' => 'PHP/' . phpversion()
                    );
                    mail($to, $subject, $message, $headers);
                    
                    flash('register_success', 'You are registered, check your mails to validate your account');
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
                'password_err' => '',
                'mail_confirmation_err' => ''
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
                    if ($this->userModel->mailIsConfirmed($data['name']))
                        $this->createUserSession($loggedInUser);
                    else
                    {
                        $data['mail_confirmation_err'] = "Your email has not been verified, check your mails";
                        $this->view('users/login', $data);
                    }
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

    public function changePassword()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'password' => trim($_POST['password']),
                'password_err' => '',
                'password_confirmation' => trim($_POST['password_confirmation']),
                'password_confirmation_err' => '',
                'password_change_message' => ''
            ];

            if (empty($data['password']))
                $data['password_err'] = "Please enter a password.";
            else if (strlen($data['password'] < $this->passwordLenght))
                $data['password_err'] = "Your password must be at least" . $this->passwordLenght . "characters long.";
            
            if (empty($data['password_confirmation']))
                $data['password_confirmation'] = "Please, confirm your password.";
            
            if ($data['password'] != $data['password_confirmation'])
                $data['password_confirmation_error'] = "Passwords do not match.";
            
            if (empty($data['password_err']) && empty($data['password_confirmation_err']))
            {
                $data['password_change_message'] = "A confirmation message has been sent to your email adresse.";
                //TODO : SEND MAIL FOR PASSWORD CHANGE CONFIRMATION
            }
            
        }
        $this->view('users/changePassword');
    }

    public function passwordConfirmation($name = '', $hash = '')
    {
        if (empty($name) || empty($hash))
        {
            redirect('');
        }
    }

    public function confirmation($name = '', $hash = '')
    {
        $data = [
            'name' => '',
            'password' => '',
            'name_err' => '',
            'password_err' => '',
            'mail_confirmation_err' => '',
            'mail_confirmation_message' => ''
        ];

        if (empty($hash) || empty($name))
            redirect('');
    
        if ($this->userModel->mailIsConfirmed($name))
        {
            $data['mail_confirmation_message'] = 'This mail has already been confirmed';
            $this->view('users/login', $data);
        }
        else if (!$this->userModel->confirmUserMail($hash))
        {
            $data['mail_confirmation_err'] = 'Something went terribly wrong.';
            $this->view('users/login', $data);
        }
        else
        {
            $data['mail_confirmation_message'] = 'Mail confirmed, you can log in.';
            $this->view('users/login', $data);
        }
        
    }

    public function profile()
    {
        if (!isLoggedIn())
            redirect('');
        $data = [
            'name' => $_SESSION['user_name'],
            'name_err' => '',
            'email' => $_SESSION['user_email'],
            'email_err' => ''
        ];
        $this->view('users/profile', $data);
    }


    private function createUserSession($user)
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

}

?>