<?php 

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (name, email, password, confirmation_hash) VALUES(:name, :email, :password, :conf_hash)');
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':conf_hash', $data['confirmation_hash']);
        
        //echo $data['confirmation_hash'];
        if ($this->db->execute())
            return (true);
        else
            return (false);    
    }

    public function mailIsConfirmed($name)
    {
        $this->db->query('SELECT * FROM users WHERE name = :name');
        $this->db->bind(':name', $name);

        $row = $this->db->single();
        if ($row->confirmed == 1)
            return (true);
        else
            return (false);
    }

    public function login($name, $password)
    {
        $this->db->query('SELECT * FROM users WHERE name= :name');
        $this->db->bind(':name', $name);

        $row = $this->db->single();
        $hash_p = $row->password;
        if (password_verify($password, $hash_p))
            return $row;
        else
            return false;
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0)
            return (true);
        else
            return (false);
    }

    public function findUserByName($name)
    {
        $this->db->query('SELECT * FROM users WHERE name = :name');
        $this->db->bind(':name', $name);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0)
            return (true);
        else
            return (false);
    }

    public function confirmUserMail($hash)
    {
        $this->db->query('SELECT * FROM users WHERE confirmation_hash = :hash');
        $this->db->bind(':hash', $hash);

        $row = $this->db->single();
        if ($this->db->rowCount() == 0)
            return (false);
        else
        {
            if ($row->confirmation_hash == $hash)
            {
                $this->db->query('UPDATE users SET confirmed = 1 WHERE id = :id');
                $this->db->bind(':id', $row->id);
                $this->db->execute();
                return (true);
            }
        }
    }

    public function changePassword($name, $newPass)
    {
        $this->db->query('UPDATE users SET password = :pass where name = :name ');
        $this->db->bind(':pass', $newpass);
        $this->db->bind(':name', $name);
        $this->db->execute();
    }
}

?>