const signinURL = "index.php?page=signin";
const signupURL = "index.php?page=signup"

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
 * @param {Object} object 
 * @description Bootstrap card template to show avaibable app
 */
const cardTemplate = (object) => {
    return `
    <div class="card" style="width: 18rem;" app=${object.id} creator=${object.creator}>
            <img class="card-img-top" src="assets/img/not-image.png" alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">${object.name}</h5>
            <p class="card-text">${object.description} | ${object.price !== 0 ? "$"+object.price : 'Gratis'}</p>
            <span>
                <a href="#" class="btn btn-primary">Ver mas</a><p>${object.price !== 0 ? "$"+object.price : 'Gratis'}</p>
            </span>
        </div>
    </div>    
    `    
}

/**
 * 
 * @param {Object} object
 * @description Table tr and td template to show developer´s app 
 */
const tableTemplate = (object) => {
    return `
        <tr app=${object.id} creator=${object.creator}>
            <td>${object.name}<td>
            <td>${object.description.length > 20 ? object.description.substring(0, 20)+".." : object.description}<td>
            <td>${object.price}</td>
            <td>
                <button class="delete-mobile-app-btn btn btn-sm btn-danger">
                    ${fontAwesomeIcon('fa fa-trash')}
                </button>
                <button class="update-mobile-app-btn btn btn-sm btn-info">
                    ${fontAwesomeIcon('fa fa-pencil')}
                </button>
            </td>
        </tr>
    `
}

const noResultsTemplate = () => {
    return `<h1>No hay resultados ${fontAwesomeIcon('fa fa-warning')} </h1>`
};

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


const signup = () => {
    $("#signup-btn").click(function(e) {

        e.preventDefault();

        if (areInputEmpty(["#username", "#user-password"])) {
            message.show("Debe completar los campos", "warning", 2500);

            return;
        } 

        let username = $("#username").val();
        let password = $("#user-password").val();
        let role     = $("#user-role").is(":checked") ? "developer" : "customer";

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
                message.show("El registro fue exitoso!", "success", 2500, "", () => {
                    window.location.href = signinURL;
                })

            } else {
                message.show("El usuario ya existe " + fontAwesomeIcon("fa fa-frown-o", "ml-2 mt-1"), "warning", 2500, "Intente con otro :)", () => {
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
            message.show("Debe completar los campos", "warning", 2500, "");

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
                message.show(response.details, "success", 2500, "", () => {
                    window.location.href = response.url
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
                message.show("Cerrando sesion", "warning", 2500, "", () => {
                    window.location.href = "index.php?page=signin"
                });

            else 
                message.show("Error al cerrar sesion " + fontAwesomeIcon("fa fa-times", "ml-2 mt-1 text-danger"), "error", 1300, "Cierre su navegador para cerrar sesion", () => {
                    return;
                })

        }, "json")
    })
}

const createApplication = () => {
    $("#create-app-btn").click(function(e) {
        e.preventDefault();

        if (areInputEmpty(["#mobile-app-name", "#mobile-app-description", "#mobile-app-price"])) {
            message.show("Debe completar los campos", "warning", 2500, "");
            
            return;
        }

        let name = $("#mobile-app-name").val();
        let description = $("#mobile-app-description").val();
        let price = $("#mobile-app-price").val();
        let category = $("#mobile-app-category").val();

        let body = 
        {
            "body" : {
                "name" : name,
                "description" : description,
                "price" : price,
                "category" : category,
                "action" : "create-app"
            }
        }

        $.post("core/controller/mobileapplicationcontroller.php", body, (response) => {

            if (response.saved) 
                message.show("Guardado!", "success", 2500, "La aplicacion se creo con exito", () => {
                    clearInput(["#mobile-app-name", "#mobile-app-price", "#mobile-app-description", "#mobile-app-category"])
                })
            
            else if ('details' in response)
                message.show(response.details, "error", 2500, "Si lo es, inicie sesion");
            
            else
                message.show("Fallo!", "error", 2500, "No se pudo crear la aplicacion revise los datos");
        
        }, "json")


    })
}


const listApplications = () => {
    let body = 
    {
        "body" : {
            "action" : "list-app"
        }
    }   

    let template = ""

    $.post("core/controller/mobileapplicationcontroller.php", body, (response) => {
        
        if (response.length <= 0) {
            template = noResultsTemplate();
        
        } else {
            response.forEach(res => {
                template += cardTemplate(res);
            })
        }

        //$("#app").html(template);

    }, "json")
}


const listDeveloperApplications = () => {
    let body = 
    {
        "body" : {
            "action" : "list-developer-app"
        }
    }

    let template = "";

    $.post("core/controller/mobileapplicationcontroller.php", body, (response) => {
        if (response.length === 0) {
            template = noResultsTemplate();
        } else {
            response.forEach(res => {
                template += tableTemplate(res)
            })
        }

        $("#app").html(template)
    
    }, "json")

}

const deleteApplication = () => {
    $(document).on("click", ".delete-mobile-app-btn", function() {
        
        let htmlParent = $(this)[0].parentElement.parentElement;
        let id = $(htmlParent).attr("app");
        
        console.log(id);

        let body = 
        {
            "body" : {
                "id" : id,
                "action" : "delete-app"
            }    
        }
        
        $.post("core/controller/mobileapplicationcontroller.php", body, (response) => {
        
            if (response.deleted)
                message.show("Aplicacion eliminada", "success", 2500, "", () => {
                    console.log("Hola")
                    listDeveloperApplications()
                })       

            else if ('details' in response)
                message.show(response.details, "error", 2500);

            else
                message.show("No se pudo eliminar", "error", 2500, "Algo ocurrio durante la eliminacion");
        
        }, "json");

    });
}


$(document).ready(() => {
    signup();
    signin();
    signout();

    createApplication();
    //listApplications();
    deleteApplication();
})