<?php

class User
{
    private $id;
    private $username;
    private $password;
    private $role;   

    public function __construct($id="", $username="", $password="", $role="")
    {
        $this->id=$id;
        $this->username=$username;
        $this->password=$password;
        $this->role=$role;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function setUsername($username)
    {
        $this->username=$username;
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password=$password;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function setRole($role)
    {
        $this->role=$role;
    }

    public function getRole() : string
    {
        return $this->role;
    }


}

?>