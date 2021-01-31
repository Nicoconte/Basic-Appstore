<?php

include $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/autoloader.php";


class UserDAO
{
    
    private $database;
    private $conn;
    private $stmt;

    private $result;
    private $row;
    private $sql;

    private $utils;

    public function __construct()
    {
        $this->database = new Database();
        $this->conn = $this->database->getConnection();
        $this->utils = new Utils();    
    }

    public function save(User $user) : bool
    {   

        if ($user !== null)
        {   

            $id = $user->getId();
            $name = $user->getUsername();
            $password = hash("sha256", $user->getPassword());
            $role = $user->getRole();

            $this->sql = "INSERT INTO users VALUES (?,?,?,?)";

            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bind_param("ssss", $id, $name, $password, $role);
            $this->stmt->execute();
    
            if ($this->stmt->affected_rows > 0) 
            {
                $this->stmt->close();
                return true;
            }
    
            $this->stmt->close();
    
            return false;
        }

        return false;

    }


    public function get(string $id) 
    {
        if ($id !== null)
        {
            $this->sql = "SELECT id, username, password, role FROM users WHERE id=?";

            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bind_param("s", $id);
            $this->stmt->execute();

            $this->result = $this->stmt->get_result();

            if ($this->result->num_rows > 0)
            {   
                $this->row = $this->result->fetch_assoc();

                $user = new User($this->row['id'], $this->row['username'], $this->row['password'], $this->row['role']);
                
                $this->stmt->free_result();
                $this->stmt->close();

                return $user;
                
            }


            $this->stmt->close();
            return null;
            
        }

        return null;
    }


    /**
     * 
     * Verify if the user exist by username and password (Authentication)
     * 
     */
    public function exist(User $user)
    {
        if ($user !== null)
        {

            $username = $user->getUsername();
            $password = hash("sha256", $user->getPassword());

            $this->sql = "SELECT id, username, password, role FROM users WHERE username=? and password=?";

            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bind_param("ss", $username, $password);
            $this->stmt->execute();

            $this->result = $this->stmt->get_result();

            if ($this->result->num_rows > 0)
            {   
                $this->row = $this->result->fetch_assoc();

                $user = new User($this->row['id'], $this->row['username'], $this->row['password'], $this->row['role']);
                
                $this->result = null;
                $this->stmt->free_result();
                $this->stmt->close();

                return $user;
                
            }


            $this->stmt->close();
            return null;
            
        }

        return null;
    }


    /**
     * @This method only will be available for the admin who watch the movement inside the platform. Extends it to use
     * 
    */
    protected function list()
    {

        $users = array();

        $this->sql = "SELECT * FROM users";

        $this->stmt = $this->conn->prepare($this->sql);
        $this->stmt->execute();

        $this->result = $this->stmt->get_result();

        if ($this->result->num_rows > 0)
        {
            while($this->row = $this->result->fetch_assoc())
            {
                array_push($users, new User($this->row['id'], $this->row['username'], $this->row['password'], $this->row['role']));
            }
            

            $this->row = null;
            $this->result = null;
            $this->stmt->free_result();
            $this->stmt->close();


            return $users;

        }

        return null;

    }

}


?>