<?php


class ViewController 
{
    private $page;
    private $notFoundPage;

    public function __construct($page)
    {

        $this->page = $_SERVER['DOCUMENT_ROOT'] ."/appstore/core/view/" . strtolower($page) . ".php";
        
        //!TODO: Turn it into a constant variable
        $this->notFoundPage = $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/view/not-found.php";

    }

    /**
     * @task View Management. If user access to some missing view it'll redirect him to error page
     */
    public function getPage() 
    {

        if (file_exists($this->page))
        {
            return include $this->page;
        }
        else 
        {
            return include $this->notFoundPage;
        }
 
    }
}


?>