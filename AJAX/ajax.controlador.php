<?php 
    require_once "../modelos/modelos.versiones.php";

    if(isset($_POST["consulUsuario"]) && !empty($_POST["consulUsuario"])){
        $tabla = "usuario";
        $columna = "codigousuario";
        $respuesta = ModelosVersiones::mdlSeleccionarAjax($tabla, $columna, $_POST["consulUsuario"]);
        if(!empty($respuesta)){
            echo json_encode($respuesta);
        }else{
            echo json_encode(null);
        }
    }
    if(isset($_POST["consulProducto"]) && !empty($_POST["consulProducto"])){
        $tabla = "productos";
        $columna = "codigoproducto";
        $respuesta = ModelosVersiones::mdlSeleccionarAjax($tabla, $columna, $_POST["consulProducto"]);
        if(!empty($respuesta)){
            echo json_encode($respuesta);
        }else{
            echo json_encode(null);
        }
    }
