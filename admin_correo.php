<?php

    session_start();
    if (!isset($_SESSION['id'])){
        setcookie("error","No tenés permiso para acceder a esta sección",time()+1,"/");
        header("Location:index.html");
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <title>Green Guial</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!--bootstrap-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/styleadmin.css" rel="stylesheet" />

</head>
<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-secondary" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger text-success" href="#page-top"><img src="assets/img/navbar-logo.svg" alt="" />Green guial</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ml-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="admin.php">Recetas</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger active" href="#">Correo</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="php_core/cerrar_sesion.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
</body>
</html>