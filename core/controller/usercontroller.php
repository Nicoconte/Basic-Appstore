<?php

include $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/autoloader.php";

class UserController
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function signup(User $user) 
    {
        $saved = null;

        if ($user !== null)
        {
            $saved = $this->userDAO->save($user);

            if ($saved)
            {
                return json_encode(array(
                    "success" => true
                ));
            } 
            else 
            {
                return json_encode(array(
                    "success" => false
                ));
            }

        }

        return json_encode(array(
            "success" => false
        ));

    }

    public function signin(User $entryUser) 
    {
        if ($entryUser !== null)
        {

            $user = $this->userDAO->exist($entryUser);
            

            if ($user !== null) 
            {
                $_SESSION['CURRENT_USER'] = array(
                    "ID" => $user->getId(),
                    "ROLE" => $user->getRole()
                );
            } 
            else 
            {
                
                return json_encode(array(
                    "details" => "Invalid credentials"
                ));

            }

        }

        return json_encode(array(
            "details" => "Something goes wrong with the authentication"
        ));
    }

}

/** 
 * Fetch POST array and do an action
 * 
*/

$utils = new Utils();

if(!$utils->isValid($_POST['body'])) 
    echo json_encode(array(
        "success" => false,
        "details" => "Empty fields"
    ));

    return;

$userController = new UserController();


switch($_POST['body']['action'])
{
    case "signup":
        $id = $utils->generateUUID();
        $username = $_POST['body']['username'];
        $password = $_POST['body']['password'];
        $role = $_POST['body']['role'];

        $response = $userController->signup(new User($id, $username, $password, $role));
        echo $response;
        
        break;

    case "signin":

        $username = $_POST['body']['username'];
        $password = $_POST['body']['password'];
        
        $response = $userController->signin(new User("", $username, $password, ""));
        echo $response;

        break;
    
    default:
        break;
}



?>