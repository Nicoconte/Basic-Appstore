<?php

class MobileApplicationDAO extends DAO
{   

    private Array $mobileApplications = array();

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
            $this->stmt->bind_param("sssssd", $id, $creator, $name, $description, $category, $price);
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

    public function list() : Array
    {
        $this->sql = "SELECT id, creator_id, name, description, category, price FROM mobile_applications";

        $this->stmt = $this->conn->prepare($this->sql);
        $this->stmt->execute();

        $this->result = $this->stmt->get_result();

        if ($this->result->num_rows > 0)
        {
            while($this->row = $this->result->fetch_assoc())
            {   
                //Built an assoc array
                $this->mobileApplications[] = array(
                    "id" => $this->row['id'], 
                    "creator" => $this->row['creator_id'], 
                    "name" => $this->row['name'], 
                    "description" => $this->row['description'], 
                    "category" => $this->row['category'], 
                    "price" => $this->row['price']
                );
                
            }

            $this->row = null;
            $this->result->free_result();
            $this->stmt->close();

            return $this->mobileApplications;
        }

        $this->result->free_result();
        $this->stmt->close();

        return null;

    }

    public function findById(String $id) : Array
    {
        return [];
    }

    public function findByDeveloper(String $id) : Array
    {
        return [];
    }

}


?>