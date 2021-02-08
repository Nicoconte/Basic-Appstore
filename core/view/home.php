<div class="page-container">

    <?php include $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/templates/home-navbar.php" ?>

    <div class="home-content">
        <div class="home-apps-preview" id="app-preview"></div>
    </div>

</div>


<script>

const listApplications = () => {
    let body = 
    {
        "body" : {
            "action" : "list-app"
        }
    }   

    let template = "";

    $.post("core/controller/mobileapplicationcontroller.php", body, (response) => {
        
        if (response.length <= 0) {
            template = noResultsTemplate();
        
        } else {

            response.forEach(res => {
                template += cardTemplate(res);
            })
        }

        $("#app-preview").html(template);

    }, "json")
}

listApplications();

</script>