<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/autoloader.php";

class MobileApplicationController
{
    private $mobileApplicationDAO;

    public function __construct()
    {
        $this->mobileApplicationDAO = new MobileApplicationDAO();
    }

    public function createApplication(MobileApplication $mobileApplication)
    {
        if ($mobileApplication !== null)
        {
            if ($this->mobileApplicationDAO->save($mobileApplication))
            {
                return json_encode(array(
                    "saved" => true
                ));
            }
            else
            {
                return json_encode(array(
                    "saved" => false
                ));
            }
        }

        return json_encode(array(
            "saved" => false
        ));
    }

}

$utils = new Utils();

if ($utils->isValid($_POST['body']))
{
    echo die(json_encode(array ("success" => false, "details" => "Empty fields")) );    
}

$auth = new Auth();

$mobileApplicationController = new MobileApplicationController();
$response = null;


switch($_POST['body']['action'])
{
    case "create-app":
        
        if ($auth->isAuthenticated() && $auth->isDeveloper())
        {
            $id = $utils->generateUUID();
            $creatorId = $_SESSION['USER']['ID'];
            $name = $_POST['body']['name'];
            $description = $_POST['body']['description'];
            $category = $_POST['body']['category'];
            $price = $_POST['body']['price'];

            $application = new MobileApplication($id, $creatorId, $name, $description, $category, $price);

            $reponse = $mobileApplicationController->createApplication($application);

        }
        else 
        {
            $reponse = json_encode(array(
                "saved" => false,
                "details" => "Debe ser un desarrollador para publicar"
            ));
        }
        
        break;

    default:
        break;
}

echo $response

?>