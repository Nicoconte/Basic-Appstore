<?php

class MobileApplication
{
    private $id;
    private $creatorId;
    private $name;
    private $description;
    private $category;
    private $price;

    public function __construct($id="", $creatorId, $name="", $description="", $category="", $price=null)
    {
        $this->id = $id;
        $this->creatorId = $creatorId;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getId() 
    {
        return $this->id;
    }

    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;
    }

    public function getCreatorId()
    {
        return $this->creatorId;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setPrice($price) 
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

}


?>