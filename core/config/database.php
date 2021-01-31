<?php

class Database 
{
    private $HOST = "localhost";
    private $USERNAME = "root";
    private $PASSWORD = "";
    private $DATABASE = "appstore";


    public function getConnection()
    {
        $conn = new mysqli($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DATABASE);

        if ($conn->connect_error)
        {
            die("Connection error");
        } 

        return $conn;

    }

}


?>