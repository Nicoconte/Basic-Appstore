<?php
session_start();

$view = "";

if (isset($_GET['page']))
{
    $view = $_GET['page'];
} 
else 
{
    $view = "test";
}

?>

<?php include("core/templates/header.php"); ?>
<body>

    <section id="page">
        <?php include("core/view/" . $view . ".php"); ?>
    </section>

<script src="assets/js/index.js"></script>
</body>
</html>