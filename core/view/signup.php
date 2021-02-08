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

    <div class="signup-container">

        <div class="signup-image">
            <a href="index.php?page=home">
                <img src="assets/img/logo.png" alt="">
                <h2>Appstore</h2>
            </a>             
        </div>

        <div class="signup-form">

            <div class="signup-form-sup">
                <span>
                    <p>Tiene cuenta?</p>
                    <a href="index.php?page=signin" class="btn btn-sm">Inicie sesion</a>
                </span>
            </div>

            <div class="signup-form-mid">

                <blockquote>
                    
                    <h1>Bienvenido a la Appstore</h1>
                    <p class="mb-4">Registre su cuenta</p>

                    <label class="mt-2" for="username">Nombre de usuario</label>
                    <input type="text" class="form-control" id="username" placeholder="Ej: Juan">

                    <label class="mt-4" for="user-password">Contraseña</label>
                    <input type="password" class="form-control" id="user-password" placeholder="8 caracteres. Ej:!Contra@segur42%">

                    <label class="mt-4" for="user-role">¿Es desarrollador?</label>
                    <input type="checkbox" name="" id="user-role">

                </blockquote>

                <button id="signup-btn" class="btn btn-lg mt-2" disabled>Registrarse</button>

            </div>

            <div class="signup-form-down"></div>

        </div>

    </div>

</div>