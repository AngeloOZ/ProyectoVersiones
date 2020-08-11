<?php 
    if(!isset($_SESSION["validarIngreso"])){
        header('location: login');
        return;
    }else{
        if($_SESSION["validarIngreso"] != "ok"){
            header('location: login');
        }
    }
    if($_GET["action"] == "agregar"){
        $action = 'agregar';
        $version = array("id"=>"", "version"=>"","fecha"=>"", "detalle"=>"", "codigousuario"=>"", "codigoproducto"=>"");
    }else{
        $action = "editar";
        $token = $_GET["token"];
        $version = ModeloFormularios::mdlSelecionarRegistro("versiones","id", $token);
    }
?>
<a href="versiones" class="btn-back" id="back-arrow">
    <span><i class="fas fa-arrow-left"></i></span>
</a>
<div class="container d-flex">
    <div class="editar-form d-flex">
        <h3 class="edit-title"><?php echo $action ?> versión</h3>
        <form action="" method="post">
            <div class="contenedor-imput">
                <div class="form-group-edit">
                    <label for="id">Id</label>
                    <input type="text" id="id" readonly placeholder="Generado Automaticamente" value="<?php echo $version["id"] ?>" name="ingresarId">
                </div>
                <div class="form-group-edit double">
                    <label for="codUser">Código de usuario</label>
                    <div class="double">
                        <select name="ingresarUsuario" id="codUser" required>
                            <option value="" selected disabled>Seleccione Usuario</option>
                            <?php 
                                $resp = ControladorFormularios::ctrCargarDatos("usuario");
                                foreach($resp as $id){
                                    if($action == "editar"){
                                        if($version["codigousuario"] == $id['codigousuario']){
                                            $state = "selected";
                                        }else{
                                            $state = "";
                                        }
                                    }
                                    echo '<option value="'.$id['codigousuario'].'"'.$state.'>'.$id['codigousuario'].'</option>';
                                }
                            ?>
                        </select>
                        <input type="text" readonly id="resultUsuario" name="resultUsuario">
                    </div>
                </div>
                <div class="form-group-edit">
                    <label for="codProducto">Código de producto</label>
                    <div class="double">
                        <select name="ingresarProducto" id="codProducto" required>
                        <option value="" selected disabled>Seleccione Producto</option>
                            <?php 
                                $resp = ControladorFormularios::ctrCargarDatos("productos");
                                $state ="";
                                foreach($resp as $id){
                                    if($action == "editar"){
                                        if($version["codigoproducto"] == $id['codigoproducto']){
                                            $state = "selected";
                                        }else{
                                            $state = "";
                                        }
                                    }
                                    echo '<option value="'.$id['codigoproducto'].'"'.$state.'>'.$id['codigoproducto'].'</option>';
                                }
                            ?>
                        </select>
                        <input type="text" readonly name="resultProducto" id="resultProducto">
                    </div>
                </div>
                <div class="form-group-edit">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="ingresarFecha" id="fecha" value="<?php echo $version["fecha"] ?>">
                </div>
                <div class="form-group-edit">
                    <label for="version">Versión</label>
                    <input type="text" placeholder="Versión" id="version" value="<?php echo $version["version"] ?>" name="ingresarVersion">
                </div>
                <div class="form-group-edit">
                    <label for="detalle">Detalle</label>
                    <textarea name="ingresarDetalle" id="detalle" cols="30" rows="10" placeholder="Detalle" maxlength="100"><?php echo $version["detalle"] ?>
                    </textarea>
                </div>
            </div>
            <?php 
                if($_GET["action"] == "agregar"){
                    $ingresarVersion = new ControladorVersion();
                    $ingresarVersion->ctrAgregarVersion();
                }else{
                    $editarVersion = new ControladorVersion();
                    $editarVersion->ctrEditarVersion();
                }
            ?>
            <input type="submit" class="btn-submit"
            id="btn-submit" value="Guardar">
        </form>
    </div>
</div>
<script>
function AJAXVersiones(){
    let xhr;
    const inputUsuario = document.getElementById("codUser");
    const inputProducto = document.getElementById("codProducto");
    
    inputUsuario.addEventListener('change',(e)=>{
        let usuario = inputUsuario.value;
        let datos = new FormData();
        datos.append("consulUsuario",usuario);            
        if(window.XMLHttpRequest){
            xhr = new XMLHttpRequest();
        }else{
            xhr = new ActiveXObject("Microsoft.XMLHTTP")
        }
        xhr.open('POST', 'ajax/ajax.controlador.php');
        xhr.addEventListener('load',()=>{
            const resultUser = document.getElementById("resultUsuario");
            let resul = JSON.parse(xhr.response);
            if(resul != null){
                resultUser.placeholder  = resul["nombre"];
            }else{
                resultUser.value  = "Articulo no registrado";
            }
        })
        xhr.send(datos);
    })
    inputProducto.addEventListener('change',(e)=>{
        let producto = inputProducto.value;
        let datos = new FormData();
        datos.append("consulProducto", producto);            
        if(window.XMLHttpRequest){
            xhr = new XMLHttpRequest();
        }else{
            xhr = new ActiveXObject("Microsoft.XMLHTTP")
        }
        xhr.open('POST', 'ajax/ajax.controlador.php');
        xhr.addEventListener('load',()=>{
            const resultUser = document.getElementById("resultProducto");
            let resul = JSON.parse(xhr.response);
            if(resul != null){
                resultUser.placeholder  = resul["nombre"];
            }else{
                resultUser.value  = "Articulo no registrado";
            }
        })
        xhr.send(datos);
    })
}
AJAXVersiones();
</script>