<?php

    require_once "controladores/plantilla.controlador.php";
    require_once "controladores/formularios.controlador.php";
    require_once "controladores/usuarios.controlador.php";
    require_once "controladores/productos.controlador.php";
    require_once "controladores/versiones.controlador.php";

    require_once "modelos/modelos.formulario.php";
    require_once "modelos/modelos.usuario.php";
    require_once "modelos/modelos.productos.php";
    require_once "modelos/modelos.versiones.php";



    $plantilla = new ControladorPlantilla();

    $plantilla->ctrTraerPlantilla();