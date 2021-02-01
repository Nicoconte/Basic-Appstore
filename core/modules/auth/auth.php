<?php


class Auth
{
    public function isAuthenticated()
    {
        if (isset($_SESSION['CURRENT_USER']['ID']))
        {
            return false;
        }

        return true;
    }

    public function isDevs()
    {
        return $_SESSION['CURRENT_USER']['ROLE'] === "developer";
    }
    
    public function isCustomer()
    {
        return $_SESSION['CURRENT_USER']['ROLE'] === "customer";
    }    
}



?>