<div class="page-container d-flex justify-content-center">

<div class="w-75 h-100 d-flex justify-content-center flex-column">

    <p> 
        <?php
            
            include $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/autoloader.php";
            
            echo empty($_SESSION['USER']) ? "No hay usuario" : var_dump($_SESSION['USER']); 
        ?>
    </p>

    <p> 
        <?php 
            $auth = new Auth();
            

            echo "Authenticated? => " . $auth->isAuthenticated();

            echo "<br>";

            echo "Developer? => " . $auth->isDeveloper();

            echo "<br>";

            echo "Customer? => " . $auth->isCustomer();

        ?> 
    </p>

    <input type="text" class="mt-3 form-control" id="username" placeholder="Usuario">

    <input type="password" class="mt-3 form-control" id="user-password" placeholder="Contraseña">

    <select class="mt-3 form-control" name="" id="user-role">
        <option value="Seleccione un rol" disabled selected >Seleccione un rol</option>
        <option value="developer">Developer</option>
        <option value="customer">Customer</option>
    </select>

    <button id="signup-btn" class="btn btn-success mt-4">Sign up</button>

    <button id="signin-btn" class="btn btn-info mt-3">Sign in </button>

    <button id="signout-btn" class="btn btn-secondary mt-3">Sign out </button>

</div>

</div>