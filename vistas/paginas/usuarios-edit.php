<?php
    if(!isset($_SESSION["validarIngreso"])){
        header('location: login');
        return;
    }else{
        if($_SESSION["validarIngreso"] != "ok"){
            header('location: login');
        }
    }
    if($_GET['action']=='agregar'){
        $action = "AGREGAR";
        $action2 = "enabled";
        $datos = array("codigousuario" => "", "nombre" => "", "nombrereal"=>"", "contrasenia"=>""); 
    }else if($_GET['action']=='editar'){
        $action = "EDITAR";
        $action2 = "readonly";
        $datos = ModeloFormularios::mdlSelecionarRegistro("usuario","codigousuario",$_GET["token"]);
    }
?>
<a href="usuarios" class="btn-back" id="back-arrow">
    <span><i class="fas fa-arrow-left"></i></span>
</a>
<div class="container d-flex">
    <div class="editar-form d-flex">
        <h3 class="edit-title"><?php echo $action?> Usuario</h3>
        <form action="" method="post">
            <div class="contenedor-imput">
                <div class="form-group-edit">
                    <label for="codigo">Código</label>
                    <input type="text" id="codigo" placeholder="Código de usuario" name="insertarCodigo" <?php echo $action ?> value="<?php echo $datos["codigousuario"]?>">
                </div>
                <div class="form-group-edit">
                    <label for="username">Username</label>
                    <input type="text" placeholder="Username" id="username"
                    name="insertarUsername" value="<?php echo $datos["nombre"]?>">
                </div>
                <div class="form-group-edit">
                    <label for="nombre">Nombre y apellido</label>
                    <input type="text" placeholder="Nombre y apellido" id="nombre"
                    name="insertarNombre" value="<?php echo $datos["nombrereal"]?>">
                </div>
                <div class="form-group-edit">
                    <label for="pwd">Contraseña</label>
                    <?php
                        if($_GET["action"] == "editar"){
                            echo '<input type="hidden" name="insertarPwdAntigua"  value="'.$datos["contrasenia"].'">';
                        }
                    ?>
                    <input type="password" name="insertarPwd" id="pwd" placeholder="<?php 
                    if($_GET["action"] == "agregar"){
                        echo "Ingrese su contraseña";
                    }else{
                        echo "Ingrese la nueva contraseña o deje vacio el campo";
                    }
                    ?>">
                </div>
            </div>
            <?php
                if($_GET["action"] == "agregar"){
                    $usuarios = new ControladorUsuarios;
                    $usuarios->ctrRegistrarUsuarios();
                }else if($_GET["action"] == "editar"){
                    $usuarios = new ControladorUsuarios;
                    $usuarios->ctrEditarUsuarios();
                }
            ?>
            <input type="submit" class="btn-submit"
            id="btn-submit" value="Guardar">
        </form>
    </div>
</div>