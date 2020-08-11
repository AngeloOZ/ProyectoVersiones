<?php 
class ControladorVersion{
    public function ctrAgregarVersion(){
        if(isset($_POST["ingresarUsuario"])){
            $usuario = $_POST["ingresarUsuario"];
            $producto = $_POST["ingresarProducto"];
            $fecha = $_POST["ingresarFecha"];
            $version = trim($_POST["ingresarVersion"]);
            $detalle = trim($_POST["ingresarDetalle"]);
            if(!empty($usuario) && !empty($producto) && !empty($fecha) && !empty($version) && !empty($detalle)){
                if($_POST["resultUsuario"] != "Articulo no registrado" && $_POST["resultProducto"] != "Articulo no registrado"){
                    $tabla = "versiones";
                    $datos = array(
                        "usuario" => $usuario,
                        "producto" => $producto,
                        "fecha" => $fecha,
                        "version" => $version,
                        "detalle" => $detalle
                    );
                    $respuesta = ModelosVersiones::mdlInsertarVersion($tabla, $datos);
                    if($respuesta == "ok"){
                        MsgSuccess("Versión registrada correctamente");
                    }else{
                        MsgDanger("Ups hubo un error al registrar la versión $respuesta[1]: $respuesta[2]");
                    }
                    LimpiarCache();
                    echo '
                    <script>
                        setTimeout(()=>{
                            window.location = "versiones";
                        },2000)
                    </script>
                ';
                }else{
                    MsgWarning(("El usuario o el producto no esta registrado"));
                }

            }else{  
                MsgDanger("Todos los campos son obligatorios");
            }
        }
    }
    public function ctrEliminarVersion(){
        if(isset($_POST["eliminarVersion"]) && !empty($_POST["eliminarVersion"])){
            
            $tabla = "versiones";

            $respuesta = ModelosVersiones::mdlEliminarVersion($tabla, $_POST["eliminarVersion"]);

            if($respuesta == "ok"){
                LimpiarCache();
                echo '
                <script>
                    window.location = "versiones";
                </script>
                ';
            }
        }
    }
    public function ctrEditarVersion(){
        if(isset($_POST["ingresarId"])){
            $usuario = $_POST["ingresarUsuario"];
            $producto = $_POST["ingresarProducto"];
            $fecha = $_POST["ingresarFecha"];
            $version = $_POST["ingresarVersion"];
            $detalle = $_POST["ingresarDetalle"];
            if(!empty($usuario) && !empty($producto) && !empty($fecha) && !empty($version) && !empty($detalle)){
                // if($_POST["resultUsuario"] != "Articulo no registrado" && $_POST["resultProducto"] != "Articulo no registrado"){
                    $tabla = "versiones";
                    $datos = array(
                        "usuario" => $usuario,
                        "producto" => $producto,
                        "fecha" => $fecha,
                        "version" => $version,
                        "detalle" => $detalle,
                        "id" => $_POST["ingresarId"]
                    );
                    $respuesta = ModelosVersiones::mdlEditarVersion($tabla, $datos);
                    if($respuesta == "ok"){
                        MsgSuccess("Versión registrada correctamente");

                    }else{
                        MsgDanger("Ups hubo un error al registrar la versión $respuesta[1]: $respuesta[2]");
                    }
                    LimpiarCache();
                    echo '
                    <script>
                        setTimeout(()=>{
                            window.location = "versiones";
                        },2000)
                    </script>
                ';
                // }else{
                //     MsgWarning(("El usuario o el producto no esta registrado"));
                // }

            }else{  
                MsgDanger("Todos los campos son obligatorios");
            }
        }
    }
}
