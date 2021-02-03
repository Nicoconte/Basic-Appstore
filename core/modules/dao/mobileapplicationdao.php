<?php

class MobileApplicationDAO extends DAO
{
    public function __construct()
    {
        $this->database = new Database();
        $this->conn = $this->database->getConnection();   
    }

    public function save(MobileApplication $mobileApplication) : bool
    {

        if ($mobileApplication != null)
        {
            $id = $mobileApplication->getId();
            $creator = $mobileApplication->getCreatorId();
            $name = $mobileApplication->getName();
            $description = $mobileApplication->getDescription();
            $category = $mobileApplication->getCategory();
            $price = $mobileApplication->getPrice();

            $this->sql = "INSERT INTO mobile_applications VALUES (?,?,?,?,?,?)";

            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bind_param("sssssf", $id, $creator, $name, $description, $category, $price);
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

}


?>