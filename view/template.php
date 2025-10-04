<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Flow</title>
    <link rel="icon" type="image/png" href="view/img/cheque.png">
    <link rel="stylesheet" href="view/css/w3.css">
    <link rel="stylesheet" href="view/css/w3-colors-win8.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.js"></script>
</head>

<body class="w3-small">

    <?php 
        include "pages/header.php";
    ?>

    <?php if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"): ?>

        <section class="w3-container w3-content w3-border w3-padding-32">

            <?php 

                include "pages/menu.php";
            
            ?>

            <hr>

            <?php
            
                if(isset($_GET["route"])) {

                    if($_GET["route"] == "welcome" || 
                    $_GET["route"] == "task" ||
                    $_GET["route"] == "new-task" ||
                    $_GET["route"] == "update-task" ||
                    $_GET["route"] == "delete-task" ||
                    $_GET["route"] == "view-task" ||
                    $_GET["route"] == "users") {

                        include "pages/".$_GET["route"].".php";

                    } else {
                        
                        include "pages/404.php";
                    }

                } else {

                    include "pages/welcome.php";

                }

            
            ?>

        </section>

        <?php else: ?>

            <?php
            
                include "pages/login.php";
                
            ?>

    <?php endif ?>


    <?php 

        include "pages/footer.php";
    
    ?>
</body>

</html>

<script>

    function myFunction() {
        let x = document.body;
        x.classList.toggle("w3-black");
    }
</script>