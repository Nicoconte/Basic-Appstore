
const signup = () => {

    $("#signup-btn").click(function(e) {

        e.preventDefault();

        let username = $("#username").val();
        let email = $("#user-email").val();
        let password = $("#user-password").val();
    
        let body = 
        {
            "body": {
                "username" : username, 
                "email" : email,
                "password" : password,
                "role" : "developer",
                "action" : "signup"
            }
        }

        $.post("core/controller/usercontroller.php", body, (response) => {

            if (response) {
                alert("Registrado de forma exitosa")
            } else {
                alert("Error al registrarse")
            }
            
        });

    })
}

$(document).ready(() => {
    signup();
    //alert("Hola, mundo")
})