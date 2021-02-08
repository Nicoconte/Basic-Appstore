<?php 

include $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/autoloader.php";

$auth = new Auth();

if (!$auth->isDeveloper())
{
    header("Location: index.php?page=signin"); 
}

?>

<h1 class="ml-3">Hola, soy un dev</h1>

<button id="signout-btn" class="btn btn-info ml-3">Cerrar sesion</button>

<table class="table table-striped mt-4">
    <tbody id="app"></tbody>
</table>

<script>
    
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

listDeveloperApplications();

</script>