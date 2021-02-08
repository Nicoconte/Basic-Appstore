<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/appstore/core/autoloader.php";

$viewController = new ViewController($_GET['page']);


?>

<?php include("core/templates/header.php"); ?>
<body>

    <section id="page">
        <?php $viewController->getPage() ?>
    </section>

<script src="assets/js/index.js"></script>
</body>
</html>