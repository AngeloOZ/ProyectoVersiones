<?php
    if(!isset($_SESSION["validarIngreso"])){
        header('location: login');
        return;
    }else{
        if($_SESSION["validarIngreso"] != "ok"){
            header('location: login');
        }
    }
?>
<title>Principal</title>
<header class="header">
        <h1>Sistema de Control de Versiones</h1>
    </header>
    <div class="container">
        <div class="contenedor-botones">
            <a href="usuarios" class="btn btn-option">
                <span class="text-inicio"><i class="fas fa-users"></i></span>
                <span class="text-inicio">Usuarios</span>
            </a>
            <a href="productos" class="btn btn-option">
                <span class="text-inicio"><i class="fas fa-boxes"></i></span>
                <span class="text-inicio">Productos</span>
            </a>
            <a href="index.php?pagina=versiones" class="btn btn-option">
                <span class="text-inicio"><i class="fas fa-history"></i></span>
                <span class="text-inicio">Versiones</span>
            </a>
            <a href="index.php?pagina=salir" class="btn btn-option">
                <span class="text-inicio"><i class="fas fa-sign-out-alt"></i></span>
                <span class="text-inicio">Salir</span>
            </a>
        </div>
    </div>