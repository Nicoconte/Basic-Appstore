<?php

class MobileApplicationDAO extends DAO
{   

    private Array $mobileApplications = array();

    public function __construct()
    {
        $this->database = new Database();
        $this->conn = $this->database->getConnection();   
    }   


    /**
     * @param MobileApplication $mobileApplication
     * @return Boolean
     */
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


    /**
     * @return Array 
     */
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

        return [];

    }


    /**
     * @param String $id
     * @return Boolean
     */
    public function delete(String $id, String $creatorId) : bool
    {

        if ($id !== null)
        {
            $this->sql = "DELETE FROM mobile_applications WHERE id=? and creator_id=?";

            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bind_param("ss", $id, $creatorId);
            $this->stmt->execute();

            if ($this->stmt->affected_rows > 0)
            {
                return true;
            }

            return false;

        }

        return false;
    }

    
    /**
     * @param MobileApplication $mobileApplication 
     * @return Boolean
     */
    public function update(MobileApplication $mobileApplication) : bool
    {

        if ($mobileApplication !== null)
        {
            $this->sql = "UPDATE mobile_applications SET description=?, price=? WHERE id=?";

            $description = $mobileApplication->getDescription();
            $price = $mobileApplication->getPrice();
            $id = $mobileApplication->getId();

            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bind_param("sds", $description, $price, $id);
            $this->stmt->execute();

            if ($this->stmt->affected_row > 0)
            {
                return true;
            }

            return false;

        }

        return false;
    }


    /**
     * @param String $id
     * @return Array
     */
    public function findById(String $id) : Array
    {
        
        if ($id !== null) 
        {
            $this->sql = "SELECT id, creator_id, name, description, category, price FROM mobile_applications WHERE id=?";

            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bind_param("s", $id);
            $this->stmt->execute();

            $this->result = $this->stmt->get_result();

            if ($this->result->num_rows > 0)
            {
                $this->row = $this->result->fetch_assoc();

                $this->mobileApplications[] = array(
                    "id" => $this->row['id'], 
                    "creator" => $this->row['creator_id'], 
                    "name" => $this->row['name'], 
                    "description" => $this->row['description'], 
                    "category" => $this->row['category'], 
                    "price" => $this->row['price']
                );

                return $this->mobileApplications;

            }

            return [];

        }   

        return [];
    }


    /**
     * @param String $creatorId
     * @return Array
     */
    public function findByDeveloper(String $creatorId) : Array
    {
        if ($creatorId !== null)
        {
            $this->sql = "SELECT id, creator_id, name, description, category, price FROM mobile_applications WHERE creator_id=?";

            $this->stmt = $this->conn->prepare($this->sql);
            $this->stmt->bind_param("s", $creatorId);
            $this->stmt->execute();

            $this->result = $this->stmt->get_result();

            if ($this->result->num_rows > 0)
            {
                while ($this->row = $this->result->fetch_assoc())
                {
                    $this->mobileApplications[] = array(
                        "id" => $this->row['id'], 
                        "creator" => $this->row['creator_id'], 
                        "name" => $this->row['name'], 
                        "description" => $this->row['description'], 
                        "category" => $this->row['category'], 
                        "price" => $this->row['price']
                    );                    
                }

                return $this->mobileApplications;
            }

            return [];
        }

        return [];
    }

}


?>