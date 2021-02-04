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
            

            echo "Authenticated? => " . $auth->isAuthenticated() . " | ";

            echo "Developer? => " . $auth->isDeveloper() . " | ";

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

    <div class="w-100 d-flex flex-row mt-3">
        <button id="signup-btn" class="btn btn-success">Sign up</button>
        <button id="signin-btn" class="btn btn-info ml-3">Sign in </button>
        <button id="signout-btn" class="btn btn-secondary ml-3">Sign out </button>
    </div>
    
    <h5 class="mt-4">Aplicaciones</h5>

    <input type="text" class="form-control" id="mobile-app-name" placeholder="Nombre">
    
    <textarea placeholder="Descripcion" id="mobile-app-description" class="form-control mt-2" cols="30" rows="10"></textarea>
        
    <input type="number" class="form-control mt-2" name="" id="mobile-app-price" placeholder="Precio">

    <select name="" class="form-control mt-2" id="mobile-app-category">
        <option value="" disabled selected>Elija una categoria</option>
        <option value="entertainment">Entretenimiento</option>
        <option value="social-media">Redes sociales</option>
        <option value="other">Otros</option>
    </select>

    <div class="w-100 d-flex flex-row mt-3">

        <button class="btn btn-sm btn-success" id="create-app-btn">Crear app</button>
        <button class="btn btn-sm btn-danger ml-3">Eliminar app</button>
        <button class="btn btn-sm btn-info ml-3">Actualizar app</button>
    </div>

    <div class="mt-5" id="app"></div>

</div>

</div>