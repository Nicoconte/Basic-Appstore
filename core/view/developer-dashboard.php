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

<button class="btn btn-secondary ml-3" data-toggle="modal" data-target="#exampleModal">Nueva app</button>

<table class="table table-striped mt-4">
    <tbody id="app"></tbody>
</table>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nueva aplicacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" id="mobile-app-name" placeholder="Nombre">
    
        <textarea placeholder="Descripcion" id="mobile-app-description" class="form-control mt-2" cols="30" rows="10"></textarea>
            
        <input type="number" class="form-control mt-2" name="" id="mobile-app-price" placeholder="Precio">

        <select name="" class="form-control mt-2" id="mobile-app-category">
            <option value="" disabled selected>Elija una categoria</option>
            <option value="entertainment">Entretenimiento</option>
            <option value="social-media">Redes sociales</option>
            <option value="other">Otros</option>
        </select>
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-success" id="create-app-btn">Crear app</button>
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

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