<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/autoloader.php";

class MobileApplicationController
{
    private MobileApplicationDAO $mobileApplicationDAO;

    public function __construct()
    {
        $this->mobileApplicationDAO = new MobileApplicationDAO();
    }

    public function createMobileApplication(MobileApplication $mobileApplication) 
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

    public function listMobileApplications() : Array
    {   
        return $this->mobileApplicationDAO->list();
    }

    public function getMobileApplication(String $id) : Array 
    {   
        if ($id !== null)
            return $this->mobileApplicationDAO->findById($id);
        
        return null;
    }

    public function listDeveloperMobileApplications(String $creatorId) : Array
    {   
        if ($creatorId !== null)
            return $this->mobileApplicationDAO->findByDeveloper($creatorId);

        return null;
    }

    public function deleteMobileApplication(String $id, String $creatorId)
    {
        if ($id !== null && $creatorId !== null) 
        {
            if ($this->mobileApplicationDAO->delete($id, $creatorId))
            {
                return json_encode(array(
                    "deleted" => true
                ));
            }

            return json_encode(array(
                "deleted" => false
            ));            
        }

        return json_encode(array(
            "deleted" => false
        ));
    }

    public function updateMobileApplication(MobileApplication $mobileApplication)
    {
        if ($mobileApplication !== null)
        {
            if ($this->mobileApplicationDAO->update($mobileApplication))
            {
                return json_encode(array(
                    "updated" => true
                ));
            }

            return json_encode(array(
                "updated" => false
            ));            
        }

        return json_encode(array(
            "updated" => false
        ));
    }

}

$utils = new Utils();

if (!$utils->isValid($_POST['body']))
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

            $response = $mobileApplicationController->createMobileApplication($application);

        }
        else 
        {   
            $response = json_encode(array(
                "saved" => false, 
                "details" => "Debe ser un desarrollador para publicar",
            ));
        }
        
        break;

    case "list-app":
        
        $response = json_encode($mobileApplicationController->listMobileApplications());
        
        break;

    case "single-app":
        
        $id = $_POST['body']['id'];
        $response = json_encode($mobileApplicationController->getMobileApplication($id));

        break;

    case "list-developer-app":

        $creatorId = $_SESSION['USER']['ID'];  
        $response = json_encode($mobileApplicationController->listDeveloperMobileApplications($creatorId));

        break;

    case "delete-app":

        if ($auth->isAuthenticated() && $auth->isDeveloper())
        {
            $id = $_POST['body']['id'];
            $creatorId = $_SESSION['USER']['ID'];
            $response = $mobileApplicationController->deleteMobileApplication($id, $creatorId);
        }
        else 
        {
            $response = json_encode(array(
                "deleted" => false, 
                "details" => "Debe ser un desarrollador para eliminar",
                "auth" => $auth->isDeveloper()
            ));            
        }

        break;

    case "update-app":

        if ($auth->isAuthenticated() && $auth->isDeveloper())
        {
            $id = $_POST['body']['id'];
            $description = $_POST['body']['description'];
            $price = $_POST['body']['price'];
            $mobileApplication = new MobileApplication($id, "", "", $description, "", $price);

            $response = $mobileApplicationController->updateMobileApplication($mobileApplication);
        }
        else 
        {
            $response = json_encode(array(
                "deleted" => false, 
                "details" => "Debe ser un desarrollador para actualizar",
            ));            
        }

        break;        
    
    default:
        break;
}

echo $response;

?>