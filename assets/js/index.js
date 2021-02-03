
const message = {
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
 * 
 * @param {Array} inputs 
 */
const clearInput = (inputs) => {
    return inputs.forEach(input => $(input).val(""));
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

        if (areInputEmpty(["#username", "#user-password", "#user-role"])) {
            message.show("Debe completar los campos", "warning", 2000, "");

            return;
        } 

        let username = $("#username").val();
        let password = $("#user-password").val();
        let role     = $("#user-role").val();

        let body = 
        {
            "body": {
                "username" : username, 
                "password" : password,
                "role" : role,
                "action" : "signup"
            }
        }

        $.post("core/controller/usercontroller.php", body, (response) => {

            if (response.saved) {
                message.show("El registro fue exitoso!", "success", 1500, () => {
                    //Redirect to dashboard
                })

            } else {
                message.show("El usuario ya existe " + fontAwesomeIcon("fa fa-frown-o", "ml-2 mt-1"), "warning", 1500, "Intente con otro :)", () => {
                    clearInput(["#username", "#user-password"]);
                })
            
            }
            
        }, "json");

    })
}



const signin = () => {
    $("#signin-btn").click(function(e) {
        e.preventDefault();

        if (areInputEmpty(["#username", "#user-password"])) {
            message.show("Debe completar los campos", "warning", 2000, "");

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

            if (response.auth)
                message.show(response.details, "success", 1300, "", () => {
                    window.location.reload();
                });

            else
                message.show(response.details + " " + fontAwesomeIcon("fa fa-times", "ml-2 mt-1 text-danger"), "error", 1300, "Revise los datos ingresados!");

        }, "json")

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
                message.show("Cerrando sesion", "warning", 1300, "", () => {
                    window.location.reload();
                });

            else 
                message.show("Error al cerrar sesion " + fontAwesomeIcon("fa fa-times", "ml-2 mt-1 text-danger"), "error", 1300, "Cierre su navegador para cerrar sesion", () => {
                    return;
                })

        }, "json")
    })
}

$(document).ready(() => {
    signup();
    signin();
    signout();
})