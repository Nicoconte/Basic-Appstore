<?php 


class Utils 
{
    public function decodeClass($object)
    {
        $classname = get_class($object);        
        $attributes = get_class_methods($classname);

        foreach($attributes as $attr)
        {
            echo " => " . $attr . "<br>";
        }
        
    }
}


?>

