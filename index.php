<?php

$view = "";

if (isset($_GET['page']))
{
    $view = $_GET['page'];
} 
else 
{
    $view = "home";
}

?>

<?php include("core/view/header.php"); ?>
<body>

    <section id="page">
        <?php include("core/view/" . $view . ".php"); ?>
    </section>

<script src="assets/js/index.js"></script>
</body>
</html>