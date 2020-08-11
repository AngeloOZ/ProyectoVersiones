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
        $action2 = "disabled";
        $datos = array("codigoproducto" => "Generado automático", "nombre" => "", "detalle"=>""); 
    }else if($_GET['action']=='editar'){
        $action = "EDITAR";
        $action2 = "disabled";
        $datos = ModeloFormularios::mdlSelecionarRegistro("productos","codigoproducto",$_GET["token"]);
    }
?>
<a href="productos" class="btn-back" id="back-arrow">
    <span><i class="fas fa-arrow-left"></i></span>
</a>
<div class="container d-flex">
        <div class="editar-form d-flex">
            <h3 class="edit-title"><?php echo $action ?> Producto</h3>
            <form action="" method="post">
                <div class="contenedor-imput">
                    <div class="form-group-edit">
                        <label for="codigoProducto">Código de producto</label>
                        <input type="text" 
                               id="codigoProducto"
                               name="insertarCodigoPro"
                               readonly
                               value="<?php echo $datos["codigoproducto"]?>"
                        >
                    </div>
                    <div class="form-group-edit">
                        <label for="nombreProducto">Nombre del producto</label>
                        <input type="text" placeholder="Nombre del producto" id="nombreProducto" name="insertarNombreProducto" value="<?php echo $datos["nombre"]?>">
                    </div>
                    <div class="form-group-edit">
                        <label for="descripcion">Descripción del Producto</label>
                        <textarea name="insertarDetalle" id="descripcion" cols="30" rows="10" placeholder="Descripción"
                        maxlength="100"><?php echo $datos["detalle"]?></textarea>
                    </div>
                </div>
                <?php
                    if($_GET["action"] == "agregar"){
                        $usuarios = new ControladorProductos;
                        $usuarios->ctrAgregarProducto();
                    }else if($_GET["action"] == "editar"){
                        $usuarios = new ControladorProductos;
                        $usuarios->crtEditarProducto();
                    }
                ?>
                <input type="submit" class="btn-submit" id="btn-submit" value="Guardar">
            </form>
        </div>
    </div>