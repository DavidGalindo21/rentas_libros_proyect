<?php
    session_start();
    include('./rentas_php/Conexion.php');
    if(!isset($_SESSION['rol'])){
        header('location: ./login.php');
    }else{
        if($_SESSION['rol'] != 1){
            header('location: ./login.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style3.css">
    <title>Carrito</title>
</head>

<body>
    <!--NavBar-->
    <div class="nav-container">

        <nav class="navar d-flex justify-content-between align-items-center h-100">
            <a href="./index.php">
                <h1 class="navar-logo">Shop.</h1>
            </a>
            <a href="./rentas_php/cerrar.php" class="btn btn-primary" >Cerrar Sesión</a>
            <h1 class="ver-carrito" id="verCarrito">🛒<span id="cantidadCarrito" class="cantidadCarrito">
            <h1 class="regresar"> Regresar</h1>
        </nav>
    </div>

    <!--banner-->
    <div class="banner">
        <div class="banner-container">
            <h1 class="title">Books Store</h1>
            <p class="p">El mejor lugar donde puedes adquirir los mejores libros</p>
        </div>
    </div>

    <!--shop content-->
    <div id="shopContent" class="shop-Content"></div>
    <!--modal container-->
    <div id="modal-container" class="modal-container"></div>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="./js/animaciones.js"></script>
    <script src="js/products.js"></script>
    <script src="js/app.js"></script>
    <script src="js/carrito.js"></script>
</body>

</html>