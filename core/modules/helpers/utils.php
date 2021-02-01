<?php 


class Utils 
{
    public function isValid($post) 
    {   

        if (!is_array($post)) 
        {
            $post = json_decode($post);
        }

        foreach($post as $value) 
        {
            if (empty($value) || $value === null)
            {   
                return false;
            }
        }

        return true;
    }

    //https://www.php.net/manual/es/function.uniqid.php
    public function generateUUID() 
    {   
        $length = 32;

        if (function_exists("random_bytes")) 
        {
            $bytes = random_bytes(ceil($length / 2));
        } 
        elseif (function_exists("openssl_random_pseudo_bytes")) 
        {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } 
        else 
        {
            throw new Exception("no cryptographically secure random function available");
        }
        
        return substr(bin2hex($bytes), 0, $length);
    }

}


?>

