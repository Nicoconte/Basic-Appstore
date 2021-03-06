<?php

include $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/autoloader.php";

$auth = new Auth();

if ($auth->isAuthenticated() && $auth->isDeveloper())
{
    header("Location: index.php?page=developer-dashboard"); 
}
else if ($auth->isAuthenticated() && $auth->isDeveloper())
{
    header("Location: index.php?page=customer-dashboard");
}

?>

<div class="page-container">

    <div class="signin-container">

        <div class="signin-image">
            <a href="index.php?page=home">
                <img src="assets/img/logo.png" alt="">
                <h2>Appstore</h2>
            </a>            
        </div>

        <div class="signin-form">

            <div class="signin-form-sup">
                <span>
                    <p>No tiene cuenta?</p>
                    <a href="index.php?page=signup" class="btn btn-sm">Registrese</a>
                </span>
            </div>

            <div class="signin-form-mid">

                <blockquote>
                    
                    <h1>Bienvenido nuevamente</h1>
                    <p class="mb-4">Inicie sesion y entre a su cuenta</p>

                    <label class="mt-2" for="username">Nombre de usuario</label>
                    <input type="text" class="form-control" id="username" placeholder="Ej: Juan">

                    <label class="mt-4" for="user-password">Contraseña</label>
                    <input type="password" class="form-control" id="user-password" placeholder="Ej: 123">

                    <button id="signin-btn" class="btn btn-lg mt-5">Iniciar sesion</button>

                </blockquote>

            </div>

            <div class="signin-form-down"></div>

        </div>

    </div>

</div>