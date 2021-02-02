
const messages = {
    show : (message, icon, time, text = "", callback = null) => {
        Swal.fire({
            icon : icon,
            title : message,
            text : text,
            timer : time
        }).then(() => {
            if (callback !== null)
                return callback();
        })
    }
}


/**
 * 
 * @param {String} icon 
 * @param {String} options => Bootstrap attributes
 */
const fontAwesomeIcon = (icon, options = "") => {
    return "<i class='" + options + " " + icon + "'></i>"
}


/**
 * https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/some
 * @param {Array} inputs 
 */
const areInputEmpty = (inputs) => {
    return inputs.some(input => $(input).val().length <= 0 )
}



const signup = () => {

    $("#signup-btn").click(function(e) {

        e.preventDefault();

        if (areInputEmpty(["#username", "#user-password"])) {
            messages.show("Debe completar los campos", "warning", 2000, "");

            return;
        } 

        let username = $("#username").val();
        let password = $("#user-password").val();

        let body = 
        {
            "body": {
                "username" : username, 
                "password" : password,
                "role" : "developer",
                "action" : "signup"
            }
        }

        $.post("core/controller/usercontroller.php", body, (response) => {

            if (response.saved === true) {
                messages.show("El registro fue exitoso!", "success", 1500, () => {
                    //Redirect to dashboard
                })

            } else {
                messages.show("El usuario ya existe " + fontAwesomeIcon("fa fa-frown-o", "ml-2 mt-1"), "warning", 1500, "Intente con otro :)", () => {
                    //Clear form
                })
            
            }
            
        }, "json");

    })
}



const signin = () => {
    $("#signin-btn").click(function(e) {
        e.preventDefault();

        if (areInputEmpty(["#username", "#user-password"])) {
            messages.show("Debe completar los campos", "warning", 2000, "");

            return;
        } 
        
        let username = $("#username").val();
        let password = $("#user-password").val();

        let body = 
        {
            "body": {
                "username" : username,
                "password" : password,
                "action" : "signin"
            }
        }        

        $.post("core/controller/usercontroller.php", body, (response) => {

            if (response.auth === true)
                messages.show("Bienvenido!", "success", 1300, "", () => {
                    window.location.reload();
                });

            else
                console.log("Credenciales invalidas")

        }, "json") // "json" equals to dataType : "JSON"

    })
}



const signout = () => {
    $("#signout-btn").click(function(e) {
        e.preventDefault();

        let body = 
        {
            "body" : {
                "action" : "signout"
            }
        }

        $.post("core/controller/usercontroller.php", body, (response) => {

            if (response.quit === true) 
                messages.show("Cerrando sesion", "warning", 1300, "", () => {
                    window.location.reload();
                });

            else 
                console.log("No se pudo cerrar sesion"); 

        }, "json")
    })
}

$(document).ready(() => {
    signup();
    signin();
    signout();
})