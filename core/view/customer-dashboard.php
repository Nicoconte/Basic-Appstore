<?php 

include $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/autoloader.php";

$auth = new Auth();

if (!$auth->isCustomer())
{
    header("Location: index.php?page=signin"); 
}


?>

<h1>Hola, soy un cliente</h1>

<button id="signout-btn" class="btn btn-info">Cerrar sesion</button>
