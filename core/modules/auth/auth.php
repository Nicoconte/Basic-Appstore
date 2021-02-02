<?php

class Auth
{
    public function isAuthenticated()
    {
        return $_SESSION['USER'] === null;
    }

    public function isDeveloper()
    {
        return $_SESSION['USER']['ROLE'] === "developer";
    }
    
    public function isCustomer()
    {
        return $_SESSION['USER']['ROLE'] === "customer";
    }    
}



?>