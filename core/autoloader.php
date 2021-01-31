<?php

spl_autoload_register(function($classname) {


    $classname = strtolower($classname);

    $dirs = array(
        $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/config/" . $classname . ".php",
        $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/controller/" . $classname . ".php",
        $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/model/" . $classname . ".php",
        $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/modules/" . $classname . ".php",
        $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/modules/dao/" . $classname . ".php",
        $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/modules/helpers/" . $classname . ".php"
    );

    foreach($dirs as $dir) 
    {
        if (file_exists($dir))
        {
            return include($dir);
        }
    }

});

?>