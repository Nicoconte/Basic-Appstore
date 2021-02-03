<?php
session_start();

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

        if ($user !== null)
        {   

            if ($this->userDAO->exist($user)) return json_encode(array( "success" => false ));

            if ($this->userDAO->save($user))
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

    public function signin(User $user) 
    {
        if ($user !== null)
        {

            $user = $this->userDAO->findByUsernameAndPassword($user);

            if ($user !== null) 
            {

                $_SESSION['USER'] = array(
                    "ID" => $user->getId(),
                    "ROLE" => $user->getRole()
                );

                return json_encode(array(
                    "auth" => true,
                    "details" => "Bienvenido" 
                ));
            } 
            else 
            {
                
                return json_encode(array(
                    "auth" => false,
                    "details" => "Credenciales invalidas"
                ));

            }

        }

        return json_encode(array(
            "auth" => false,
            "details" => "Algo salio mal"
        ));
    }


    public function signout()
    {
        session_destroy();
        unset($_SESSION['USER']);

        return json_encode(array(
            "quit" => empty($_SESSION['USER'])
        ));
    }

}

/** 
 * Fetch POST array and do an action
 * TODO: Refactor. Make it more secure avoiding the calling from another php file
*/

$utils = new Utils();

if(!$utils->isValid($_POST['body'])) 
{ 
    echo die(json_encode(array ("success" => false, "details" => "Empty fields")) );
}

$auth = new Auth();

$userController = new UserController();
$response = null;

switch($_POST['body']['action'])
{
    case "signup":

        $id = $utils->generateUUID();
        $username = $_POST['body']['username'];
        $password = $_POST['body']['password'];
        $role = $_POST['body']['role'];

        $response = $userController->signup(new User($id, $username, $password, $role));
        
        break;

    case "signin":

        $username = $_POST['body']['username'];
        $password = $_POST['body']['password'];

        if ($auth->isAuthenticated())
        {
            echo json_encode(array(
                "auth" => false,
                "details" => "El usuario esta autenticado"
            ));

            break;
        }
        
        $response = $userController->signin(new User("", $username, $password, ""));
       
        break;
    
    case "signout":

        $response = $userController->signout();

        break;

    default:
        break;
}

echo $response;


?>