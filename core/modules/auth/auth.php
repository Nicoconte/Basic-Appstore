<?php

class Auth
{
    public function isAuthenticated()
    {
        return !empty($_SESSION['USER']) && $_SESSION['USER'] !== null;
    }

    public function isDeveloper()
    {
        return !empty($_SESSION['USER']) && $_SESSION['USER']['ROLE'] === "developer";
    }
    
    public function isCustomer()
    {
        return !empty($_SESSION['USER']) && $_SESSION['USER']['ROLE'] === "customer";
    }    
}



?>