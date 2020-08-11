<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <?php
        if(isset($_GET['pagina'])){
            if($_GET['pagina'] == 'login' ||
               $_GET['pagina'] == 'inicio' ||
               $_GET['pagina'] == 'usuarios' ||
               $_GET['pagina'] == 'productos' ||
               $_GET['pagina'] == 'versiones' ||
               $_GET['pagina'] == 'salir' ||
               $_GET['pagina'] == 'usuarios-edit' ||
               $_GET['pagina'] == 'versiones-edit' ||
               $_GET['pagina'] == 'reporte-version' ||
               $_GET['pagina'] == 'reporte-usuarios' ||
               $_GET['pagina'] == 'reporte-productos' ||
               $_GET['pagina'] == 'productos-edit'
            ){
                include "paginas/".$_GET['pagina'].".php";
            }else{
                echo "Error 404"; //? pendiente incluir 404
            }
        }else{
            include "paginas/login.php";
        } 
    
    
    ?>
    <!-- <script src="./vistas/js/popup.js"></script> -->
</body>
</html>