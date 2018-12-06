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
        $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        
        if ($this->db->execute())
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
}

?>