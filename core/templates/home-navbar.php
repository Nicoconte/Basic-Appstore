
<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/autoloader.php"; 
    
    $auth = new Auth();
?>

<div class="navbar-container">
    <div class="navbar-logo">
        <a href="index.php?page=home">
            <img src="assets/img/logo.png" alt="">
            <h2>Appstore</h2>
        </a>
    </div>
    <div class="navbar-search-bar">
        <input type="text" class="form-control" id="" placeholder="Nombre de la aplicacion. Ej: Facebook">
    </div>

    <?php

        if ($auth->isDeveloper())
        {
            echo 
            '<div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="index.php?page=developer-dashboard">Ir al panel</a>
                    <button id="signout-btn" class="dropdown-item">Cerrar sesion</button>
                </div>
            </div>';
        } 
        else if ($auth->isCustomer())
        {
            echo 
            '<div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="index.php?page=customer-dashboard">Ir al panel</a>
                    <button id="signout-btn" class="dropdown-item">Cerrar sesion</button>
                </div>
            </div>';
        }
        else 
        {
            echo 
            '<div class="navbar-buttons">
                <a href="index.php?page=signin" class="btn">Iniciar sesion</a>
                <a href="index.php?page=signup" class="btn">Registrarse</a>
            </div>';
        }

    ?>
</div>