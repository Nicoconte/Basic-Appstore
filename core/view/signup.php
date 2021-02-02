<div class="page-container d-flex justify-content-center align-items-center">

<div class="w-50 h-75 d-flex justify-content-center flex-column">

    <p> <?php echo empty($_SESSION['USER']) ? "No hay usuario" : var_dump($_SESSION['USER']); ?></p>

    <input type="text" class="mt-3" id="username" placeholder="Usuario">

    <input type="password" class="mt-3" id="user-password" placeholder="Contraseña">

    <button id="signup-btn" class="btn btn-success mt-4">Sign up</button>

    <button id="signin-btn" class="btn btn-info mt-3">Sign in </button>

    <button id="signout-btn" class="btn btn-secondary mt-3">Sign out </button>

</div>

</div>