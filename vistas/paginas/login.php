<?php
    if(isset($_SESSION["validarIngreso"])){
        if($_SESSION["validarIngreso"] == "ok"){
            header("location: inicio");
            return;
        }
    }
?>
<title>Login</title>
<div class="container">
        <div class="contenedor-form">
            <h1>Iniciar Sesión</h1>
            <form action="" method="post" class="form-registro">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <div class="icon-group">
                        <span class="icon"><i class="fas fa-at"></i></span>
                        <input type="text" name="iniciarUser" id="email" placeholder="Ingrese su Nombre de Usuario">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pwd">Contraseña:</label>
                    <div class="icon-group">
                        <span class="icon"><i class="fas fa-key"></i></span>
                        <input type="password" name="iniciarPwd" id="pwd" placeholder="Ingrese su Contraseña">
                    </div>
                </div>
                <input type="submit" value="Iniciar Sesión" class="btn-inicio">
                <?php
                    $ingreso = new ControladorFormularios();
                    $ingreso->crtIniciarSession();
                ?>
            </form>
        </di>
    </div>